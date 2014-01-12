<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		$this->call('UserTableSeeder');
		$this->call('CategoryTableSeeder');
		$this->call('PostTableSeeder');

		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
	class UserTableSeeder extends Seeder {

	    public function run()
	    {
	        DB::table('users')->delete();

	        User::create(array(
	        	'username' => 'David',
	        	'password' => 'password',
	        	));
	        User::create(array(
	        	'username' => 'Adam',
	        	'password' => 'password',
	        	));
	        User::create(array(
	        	'username' => 'Ben',
	        	'password' => 'password',
	        	));
	        User::create(array(
	        	'username' => 'Joel',
	        	'password' => 'password'
	        	));
	    }

	}

	class CategoryTableSeeder extends Seeder {

	    public function run()
	    {
	        DB::table('categories')->delete();

	        Category::create(array(
	        	'title' => 'category title',
	        	'description' => 'blah description blah'
	        	));
	        Category::create(array(
	        	'title' => 'category title 2',
	        	'description' => 'blah description 2 blah'
	        	));
	        Category::create(array(
	        	'title' => 'Computer Science',
	        	'description' => 'For talking about all the new technologies.'
	        	));
	        Category::create(array(
	        	'title' => 'Business',
	        	'description' => 'For discussing business classes and majors.'
	        	));
	    }

	}

	class PostTableSeeder extends Seeder {

	    public function run()
	    {
	        DB::table('posts')->delete();

	        Post::create(array(
	        	'content' => 'blah blah blah content 1 blah blah blah',
	        	'title' => 'title 1',
	        	'parentpost_id' => '0',
	        	'cate_id' => '1',
	        	'user_id' => '1'
	        	));
	        Post::create(array(
	        	'content' => 'blah blah blah content 2 blah blah blah',
	        	'title' => 'title 2',
	        	'parentpost_id' => '0',
	        	'cate_id' => '2',
	        	'user_id' => '2'
	        	));
	        Post::create(array(
	        	'content' => 'blah blah blah content 3 blah blah blah',
	        	'title' => 'title 3',
	        	'parentpost_id' => '1',
	        	'cate_id' => '1',
	        	'user_id' => '3'
	        	));
	        Post::create(array(
	        	'content' => 'blah blah blah content 4 blah blah blah',
	        	'title' => 'title 4',
	        	'parentpost_id' => '2',
	        	'cate_id' => '2',
	        	'user_id' => '4'
	        	));
	        Post::create(array(
	        	'content' => 'blah blah blah content 5 blah blah blah',
	        	'title' => 'title 5',
	        	'parentpost_id' => '2',
	        	'cate_id' => '2',
	        	'user_id' => '1'
	        	));
	    }

	}