<?php

class UsersController extends BaseController {

	/*
	*	Displays all users
	*/
	public function getIndex()
	{
		$users = User::orderBy('username')->get();
		return View::make('users.index', array('users' => $users));
	}

	/*
	*	displays create a user
	*/
	public function getUser(){
		return View::make('users.create');
	}

	/*
	*	creates a user
	*/
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

	/*
	*	displays login user
	*/
	public function getLoginUser(){
		return View::make('users.login');
	}

	/*
	*	logs in user
	*/
	public function postLoginUser(){

		if(Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')), true)){
			return Redirect::intended('/');
		}
		$message = "";
		return Redirect::to('login')->withErrors(array('error_message' => $message));
	}

	/*
	*	log out user
	*/
	public function getLogout(){
		if(!Auth::logout()){ return Redirect::back(); }
		$message = 'There was an error logging you out. Please try again.';
		return Redirect::back()->withErrors(array('error_message' => $message));
	}

}