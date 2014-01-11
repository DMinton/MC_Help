<?php

class Post extends Eloquent {

	protected $table = 'posts';
	protected $fillable = array('content', 'title');

	public function category()
    {
        return $this->belongsTo('Category');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    protected function format_time($date){
        $time = date_format($date, 'M j, Y') 
                . "</br>" 
                . date_format($date, 'g:m');
        return $time;
    }


}