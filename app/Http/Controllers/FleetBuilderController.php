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
use Illuminate\Support\Facades\View;

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
    public function getFleetListByFaction(Faction $faction) : JsonResponse
    {
        $fleetLists = $faction->fleetLists()->get();

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
    public function getShipsByFleetList(FleetList $fleetList) : JsonResponse
    {
        $ships = $fleetList->ships()->with('armaments')->get()->groupBy('type');
        $shipsSorted = $this->fleetBuilderService->sortShips($ships);

        return response()->json([
            'message' => 'Fleet List selected.',
            'fleetList' => $fleetList,
            'ships' => $shipsSorted
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

    public function fleetExport(Request $request) {
        $factionId = $request->get('faction');
        $faction = Faction::findOrFail($factionId);

        $fleetListId = request()->get('fleet-list');
        $fleetList = FleetList::findOrFail($fleetListId);

        $shipIds = request()->get('ships');
        $ships = collect();
        foreach ($shipIds as $shipId) {
            $ship = Ship::findOrFail($shipId);
            if($ship) {
                $ships->push($ship);
            }
        }

        return view('pages.fleet-export', compact('faction', 'fleetList', 'ships'));
    }
}
