@extends('layouts.login')

@section('content')

<div>
  @foreach($icons as $icon)
  <a href="">
    <img src="/images/{{ $icon->images }}" alt="">
  </a>
  @endforeach
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