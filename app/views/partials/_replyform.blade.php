{{ Form::open(array('class' => "form-horizontal", 'action' => 'ForumController@postPost')) }}

	<div class="form-group">

		{{ Form::hidden('category_id', $posts->first()->category_id) }}
		@if(isset($cate->title))
			{{ Form::hidden('parentpost_id', 0) }}
		@else
			{{ Form::hidden('parentpost_id', $posts->first()->id) }}
		@endif

		<div class="form-group">
			{{ Form::label('title') }}
			{{ Form::text('title', '', array('id' => 'forum_reply_text')) }}
		</div>
		
		{{ Form::textarea('content', '',array('id' => 'forum_reply_textarea')) }}

	</div>
		@if(isset($cate->title))
			{{ Form::submit('New Post', array('class' => 'btn btn-info')) }}
		@else
			{{ Form::submit('Reply', array('class' => 'btn btn-info')) }}
		@endif

{{ Form::close() }}