@extends('layouts.login')

@section('content')
<div>
	<img src="/images/{{ $profile->images }}">
	<p>{{ $profile->username }}</p>
	<p>{{ $profile->bio }}</p>
	@if($followings->contains($profile->id))
	<form action="/follow/delete" method="post">
					@csrf
					<input type="hidden" name="id" value="{{$profile->id}}">
					<input type="submit" value="フォロー外す">
	</form>

	@else

	<form action="/follow/create" method="post">
					@csrf
					<input type="hidden" name="id" value="{{$profile->id}}">
					<input type="submit" value="フォローする">
	</form>
	@endif

</div>
<table class='table table-hover'>
		 <tr>
				<th>投稿者アイコン</th>
				<th>投稿者名</th>
				<th>投稿内容</th>
				<th>投稿日時</th>
				<th></th>
		 </tr>
		 @foreach ($timelines as $timeline)
			<tr class="posts-list">
					<td class="posts-name">
						<img src="/images/{{ $timeline->user->images }}">
					</td>
					<td class="posts-name">
						<p>{{ $timeline->user->username }}"</p>
					</td>
					<td class="posts-post">
						{{ $timeline->posts }}
					</td>
					<td class="posts-created_at">
						{{ $timeline->created_at }}
					</td>
				</tr>
		 @endforeach
 </table>

@endsection