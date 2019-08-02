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
Route::get('/spp','SppController@index');
Route::get('/spp/cari','SppController@cari');
Route::post('/spp/save','SppController@save');
Route::get('/adminspp','SppController@admin');
Route::get('/adminspp/search','SppController@search');
Route::get('/adminspp/edit{id}','SppController@edit');
Route::post('/adminspp/save','SppController@saveAdmin');
