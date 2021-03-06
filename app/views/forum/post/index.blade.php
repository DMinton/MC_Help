@extends('layouts.master')

@section('output')
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">
			<h2>
				{{ $cate->title }}
			</h2>
			@if(isset($results))
				<h4>{{$results}}</h4>
			@endif
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			@include('partials._postsindex')
		</div>
	</div>
	@if(Auth::check())
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				@include('partials._reply')
			</div>
		</div>
	@endif
@endsection