<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/home', 'UserController@index')->name('home');
Route::resource('user', 'UserController',['except' => ['create', 'store']]);
Route::resource('weight', 'WeightController');
Route::resource('temperature', 'TemperatureController');
Auth::routes();