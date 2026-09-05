<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BattlefieldGeneratorController extends Controller
{
    public function index()
    {
        return view('pages.battlefield-generator.index');
    }
}
