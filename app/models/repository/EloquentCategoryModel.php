<?php namespace repository;

use interfaces\CategoryModelInterface;
use Category;

class EloquentCategoryModel implements CategoryModelInterface {
	public function getAllCategories() {
    	return Category::with('post')
					->orderBy('title')
					->get();
    }

    public function findCategory($category_id) {
    	return Category::find($category_id);
    }

    public function getCategoryIndex($category) {
    	return Category::where('title', '=', $category)
					->first();
    }

    public function getCategoriesforSearch() {
        return Category::orderBy('title')
                    ->lists('title', 'id');
    }
}