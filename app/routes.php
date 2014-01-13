<?php


Route::get(		'/',					'HomeController@getIndex');
Route::get(		'/search',				'HomeController@getSearch');

Route::get(		'/forum',				'ForumController@getCategoryIndex');
Route::get(		'/forum/{cate}',		'ForumController@getPostIndex');
Route::get(		'/forum/{cate}/{id}',	'ForumController@getPost');
Route::post(	'/forum/reply',			'ForumController@postPost');

Route::get(		'/users',				'UsersController@getIndex');
Route::get(		'/signup',				'UsersController@getUser');
Route::post(	'/signup',				'UsersController@postUser');
Route::get(		'/login',				'UsersController@getLoginUser');
Route::post(	'/login',				'UsersController@postLoginUser');