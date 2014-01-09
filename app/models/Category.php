<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Category extends Eloquent implements UserInterface, RemindableInterface {

	protected $table = 'categories';
	protected $fillable = array('description', 'title');


}