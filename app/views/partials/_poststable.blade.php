<table class="table table-striped">
	@foreach($posts as $post)
		<tr>
			<td>
				{{ link_to_action('ForumController@getPost', $post->title, 
													array($cate->title, $post->id)) }}
			</td>
			<td>
				{{ "Created by: " . $post->user->username }}</br>
				@if(!is_null($post->childrenPosts->last()))
					{{ "Last post by: " . $post->user->username }}
				@endif
			</td>
			<td>
					{{ Post::format_time($post->created_at) }}
			</td>
		</tr>
	@endforeach
</table>