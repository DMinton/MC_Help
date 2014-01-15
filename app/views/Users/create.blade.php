@extends('layouts.master')

@section('output')
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">
			<h2>
				Signup
			</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">
			
			{{ Form::open(array('class' => "form-horizontal", 'action' => 'UsersController@postUser')) }}

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

				<div class="form-group">
					<div class='col-md-1'>
						{{ Form::label('password_confirmation') }}
					</div>
					{{ Form::password('password_confirmation') }}
				</div>

				{{ Form::submit('Signup', array('class' => 'btn btn-info')) }}
			{{ Form::close() }}

		</div>
	</div>
@endsection