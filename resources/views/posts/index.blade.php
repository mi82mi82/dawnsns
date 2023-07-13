@extends('layouts.login')
@section('content')
<!DOCTYPE html>
<html>

<h2><div class='container'>
{!! Form::open(['class' => 'pan'],['url' => 'post/create']) !!}
        <div class="form-groupup">
            {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => 'なにをつぶやこうか...？']) !!}
						<button type="submit" class="btn btn-success pull-right"><img src="images/post.png"></button>
        </div>
        {!! Form::close() !!}

<h2 class='page-header'>投稿一覧</h2>
<table class='table table-hover'>
		 <tr>
				<th>投稿者アイコン</th>
				<th>投稿者名</th>
				<th>投稿内容</th>
				<th>投稿日時</th>
		 </tr>
		 @foreach ($posts as $post)


		 <tr class="posts-list">
		    <!-- 制御構文 投稿リストページの中で最も重要となる投稿一覧を実装している箇所 -->
				<td class="posts-name"><img src=<img src="/images/{{ $post->images }}">{{ $post->id }}</td>
				<td class="posts-post">{{ $post->posts }}</td>
				<td class="posts-created_at">{{ $post->created_at }}</td>

@if ($post-> user_id == Auth::id())
<!-- もし、その投稿がログインしている自分のidであったら -->
				{!! Form::open(['url' => '/post/update']) !!}
				<td class="tdtd"><a class="btn btn-primary" href="/post/{{ $post->id }}/"><img src="images/edit.png"></a></td>
				@method('patch')
           <div class="form-group">
            {!! Form::hidden('id', $post->id) !!}
						<!-- 上の記述 <input type="hidden" name="id" value="{{ $post->id }}"> -->
            {!! Form::input('text', 'upPost',$post->posts, ['required', 'class' => 'form-control']) !!}
						<!-- 上の記述 <input type="text" name="upPost" value="{{ $post->posts }}" required class="form-controle"> -->
						<button type="submit" class="btn btn-success pull-right">更新</button>
						{!! Form::close() !!}
					 </div>

				{!! Form::open(['url' => '/post/delete']) !!}
				<!-- {!! Form::input('text', 'delete',$post->posts, ['required', 'class' => 'form-control']) !!} -->
				{!! Form::hidden('id', $post->id) !!}
				<td class="tdtdtd"><a class="btn btn-danger" href="/post/{{ $post->id }}/delete" onclick="return confirm('こちらのつぶやきを削除します。よろしいでしょうか？')"><img src="images/trash_h.png"></a></td>
				@method('delete')
				{{ csrf_field() }}
				{!! Form::close() !!}
		 </tr>
		 @endif
		 @endforeach
 </table>
</div></h2>
</html>

@endsection

