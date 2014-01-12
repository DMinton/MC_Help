<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('cate_id')->unsigned();
			$table->integer('parentpost_id')->default(0)->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('cate_id')->references('id')->on('posts')->onDelete('cascade');
			$table->foreign('parentpost_id')->references('id')->on('posts')->onDelete('cascade');
			$table->string('title', 128);
			$table->text('content');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts');
	}

}
