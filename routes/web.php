<?php

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


Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::group(['prefix' => 'editor'], function () {
        Route::get('/', 'EditorController@index')->name('editor.index');
        Route::get('/{faction}/', 'EditorController@index')->name('editor.faction');
    });
});
