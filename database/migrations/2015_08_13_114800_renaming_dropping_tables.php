<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenamingDroppingTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::drop('business_type');
		Schema::drop('business_organization');
		Schema::rename('types', 'business_types');
		Schema::rename('organizations', 'organization_types');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::create('business_type', function(Blueprint $table)
            {
                $table->increments('id');
                $table->integer('type_id')->unsigned();
                $table->integer('business_id')->unsigned();
                $table->unique(['type_id', 'business_id']);
                $table->timestamps();
        });        
        Schema::create('business_organization', function(Blueprint $table)
            {
                $table->increments('id');
                $table->integer('organization_id')->unsigned();
                $table->integer('business_id')->unsigned();
                $table->unique(['organization_id', 'business_id']);
                $table->timestamps();
        });

        Schema::rename('business_types', 'types');
		Schema::rename('organization_types', 'organizations');

        Schema::table('business_type', function(Blueprint $table)
        {
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade')->onUpdate('cascade');
        });		
		Schema::table('business_organization', function(Blueprint $table)
            {
                $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade')->onUpdate('cascade');
        });
        
	}

}
