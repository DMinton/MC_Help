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

		if(is_null($cate)){
			return View::make('home.notfound');
		}

		$posts = Post::where('cate_id', '=', $cate->id)
					->where('parentpost', '=', 0)
					->orderBy('created_at')
					->get();

		$users = Post::where('parentpost', '>', 0)
					->orderBy('created_at', 'asc')
					->distinct('parentpost')
					->get();
					
		if($posts){
			return View::make('forum.post.index', array('posts' => $posts, 'cate' => $cate, 'users' => $users));
		}
		else{ return View::make('home.notfound'); }
	}

	public function getPost($cate, $post_id){


		$cate_id = Category::where('title', '=', $cate)
					->get();

		$posts = Post::where('id', '=', $post_id)
					->where('cate_id', '=', $cate_id->first()->id)
					->orWhere('parentpost', '=', $post_id)
					->orderBy('created_at')
					->get();

		if($posts){
			return View::make('forum.post.show', array('posts' => $posts));
		}
		else{ return View::make('home.notfound'); }
	}
}