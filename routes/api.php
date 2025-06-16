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

Route::prefix('{fleet}')->group(function () {
    Route::patch('/faction/{faction}', [FleetBuilderController::class, 'setFaction']);
    Route::patch('/fleet-list/{fleetList}', [FleetBuilderController::class, 'setFleetList']);
    Route::patch('/ship-add/{ship}', [FleetBuilderController::class, 'attachShipToFleet']);
    Route::patch('/ship-remove/{shipPivotId}', [FleetBuilderController::class, 'detachShipFromFleet']);
    Route::patch('/ship-refit/{fleetShip}', [FleetBuilderController::class, 'refitShip']);
    Route::get('/export/{faction}/{fleetList}', [FleetBuilderController::class, 'getFleetAsPdf'])->name('fleet.export-pdf');
});
