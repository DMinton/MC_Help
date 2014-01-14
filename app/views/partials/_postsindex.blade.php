
<table class="table table-striped">
	@foreach($posts as $post)
		<tr>
			<td>
				{{ link_to_action('ForumController@getPost', $post->parentPost->title, 
													array($cate->title, $post->parentPost->id)) }}
			</td>
			<td>
				{{ "Created by: " . $post->parentPost->user->username }}</br>
				@if(!is_null($post->parentPost->childrenPosts->last()))
					{{ "Last post by: " . $post->parentPost->childrenPosts->last()->user->username }}
				@endif
			</td>
			<td>
				@if(!is_null($post->parentPost->childrenPosts->last()))
					{{ Post::format_time($post->parentPost->childrenPosts->last()->created_at) }}
				@elseif
					{{ Post::format_time($post->parentPost->parentPost->created_at) }}
				@endif
			</td>
		</tr>
	@endforeach
	@if(empty($posts))
		<tr>
			<td>
				No Posts Yet
			</td>
		</tr>
	@endif
</table>