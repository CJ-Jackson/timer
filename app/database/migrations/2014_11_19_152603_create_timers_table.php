<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("timers", function($table){
			$table->increments("id");
			$table->string("name");
			$table->timestamp("start");
			$table->timestamp("stop")->nullable();
			$table->timestamps();
			$table->integer("user_id")->unsigned();
			$table->foreign("user_id")->references("id")->on("users");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("timers");
	}

}
