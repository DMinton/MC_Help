<?php

Route::get('/', 'HomeController@getIndex');
Route::get('/search', 'HomeController@getSearch');
Route::get('/users', 'UsersController@getIndex');
Route::get('/forum', 'ForumController@getCategoryIndex');
Route::get('/forum/{id}', 'ForumController@getPostIndex');
Route::get('/forum/{any}/{id}', 'ForumController@getPost');