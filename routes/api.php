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

Route::prefix('{fleet}')
    ->group(function () {
        Route::group(['middleware' => 'can:update,fleet'], function () {
            Route::patch('/name/{name}', [FleetBuilderController::class, 'updateFleetName']);
            Route::patch('/faction/{faction}', [FleetBuilderController::class, 'setFaction']);
            Route::patch('/fleet-list/{fleetList}', [FleetBuilderController::class, 'setFleetList']);
            Route::patch('/ship-add/{ship}', [FleetBuilderController::class, 'attachShipToFleet']);
            Route::patch('/ship-remove/{shipPivotId}', [FleetBuilderController::class, 'detachShipFromFleet']);
            Route::patch('/ship-refit/{fleetShip}', [FleetBuilderController::class, 'refitShip']);
            Route::patch('/ship-squadron-counter/{fleetShip}', [FleetBuilderController::class, 'updateSquadronCounter']);
            Route::patch('/ship-fields/{fleetShip}', [FleetBuilderController::class, 'updateShipFields']);
            Route::patch('/commander-add/{commander}', [FleetBuilderController::class, 'attachCommanderToFleet']);
            Route::patch('/commander-remove/{fleetCommander}', [FleetBuilderController::class, 'detachCommanderFromFleet']);
            Route::patch('/commander-ship-assign/{fleetCommander}/{fleetShip}', [FleetBuilderController::class, 'commanderAssignShip']);
            Route::patch('/commander-rerolls/{fleetCommander}/{commanderRerolls}', [FleetBuilderController::class, 'commanderApplyExtraRerolls']);
        });
        Route::delete('/delete/', [FleetBuilderController::class, 'destroyApi'])->name('api.builder.delete');
        Route::get('/export-pdf/', [FleetBuilderController::class, 'getFleetAsPdf']);
});
