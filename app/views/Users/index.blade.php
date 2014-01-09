@extends('layouts.master')

@section('output')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			@include('partials._userstable')
		</div>
	</div>
@endsection