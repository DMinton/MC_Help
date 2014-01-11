<table class="table table-striped">
	@foreach($posts as $post)
		<tr>
			<td>
				{{ link_to_action('ForumController@getPost', $post->title, array($cate->title ,$post->id)) }}
			</td>
			<td>
				{{ "Created by: " . $post->user->name }}
			</td>
			<td>
				{{ Post::format_time($post->created_at) }}
			</td>
		</tr>
	@endforeach
</table>