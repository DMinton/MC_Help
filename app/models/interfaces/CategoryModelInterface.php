<?php namespace interfaces;

interface CategoryModelInterface {
	public function getAllCategories();
    public function findCategory($category_id);
    public function getCategoryIndex($category);
    public function getCategoriesforSearch();
}