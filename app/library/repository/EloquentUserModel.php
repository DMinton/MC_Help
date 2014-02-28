<?php namespace repository;

use interfaces\UserModelInterface;
use User;

class EloquentUserModel implements UserModelInterface {
	public function orderUser() {
		return User::orderBy('username')->get();
	}

	public function createUser($credentials) {
		$newuser = new User();

		$newuser->username = $credentials['username'];
		$newuser->password = $credentials['password'];

		 return $newuser->save();
	}
}