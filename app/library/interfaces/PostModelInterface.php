<?php namespace interfaces;

interface PostModelInterface {
	public function findPost($post_id);
    public function getParentpostAndCategory($category, $post_id);
    public function getSearchQuery($cate_id, $search);
}