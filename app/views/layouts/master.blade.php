<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
		<title>MC_Help</title>
		{{stylesheet_link_tag()}}
		{{stylesheet_link_tag("bootstrap-theme.min.css")}}
		{{stylesheet_link_tag("bootstrap.min.css")}}
    	{{javascript_include_tag()}}
    	{{javascript_include_tag("bootstrap.min.js")}}
	</head>
	<body>
		<div class="container">
			@include('partials._nav')
			<div class="output">
				@yield('output')
			</div>
			@include('partials._footer')
		</div>
	</body>
</html>