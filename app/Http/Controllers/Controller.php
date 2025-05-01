<?php

namespace App\Http\Controllers;

use App\Models\Faction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function home() {
        $factions = Faction::all();

        return view('welcome', compact('factions'));
    }
}
