<?php

namespace App\Http\Controllers;

use App\Http\Requests\FleetBuilderFormRequest;
use App\Models\Faction;
use App\Models\Fleet;
use App\Models\FleetList;
use App\Models\FleetBuilder\FleetShip;
use App\Models\Ship;
use App\Services\ArmamentService;
use App\Services\FleetBuilderService;
use App\Services\RefitService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Spatie\Browsershot\Browsershot;
use Spatie\LaravelPdf\Facades\Pdf;

class FleetBuilderController extends Controller
{
    private FleetBuilderService $fleetBuilderService;
    private RefitService $refitService;
    private ArmamentService $armamentService;

    /**
     * @param FleetBuilderService $fleetBuilderService
     */
    public function __construct(FleetBuilderService $fleetBuilderService, RefitService $refitService, ArmamentService $armamentService) {
        $this->fleetBuilderService = $fleetBuilderService;
        $this->refitService = $refitService;
        $this->armamentService = $armamentService;
    }

    /**
     * First step in opening fleet builder - creating a new fleet
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
            $ships = $fleet->ships()
                ->with(['armaments', 'rules', 'refitParents', 'modifications'])
                ->withPivot('id', 'points', 'speed', 'turns', 'shields', 'armour', 'turrets')
                ->get();
            $shipOrder = $this->fleetBuilderService->shipTypeOrder;

            foreach ($ships as $ship) {
                $ship = $this->refitService->rebuildRefitRelation($ship);
                $ship = $this->armamentService->rebuildArmRelation($ship);
                $ship->order = $shipOrder[$ship->type];
            }
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
        $ship->load(['armaments', 'rules', 'refitParents', 'modifications']);
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
        $fleet->points = $this->fleetBuilderService->calculatePoints($fleet, $shipPoints);
        $fleet->save();

        //Get last attached ship id for frontend data attribute
        $shipPivot = $fleet->ships()->newPivotStatement()
            ->select('id')
            ->where('ship_id', $ship->id)
            ->latest('id')
            ->first();
        $ship->pivot_id = $shipPivot->id;


        return response()->json([
            'message' => 'Ship added to fleet.',
            'html' => View::make('components.fleet-builder.ship-profile-card', compact('ship', 'shipOrder'))->render(),
            'points' => $fleet->points
        ]);
    }

    public function detachShipFromFleet(Fleet $fleet, int $shipPivotId) : JsonResponse
    {
        $shipPivot = $fleet->ships()->newPivotStatement()
            ->where('id', $shipPivotId)
            ->first();

        $shipPoints = $shipPivot->points;
        $fleet->points = $this->fleetBuilderService->calculatePoints($fleet, -($shipPoints));
        $fleet->save();

        $fleet->ships()->newPivotStatement()
            ->where('id', $shipPivotId)
            ->delete();

        return response()->json([
            'message' => 'Ship removed from fleet.',
            'points' => $fleet->points
        ]);
    }

    public function refitShip(Fleet $fleet, FleetShip $fleetShip, Request $request) : JsonResponse
    {
        $selectedRefits = $request->get('selected-refits');

        $syncResult = $fleetShip->appliedRefits()->sync($selectedRefits);

        $this->refitService->handleAppliedRefits($syncResult, $fleetShip, $fleet);

        dd($syncResult);
    }

    public function getFleetAsPdf(Faction $faction, FleetList $fleetList, Request $request)
    {
        try {
            $shipsData = $request->get('ships');

            if (!is_array($shipsData)) {
                return response()->json(['error' => 'Invalid ships data'], 400);
            }

            $ships = collect();
            foreach ($shipsData as $shipData) {
                $ship = Ship::findOrFail($shipData['id']);
                if ($ship) {
                    $ship->name = $shipData['name'];
                    $ship->order = $shipData['order'];
                    $ship->points = $shipData['points'];
                    $ship->ld = $shipData['ld'];

                    $ships->push($ship);
                }
            }

            $ships = $ships->sortBy('order');

            return Pdf::view('pages.fleet-export', compact('faction', 'ships', 'fleetList'))
                ->withBrowsershot(function (Browsershot $browsershot) {
                    $customCachePath = env('PUPPETEER_CACHE_PATH');

                    $browsershot->scale(0.55)
                        ->setOption('puppeteer:cacheDirectory', $customCachePath);
                })
                ->format('a4')
                ->download('fleet-export.pdf');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred while generating the PDF.'], 500);
        }
    }

    //TODO: for pdf testing, remove after pdf export fully completed
    public function testPdf(Faction $faction, FleetList $fleetList, Request $request)
    {
        $shipsData = $request->get('ships');
        $ships = collect();
        foreach ($shipsData as $shipData) {
            $ship = Ship::findOrFail($shipData['id']);
            if($ship) {
                $ship->name = $shipData['name'];
                $ship->order = $shipData['order'];
                $ship->points = $shipData['points'];
                $ship->ld = $shipData['ld'];

                $ships->push($ship);
            }
        }

        $ships->sortBy('order');

        return view('pages.fleet-export', compact('faction', 'ships', 'fleetList'));
    }
}
