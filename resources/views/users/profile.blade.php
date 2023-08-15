@extends('layouts.login')

@section('content')
{!! Form::open(['class' => ''],['url' => '/search']) !!}
	<div class="index-content">

	<div class="books-list">

	<div class="books-list__title mypage-color">

	マイページトップ

	</div>

	<div class="book-table">

	<div class="book-table__profile-list">

	<div class="profile-group">

	<div class="profile-group__title">ユーザー名</div>

	<div class="profile-group__element">{{$Auth->user}}</div>

	</div>

	<div class="profile-group">

	<div class="profile-group__title">メールアドレス</div>

	<div class="profile-group__element">{{$Auth->email}}</div>

	</div>

	<div class="profile-group">

	<div class="profile-group__title">既存パスワード</div>

	<div class="profile-group__element">{{$Auth->password}}</div>

	</div>
	<div class="profile-group">

	<div class="profile-group__title">新しいパスワード</div>

	<div class="profile-group__element">{{$Auth->newpassword}}</div>

	</div>

	<div class="profile-group">

	<div class="profile-group__title">自己紹介文</div>

	<div class="profile-group__element">{{$Auth->bio}}</div>

	</div>

	<div class="profile-group">

	<div class="profile-group__title">ユーザーアイコン</div>

	<div class="profile-group__element">{{$Auth->Iconimage}}</div>

	</div>

	</div>

	</div>

	</div>

	</div>

@endsection