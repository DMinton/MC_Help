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
				
			</td>
			<td>
				
			</td>
		</tr>
	@endforeach
</table>