<?php namespace interfaces;

interface LastModelInterface {
	public function findLast($parentpost_id);
    public function getLastPost($cate_id);
    public function createLast($post, $cate_id);
    public function getLastCategory($parentpost_id, $cate_id);
}