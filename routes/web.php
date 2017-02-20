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
Route::get('/info', 'HomeController@info');
Route::get('/token', 'HomeController@token');

Route::group(['prefix' => 'i'], function () {
    Route::group(['prefix' => 'contest'], function () {
        Route::get('list', 'Contest\IndexController@list');
        Route::get('problem/{cid}/{id}', 'Contest\IndexController@problem');
        Route::get('detail/{id}', 'Contest\IndexController@detail');
        Route::get('rank/{id}', 'Contest\IndexController@rank');
        Route::post('submit', 'Contest\IndexController@submit');
    });
    Route::group(['prefix' => 'problem'], function () {
        Route::get('list', 'Problem\IndexController@list');
        Route::get('detail/{id}', 'Problem\IndexController@detail');
        Route::post('submit', 'Problem\IndexController@submit');
    });
    Route::group(['prefix' => 'solution'], function () {
        Route::get('in-contest/{id}', 'Solution\IndexController@inContest');
        Route::get('in-problem', 'Solution\IndexController@inProblem');
        Route::get('detail/{id}', 'Solution\IndexController@detail');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function() {
    Route::group(['prefix'=>'d'], function ()
    {
        Route::group(['prefix'=>'problem'], function ()
        {
            Route::post('grab', 'Problem\AdminController@grab');
        });
    });

    Route::resource('user', 'User\AdminController');
    Route::resource('problem', 'Problem\AdminController');
    Route::resource('solution', 'Solution\AdminController');
    Route::resource('contest', 'Contest\AdminController');
});
