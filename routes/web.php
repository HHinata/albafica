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

/**
 * i - index
 */
Route::group(['prefix'=>'i'], function ()
{
    Route::group(['prefix'=>'contest'], function ()
    {
        Route::get('list', 'Contest\IndexController@list');
        Route::get('problem/{cid}/{id}', 'Contest\IndexController@problem');
        Route::get('detail/{id}', 'Contest\IndexController@detail');
    });
    Route::group(['prefix'=>'problem'], function ()
    {
        Route::get('list', 'Problem\IndexController@list');
        Route::get('detail/{id}', 'Problem\IndexController@detail');
    });
});

Route::group(['prefix'=>'plat'], function ()
{
    Route::post('grab', 'PlatformController@grab');
    Route::post('submit', 'PlatformController@submit');
});

Route::resource('user', 'User\AdminController');
Route::resource('problem', 'Problem\AdminController');
Route::resource('solution', 'Status\AdminController');
Route::resource('contest', 'Contest\AdminController');
