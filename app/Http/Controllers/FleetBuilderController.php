<?php

namespace App\Http\Controllers;

use App\Http\Requests\FleetBuilderFormRequest;
use App\Models\Faction;
use App\Models\Fleet;
use App\Models\FleetList;
use App\Models\Ship;
use App\Services\FleetBuilderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Spatie\Browsershot\Browsershot;
use Spatie\LaravelPdf\Facades\Pdf;

class FleetBuilderController extends Controller
{
    private FleetBuilderService $fleetBuilderService;

    /**
     * @param FleetBuilderService $fleetBuilderService
     */
    public function __construct(FleetBuilderService $fleetBuilderService) {
        $this->fleetBuilderService = $fleetBuilderService;
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

        //If fleet has selected fleet list (edit fleet)
        $selectedFleetList = null;
        $shipList = null;
        if ($fleet->fleet_list_id) {
            $selectedFleetList = FleetList::findOrFail($fleet->fleet_list_id);
            $shipList = $this->fleetBuilderService->getShipsByFleetList($selectedFleetList);
        }

        return view('pages.fleet-builder', compact(
            'fleet',
            'factions',
            'fleetLists',
            'selectedFleetList',
            'shipList'
        ));
    }

    /**
     * @param FleetBuilderFormRequest $request
     * @param Faction $faction
     * @return JsonResponse
     */
    public function upsertFaction(FleetBuilderFormRequest $request, Faction $faction) : JsonResponse
    {
        $fleetLists = $faction->fleetLists()->get();

        $fleet = Fleet::findOrFail($request->input('fleetId'));
        $fleet->faction()->associate($faction);
        $fleet->fleetList()->dissociate();
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
    public function upsertFleetList(FleetBuilderFormRequest $request, FleetList $fleetList) : JsonResponse
    {
        $ships = $this->fleetBuilderService->getShipsByFleetList($fleetList);

        $fleet = Fleet::findOrFail($request->input('fleetId'));
        $fleet->fleetList()->associate($fleetList);
        $fleet->save();

        return response()->json([
            'message' => 'Fleet List selected.',
            'fleetList' => $fleetList,
            'ships' => $ships
        ]);
    }

    public function getShipById(Ship $ship) : JsonResponse
    {
        $ship->load(['armaments', 'rules']);
        $shipOrder = $this->fleetBuilderService->shipTypeOrder[$ship->type];

        return response()->json([
            'message' => 'Ship added to fleet.',
            'html' => View::make('components.fleet-builder.ship-profile-card', compact('ship', 'shipOrder'))->render(),
            'points' => $ship->points
        ]);
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
