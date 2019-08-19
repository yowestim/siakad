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

// Route::prefix('absensiguru')->group(function() {
//     Route::get('/', 'AbsensiGuruController@index');
// });
Route::get('absensiguru', 'AbsensiGuruController@index');
Route::get('absensiguru/show', 'AbsensiGuruController@show');
Route::post('absensiguru/store', 'AbsensiGuruController@store');
