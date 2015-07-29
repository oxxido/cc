<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('businesses', function(Blueprint $table)
    {
      $table->increments('id');
      $table->string('name');
      $table->text('description')->nullable();
      $table->string('telephone', 16)->nullable();
      $table->string('address', 128)->nullable();
      $table->string('link', 128);
      $table->integer('users_id')->unsigned();
      $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
    Schema::drop('businesses');
  }

}
