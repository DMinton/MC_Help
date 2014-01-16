<?php

class HomeController extends BaseController {

	public function getIndex() {
		return View::make('home.index');
	}

	public function getSearch() {
		$categories = Category::orderBy('title')->lists('title', 'id');
		return View::make('home.search', array( 'categories' => $categories));
	}

	public function postSearch() {
		$search = Input::get('search');
		$cate = Category::where('id', '=', Input::get('category'))
						->first();
						
		$posts = Post::where('category_id', '=', $cate->id)
						->where('content', 'like', "%$search%")
						->orderBy('created_at')
						->get();

		$results = 'search results';

		return View::make('forum.post.index', array('cate' => $cate, 'posts' => $posts, 'results' => $results));
	}

}