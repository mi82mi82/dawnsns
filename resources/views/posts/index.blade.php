@extends('layouts.login')
@section('content')
<!DOCTYPE html>
<html>

<h2><div class='container'>

<p class="pull-right"><a class="btn btn-success" href="/post/create-form">投稿する</a></p>

<h2 class='page-header'>投稿一覧</h2>
<table class='table table-hover'>
		 <tr>
				<th>投稿No</th>
				<th>投稿内容</th>
				<th>投稿日時</th>
				<th></th>
				<th></th>
		 </tr>
		 @foreach ($posts as $post)


		 <tr>
				<td>{{ $post->id }}</td>
				<td>{{ $post->posts }}</td>
				<td>{{ $post->created_at }}</td>
				<td><a class="btn btn-primary" href="/post/{{ $post->id }}/update-form">更新</a></td>
				<td><a class="btn btn-danger" href="/post/{{ $post->id }}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a></td>
		 </tr>
		 @endforeach
 </table>
</div></h2>
</html>

@endsection