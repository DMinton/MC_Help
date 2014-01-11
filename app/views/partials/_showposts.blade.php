<table class="table table-striped">
	@foreach($posts as $post)
		<tr class="">
			<td>
				{{ $post->user->name }}</br>
				{{ "Posts: " . $post->user->postcount }}</br></br>
				{{ Post::format_time($post->created_at) }}
			</td>
			<td>
				<table>
					<tr>
						<th>
							<small>
								{{ $post->title }}
							</small>
						</th>
					</tr>
					<tr>
						<td>
							{{ $post->content }}
						</td>
					</tr>
				</table>
			</td>
		</tr>
	@endforeach
</table>