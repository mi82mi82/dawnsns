@extends('layouts.login')
@section('content')
<!DOCTYPE html>
<html>

<h2><div class='container'>
{!! Form::open(['url' => 'post/create']) !!}
        <div class="form-group">
            {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容']) !!}
        </div>
        <button type="submit" class="btn btn-success pull-right">投稿</button>
        {!! Form::close() !!}

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
		    <!-- 制御構文 投稿リストページの中で最も重要となる投稿一覧を実装している箇所 -->
				<td>{{ $post->id }}</td>
				<td>{{ $post->posts }}</td>
				<td>{{ $post->created_at }}</td>
				
				{!! Form::open(['url' => '/post/update']) !!}
				<td><a class="btn btn-primary" href="/post/{{ $post->id }}/">更新</a></td>
				@method('patch')
           <div class="form-group">
            {!! Form::hidden('id', $post->id) !!}
            {!! Form::input('text', 'upPost',$post->posts, ['required', 'class' => 'form-control']) !!}
        </div>
        <button type="submit" class="btn btn-success pull-right">更新</button>
        {!! Form::close() !!}

				<td><a class="btn btn-danger" href="/post/{{ $post->id }}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a></td>
		 </tr>
		 @endforeach
 </table>
</div></h2>
</html>

@endsection