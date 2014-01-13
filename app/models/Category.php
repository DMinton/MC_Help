<?php

class Category extends Eloquent {

	protected $table = 'categories';
	protected $fillable = array('description', 'title');

	public function post()
    {
        return $this->hasMany('Post', 'category_id');
    }

    public function getLastCatePostParentId(){
    	return $this->post->last()->parentpost_id;
    }

    public function getLastCatePostId(){
    	return $this->post->last()->user_id;
    }


}