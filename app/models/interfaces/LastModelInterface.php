<?php namespace interfaces;

interface LastModelInterface {
	public function findLast($id);
    public function getLastPost($cate_id);
    public function createLast($post, $cate_id);
}