<?php

use repository\EloquentCategoryModel as CategoryModel;
use repository\EloquentLastModel as LastModel;
use repository\EloquentPostModel as PostModel;

class ForumController extends BaseController {

	/*
	*	Constructor
	*/	
	public function __construct(CategoryModel $category, PostModel $post, LastModel $last){
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

			// finds post and checks if it is the parent
			// and then checks if the category is correct
			// redirects if either is incorrect
			$primarypost = $this->post->findPost($post_id);
			if($primarypost->parentpost_id != $primarypost->id){
				return Redirect::action('ForumController@getPost', 
							array('cate' => $primarypost->category->title, 'id' => $primarypost->parentpost_id));
			}

			// category check
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

			// creates array containing data for post
			$data = array(
					'category_id' 	=> Input::get('category_id'),
					'parentpost_id' => Input::get('parentpost_id'),
					'title' 		=> Input::get('title'),
					'content' 		=> $content
				);

			// gets category, parentpost and user
			$cate = $this->category->findCategory($data['category_id']);
			$parentpost = $this->post->findPost($data['parentpost_id']);
			$user = Auth::user();

			// creates post and returns results
			$post = $this->post->createPost($data, $cate, $user, $parentpost);
			
			// if post did not fail
			if( ! is_null($post->id)){
				$user->increment('postcount');

				// creates last
				$this->last->createLast($post, $cate->id);

				return Redirect::action('ForumController@getPost', 
							array('cate' => $post->category->title, 'id' => $post->parentpost_id));
			}
		}
		$message = 'Invalid post.';
		return Redirect::back()->withErrors(array('error_message' => $message));
	}
}