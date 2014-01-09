<?php

Route::get('/', 'HomeController@getIndex');
Route::get('/search', 'HomeController@getSearch');
Route::get('/users', 'UsersController@getIndex');
Route::get('/forum', 'PostsController@getIndex');