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

Route::get('staff', 'StaffController@index');
Route::get('staff/tambah', 'StaffController@tambah');
Route::post('staff/save', 'StaffController@save');
Route::get('staff/edit/{id}', 'StaffController@edit');
Route::put('staff/update/{id}', 'StaffController@update');
Route::get('staff/delete/{id}', 'StaffController@delete');
