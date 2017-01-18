<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@showWelcome');

Route::get('/board/{board_name}', 'HomeController@showBoard');

Route::get('/board/{board_name}/{article_id}', 'HomeController@showArticle');

Route::get('/export', 'HomeController@export');

Route::get('/search', 'HomeController@search');

Route::get('/search_author', 'HomeController@searchAuthor');


Route::get('/api/v1/board/{board_name}/date/{date}', 'HomeController@apiListBoardArticleByDate');
Route::get('/api/v1/forum/{board_name}/date/{date}', 'HomeController@apiListBoardArticleByDate');
Route::get('/api/v1/article/{article_id}', 'HomeController@apiShowArticle');

Route::get('/api', 'HomeController@apiDoc');