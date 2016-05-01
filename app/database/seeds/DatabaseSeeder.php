<?php

class DatabaseSeeder extends Seeder {

	public $parentpost 	= 50;
	public $replys 		= 450;
	public $usercount	= 25;

	public function getFaker() {
		if (empty($this->faker)) {
			$faker = Faker\Factory::create();
			$faker->addProvider(new Faker\Provider\Base($faker));
			$faker->addProvider(new Faker\Provider\Lorem($faker));
		}
		return $this->faker = $faker;
	}

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
		$this->call('LastTableSeeder');

		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
	class UserTableSeeder extends DatabaseSeeder {

	    public function run()
	    {
	        DB::table('users')->delete();

	        $pass = Hash::make('password');

	        $users = array(
	        				'David',
	        				'Adam',
	        				'Ben',
	        				'Joel',
	        				'Patrick'
	        			);

	        foreach($users as $user){
		        $save = User::create(array(
					        	'username' => $user,
					        	'password' => $pass,
			        	));
		        $save->save();
	    	}

	    	$faker = $this->getFaker();

	    	$usercount = $this->usercount;

	    	for($i = 0; $i < $usercount; $i++) {
	    		$user = $faker->name();
	    		$save = User::create(array(
					        	'username' => $user,
					        	'password' => $pass,
			        	));
		        $save->save();
	    	}

	    }

	}

	class CategoryTableSeeder extends DatabaseSeeder {

	    public function run()
	    {
	        DB::table('categories')->delete();

	        Category::create(array(
	        	'title' => 'Computer Science',
	        	'description' => 'For talking about all the new technologies.'
	        	));
	        Category::create(array(
	        	'title' => 'Math',
	        	'description' => 'For closely approaching but not touching mathematics.'
	        	));
	        Category::create(array(
	        	'title' => 'Fine Arts',
	        	'description' => 'The finer things in life..'
	        	));
	        Category::create(array(
	        	'title' => 'Business',
	        	'description' => 'For discussing business classes and majors.'
	        	));
	        Category::create(array(
	        	'title' => 'Humanities',
	        	'description' => 'Because are we not all human.'
	        	));
	    }

	}

	class PostTableSeeder extends DatabaseSeeder {

	    public function run()
	    {
	        DB::table('posts')->delete();

	        $faker = $this->getFaker();

			$parentpost = $this->parentpost;
			$replys 	= $this->replys;

			$usercount 	= User::count();
			$catecount 	= Category::count();
			$category  	= Category::all();
			$users		= User::all();
			$totalposts = 1;
			$date 		= new DateTime('NOW');
			$date->modify("-5 days");

			for($i = 0; $i < $parentpost; $i++){
				$date->modify("+$totalposts seconds");
				$post = Post::create(array(
				        	'content' 		=> 	$faker->paragraph(mt_rand( 1, 25 )),
				        	'title' 		=> 	'Title ' . $totalposts++,
				        	'parentpost_id' => 	$i+1,
				        	'category_id' 	=> 	array_rand($category, 1)->id,
				        	'user_id' 		=> 	array_rand($users, 1)->id,
				        	'created_at'	=>	$date,
				        	'updated_at'	=>	$date
	        			));
				User::find($post->user_id)->increment('postcount');
				$post->save();
			}

			for($i = 0; $i < $replys; $i++){
				$date->modify("+$totalposts seconds");

				$parentpost_id = mt_rand( 1, $parentpost );
				$category_id = Post::where('id', '=', $parentpost_id)->first()->category_id;

				$post = Post::create(array(
				        	'content' 		=> 	$faker->paragraph(mt_rand( 1, 25 )),
				        	'title' 		=> 	'Title ' . $totalposts++,
				        	'parentpost_id' => 	$parentpost_id,
				        	'category_id' 	=> 	$category_id,
				        	'user_id' 		=> 	array_rand($users, 1)->id,
				        	'created_at'	=>	$date,
				        	'updated_at'	=>	$date
	        			));
				User::find($post->user_id)->increment('postcount');
				$post->save();
			}
	    }
	}

	class LastTableSeeder extends DatabaseSeeder {

	    public function run()
	    {
	        DB::table('lasts')->delete();

	        $posts = Post::all();

	        for($i = 0; $i < count($posts); $i++){
	        	$post = $posts->find($i+1);
		        if($post->id == $post->parentpost_id){
		        	Last::create(array(
		        			'parentpost_id' => $post->parentpost_id,
		        			'last_id' => $post->id,
		        			'category_id' => $post->category_id
		        		));
		        }
		        else{
		        	$last = Last::find($post->parentpost_id);
		        	$last->last_id = $post->id;
		        	$last->updated_at = $post->created_at;
		        	$last->save();
		        }
	    	}

	    }

	}
