<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
		<title>MC_Help</title>

		<link href="{{ secure_asset('assets/stylesheets/bootstrap-theme.min.css') }}" rel="stylesheet">
		<link href="{{ secure_asset('assets/stylesheets/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ secure_asset('assets/stylesheets/stylesheet.css') }}" rel="stylesheet">

    	<script src="{{ secure_asset('assets/javascripts/1.11.0.min.js') }}" ></script>
    	<script src="{{ secure_asset('assets/javascripts/bootstrap.min.js') }}" ></script>

	</head>
	<body>
		<div class="container">
			@include('partials._nav')
			@include('partials._errors')
			<div class="output">
				@yield('output')
			</div>
			@include('partials._footer')
		</div>
	</body>
</html>
