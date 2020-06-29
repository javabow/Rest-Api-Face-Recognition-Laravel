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


//Eloquent

Route::get('/elo', 'EloController@index');

Route::get('/elo/add', 'EloController@add');

Route::get('/elo/edit/{id}', 'EloController@edit');

Route::get('/elo/delete/{id}', 'EloController@delete');

Route::post('/elo/input', 'EloController@input');

Route::put('/elo/update/{id}', 'EloController@update');


// Guide Javabow

Route::get('toram/guide', 'GuideController@index');

// Training

Route::get('/training', 'TrainingController@index');
Route::get('/training/add', 'TrainingController@add');
Route::post('/training/input', 'TrainingController@train');
Route::get('/training/edit/{id}', 'TrainingController@edit');
Route::put('/training/update/{id}', 'TrainingController@update');
Route::get('/training/delete/{id}/{nim}', 'TrainingController@delete');