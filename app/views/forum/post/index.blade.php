@extends('layouts.master')

@section('output')
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">
			<h2>
				{{ $cate->title }}
			</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			@include('partials._poststable')
		</div>
	</div>
@endsection