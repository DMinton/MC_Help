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

		return View::make('forum.category.index', array('categories' => $categories));
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

		$posts = Last::with('parentPost')
					->where('category_id', '=', $cate->id)
					->orderBy('last_id', 'desc')->get();

		return View::make('forum.post.index', array('cate' => $cate, 'posts' => $posts ));
	}

	/*
	*	displays the parentpost and all children
	*/
	public function getPost($cate, $post_id){

			//finds post and checks if it is the parent
			// and then checks if the category is correct
			// redirects if either is incorrect
			$primarypost = Post::find($post_id);
			if($primarypost->parentpost_id != $primarypost->id){
				return Redirect::action('ForumController@getPost', 
							array('cate' => $primarypost->category->title, 'id' => $primarypost->parentpost_id));
			}

			if($cate != $primarypost->category->title){
				return Redirect::action('ForumController@getPost', 
							array('cate' => $primarypost->category->title, 'id' => $primarypost->parentpost_id));
			}


			// gets all posts with a specific parent and
			// in category
			$posts = Post::with('user')
						->where('category_id', '=', $primarypost->category)
						->orWhere('parentpost_id', '=', $post_id)
						->orderBy('created_at')
						->get();

			return View::make('forum.post.show', array('posts' => $posts));
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