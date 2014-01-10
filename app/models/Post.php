<?php

class Post extends Eloquent {

	protected $table = 'posts';
	protected $fillable = array('content', 'title');

	public function categories()
    {
        return $this->belongsTo('Category');
    }

    public function users()
    {
        return $this->belongsTo('User');
    }


}