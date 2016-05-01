@extends('layouts.master')

@section('output')
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">
			<h2>
				Users
			</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			@include('partials._userstable')
		</div>
	</div>
@endsection