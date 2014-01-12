<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
		<title>MC_Help</title>
    	{{ stylesheet_link_tag() }}
    	{{ javascript_include_tag() }}
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