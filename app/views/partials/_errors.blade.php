@if($errors->first())
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			{{ "<div class='alert alert-danger'>" }}
				<ul>
			      @foreach($errors->all() as $error)
			         <li>{{ $error }}</li>
			      @endforeach
				</ul>
			</div>
		</div>
	</div>
@endif