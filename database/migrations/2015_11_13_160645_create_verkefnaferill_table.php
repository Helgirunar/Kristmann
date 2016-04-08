<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerkefnaferillTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('verkefnaferills', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('post_type');
			$table->string('post_id');
			$table->string('post_title');
			$table->string('post_user');
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
		Schema::drop('verkefnaferills');
	}

}
