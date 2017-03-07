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

Route::get('info', 'HomeController@info');
Route::get('rank', 'UserController@rank');
Route::get('menu', 'HomeController@menu');
Route::get('token', 'HomeController@token');

Route::get('problem', 'ProblemController@index');
Route::get('problem/rack', 'ProblemController@rack');
Route::get('problem/tags', 'ProblemController@tags');
Route::get('problem/show', 'ProblemController@show');
Route::get('problem/crawler', 'ProblemController@crawler');
Route::get('problem/detail', 'ProblemController@detail');
Route::get('problem/seek', 'ProblemController@seek');

Route::put('problem', 'ProblemController@store');
Route::post('problem', 'ProblemController@update');
Route::post('problem/submit', 'ProblemController@submit');

Route::get('solution', 'SolutionController@index');
Route::get('solution/detail', 'SolutionController@detail');

Route::get('contest', 'ContestController@index');
Route::get('contest/rack', 'ContestController@rack');
Route::get('contest/show', 'ContestController@show');
Route::get('contest/detail', 'ContestController@detail');
Route::get('contest/problem', 'ContestController@problem');

Route::put('contest', 'ContestController@store');
Route::post('contest', 'ContestController@update');

Route::get('post', 'PostController@index');
Route::get('post/detail', 'PostController@detail');
Route::get('post/rack', 'PostController@rack');
Route::get('post/show', 'PostController@show');

Route::put('post', 'PostController@store');
Route::post('post', 'PostController@update');

Route::get('comment', 'CommentController@index');
Route::put('comment', 'CommentController@store');