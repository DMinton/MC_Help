<table class="table table-striped">
	@foreach($categories as $cate)
		<tr class="">
			<td>
				<h4>{{link_to("forum/$cate->title", $cate->title)}}</h4>
				<small>{{$cate->description}}</small>
			</td>
			<td>
				<small>{{link_to('#', 'most recent post')}}</small></br>
				<small>{{'By: User Name'}}</small>
			</td>
			<td>
				<small>{{date_format($cate->created_at, 'M j, Y')}}</small></br>
				<small>{{date_format($cate->created_at, 'g:m')}}</small>
			</td>
		</tr>
	@endforeach
</table>