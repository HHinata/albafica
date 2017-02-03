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

Route::get('/menu', 'HomeController@menu');

Auth::routes();

Route::get('/index', function(){
    return Redirect::to('/');
});
Route::get('/home', function(){
    return Redirect::to('/');
});
Route::get('/', 'HomeController@index');
//
//Route::get('/', function () {
//    return view('welcome');
//});