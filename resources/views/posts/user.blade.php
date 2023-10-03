<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ログインしているユーザーの投稿一覧</title>
</head>
<body>
	<h2 class='page-header'>投稿一覧</h2>
		<table class='table table-hover'>
				<tr>
						<th>投稿内容</th>
				</tr>
				@foreach ($posts as $post)
					<tr class="posts-list">
							<td class="posts-post">
								{{ $post->posts }}
							</td>
					</tr>
			@endforeach
		</table>
	</body>
</html>