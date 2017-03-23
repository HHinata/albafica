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
Route::get('problem/speech', 'ProblemController@speech');

Route::post('problem/star', 'ProblemController@star');
Route::put('problem', 'ProblemController@store');
Route::post('problem', 'ProblemController@update');
Route::put('problem/comment', 'ProblemController@comment');
Route::post('problem/submit', 'ProblemController@submit');

Route::get('solution', 'SolutionController@index');
Route::get('solution/detail', 'SolutionController@detail');
Route::post('solution/callback', 'SolutionController@callback');

Route::get('contest', 'ContestController@index');
Route::get('contest/rack', 'ContestController@rack');
Route::get('contest/show', 'ContestController@show');
Route::get('contest/rank', 'ContestController@rank');
Route::get('contest/detail', 'ContestController@detail');
Route::get('contest/problem', 'ContestController@problem');
Route::get('contest/speech', 'ContestController@speech');

Route::put('contest/comment', 'ContestController@comment');
Route::put('contest', 'ContestController@store');
Route::post('contest', 'ContestController@update');
Route::post('contest/submit', 'ContestController@submit');

Route::get('post', 'PostController@index');
Route::get('post/detail', 'PostController@detail');
Route::get('post/rack', 'PostController@rack');
Route::get('post/show', 'PostController@show');
Route::get('post/seek', 'PostController@seek');
Route::get('post/speech', 'PostController@speech');

Route::put('post/comment', 'PostController@comment');
Route::post('post/star', 'PostController@star');
Route::put('post', 'PostController@store');
Route::post('post', 'PostController@update');

Route::put('team', 'TeamController@store');
Route::get('team/speech', 'TeamController@speech');
Route::put('team/comment', 'TeamController@comment');
Route::post('team/apply', 'TeamController@apply');
Route::get('team/show', 'TeamController@show');
Route::get('team', 'TeamController@index');
Route::get('team/rack', 'TeamController@rack');
Route::get('team/seek', 'TeamController@seek');
Route::get('team/test', 'TeamController@test');

Route::get('comment', 'CommentController@index');
Route::put('comment', 'CommentController@store');

Route::get('message', 'MessageController@index');
Route::get('notice', 'NoticeController@index');
Route::put('notice', 'NoticeController@store');
Route::get('notice/rack', 'NoticeController@rack');

Route::get('user/info', 'UserController@info');
Route::post('user', 'UserController@update');
Route::post('user/star', 'UserController@star');