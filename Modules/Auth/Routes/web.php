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
//--------------------------------Login,Logout dan Register-----------------------------------//
//staff
Route::get('/login/loginPoststaff','AuthController@loginPoststaff');
Route::get('/loginstaff','AuthController@loginstaff');
//guru
Route::get('/login/loginPostguru','AuthController@loginPostguru');
Route::get('/loginguru','AuthController@loginnguru');
//siswa
Route::get('/login/loginPostsiswa','AuthController@loginPostsiswa');
Route::get('/loginsiswa','AuthController@loginsiswa');

//staff
Route::get('/logoutstaff','AuthController@logoutstaff');
//guru
Route::get('/logoutguru','AuthController@logoutguru');
//siswa
Route::get('/logoutsiswa','AuthController@logoutsiswa');

Route::get('/registrasi','AuthController@registrasi');
Route::post('/registrasi/post','AuthController@registrasiPost');
//--------------------------------------------------------------------------------------------//

Route::get('guru/index','AuthController@guruIndex');
Route::get('staff/index','AuthController@staffIndex');
Route::get('siswa/index','AuthController@siswaIndex');

