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

Route::get('/', 'HomeController@index');
Route::get('/calendar', 'ObserverController@index');
Route::get('/calendar/{flag}', 'ObserverController@index')
-> where(['flag' => '[0-9]+']);
Route::get('/spec/addAction', 'SpecialistController@addAction');

