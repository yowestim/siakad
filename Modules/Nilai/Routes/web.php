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

Route::get('nilai', 'NilaiController@index');
Route::get('nilai/add', 'NilaiController@add');
Route::post('nilai/save', 'NilaiController@save');
Route::get('nilai/update/{id}', 'NilaiController@update');
Route::post('nilai/update/save/{id}', 'NilaiController@saveUpdate');
Route::get('nilai/delete/{id}', 'NilaiController@delete');
