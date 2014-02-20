<table class="table table-striped">
	@foreach($posts as $post)
		@if(is_null($post->parentPost))
			<tr>
				<td>
					{{ link_to_action('ForumController@getPost', $post->title, 
														array($cate->title, $post->id)) }}
				</td>
				<td>
					{{ "Created by: " . $post->user->username }}</br>
					@if(!is_null($post->childrenPosts->last()))
						{{ "Last post by: " . $post->childrenPosts->last()->user->username }}
					@endif
				</td>
				<td>
					@if(!is_null($post->childrenPosts->last()))
						{{ Post::format_time($post->parentPost->created_at) }}
					@else
						{{ Post::format_time($post->childrenPosts->last()->created_at) }}
					@endif
				</td>
			</tr>
		@else
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
					@if(is_null($post->parentPost->childrenPosts->last()))
						{{ Post::format_time($post->parentPost->parentPost->created_at) }}
					@else
						{{ Post::format_time($post->parentPost->childrenPosts->last()->created_at) }}
					@endif
				</td>
			</tr>
		@endif
	@endforeach
	@if(empty($posts))
		<tr>
			<td>
				No Posts Yet
			</td>
		</tr>
	@endif
</table>
<div>
	{{ $posts->links() }}
</div>