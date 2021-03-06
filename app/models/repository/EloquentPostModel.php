<?php namespace repository;

use interfaces\PostModelInterface;
use Post, Category, User;

class EloquentPostModel implements PostModelInterface {
	public function findPost($post_id) {
        return Post::find($post_id);
    }

    public function getCategoryPosts($category, $post_id) {
        return Post::with('user')
                        ->where('category_id', '=', $category)
                        ->orWhere('parentpost_id', '=', $post_id)
                        ->orderBy('created_at')
                        ->paginate(10);
    }
    
    public function getSearchQuery($cate_id, $search){ 
        return Post::where('category_id', '=', $cate_id)
                        ->where('content', 'like', "%$search%")
                        ->orderBy('created_at')
                        ->groupBy('parentpost_id')
                        ->paginate(10);
    }

    public function createPost($data, $cate, $user, $parentpost){

        $post = new Post;

        $post->content  = $data['content'];
        $post->title    = $data['title'];

        $post->user()->associate($user);
        $post->category()->associate($cate);

        if( ! is_null($parentpost)){
            $post->parentPost()->associate($parentpost);
        }
        else{
            $post->parentPost()->associate($post);
        }

        $post->save();

        return $post;
    }
}