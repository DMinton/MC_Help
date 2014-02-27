<?php

class Category extends Eloquent {

	protected $table = 'categories';
	protected $fillable = array('description', 'title');

	public function post()
    {
        return $this->hasMany('Post', 'category_id');
    }

    public function getCategories() {
    	return $this::with('post')
					->orderBy('title')
					->get();
    }

    public function findCateogry($category_id) {
    	return $this::find($category_id);
    }

    public function getCategoryIndex($category) {
    	return $this::where('title', '=', $category)
					->first();
    }

}