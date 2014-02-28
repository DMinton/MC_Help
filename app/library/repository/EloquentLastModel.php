<?php namespace repository;

use interfaces\LastModelInterface;
use Last;

class EloquentLastModel implements LastModelInterface {
    public function findLast($parentpost_id) {
        return Last::find($parentpost_id);
    }

    public function getLastPost($cate_id) {
        return Last::with('parentPost')
                    ->where('category_id', '=', $cate_id)
                    ->orderBy('last_id', 'desc')->paginate(10);
    }
}