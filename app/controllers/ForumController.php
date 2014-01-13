<?php

class ForumController extends BaseController {

	/*
	*	Displays all categories
	*/
	public function getCategoryIndex(){
		$categories = Category::with('post')
					->orderBy('title')
					->get();

		$parents = Post::where('parentpost_id', '=', 0)
					->get();

		$users = User::where('postcount', '>', 0)
					->get();

		return View::make('forum.category.index', array('categories' => $categories, 'users' => $users, 'parents' => $parents));
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

		$posts = Post::with('user', 'getPosts')
					->where('category_id', '=', $cate->id)
					->where('parentpost_id', '!=', 0)
					->orderBy('created_at', 'asc')
					->groupBy('parentpost_id')
					->get();

		$parentposts = Post::with('user', 'getPosts')
					->where('category_id', '=', $cate->id)
					->where('parentpost_id', '=', 0)
					->orderBy('created_at', 'desc')
					->get();

		$users = User::where('postcount', '>', 0)
					->get();
					
		if(!is_null($posts)){
			return View::make('forum.post.index', array(
													'posts' => $posts,
													'cate' => $cate,
													'users' => $users,
													'parentposts' => $parentposts
												));
		}
		else{ return View::make('home.notfound'); }
	}

	/*
	*	displays the parentpost and all children
	*/
	public function getPost($cate, $post_id){

		try{
			// gets parentpost if postid is not parents
			$primarypost = Post::find($post_id);
			if($primarypost->parentpost_id != 0){
				$post_id = Post::find($primarypost->parentpost_id)->id;
				return Redirect::action('ForumController@getPost', array('cate' => $cate, 'id' => $post_id));
			}


			$cate_id = Category::where('title', '=', $cate)
						->get();

			$posts = Post::with('user')
						->where('id', '=', $post_id)
						->where('category_id', '=', $cate_id->first()->id)
						->orWhere('parentpost_id', '=', $post_id)
						->orderBy('created_at')
						->get();

			if($posts->first()->category_id == $primarypost->category_id){
				return View::make('forum.post.show', array('posts' => $posts));
			}
			else{ return View::make('home.notfound'); }
		}
		catch(Exception $error){ return View::make('home.notfound'); }
	}

	/*
	*	creates a new post
	*/
	public function postPost(){

		$content = Input::get('content');

		if ($content && Auth::check()){

			dd($content);
			$cate = Category::find(Input::get('category_id'));
			$parentpost = Post::find(Input::get('parentpost_id'));

			$post = new Post(array(
		        	'content' => $content,
		        	'title' => Input::get('title')
	        	));

			$post->parentpost()->associate($parentpost);
			$post->user()->associate(Auth::user());
			$data = $cate->post()->save($post);
			Auth::user()->increment('postcount');

			return Redirect::back();

		}
		$message = 'Invalid post.';
		return Redirect::back()->withErrors(array('error_message' => $message));
	}
}