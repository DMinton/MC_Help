<?php

class ForumController extends BaseController {

	/*
	*	Constructor
	*/	
	public function __construct(Category $category, Post $post, Last $last){
		$this->post = $post;
		$this->category = $category;
		$this->last = $last;
	}

	/*
	*	Displays all categories
	*/
	public function getCategoryIndex(){

		// gets all categories and orders by name
		$categories = $this->category->getCategories();

		return View::make('forum.category.index', array('categories' => $categories));
	}

	/*
	*	displays all posts under a category
	*/
	public function getPostIndex($category){

		// gets category data
		$cate = $this->category->getCategoryIndex($category);

		// if category not found, return error page
		if(is_null($cate)){
			return View::make('home.notfound');
		}

		$posts = $this->last->getLastPost($cate->id);

		return View::make('forum.post.index', array('cate' => $cate, 'posts' => $posts));
	}

	/*
	*	displays the parentpost and all children
	*/
	public function getPost($cate, $post_id){

			//finds post and checks if it is the parent
			// and then checks if the category is correct
			// redirects if either is incorrect
			$primarypost = $this->post->findPost($post_id);
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
			$posts = $this->post->getParentpostAndCategory($primarypost->category, $post_id);

			return View::make('forum.post.show', array('posts' => $posts));
	}

	/*
	*	creates a new post
	*/
	public function postPost(){

		$content = Input::get('content');

		// auth user and checks if content field is valid
		if ($content && Auth::check()){

			$post = new Post();

			$cate = $this->category->findCategory(Input::get('category_id'));
			$parentpost = $this->post->findPost(Input::get('parentpost_id'));

			if(Input::get('parentpost_id') != 0){
				$last_update = $this->last->findLast(Input::get('parentpost_id'));
			}
			else{
				$last_update = new Last();
				$last_update->category_id = $cate->id;
			}

			// associates data
			$post->content 	= $content;
		    $post->title 	= Input::get('title');

			$post->user()->associate(Auth::user());
			$post->category()->associate($cate);

			// if not null then the post is not a parent
			if(!is_null($parentpost)){
		    	$post->parentPost()->associate($parentpost);
			}

			$success = $post->save();

			// if null then post is parent
			if(is_null($parentpost)){
		    	$post->parentPost()->associate($post);
		    	$post->save();
			}

			
			if($success){
				Auth::user()->increment('postcount');

				$last_update->last_id = $post->id;
				$last_update->parentpost_id = $post->parentpost_id;
				$last_update->save();

				return Redirect::action('ForumController@getPost', 
							array('cate' => $post->category->title, 'id' => $post->parentpost_id));
			}
		}
		$message = 'Invalid post.';
		return Redirect::back()->withErrors(array('error_message' => $message));
	}
}