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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login');

// Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');


//ログイン中のページ
// 新規投稿
Route::get('/top','PostsController@index');
Route::post('/post/create','PostsController@create');
// Route::get('/post/create-form', 'PostsController@createForm');

// 投稿更新
Route::get('/post/update', 'PostsController@update');
Route::patch('/post/update', 'PostsController@update');

// 投稿削除
Route::delete('/post/delete', 'PostsController@delete')->name('delete');
Route::get('/profile','UsersController@profile');


// フォローフォロワー機能
Route::get('/search','UsersController@search');

// ログインしているユーザーのフォローしているユーザー数、フォローされているユーザー数（count使って取得）
Route::group(['middleware' => 'auth'], function() {
Route::get('/show','FollowsController@index');
});
Route::get('/follow-list','FollowsController@followList');
Route::get('/follower-list','FollowsController@followerList');
Route::post('/follow/create','FollowsController@create');
Route::post('/follow/delete','FollowsController@delete');

// マイプロフィール機能
Route::get('/search','UsersController@profile');
Route::POST('/upload','UsersController@upload');
// Route::get('/search', 'UserController@profile')->name('user.index');



