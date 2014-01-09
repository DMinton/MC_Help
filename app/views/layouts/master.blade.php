<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
		<title>MC_Help</title>
		{{stylesheet_link_tag("bootstrap-theme.min.css")}}
		@if(Input::get('theme') == 'slate')
			{{stylesheet_link_tag("bootstrapslate.min.css")}}
		@else
			{{stylesheet_link_tag("bootstrap.min.css")}}    	
    	@endif
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