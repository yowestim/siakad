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

// Route::prefix('absensistaff')->group(function() {
//     Route::get('/', 'AbsensiStaffController@index');
// });
Route::get('absenstaff', 'AbsensiStaffController@index');
Route::get('absenstaff/show', 'AbsensiStaffController@show');
// Route::post('absenstaff/store/{id}', 'AbsensiStaffController@store');
Route::get('absenstaff/destroy/{id}', 'AbsensiStaffController@destroy');
Route::post('absenstaff/store/', 'AbsensiStaffController@store');
