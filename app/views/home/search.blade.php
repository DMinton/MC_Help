@extends('layouts.master')

@section('output')
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">
			<h2>
				Search
			</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			@include('partials._searchform')
		</div>
	</div>
@endsection