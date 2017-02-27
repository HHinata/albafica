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

Route::get('problem', 'ProblemController@index');

Route::get('problem/detail', 'ProblemController@detail');

Route::post('problem/submit', 'ProblemController@submit');

Route::get('solution', 'SolutionController@index');

Route::get('solution/detail', 'SolutionController@detail');

Route::get('contest', 'ContestController@index');

Route::get('contest/detail', 'ContestController@detail');