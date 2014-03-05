<?php namespace repository;

use interfaces\UserModelInterface;
use User;

class EloquentUserModel implements UserModelInterface {
	public function getUserOrdered() {
		return User::orderBy('username')->paginate(25);
	}

	public function createUser($credentials) {
		$newuser = new User();

		$newuser->username = $credentials['username'];
		$newuser->password = $credentials['password'];

		 return $newuser->save();
	}
}