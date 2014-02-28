<?php namespace interfaces;

interface UserModelInterface {
	public function orderUser();
	public function createUser($credentials);
}