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
Route::get('tags', 'HomeController@tags');
Route::get('token', 'HomeController@token');
Route::get('tag', 'HomeController@tag');

Route::get('problem', 'ProblemController@index');
Route::get('problem/rack', 'ProblemController@rack');
Route::get('problem/show', 'ProblemController@show');
Route::get('problem/seek', 'ProblemController@seek');
Route::get('problem/detail', 'ProblemController@detail');
Route::get('problem/crawler', 'ProblemController@crawler');

Route::post('problem/star', 'ProblemController@star');
Route::put('problem', 'ProblemController@store');
Route::post('problem', 'ProblemController@update');
Route::post('problem/submit', 'ProblemController@submit');

Route::get('solution', 'SolutionController@index');
Route::get('solution/detail', 'SolutionController@detail');

Route::get('contest', 'ContestController@index');
Route::get('contest/rack', 'ContestController@rack');
Route::get('contest/show', 'ContestController@show');
Route::get('contest/rank', 'ContestController@rank');
Route::get('contest/detail', 'ContestController@detail');
Route::get('contest/problem', 'ContestController@problem');

Route::put('contest', 'ContestController@store');
Route::post('contest', 'ContestController@update');
Route::post('contest/submit', 'ContestController@submit');

Route::get('post', 'PostController@index');
Route::get('post/detail', 'PostController@detail');
Route::get('post/rack', 'PostController@rack');
Route::get('post/show', 'PostController@show');

Route::post('post/star', 'PostController@star');
Route::put('post', 'PostController@store');
Route::post('post', 'PostController@update');

Route::get('comment', 'CommentController@index');
Route::put('comment', 'CommentController@store');

Route::get('user/info', 'UserController@info');
Route::post('user', 'UserController@update');
Route::post('user/star', 'UserController@star');