<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/getScrapedArticles/{fileName}', 'App\Http\Controllers\ArticlesController@getScrapedArticles');

Route::get('/getFullArticle/{articleId}', 'App\Http\Controllers\ArticlesController@getFullArticle');

Route::post('/getArticles', 'App\Http\Controllers\ArticlesController@index');
