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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('siswarest', 'SiswaRestController@index');
Route::post('/siswarest/add', 'SiswaRestController@create');
Route::put('/siswarest/{id}', 'SiswaRestController@update');
Route::delete('/siswarest/{id}', 'SiswaRestController@delete');

Route::get('guide', 'GuideRestController@index');
Route::get('guide/{url}', 'GuideRestController@show');
Route::post('guide', 'GuideRestController@store');
Route::put('guide/{guide}', 'GuideRestController@update');
Route::delete('guide/{guide}', 'GuideRestController@delete');

Route::get('mahasiswa', 'MahasiswaController@index');
Route::get('mahasiswa/{id}', 'MahasiswaController@show');
Route::post('mahasiswa', 'MahasiswaController@store');
Route::put('mahasiswa/{id}', 'MahasiswaController@update');
Route::delete('mahasiswa/{id}', 'MahasiswaController@delete');
