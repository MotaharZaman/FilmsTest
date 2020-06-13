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


Auth::routes();

//Route::group([ 'middleware' => 'ForceSSL'], function() {
    Route::get('/', 'FilmController@showFilms')->name('home')->middleware('auth');
    Route::prefix('/films')->group(function () {
        Route::get('/', 'FilmController@showFilms')->name('showFilms')->middleware('auth');
        Route::get('/create', 'FilmController@create')->name('create')->middleware('auth');
        Route::get('/{name}', 'FilmController@filmWithComments')->name('filmDetails')->middleware('auth');
    });
//});
