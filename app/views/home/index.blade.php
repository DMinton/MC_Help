@extends('layouts.master')

@section('output')
	<div class="jumbotron">
  		<h1>MC_Help</h1>
  		<p>Welcome to my thesis project 2.0</p>
	</div>
	<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<p>
					To see how far I have come as a developer in the past two years, a link to the old site is provided {{ link_to( 'http://mc-help.herokuapp.com/index.php', 'here' , array('target' => '_blank')) }}. This site is currently still a work in progress.
				</p>
			</div>
		</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<p>
				This website is made in coordination with my thesis. It is being made to help me learn and develop as a programmer. Along with that, this site is designed to be a way to communicate and collaborate with peers outside the classroom to find solutions to problems and assignments in the classroom. It is also designed to integrate with Facebook for easy notification and fast responses to these questions. This website is designed purely for learning and sharing of ideas.
			</p>
		</div>
	</div>
@endsection