<table class="table table-striped">
	@foreach($posts as $post)
		<tr>
			<td>
				{{ link_to_action('ForumController@getPost', $post->title, array($cate->title ,$post->id)) }}
			</td>
			<td>
				{{ 'Posted by: ' . $users->find($post->user_id)->name }}</br>
			</td>
			<td>
				{{ 'Posted at: ' . $post->created_at }}
			</td>
		</tr>
	@endforeach
</table>