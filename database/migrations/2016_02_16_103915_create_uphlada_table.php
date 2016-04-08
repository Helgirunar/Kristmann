<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUphladaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('uphladas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_vef')->unsigned();
			$table->integer('id_verk')->unsigned();
			$table->foreign('id_vef')->references('id')->on('vefspurn');
			$table->foreign('id_verk')->references('id')->on('verktakar');
			$table->text('uphlada_img');
			$table->text('uphlada_file');
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
		Schema::drop('uphladas');
	}

}
