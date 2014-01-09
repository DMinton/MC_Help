<?php

class UsersController extends BaseController {

	public function getIndex()
	{
		$users = User::orderBy('name')->get();
		return View::make('users.index', array('users' => $users));
	}

}