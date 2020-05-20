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

Auth::routes();

Route::get('/siswa', 'SiswaController@index');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('halo', function () {
	return "Halo, Selamat datang di tutorial laravel www.malasngoding.com";
});

Route::get('login-sistem', function () {
	return view('blog');
});

Route::get('dosen', 'DosenController@index');

//Route::get('/pegawai/{nama}', 'PegawaiController@index');

//Route::get('/formulir', 'PegawaiController@formulir');

//Route::post('/formulir/proses', 'PegawaiController@proses');

Route::get('/blog', 'BlogController@home');

Route::get('/blog/tentang', 'BlogController@tentang');

Route::get('/blog/kontak', 'BlogController@kontak');

//route CRUD
Route::get('/pegawai','PegawaiController@index');

Route::get('/pegawai/tambah','PegawaiController@tambah');

Route::post('/pegawai/store','PegawaiController@store');

Route::get('/pegawai/edit/{id}','PegawaiController@edit');

Route::post('/pegawai/update','PegawaiController@update');

Route::get('/pegawai/hapus/{id}','PegawaiController@hapus');

Route::get('/pegawai/cari','PegawaiController@cari');

Route::get('/pegawai/input', 'PegawaiController@input');
 
Route::post('/pegawai/proses', 'PegawaiController@proses');

//Eloquent

Route::get('/elo', 'EloController@index');

Route::get('/elo/add', 'EloController@add');

Route::get('/elo/edit/{id}', 'EloController@edit');

Route::get('/elo/delete/{id}', 'EloController@delete');

Route::post('/elo/input', 'EloController@input');

Route::put('/elo/update/{id}', 'EloController@update');

// Relasi

Route::get('/pengguna', 'PenggunaController@index'); // One to One

Route::get('/article', 'WebController@index'); // One to Many

Route::get('/anggota', 'DikiController@index'); // Many to Many


// Guide Javabow

Route::get('toram/guide', 'GuideController@index');