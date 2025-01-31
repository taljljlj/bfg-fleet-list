<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FleetBuilderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::group(['prefix' => 'fleet-builder'], function () {
        Route::get('/', [FleetBuilderController::class, 'index'])->name('builder.index');
//        Route::post('/', [FleetBuilderController::class, 'submitFaction'])->name('builder.submit.faction');
//        Route::get('/{faction}/', [FleetBuilderController::class, 'showFleetList'])->name('builder.fleet-list');
//        Route::post('/{faction}/', [FleetBuilderController::class, 'submitFleetList'])->name('builder.submit.fleet-list');
//        Route::get('/{faction}/{fleetList}/fleet/', [FleetBuilderController::class, 'showFleet'])->name('builder.fleet');
    });
});
