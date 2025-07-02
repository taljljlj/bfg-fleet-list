<?php

namespace App\Http\Controllers;

use App\Helpers\FleetBuilderUtils;
use App\Http\Requests\FleetBuilderFormRequest;
use App\Models\Faction;
use App\Models\Fleet;
use App\Models\FleetList;
use App\Models\FleetBuilder\FleetShip;
use App\Models\Ship;
use App\Services\FleetBuilderService;
use App\Services\RefitService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Spatie\Browsershot\Browsershot;
use Spatie\LaravelPdf\Facades\Pdf;

class FleetBuilderController extends Controller
{
    private FleetBuilderService $fleetBuilderService;
    private RefitService $refitService;

    /**
     * @param FleetBuilderService $fleetBuilderService
     * @param RefitService $refitService
     */
    public function __construct(FleetBuilderService $fleetBuilderService, RefitService $refitService) {
        $this->fleetBuilderService = $fleetBuilderService;
        $this->refitService = $refitService;}

    /**
     * The first step in opening fleet builder - creating a new fleet
     * Redirects to fleet builder page
     * @return RedirectResponse
     */
    public function index() : RedirectResponse
    {
        $fleet = $this->fleetBuilderService->createFleetInitial();

        return redirect()->route('builder.edit', ['fleet' => $fleet]);
    }

    /**
     * First step in opening fleet builder if faction hotpick was selected - create new fleet, prefill fleet-faction relation
     * Redirects to fleet builder page
     * @param Faction $faction
     * @return RedirectResponse
     */
    public function hotpickIndex(Faction $faction) : RedirectResponse
    {
        $fleet = $this->fleetBuilderService->createFleetInitial();
        $fleet = $this->fleetBuilderService->hotpickFaction($fleet, $faction->id);

        return redirect()->route('builder.edit', ['fleet' => $fleet]);
    }

    /**
     * Returns Fleet Builder page blank or prefilled with params
     * @param Fleet $fleet
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit(Fleet $fleet)
    {
        $factions = Faction::all();

        //If fleet has selected faction (hotpick and edit fleet)
        $fleetLists = null;
        if ($fleet->faction_id) {
            $fleetLists = FleetList::getByFactionId($fleet->faction_id);
        }

        //If fleet has selected fleet list
        $selectedFleetList = null;
        $shipList = null;
        if ($fleet->fleet_list_id) {
            $selectedFleetList = FleetList::findOrFail($fleet->fleet_list_id);
            $shipList = $this->fleetBuilderService->getShipsByFleetList($selectedFleetList);
        }

        //If fleet has attached ships return full list and assign order for frontend
        $ships = null;
        if ($fleet->ships()->exists()) {
            $ships = $this->fleetBuilderService->loadAndPrepareShips($fleet->ships(), true);
        }

        return view('pages.fleet-builder', compact(
            'fleet',
            'factions',
            'fleetLists',
            'selectedFleetList',
            'shipList',
            'ships',
        ));
    }

    /**
     * @param FleetBuilderFormRequest $request
     * @param Faction $faction
     * @return JsonResponse
     */
    public function setFaction(Fleet $fleet, Faction $faction) : JsonResponse
    {
        $fleetLists = $faction->fleetLists()->get();

        $fleet->points = 0;
        $fleet->faction()->associate($faction);
        $fleet->fleetList()->dissociate();
        $fleet->ships()->detach();
        $fleet->save();

        return response()->json([
            'message' => 'Faction selected.',
            'faction' => $faction,
            'fleetLists' => $fleetLists
        ]);
    }

    /**
     * @param FleetBuilderFormRequest $request
     * @return JsonResponse
     */
    public function setFleetList(Fleet $fleet, FleetList $fleetList) : JsonResponse
    {
        $shipList = $this->fleetBuilderService->getShipsByFleetList($fleetList);

        $fleet->fleetList()->associate($fleetList);
        $fleet->save();

        $msg = "Fleet list selected.";

        $excludedShipsData = null;
        if ($fleet->ships()->exists()) {
            $syncShips = $fleet->ships()->sync($fleet->shipsInFleetList($fleetList)->pluck('ships.id')->toArray());

            if ($syncShips['detached']) {
                $msg .= " Some ships have been removed as they are not compatible with selected fleet list.";

                $fleet->points = $fleet->ships()->sum('fleet_ship.points');
                $fleet->save();

                $excludedShipsData = [
                    'points' => $fleet->points,
                    'shipIds' => collect($syncShips['detached'])->unique()->values()->toArray(),
                ];
            }
        }

        return response()->json([
            'message' => $msg,
            'fleetList' => $fleetList,
            'shipList' => $shipList,
            'excludedShipsData' => $excludedShipsData,
        ]);
    }

    public function attachShipToFleet(Fleet $fleet, Ship $ship) : JsonResponse
    {
        //Prepare Ship object
        $ship->load(['armaments', 'rules', 'refits', 'modifications']);
        $ship = $this->refitService->rebuildRefitRelation($ship);

        //Prepare ship profile vars
        $shipOrder = $this->fleetBuilderService->shipTypeOrder[$ship->type];
        $shipPoints = $ship->points;

        //Update fleet
        $fleet->ships()->attach(
            $ship,
            [
                'points' => $shipPoints,
                'speed' => $ship->speed,
                'turns' => $ship->turns,
                'shields' => $ship->shields,
                'armour' => $ship->armour,
                'turrets' => $ship->turrets
            ]
        );
        $fleet->points = FleetBuilderUtils::calculatePoints($fleet, $shipPoints);
        $fleet->save();

        //Get last attached ship id for frontend data attribute
        $shipPivot = $fleet->ships()->newPivotStatement()
            ->select('id')
            ->where('ship_id', $ship->id)
            ->latest('id')
            ->first();
        $ship->setRelation('pivot', $shipPivot);

        return response()->json([
            'message' => 'Ship added to fleet.',
            'html' => View::make('components.fleet-builder.ship-profile-card', compact('ship', 'shipOrder'))->render(),
            'points' => $fleet->points
        ]);
    }

    public function detachShipFromFleet(Fleet $fleet, int $shipPivotId) : JsonResponse
    {
        $fleetShip = FleetShip::findOrFail($shipPivotId);

        $shipPoints = $fleetShip->points;

        $fleetShip->delete();

        $fleet->points = FleetBuilderUtils::calculatePoints($fleet, -($shipPoints));
        $fleet->save();

        return response()->json([
            'message' => 'Ship removed from fleet.',
            'points' => $fleet->points
        ]);
    }

    public function refitShip(Fleet $fleet, FleetShip $fleetShip, Request $request) : JsonResponse
    {
        $selectedRefits = $request->get('selected-refits');

        $syncResult = $fleetShip->appliedRefits()->sync($selectedRefits);

        $refittedSections = $this->refitService->handleAppliedRefits($syncResult, $fleetShip, $fleet);

        $ship = $this->fleetBuilderService->loadAndPrepareShips($fleet->ships()->wherePivot('id', $fleetShip->id), false, true);

        $htmlData = [];
        if ($refittedSections['shipModified']) {
            //render the ship stats component and return to the frontend
            $htmlData['stats'] = View::make(
                'components.fleet-builder.ship-profile-sections.ship-profile-stats-section',
                [ 'ship' => $ship ]
            )->render();
        }
        if ($refittedSections['armModified']) {
            //render the armament table component and return to the frontend
            $htmlData['armaments'] = View::make(
                'components.fleet-builder.ship-profile-sections.ship-profile-armaments-section',
                [ 'armaments' => $ship->armaments ]
            )->render();
        }
        if ($refittedSections['ruleModified']) {
            //render the rule list component and return to the frontend
            $htmlData['rules'] = View::make(
                'components.fleet-builder.ship-profile-sections.ship-profile-rules-section',
                [ 'rules' => $ship->rules ]
            )->render();
        }

        $points = [
            'fleet' => $fleet->points,
            'ship' => $ship->pivot->points,
        ];

        return response()->json([
            'htmlData' => $htmlData,
            'refittedSections' => $refittedSections,
            'pointsData' => $points
        ]);
    }

    public function getFleetAsPdf(Fleet $fleet)

    {
        try {
            $shipsGrouped = $fleet->ships()->withPivot('points')->with(['armaments', 'rules'])->get()->groupBy('type');
            $shipsGrouped = $this->fleetBuilderService->sortShips($shipsGrouped);

            $faction = $fleet->faction()->first();
            $fleetList = $fleet->fleetList()->first();

            $pdf = Pdf::view('pages.fleet-export', compact('faction', 'shipsGrouped', 'fleetList', 'fleet'))
                ->withBrowsershot(fn(Browsershot $browsershot) =>
                    $browsershot->scale(0.55)
                        ->noSandbox() //PDF generation stalls with sandbox on Windows. Might be redundant if hosted on Linux but security implications are low as there is no backdoor to inject malicious html
                )
                ->format('a4')
                ->download('fleet-export-' . $fleet->id . '.pdf');

            return $pdf;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    //TODO: for pdf testing, remove after pdf export fully completed
    public function testPdf(Fleet $fleet)
    {
        $shipsGrouped = $fleet->ships()->withPivot('points')->with(['armaments', 'rules'])->get()->groupBy('type');
        $shipsGrouped = $this->fleetBuilderService->sortShips($shipsGrouped);

        $faction = $fleet->faction()->first();
        $fleetList = $fleet->fleetList()->first();

        return view('pages.fleet-export', compact('faction', 'shipsGrouped', 'fleetList', 'fleet'));
    }
}
