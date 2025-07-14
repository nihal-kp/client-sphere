<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Client Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "client" middleware group. Make something great!
|
*/

Auth::routes();

Route::middleware(['auth','type:client'])->group(function () {
    Route::get('text-boxes', 'TextBoxController@index')->name('text-boxes.index');
    Route::get('profile', 'ProfileController@edit')->name('profile.edit');
    Route::put('profile', 'ProfileController@update')->name('profile.update');
});