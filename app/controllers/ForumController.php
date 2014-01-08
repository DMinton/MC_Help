<?php

class ForumController extends BaseController {

	public function getIndex()
	{
		return View::make('forum.index');
	}

}