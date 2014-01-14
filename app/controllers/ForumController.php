<?php

class ForumController extends BaseController {

	/*
	*	Displays all categories
	*/
	public function getCategoryIndex(){

		// gets all categories and orders by name
		$categories = Category::with('post')
					->orderBy('title')
					->get();

		// gets all parent posts
		$parents = Post::where('parentpost_id', '=', 0)
					->get();

		// gets all users with a postcount
		$users = User::where('postcount', '>', 0)
					->get();

		return View::make('forum.category.index', array('categories' => $categories, 'users' => $users, 'parents' => $parents));
	}

	/*
	*	displays all posts under a category
	*/
	public function getPostIndex($category){

		// gets category data
		$cate = Category::where('title', '=', $category)
					->first();

		// if category not found, return error page
		if(is_null($cate)){
			return View::make('home.notfound');
		}

		// gets all posts in category that is not a parent post
		// groups them and orders by created at
		

		$query = Post::with('user', 'childrenPosts')
					->where('category_id', '=', $cate->id)
					->where('parentpost_id', '=', 0)
					->orderBy('created_at', 'desc')
					->get();
					
		// checks if posts are found, returns error if not found
		if(!is_null($posts)){
			return View::make('forum.post.index', array(
													'posts' => $posts,
													'cate' => $cate,
												));
		}
		else{ return View::make('home.notfound'); }
	}

	/*
	*	displays the parentpost and all children
	*/
	public function getPost($cate, $post_id){

		// try is used in case user inputs incorrect url data
		try{
			// gets parentpost if postid is not parents
			// redirects if post is a child
			$primarypost = Post::find($post_id);
			if($primarypost->parentpost_id != 0){
				$post_id = Post::find($primarypost->parentpost_id)->id;
				return Redirect::action('ForumController@getPost', array('cate' => $cate, 'id' => $post_id));
			}

			// gets category data
			$cate_id = Category::where('title', '=', $cate)
						->get();

			// gets all posts with a specific parent and
			// in category
			$posts = Post::with('user')
						->where('id', '=', $post_id)
						->where('category_id', '=', $cate_id->first()->id)
						->orWhere('parentpost_id', '=', $post_id)
						->orderBy('created_at')
						->get();

			// checks category id data
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

		// auth user and checks if content field is valid
		if ($content && Auth::check()){

			$post = new Post(array(
		        	'content' => $content,
		        	'title' => Input::get('title')
	        	));

			$cate = Category::find(Input::get('category_id'));
			$parentpost = Post::find(Input::get('parentpost_id'));

			// associates data
			$post->user()->associate(Auth::user());

			if(is_null($parentpost)){
				$parentpost = $post;
			}

			$data = $cate->post()->save($post);
			Auth::user()->increment('postcount');

			return Redirect::back();

		}
		$message = 'Invalid post.';
		return Redirect::back()->withErrors(array('error_message' => $message));
	}
}