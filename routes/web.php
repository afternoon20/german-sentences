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

Auth::routes();
Route::get('/', 'App\Http\Controllers\TopController@index')->name('top.index');
Route::get('/list', 'App\Http\Controllers\ListController@index')->name('list.index');
// Route::get('/question', 'App\Http\Controllers\QuestionController@index')->name('question.index');
// Route::get('/question/list', 'App\Http\Controllers\QuestionController@list')->name('question.list');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/favorite/register', 'App\Http\Controllers\FavoriteController@register')->name('favorite.register');
    Route::get('/favorite/delete', 'App\Http\Controllers\FavoriteController@delete')->name('favorite.delete');
});
Route::get('/rate', 'App\Http\Controllers\RateController@register')->name('rate.register');
