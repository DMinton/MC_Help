@extends('layouts.master')

@section('output')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			@include('partials._poststable')
		</div>
	</div>
@endsection