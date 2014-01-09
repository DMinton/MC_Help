<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Post extends Eloquent implements UserInterface, RemindableInterface {

	protected $table = 'posts';
	protected $fillable = array('content', 'title');


}