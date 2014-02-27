<?php

class Last extends Eloquent {

    protected $primaryKey = 'parentpost_id';
	protected $table = 'lasts';
	protected $fillable = array('last_id');

    public function parentPost() {
        return $this->belongsTo('Post', 'parentpost_id');
    }

    public function findLast($parentpost_id) {
    	return Last::find($parentpost_id);
    }

    public function getLastPost($cate_id) {
        return $this::with('parentPost')
                    ->where('category_id', '=', $cate_id)
                    ->orderBy('last_id', 'desc')->paginate(10);
    }
}