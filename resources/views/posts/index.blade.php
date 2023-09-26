@extends('layouts.login')
@section('content')
<!DOCTYPE html>
<html>
<div class='container'>
{!! Form::open(['url' => 'post/create', 'class' => 'pan']) !!}
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
				<th></th>
		 </tr>
		 @foreach ($posts as $post)
			<tr class="posts-list">
					<td class="posts-name">
						<img src="/images/{{ $post->images }}">
					</td>
					<td class="posts-name">
						<p>{{ $post->username }}"</p>
					</td>
					<td class="posts-post">
						{{ $post->posts }}
					</td>
					<td class="posts-created_at">
						{{ $post->created_at }}
					</td>
					<td class="tdtd">
						@if ($post-> user_id == Auth::id())
						<div class="posts-edit" data-target="{{ $post->id }}">
							<img src="images/edit.png">
						</div>
						<div class="edit-content" id="{{ $post->id }}">
							{!! Form::open(['url' => '/post/update']) !!}
								@method('patch')
								<div class="form-group">
									{!! Form::hidden('id', $post->id) !!}
									{!! Form::input('text', 'upPost',$post->posts, ['required', 'class' => 'form-control']) !!}
									<button type="submit" class="btn btn-success pull-right" ><img src="images/edit.png"></button>
								</div>
							{!! Form::close() !!}
						</div>
						{!! Form::open(['url' => '/post/delete']) !!}
							{!! Form::hidden('id', $post->id) !!}
							@method('delete')
							<button type="submit" class="btn btn-success pull-right" onclick="return confirm('こちらのつぶやきを削除します。よろしいでしょうか？')"><img src="images/trash_h.png"></button>
						{!! Form::close() !!}
						@endif
					</td>
				</tr>
		 @endforeach
 </table>
</div>
</html>
@endsection

