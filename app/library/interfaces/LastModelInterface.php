<?php namespace interfaces;

interface LastModelInterface {
	public function findLast($parentpost_id);
    public function getLastPost($cate_id);
}