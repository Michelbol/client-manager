<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('clients.index');
})->name('home');

Route::resource('clients', 'ClientController')->except(['show']);

Route::get('cities/{state}', 'CityController@getCityByState');
