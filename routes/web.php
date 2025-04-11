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
        Route::get('/{fleet}', [FleetBuilderController::class, 'edit'])->name('builder.edit');
        Route::get('test-export/{faction}/{fleetList}', [FleetBuilderController::class, 'testPdf'])->name('test.fleet.export-pdf'); //TODO: test route for testing pdf view; remove
    });
});
