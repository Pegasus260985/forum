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

Route::get('/home', 'HomeController@index');

Route::get('/treads', 'TreadsController@index');
Route::get('/treads/create', 'TreadsController@create');
Route::get('/treads/{channel}/{tread}', 'TreadsController@show');
Route::post('/treads', 'TreadsController@store');
Route::get('/treads/{channel}', 'TreadsController@index');

//Route::resource('treads', 'TreadsController');

Route::post('/treads/{channel}/{tread}/replies', 'RepliesController@store');