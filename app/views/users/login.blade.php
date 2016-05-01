@extends('layouts.master')

@section('output')
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">
			<h2>
				Login
			</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">
			
			{{ Form::open(array('class' => "form-horizontal", 'action' => 'UsersController@postLoginUser')) }}

				<div class="form-group">
					<div class='col-md-1'>
						{{ Form::label('username') }}
					</div>
					{{ Form::text('username') }}
				</div>	

				<div class="form-group">
					<div class='col-md-1'>
						{{ Form::label('password') }}
					</div>
					{{ Form::password('password') }}
				</div>

				{{ Form::submit('Signup', array('class' => 'btn btn-info')) }}
			{{ Form::close() }}

		</div>
	</div>
@endsection