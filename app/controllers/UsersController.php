<?php

class UsersController extends BaseController {

	public function getIndex()
	{
		$users = User::orderBy('username')->get();
		return View::make('users.index', array('users' => $users));
	}

	public function getUser(){
		return View::make('users.create');
	}

	public function postUser(){

		$signup = User::create(array(
					'username' => Input::get('username'),
					'password' => Hash::make(Input::get('password'))
				));

		if(Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')), true)){
			return Redirect::intended('/');
		}
		return Redirect::to('signup');
	}

}