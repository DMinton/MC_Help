<?php namespace interfaces;

interface CategoryModelInterface {
	public function getCategories();
    public function findCategory($category_id);
    public function getCategoryIndex($category);
    public function orderCategories();
}