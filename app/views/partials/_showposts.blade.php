<table class="table table-striped">
	<tr>
		<td>
			{{ $mainpost->title }}
		</td>
		<td>
			{{ $mainpost->content }}
		</td>

	</tr>
	@foreach($posts as $post)
		<tr class="">
			<td>{{ $post->title }}</td>
			<td>{{ $post->content }}</td>
		</tr>
	@endforeach
</table>