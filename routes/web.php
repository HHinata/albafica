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

Route::get('/', 'HomeController@index');
Route::get('/menu', 'HomeController@menu');

Route::resource('user', 'UserController');
Route::resource('problem', 'ProblemController');
Route::resource('solution', 'SolutionController');

Route::resource('contest', 'ContestController');
Route::group(['prefix'=>'contest'], function ()
{
    Route::get('detail/{id}', 'ContestController@detail');
});

Route::group(['prefix'=>'plat'], function ()
{
    Route::post('grab', 'PlatformController@grab');
    Route::post('submit', 'PlatformController@submit');
});


