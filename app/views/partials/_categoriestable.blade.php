<table class="table table-striped">
	<thead>
		<tr>
			<th>
				Category
			</th>
			<th>
				Most Recent Post
			</th>
		</tr>
	</thead>
	@foreach($categories as $cate)
		<tr class="">
			<td>
				<h4>{{ link_to_action("ForumController@getPostIndex", $cate->title, array($cate->title)) }}</h4>
				<small>{{ $cate->description }}</small>
			</td>
			<td>
				<small>
					{{ link_to_action("ForumController@getPost", $cate->post->last()->parentPost->title, 
												array($cate->title, $cate->post->last()->parentpost_id)) }}
				</small></br>
				<small>
					{{ 'Created By: ' . $cate->post->last()->parentPost->user->username }}
				</small></br>
				<small>
					{{ 'Last post by: ' . $cate->post->last()->user->username }}
				</small>
			</td>
			<td>
				</br>
				{{ Post::format_time($cate->post->last()->created_at) }}
			</td>
		</tr>
	@endforeach
</table>