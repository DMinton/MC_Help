<table class="table table-striped">
	@foreach($posts as $post)
	{{dd($post)}}
		<tr>
			<td>
				{{ link_to_action('ForumController@getPost', $parentposts->find($post->parentpost_id)->title, 
									array($cate->title, 
										$parentposts->find($post->parentpost_id)->id
									))
				}}
			</td>
			<td>
				{{ "Created by: " . $parentposts->find($post->parentpost_id)->user->username }}</br>
				@if(!is_null($post->user))
					{{ "Last post by: " . $post->user->username }}
				@endif
			</td>
			<td>
				@if(is_null($post->getPosts->first()))
					{{ Post::format_time($post->created_at) }}
				@else
					{{ Post::format_time($post->getPosts()->first()->created_at) }}
				@endif
			</td>
		</tr>
	@endforeach
</table>