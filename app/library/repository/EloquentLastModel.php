<?php namespace repository;

use interfaces\LastModelInterface;
use Last;

class EloquentLastModel implements LastModelInterface {
    public function findLast($id) {
        return Last::find($id);
    }

    public function getLastPost($cate_id) {
        return Last::with('parentPost')
                    ->where('category_id', '=', $cate_id)
                    ->orderBy('last_id', 'desc')->paginate(10);
    }

    public function createLast($post, $cate_id) {
        $last_update = $this->findLast($post->parentpost_id);

        if(is_null($last_update)){
            $last_update = new Last();
            $last_update->category_id = $cate_id;
        }

        $last_update->last_id = $post->id;
		$last_update->parentpost_id = $post->parentpost_id;
		$last_update->save();

		return $last_update;
    }
}