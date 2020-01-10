<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::post('skordosen','SkorDosenController@create',function(){})->middleware('SkorSprint');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/lihatdosen','NilaiDosenController@lihatdosen');
Route::get('/lihatasdos','NilaiPointController@lihatasdos');
Route::get('/lihatmahasiswa','NilaiSprintController@lihatmahasiswa');

//Skor Dosen
Route::get('/nilaidosen','NilaiDosenController@index');
Route::get('/nilaidosen/{id}','NilaiDosenController@show');
Route::get('/nilaidosen/{id}/{idTim}','NilaiDosenController@showbyuser');
Route::post('nilaidosen','NilaiDosenController@create',function(){})->middleware('SkorSprint');
Route::put('/nilaidosen/{id}','NilaiDosenController@update',function(){})->middleware('SkorSprint');
Route::delete('/nilaidosen/{id}','NilaiDosenController@delete',function(){})->middleware('SkorSprint'); 

//skorPoint
Route::get('nilaipoint','NilaiPointController@index');
Route::get('/nilaipoint/{id}','NilaiPointController@show');
Route::get('/nilaipoint/{user_id}/{tim_id}','NilaiPointController@showData');
Route::post('nilaipoint','NilaiPointController@create',function(){})->middleware('SkorSprint');
Route::put('/nilaipoint/{id}','NilaiPointController@update',function(){})->middleware('SkorSprint');
Route::delete('/nilaipoint/{id}','NilaiPointController@delete',function(){})->middleware('SkorSprint');

//nilaisprint
Route::get('nilaisprint','NilaiSprintController@index');
Route::get('/nilaisprint/{id}','NilaiSprintController@show');
Route::post('nilaisprint','NilaiSprintController@create',function(){})->middleware('SkorFinal');
Route::put('/nilaisprint/{id}','NilaiSprintController@update',function(){})->middleware('SkorFinal');
Route::delete('/nilaisprint/{id}','NilaiSprintController@delete',function(){})->middleware('SkorFinal');

//nilaifinal
Route::get('nilaifinal','NilaiFinalController@index');
Route::get('/nilaifinal/{id}','NilaiFinalController@show');
Route::post('nilaifinal','NilaiFinalController@create');
Route::put('/nilaifinal/{id}','NilaiFinalController@update');
Route::delete('/nilaifinal/{id}','NilaiFinalController@delete');

