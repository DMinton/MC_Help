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
				<h4>{{ link_to("forum/$cate->title", $cate->title) }}</h4>
				<small>{{ $cate->description }}</small>
			</td>
			<td>
				@if($cate->post->first())
					<small>
						{{ link_to("forum/$cate->title/" . $cate->getLastCatePostParentId(), 
							$parents->find($cate->getLastCatePostParentId())->title ) }}
					</small></br>
					<small>
						{{ 'Created By: ' . $users->find($parents->find($cate->getLastCatePostParentId())->user_id)->username }}
					</small></br>
					<small>
						{{ 'Last post by: ' . $users->find($cate->getLastCatePostId())->username }}
					</small>

				@endif
			</td>
			<td>
				@if($cate->post->first())
					{{ Post::format_time($cate->post->last()->created_at) }}
				@endif
			</td>
		</tr>
	@endforeach
</table>