<?php

class Last extends Eloquent {

    protected $primaryKey = 'parentpost_id';
	protected $table = 'lasts';
	protected $fillable = array('last_id');

    public function parentPost() {
        return $this->belongsTo('Post', 'parentpost_id');
    }
}