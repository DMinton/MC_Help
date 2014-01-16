{{ Form::open(array('class' => "form-horizontal", 'action' => 'HomeController@postSearch')) }}

	<div class="form-group">

		<div class="form-group">
			{{ Form::select('category', $categories, 'id', array('class' => 'form-control')) }}
		</div>
		
		<div class="form-group">
			{{ Form::label('searchTitle', 'Search title only') }}
			{{ Form::radio('searchOptions', 'searchTitle') }}
			{{ Form::label('searchAll', 'Search all text') }}
			{{ Form::radio('searchOptions', 'searchAll', 'autofocus') }}
		</div>

		<div class="form-group">
			{{ Form::label('search') }}
			{{ Form::text('search') }}
		</div>
	</div>
	{{ Form::submit('Search', array('class' => 'btn btn-info')) }}

{{ Form::close() }}