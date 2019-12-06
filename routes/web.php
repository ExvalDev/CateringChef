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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/tables', 'TableController');

Route::get('/tables', 'TableController@index');
Route::get('/tables/create', 'TableController@create');
Route::post('/tables', 'TableController@store');
Route::get('/tables/destroy/{id}', 'TableController@destroy');