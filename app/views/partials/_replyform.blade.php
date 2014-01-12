{{ Form::open(array('class' => "form-horizontal", 'action' => 'ForumController@postPost')) }}

	<div class="form-group">

		{{ Form::hidden('parentpost_id', $posts->first()->id) }}
		{{ Form::hidden('cate_id', $posts->first()->cate_id) }}

		<div class="form-group">
			{{ Form::label('title') }}
			{{ Form::text('title', '', array('id' => 'forum_reply_text')) }}
		</div>
		
		{{ Form::textarea('content', '',array('id' => 'forum_reply_textarea')) }}

	</div>
	{{ Form::submit('Reply', array('class' => 'btn btn-default')) }}

{{ Form::close() }}