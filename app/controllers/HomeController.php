<?php

use repository\EloquentCategoryModel as CategoryModel;
use repository\EloquentPostModel as PostModel;

class HomeController extends BaseController {

	public function __construct(CategoryModel $category, PostModel $post) {
		$this->category = $category;
		$this->post = $post;
	}

	public function getIndex() {
		return View::make('home.index');
	}

	public function getSearch() {
		$categories = $this->category->orderCategories();
		return View::make('home.search', array( 'categories' => $categories));
	}

	public function postSearch() {
		$search = Input::get('search');
		$cate = $this->category->findCategory(Input::get('category'));

		$posts = $this->post->getSearchQuery($cate->id, $search);

		$results = 'search results';

		return View::make('forum.post.index', array('cate' => $cate, 'posts' => $posts, 'results' => $results));
	}

}