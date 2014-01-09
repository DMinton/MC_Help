<?php

class ForumController extends BaseController {

	public function getCategoryIndex(){
		$categories = Category::orderBy('title')->get();
		return View::make('forum.category.index', array('categories' => $categories));
	}

	public function getPostIndex($category){
		$cate = Category::where('title', '=', $category)->first();
		$posts = Post::where('cate_id', '=', $cate->id)->orderBy('created_at')->get();
		return View::make('forum.post.index', array('posts' => $posts));
	}

}