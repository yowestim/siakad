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

Route::get('buku', 'BukuController@index');
Route::get('buku/add', 'BukuController@add');
Route::post('buku/save', 'BukuController@save');
Route::get('buku/update/{id}', 'BukuController@update');
Route::post('buku/update/save/{id}', 'BukuController@saveUpdate');
Route::get('buku/delete/{id}', 'BukuController@delete');
