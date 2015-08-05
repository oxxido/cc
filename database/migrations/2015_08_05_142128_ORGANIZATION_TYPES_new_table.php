<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ORGANIZATIONTYPESNewTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::transaction(function() {
            Schema::create('organizations', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('name', 64);
                $table->timestamps();
            });
            Schema::create('business_organization', function(Blueprint $table)
            {
                $table->increments('id');
                $table->integer('organization_id')->unsigned();
                $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('business_id')->unsigned();
                $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade')->onUpdate('cascade');
                $table->unique(['organization_id', 'business_id']);
                $table->timestamps();
            });
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::transaction(function() {
            Schema::drop('business_organization');
            Schema::drop('organizations');
        });
	}

}
