<table class="table table-striped">
	@foreach($categories as $cate)
		<tr class="">
			<td>
				<h4>{{link_to("forum/$cate->title", $cate->title)}}</h4>
				<small>{{$cate->description}}</small>
			</td>
			<td><small>{{$cate->created_at}}</small></td>
		</tr>
	@endforeach
</table>