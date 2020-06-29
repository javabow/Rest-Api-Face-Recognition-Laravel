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
Route::get('mahasiswa/search/{query}', 'MahasiswaController@search');

Route::get('matakuliah', 'MatakuliahController@index');
Route::get('matakuliah/{hari}/{time}/', 'MatakuliahController@show');
Route::post('matakuliah', 'MatakuliahController@store');
Route::put('matakuliah/{kode_matkul}', 'MatakuliahController@update');
Route::delete('matakuliah/{kode_matkul}', 'MatakuliahController@delete');

Route::get('krs', 'KrsRestController@index');
Route::get('krs/{kode_matkul}/{nim}/', 'KrsRestController@show');
Route::post('krs', 'KrsRestController@store');
Route::put('krs/{id}', 'KrsRestController@update');
Route::delete('krs/{id}', 'KrsRestController@delete');

Route::get('absensi', 'AbsensiRestController@index');
Route::get('absensi/{kode_matkul}/{nim}/{date}', 'AbsensiRestController@show');
//Route::get('absensi/input/{kode_matkul}/{nim}/{date}/{kode_kelas}', 'AbsensiRestController@absensiRecognition');
Route::post('absensi', 'AbsensiRestController@store');
Route::put('absensi/{id}', 'AbsensiRestController@update');
Route::delete('krs/{id}', 'AbsensiRestController@delete');
