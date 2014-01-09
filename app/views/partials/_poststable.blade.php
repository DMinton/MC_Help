<table class="table table-striped">
	@foreach($posts as $post)
		<tr class="">
			<td>{{link_to('#', $post->title)}}</td>
		</tr>
	@endforeach
</table>