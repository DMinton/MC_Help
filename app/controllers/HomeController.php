<?php

class HomeController extends BaseController {

	public function getIndex(){
		return View::make('home.index');
	}

	public function getSearch(){
		return View::make('home.search');
	}

}