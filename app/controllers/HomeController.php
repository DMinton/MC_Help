<?php

use interfaces\CategoryModelInterface as CategoryModel;
use interfaces\PostModelInterface as PostModel;

class HomeController extends BaseController {

	/*
	*	Constructor
	*/
	public function __construct(CategoryModel $category, PostModel $post) {
		$this->category = $category;
		$this->post = $post;
	}

	/*
	*	displays main page
	*/
	public function getIndex() {
		return View::make('home.index');
	}

	/*
	*	displays search page
	*/
	public function getSearch() {
		$categories = $this->category->getCategoriesforSearch();
		return View::make('home.search', array( 'categories' => $categories));
	}

	/*
	*	displays search results
	*/
	public function postSearch() {
		$search = Input::get('search');
		$cate = $this->category->findCategory(Input::get('category'));

		$posts = $this->post->getSearchQuery($cate->id, $search);

		$results = 'search results';

		return View::make('forum.post.index', array('cate' => $cate, 'posts' => $posts, 'results' => $results));
	}

}