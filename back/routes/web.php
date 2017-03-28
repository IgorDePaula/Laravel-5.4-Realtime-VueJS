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
Route::get('/mensagem','MensagemController@index');

Route::post('/mensagem','MensagemController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/fakelogin', 'MensagemController@fakeLogin');
Route::post('/faketoken', 'MensagemController@fakeToken');
