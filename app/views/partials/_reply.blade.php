<div class="panel-group" id="accordion">
	<div class="panel panel-default hidden">
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
					@if(isset($cate->title))
						New Post
					@else
						Reply
					@endif
				</a>
			</h4>
		</div>
		<div id="collapseTwo" class="panel-collapse collapse">
			<div class="panel-body text-center">
				@include('partials._replyform')
			</div>
		</div>
	</div>
</div>