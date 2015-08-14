<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->bigInteger('product_id')->unsigned();
			$table->bigInteger('customer_id')->unsigned();
			$table->string('comment', 255);
			$table->tinyInteger('rating')->default(0);
			$table->tinyInteger('score')->nullable();
			$table->tinyInteger('status')->nullable();
			$table->tinyInteger('show_on_website')->default(0);
			$table->timestamps();
			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comments');
	}

}
