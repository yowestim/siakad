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

// Route::prefix('murid')->group(function() {
//     Route::get('/', 'MuridController@index');
// });
Route::get('absensi','MuridController@index');
Route::get('/spp','MuridController@index');
Route::post('/spp/save','MuridController@save');
Route::get('spp/cetak_pdf', 'MuridController@cetak_pdf');
Route::get('spp/cetak_excel', 'MuridController@cetak_excel');
