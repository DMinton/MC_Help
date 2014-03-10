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
		$categories = $this->category->getAllCategories();

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

			// finds post and sets redirect
			// array if needed
			$primarypost = $this->post->findPost($post_id);
			$redirect = array(
				'cate' => $primarypost->category->title,
				'id' => $primarypost->parentpost_id
			);

			// category check
			if($cate != $primarypost->category->title){
				return Redirect::action('ForumController@getPost', $redirect);
			}

			// gets all posts with a specific
			// parent and in category
			$posts = $this->post->getCategoryPosts($primarypost->category, $post_id);

			// checks if the paginate page is valid
			if(is_null($posts->first())){
				return Redirect::action('ForumController@getPost', $redirect);
			}

			return View::make('forum.post.show', array('posts' => $posts));
	}

	/*
	*	creates a new post
	*/
	public function postPost(){

		$data = Input::all();

		// auth user and checks if content field is valid
		if ($data['content'] && Auth::check()){

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

				return Redirect::back();
			}
		}
		$message = 'Invalid post.';
		return Redirect::back()->withErrors(array('error_message' => $message));
	}
}