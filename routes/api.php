<?php

use App\Http\Controllers\FleetBuilderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/faction/{faction}', [FleetBuilderController::class, 'getFleetListByFaction']);
Route::get('/fleet-list/{fleetList}', [FleetBuilderController::class, 'getShipsByFleetList']);
Route::get('/ship/{ship}', [FleetBuilderController::class, 'getShipById']);
Route::get('/export/{faction}/{fleetList}', [FleetBuilderController::class, 'getFleetAsPdf'])->name('fleet.export-pdf');
