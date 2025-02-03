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

class FleetBuilderController extends Controller
{
    private FleetBuilderService $fleetBuilderService;

    public function __construct(FleetBuilderService $fleetBuilderService) {
        $this->fleetBuilderService = $fleetBuilderService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $factions = Faction::all();

        return view('pages.fleet-builder', compact('factions'));
    }

    /**
     * @param FleetBuilderFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function submitFaction(FleetBuilderFormRequest $request) : JsonResponse
    {
        $request->validated();
        $factionId = $request->get('faction');

        $faction = Faction::findOrFail($factionId);
        $fleetLists = $faction->fleetLists()->get();

        return response()->json([
            'message' => 'Faction successfully created.',
            'faction' => $faction,
            'fleetLists' => $fleetLists
        ]);
    }

    /**
     * @param FleetBuilderFormRequest $request
     * @return JsonResponse
     */
    public function submitFleetList(FleetBuilderFormRequest $request) : JsonResponse
    {
        $request->validated();
        $fleetListId = $request->get('fleetList');

        $fleetList = FleetList::findOrFail($fleetListId);

        $ships = $fleetList->ships()->with('armaments')->get()->groupBy('type');
        $shipsSorted = $this->fleetBuilderService->sortShips($ships);

        return response()->json([
            'message' => 'Faction successfully created.',
            'fleetList' => $fleetList,
            'ships' => $shipsSorted
        ]);
    }
}
