<?php

namespace App\Http\Controllers;

use App\Http\Requests\FleetEditorFormRequest;
use App\Models\Faction;
use Illuminate\Http\RedirectResponse;

class EditorController extends Controller
{
    public function index()
    {
        $factions = Faction::all();

        return view('pages.editor-faction', compact('factions'));
    }

    public function submitFaction(FleetEditorFormRequest $request) : RedirectResponse
    {
        $request->validated();
        $factionId = $request->get('faction');

        $faction = Faction::findOrFail($factionId);

        return redirect()->route('editor.fleet-list', ['faction' => $faction]);
    }

    public function showFleetList(Faction $faction) {
        $fleetLists = $faction->fleetLists()->get();

        dd($fleetLists);
    }
}
