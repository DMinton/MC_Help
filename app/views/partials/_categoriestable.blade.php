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
					<small>{{ link_to("forum/$cate->title/" . $cate->post->first()->id, $cate->post->first()->title) }}</small></br>
					{{ 'Created By: ' . $users->find($cate->post->first()->user_id)->username }}
				@endif
			</td>
			<td>
				@if($cate->post->first())
					{{ Post::format_time($cate->post->first()->created_at) }}
				@endif
			</td>
		</tr>
	@endforeach
</table>