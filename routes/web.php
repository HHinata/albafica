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
Route::get('roles', 'HomeController@roles');
Route::get('token', 'HomeController@token');

Route::get('comment', 'CommentController@index');
Route::put('comment', 'CommentController@store');

Route::group(['prefix'=>'problem'],function() {
    Route::get('/', 'ProblemController@index');
    Route::get('/rack', 'ProblemController@rack');
    Route::get('/show', 'ProblemController@show');
    Route::get('/seek', 'ProblemController@seek');
    Route::get('/detail', 'ProblemController@detail');
    Route::get('/crawler', 'ProblemController@crawler');
    Route::get('/download', 'ProblemController@download');

    Route::put('/', 'ProblemController@store');

    Route::post('/', 'ProblemController@update');
    Route::post('/star', 'ProblemController@star');
    Route::post('/submit', 'ProblemController@submit');
    Route::post('/export', 'ProblemController@export');
    Route::post('/import', 'ProblemController@import');
});

Route::group(['prefix'=>'contest'],function() {
    Route::get('/', 'ContestController@index');
    Route::get('/rack', 'ContestController@rack');
    Route::get('/show', 'ContestController@show');

    Route::get('/rank', 'ContestController@rank');
    Route::get('/verify', 'ContestController@verify');
    Route::get('/detail', 'ContestController@detail');
    Route::get('/problem', 'ContestController@problem');

    Route::put('/', 'ContestController@store');
    Route::post('/', 'ContestController@update');
    Route::post('/submit', 'ContestController@submit');
});

Route::group(['prefix'=>'post'],function() {
    Route::get('/', 'PostController@index');
    Route::get('/detail', 'PostController@detail');
    Route::get('/rack', 'PostController@rack');
    Route::get('/show', 'PostController@show');
    Route::get('/seek', 'PostController@seek');
    Route::post('/', 'PostController@update');
    Route::post('/star', 'PostController@star');
    Route::put('/', 'PostController@store');
});
Route::group(['prefix'=>'team'],function() {
    Route::get('/', 'TeamController@index');
    Route::get('/rack', 'TeamController@rack');
    Route::get('/seek', 'TeamController@seek');
    Route::get('/verify', 'TeamController@verify');
    Route::post('/apply', 'TeamController@apply');

    Route::group(['middleware' => ['verify.team']],function() {
        Route::get('/show', 'TeamController@show');
        Route::get('/detail', 'TeamController@detail');
        Route::put('/', 'TeamController@store');
        Route::post('/', 'TeamController@update');
        Route::post('/switch', 'TeamController@switchRole');
    });
});

Route::get('message', 'MessageController@index');

Route::get('notice', 'NoticeController@index');
Route::get('notice/rack', 'NoticeController@rack');
Route::put('notice', 'NoticeController@store');

Route::get('user/info', 'UserController@info');
Route::get('user/role', 'UserController@role');
Route::post('user/role', 'UserController@updateRole');
Route::post('user', 'UserController@update');
Route::post('user/star', 'UserController@star');

Route::get('solution', 'SolutionController@index');
Route::get('solution/detail', 'SolutionController@detail');
Route::post('solution/callback', 'SolutionController@callback');