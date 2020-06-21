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

Route::get('/', 'EnquetesController@top');

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// ユーザ機能
Route::group(['middleware' => 'auth'], function(){
    //アンケート作成、変更、削除
    Route::get('enquetes/index/{page_type}', 'EnquetesController@index')->name('enquetes.index_type');
    Route::resource('enquetes', 'EnquetesController');
    Route::get('enquetes/{id}/choice_create', 'ChoicesController@create')->name('choices.create');
    Route::post('enquetes/{id}/choice_store', 'ChoicesController@store')->name('choices.store');

    //アンケート回答
    Route::resource('answers', 'AnswersController');
    Route::get('enquetes/{id}/answer_create', 'AnswersController@create')->name('answers.create');
    Route::post('enquetes/{id}/answer_store', 'AnswersController@store')->name('answers.store');
    
    /*Route::group(['prefix' => 'users/{id}'], function(){
        Route::get('favorites', 'UsersController@favorites')->name('users.favorites');
    });*/
    
    Route::group(['prefix' => 'enquetes/{id}'], function(){
        Route::post('favorite', 'FavoritesController@store')->name('favorites.favorite');
        Route::delete('unfavorite', 'FavoritesController@destroy')->name('favorites.unfavorite');
    });
});