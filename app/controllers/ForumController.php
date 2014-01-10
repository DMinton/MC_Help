<?php

class ForumController extends BaseController {

	public function getCategoryIndex(){
		$categories = Category::orderBy('title')
					->get();
		$users = User::all();

		return View::make('forum.category.index', array('categories' => $categories, 'users' => $users));
	}

	public function getPostIndex($category){

		$cate = Category::where('title', '=', $category)
					->first();
		$posts = Post::where('cate_id', '=', $cate->id)
					->where('parentpost', '=', 0)
					->orderBy('created_at')
					->get();
		$users = User::all();

		if($posts){
			return View::make('forum.post.index', array('posts' => $posts, 'cate' => $cate, 'users' => $users));
		}
		else{ return View::make('home.notfound'); }
	}

	public function getPost($cate, $post_id){

		$cate_id = Category::where('title', '=', $cate)
					->get();
		$mainpost = Post::where('id', '=', $post_id)
					->where('cate_id', '=', $cate_id->first()->id)
					->first();
		$posts = Post::where('parentpost', '=', $post_id)
					->get();

		if($mainpost){
			return View::make('forum.post.show', array('mainpost' => $mainpost, 'posts' => $posts));
		}
		else{ return View::make('home.notfound'); }
	}

}