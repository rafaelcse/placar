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
    return view('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/jogadores', 'JogadoresController')->middleware('auth');
Route::resource('partidas', 'PartidasController')->middleware('auth');
Route::get('/ranking', 'JogadoresController@ranking')->name('home')->middleware('auth');;
Route::get('/jogadores/delete/{id}', 'JogadoresController@destroy')->name('jogadores.delete')->middleware('auth');;
Route::get('/jogadores/historico/{id}', 'JogadoresController@historico')->name('jogadores.historico')->middleware('auth');
Route::get('/partidas/delete/{id}', 'PartidasController@destroy')->name('partidas.delete')->middleware('auth');


// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
