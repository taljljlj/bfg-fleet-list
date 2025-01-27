<?php

namespace App\Http\Controllers;

use App\Http\Requests\FleetBuilderFormRequest;
use App\Models\Faction;
use App\Models\Fleet;
use App\Models\FleetList;
use App\Models\Ship;
use Illuminate\Http\RedirectResponse;

class FleetBuilderController extends Controller
{
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
     * @return RedirectResponse
     */
    public function submitFaction(FleetBuilderFormRequest $request) : RedirectResponse
    {
        $request->validated();
        $factionId = $request->get('faction');

        $faction = Faction::findOrFail($factionId);

        return redirect()->route('builder.fleet-list', compact('faction'));
    }

    /**
     * @param Faction $faction
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function showFleetList(Faction $faction) {
        $fleetLists = $faction->fleetLists()->get();

        return view('pages.builder-fleet-list', compact('fleetLists', 'faction'));
    }

    /**
     * @param FleetBuilderFormRequest $request
     * @param Faction $faction
     * @return RedirectResponse
     */
    public function submitFleetList(FleetBuilderFormRequest $request, Faction $faction) : RedirectResponse
    {
        $request->validated();
        $fleetListId = $request->get('fleet_list');

        $fleetList = FleetList::findOrFail($fleetListId);

        return redirect()->route('builder.fleet', compact('faction', 'fleetList'));
    }

    public function showFleet(Faction $faction, FleetList $fleetList) {
        $shipsGrouped = $faction->ships()->get()->groupBy('type');
//dd($shipsGrouped);
        return view('pages.builder-fleet', compact('faction', 'fleetList', 'shipsGrouped'));
    }
}
