<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Posts</th>
			<th>Joined</th>
		</tr>
	</thead>
	@foreach($users as $user)
		<tr class="">
			<td>{{$user->name}}</td>
			<td>{{$user->postcount}}</td>
			<td>{{date_format($user->created_at, 'M d, Y')}}</td>
		</tr>
	@endforeach
</table>