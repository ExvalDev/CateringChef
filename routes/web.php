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

/* Route::get('/', function () {
    return view('menu');
}); */

Auth::routes(['verify' => true]);

Route::get('/', 'MenuController@index');
Route::get('/menu', 'MenuController@index');
Route::get('/tables', 'TableController@index');
Route::resource('/customer', 'CustomerController');
Route::resource('/ingredient', 'IngredientController');
Route::resource('/component', 'ComponentController');
Route::resource('/meal', 'MealController');

