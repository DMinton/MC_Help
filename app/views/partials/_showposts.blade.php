<table class="table table-striped table-bordered">
	@foreach($posts as $post)
		<tr class="post-row">
			<td class="post-data">
				{{ $post->user->username }}</br>
				{{ "Posts: " . $post->user->postcount }}</br></br>
				{{ Post::format_time($post->created_at) }}
			</td>
			<td class="post">
				<table>
					<tr>
						<th class="post-title">
							<small>
								{{ $post->title }}
							</small>
						</th>
					</tr>
					<tr>
						<td class="post-content">
							{{ $post->content }}
						</td>
					</tr>
				</table>
			</td>
		</tr>
	@endforeach
</table>