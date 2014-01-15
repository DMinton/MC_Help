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
				@if(!is_null($cate->post->last()))
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
				@endif
			</td>
			<td>
				@if(!is_null($cate->post->last()))
					</br>
					{{ Post::format_time($cate->post->last()->created_at) }}
				@endif
			</td>
		</tr>
	@endforeach
</table>