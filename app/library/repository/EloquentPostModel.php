<?php namespace repository;

use interfaces\PostModelInterface;
use Post;

class EloquentPostModel implements PostModelInterface {
	public function findPost($post_id) {
        return Post::find($post_id);
    }

    public function getParentpostAndCategory($category, $post_id) {
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
                        ->paginate(10);
    }
}