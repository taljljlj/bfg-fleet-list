<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FleetBuilderController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [Controller::class, 'home'])->name('home');

Route::group(['prefix' => 'fleet-builder'], function () {
    Route::get('/', [FleetBuilderController::class, 'index'])->name('builder.index');
    Route::post('/create', [FleetBuilderController::class, 'create'])->name('builder.create');
    Route::get('/view/{fleet}', [FleetBuilderController::class, 'show'])->name('builder.view');
    Route::delete('/delete/{fleet}', [FleetBuilderController::class, 'delete'])->name('builder.delete');
    Route::get('/edit/{fleet}', [FleetBuilderController::class, 'edit'])->name('builder.edit');
    Route::get('/create/hotpick/{faction}', [FleetBuilderController::class, 'hotpickIndex'])->name('builder.index-hotpick');
    Route::get('test-export/{fleet}', [FleetBuilderController::class, 'testPdf'])->name('test.fleet.export-pdf'); //TODO: test route for testing PDF view; remove
    Route::get('{fleet}/export-pdf/', [FleetBuilderController::class, 'getFleetAsPdf'])->name('pdf-export.test');
});

Route::group(['middleware' => 'guest'], function () {
    //Basic auth
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('show-login');
    Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('show-register');
    Route::post('/login', [UserController::class, 'login'])->name('login');
    Route::post('/register', [UserController::class, 'register'])->name('register');
    Route::get('password/reset', [UserController::class, 'showPasswordResetLinkRequestForm'])->name('password.request');
    Route::post('password/email', [UserController::class, 'sendPasswordResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [UserController::class, 'showPasswordResetForm'])->name('password.reset');
    Route::post('password/reset', [UserController::class, 'resetPassword'])->name('password.update');

    //Socialite auth
    Route::get('auth/{driver}', [SocialiteController::class, 'redirect'])->name('socialite.redirect');
    Route::get('auth/{driver}/callback', [SocialiteController::class, 'callback']);

});

Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});
