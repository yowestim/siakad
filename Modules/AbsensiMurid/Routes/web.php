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

Route::get('absensiswa', 'AbsensiMuridController@index');
Route::get('absensiswa/show/', 'AbsensiMuridController@show');
Route::get('absensiswa/destroy/{id}', 'AbsensiMuridController@destroy');
Route::post('absensiswa/store/', 'AbsensiMuridController@store');
