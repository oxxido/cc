<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('billings', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->bigInteger('user_id')->unsigned();
			$table->bigInteger('country_id')->unsigned();
			$table->bigInteger('city_id')->unsigned()->nullable();
			$table->string('address', 100);
			$table->string('phone', 16);
			$table->bigInteger('price');
			$table->string('cityname', 100)->nullable();
			$table->string('state', 100)->nullable();
			$table->string('zipcode', 8)->nullable();
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade');
			$table->foreign('city_id')->references('id')->on('cities')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('billings');
	}

}
