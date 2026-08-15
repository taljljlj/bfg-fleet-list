<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
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
    Route::get('/', [Controller::class, 'home'])->name('home');

    Route::group(['prefix' => 'fleet-builder'], function () {
        Route::get('/', [FleetBuilderController::class, 'index'])->name('builder.index');
        Route::get('/{fleet}', [FleetBuilderController::class, 'edit'])->name('builder.edit');
        Route::get('/hotpick/{faction}', [FleetBuilderController::class, 'hotpickIndex'])->name('builder.index-hotpick');
        Route::get('test-export/{fleet}', [FleetBuilderController::class, 'testPdf'])->name('test.fleet.export-pdf'); //TODO: test route for testing pdf view; remove
        Route::get('{fleet}/export-pdf/', [FleetBuilderController::class, 'getFleetAsPdf'])->name('pdf-export.test');
    });

    Route::get('/login', [UserController::class, 'showLoginForm'])->name('show-login');
    Route::post('/login', [UserController::class, 'login'])->name('login');
    Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('show-register');
    Route::post('/register', [UserController::class, 'register'])->name('register');

});

Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});
