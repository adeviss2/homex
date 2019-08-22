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
Route::get('lang/{locale}', 'LanguageController@index');

Route::prefix('home')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/view/{id}', 'HomeController@view');
    Route::get('/view/public/{id}', 'PublicController@view');
    Route::get('/delete/{id}', 'HomeController@delete');
    Route::get('/download/{id}', 'HomeController@download');
    Route::post('/extract', 'HomeController@extract')->name('action');
});


