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
			<td>{{$user->username}}</td>
			<td>{{$user->postcount}}</td>
			<td>{{date_format($user->created_at, 'M d, Y')}}</td>
		</tr>
	@endforeach
</table>
<div>
	{{ $users->links() }}
</div>