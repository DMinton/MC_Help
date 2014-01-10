<?php

class Category extends Eloquent {

	protected $table = 'categories';
	protected $fillable = array('description', 'title');

	public function post()
    {
        return $this->hasMany('post', 'cate_id');
    }


}