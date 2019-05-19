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

Route::get('/', 'IndexController@index');

Route::group(['middleware', 'guest'], function() {
    // 登録フォームと登録処理
    Route::get('/register', 'RegisterController@create');
    Route::post('/register', 'RegisterController@store');

    // ログインフォームとログイン処理
    Route::get('/login', 'SessionController@showLoginForm');
    Route::post('/login', 'SessionController@login');
});

Route::group(['middleware', 'auth'], function() {

    // ログアウト処理
    Route::get('/logout', 'SessionController@logout');

    // ユーザ情報
    Route::get('/users/{user}', 'UserController@show');
    Route::get('/users/{user}/edit', 'UserController@edit');
    Route::put('users/{user}','UserController@update');
    Route::delete('users/{user}', 'UserController@delete');

    // コメント
    Route::post('recipes/{recipe}/comment', 'CommentController@store');

    // レシピ作成
    Route::get('/recipes/create', 'RecipeController@create');
    Route::post('/recipes/confirm', 'RecipeController@confirm');
    Route::post('/recipes/store', 'RecipeController@store');
    Route::get('/recipes/{recipe}', 'RecipeController@show');

    // レシピ編集
    Route::get('recipes/{recipe}/edit', "RecipeController@edit");
    Route::put('recipes/{recipe}', 'RecipeController@update');

    Route::get('recipe/{recipe}', 'RecipeController@delete');

});






