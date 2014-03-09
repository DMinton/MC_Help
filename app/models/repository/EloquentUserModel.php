<?php namespace repository;

use interfaces\UserModelInterface;
use User;

class EloquentUserModel implements UserModelInterface {
	public function getUserOrdered() {
		return User::orderBy('username')->paginate(25);
	}

	public function createUser($credentials) {
		$newuser = new User();

		$newuser->username = e($credentials['username']);
		$newuser->password = e($credentials['password']);

		 return $newuser->save();
	}

	public function getCredentials($credentials) {
		return array(	
					'username' => e($credentials['username']),
					'password' => e($credentials['password'])
				);
	}
}