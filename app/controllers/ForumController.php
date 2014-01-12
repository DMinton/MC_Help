<?php

class ForumController extends BaseController {

	/*
	*	Displays all categories
	*/
	public function getCategoryIndex(){
		$categories = Category::orderBy('title')
					->get();
		$users = User::all();

		return View::make('forum.category.index', array('categories' => $categories, 'users' => $users));
	}

	/*
	*	displays all posts under a category
	*/
	public function getPostIndex($category){

		$cate = Category::where('title', '=', $category)
					->first();

		if(is_null($cate)){
			return View::make('home.notfound');
		}

		$posts = Post::where('cate_id', '=', $cate->id)
					->where('parentpost_id', '=', 0)
					->orderBy('created_at')
					->get();

		$users = Post::where('parentpost_id', '>', 0)
					->orderBy('created_at', 'asc')
					->distinct('parentpost_id')
					->get();
					
		if($posts){
			return View::make('forum.post.index', array('posts' => $posts, 'cate' => $cate, 'users' => $users));
		}
		else{ return View::make('home.notfound'); }
	}

	/*
	*	displays the parentpost and all children
	*/
	public function getPost($cate, $post_id){


		$cate_id = Category::where('title', '=', $cate)
					->get();

		$posts = Post::where('id', '=', $post_id)
					->where('cate_id', '=', $cate_id->first()->id)
					->orWhere('parentpost_id', '=', $post_id)
					->orderBy('created_at')
					->get();

		if($posts){
			return View::make('forum.post.show', array('posts' => $posts));
		}
		else{ return View::make('home.notfound'); }
	}

	/*
	*	creates a new post
	*/
	public function postPost(){

		if (Auth::attempt(array('username' => 'testuser', 'password' => 'test'), true)){

			$cate = Category::find(Input::get('cate_id'));
			$parentpost = Post::find(Input::get('parentpost_id'));

			$post = new Post(array(
		        	'content' => Input::get('content'),
		        	'title' => Input::get('title')
	        	));

			$post->parentpost()->associate($parentpost);
			$post->user()->associate(Auth::user());
			$data = $cate->post()->save($post);
			Auth::user()->increment('postcount');

			return Redirect::back();

		}
		return Redirect::back()->withErrors(array('error_message' => 'message'));
	}
}