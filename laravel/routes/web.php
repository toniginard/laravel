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

Route::group(['middleware' => ['web']], function () {
    Route::get('login', 'AuthController@getLogin');
    Route::post('login', 'AuthController@postLogin');
    Route::get('logout', 'AuthController@getLogout');
});


// Register your Routes to be accessed only with authentication
Route::group(['middleware' => 'auth'], function () {
    Route::get('laravel', function () {
        return view('welcome');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
