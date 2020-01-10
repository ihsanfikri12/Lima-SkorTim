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

Route::get('/','SkorSprint@login');
Route::get('/loginDosen','SkorDosen@login');
Route::get('/loginAsdos','SkorPoint@loginAsdos');
Route::get('/loginMahasiswa','SkorSprint@loginMahasiswa');

//skordosen
Route::get('/skordosen/{id}','SkorDosen@show2');
Route::get('/skordosen/{idUser}/{idTim}','SkorDosen@show');
Route::get('/skordosen/ubah/{id}/{user_id}','SkorDosen@ubahNilai');
Route::get('/skordosen/create/{id}/{matkul_id}','SkorDosen@createNilai');
Route::post('/skordosen/create/{id}/{matkul}','SkorDosen@create');
Route::put('/skordosen/ubah/{id}/{user_id}','SkorDosen@update');
Route::delete('/skordosen/{id}','SkorDosen@delete');

//skorpoint
Route::get('/skorpoint/{id}','SkorPoint@show2');
Route::get('/skorpoint/create/{user_id}','SkorPoint@createPoint');
Route::get('/skorpoint/ubah/{id}/','SkorPoint@ubahNilai');
Route::get('/skorpoint/{user_id}/{tim_id}','SkorPoint@show');
Route::put('/skorpoint/{id}','SkorPoint@update');
Route::post('/skorpoint/create/{user_id}','SkorPoint@create');
Route::delete('/skorpoint/{id}','SkorPoint@delete');

//skorsprint
Route::get('skorsprint','SkorSprint@index');
Route::get('/skorsprint/{id}','SkorSprint@show');
Route::post('skorsprint','SkorSprint@create');
Route::put('/skorsprint/{id}','SkorSprint@update');
Route::delete('/skorsprint/{id}','SkorSprint@delete');

//skorfinal
Route::get('skorfinal','NilaiFinal@index');
Route::get('/skorfinal/{id}','NilaiFinal@show');
Route::get('/skorfinal/{matkul}/{uts}','NilaiFinal@create2');
Route::post('/skorfinal','NilaiFinal@create');
Route::put('/skorfinal/{id}','NilaiFinal@update');
Route::delete('/skorfinal/{id}','NilaiFinal@delete');
