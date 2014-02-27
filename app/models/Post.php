<?php

class Post extends Eloquent {

	protected $table = 'posts';
	protected $fillable = array('content', 'title');

	public function category() {
        return $this->belongsTo('Category');
    }

    public function user() {
        return $this->belongsTo('User');
    }

    public function parentPost() {
        return $this->belongsTo('Post', 'parentpost_id');
    }

    public function childrenPosts() {
        return $this->hasMany('Post', 'parentpost_id');
    }

    public function findPost($post_id) {
        return $this::find($post_id);
    }

    public function getParentpostAndCategory($category, $post_id) {
        return $this::with('user')
                        ->where('category_id', '=', $category)
                        ->orWhere('parentpost_id', '=', $post_id)
                        ->orderBy('created_at')
                        ->paginate(10);
    }

    protected function format_time($date) {
        $time = date_format($date, 'M j, Y') 
                . "</br>" 
                . date_format($date, 'g:i A');
        return $time;
    }
}