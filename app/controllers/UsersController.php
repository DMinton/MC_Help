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

		$validator = Validator::make(Input::all(), User::$rules);

		if($validator->passes()){
			$credentials = array(	'username' => Input::get('username'),
									'password' => Input::get('password'));

			$signup = User::create(array(
						'username' => $credentials->username,
						'password' => Hash::make($credentials->password)
					));

			if(Auth::attempt($credentials, true) && Auth::check()){
				return Redirect::intended('/');
			}
		}
		// returns errors due to not validating
		return Redirect::to('signup')->with('type', 'danger')->withErrors($validator)->withInput();
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

		$credentials = array('username' => Input::get('username'),
							 'password' => Input::get('password')
							);

		if(Auth::attempt($credentials, true)){
			if(Auth::check()) { return Redirect::intended('/'); }
		}
		// returns errors due to invalid login data
		$message = "Incorrect username or password.";
		return Redirect::to('login')->withErrors(array('error_message' => $message));
	}

	/*
	*	log out user
	*/
	public function getLogout(){
		if(!Auth::logout()){ return Redirect::back(); }
		// returns errors due to logout
		$message = 'There was an error logging you out. Please try again.';
		return Redirect::back()->withErrors(array('error_message' => $message));
	}

}