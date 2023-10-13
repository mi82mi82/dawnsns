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

// 新規登録バリデーション
Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

// 新規登録完了画面
Route::get('/added', 'Auth\RegisterController@added');


//ログイン中のページ
// 新規投稿
Route::group(['middleware' => 'auth'], function() {
Route::get('/top','PostsController@index');
Route::post('/post/create','PostsController@create');
// Route::get('/post/create-form', 'PostsController@createForm');

// テストログインしているユーザーの投稿一覧
Route::get('/test','PostsController@user');

// 投稿編集
Route::get('/post/update', 'PostsController@update');
Route::patch('/post/update', 'PostsController@update');

// 投稿削除
Route::delete('/post/delete', 'PostsController@delete')->name('delete');


// ユーザー検索機能
Route::get('/search','UsersController@search');

// ログインしているユーザーのフォローしているユーザー数、フォローされているユーザー数（count使って取得）
Route::get('/show','FollowsController@index');

// フォローするとフォロー外す
Route::post('/follow/create','FollowsController@create');
Route::post('/follow/delete','FollowsController@delete');

// マイプロフィール機能
Route::get('/profile','UsersController@profile');
Route::POST('/upload','UsersController@upload');

// フォロー リスト（自分がフォローした人のユーザー一覧リスト）
	Route::get('/followList', 'FollowsController@followList');

// フォロワー リスト（自分をフォローしてる人のユーザー一覧リスト）
Route::get('/followerList', 'FollowsController@followerList');

// フォローリストやフォロワーリストからユーザープロフィールに飛ぶ
Route::get('/userProfile/{userId}', 'UsersController@userProfile');

// ログアウト機能
Route::get('/logout','Auth\LoginController@logout');
	});

