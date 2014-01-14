<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLastsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lasts', function(Blueprint $table) {
			$table->integer('parentpost_id')->unsigned()->indexed();
			$table->integer('category_id')->indexed();
			$table->integer('last_id')->indexed();
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
		Schema::drop('lasts');
	}

}
