<?php

class PostsController extends BaseController {

	public function getIndex()
	{
		return View::make('posts.index');
	}

}