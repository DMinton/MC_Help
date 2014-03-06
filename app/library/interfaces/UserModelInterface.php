<?php namespace interfaces;

interface UserModelInterface {
	public function getUserOrdered();
	public function createUser($credentials);
	public function getCredentials($credentials);
}