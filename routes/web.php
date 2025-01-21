<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditorController;

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

    Route::group(['prefix' => 'editor'], function () {
        Route::get('/', [EditorController::class, 'index'])->name('editor.index');
        Route::post('/', [EditorController::class, 'submitFaction'])->name('editor.submit.faction');
        Route::get('/{faction}/', [EditorController::class, 'showFleetList'])->name('editor.fleet-list');
        Route::post('/{faction}/', [EditorController::class, 'submitFleetList'])->name('editor.submit.fleet-list');
        Route::get('/{faction}/{fleetList}/fleet/', [EditorController::class, 'showFleet'])->name('editor.fleet');
    });
});
