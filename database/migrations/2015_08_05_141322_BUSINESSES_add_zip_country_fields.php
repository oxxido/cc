<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BUSINESSESAddZipCountryFields extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::transaction(function() {
			Schema::table('businesses', function(Blueprint $table)
			{
				$table->integer('zip')->after('owner_last_name');
				$table->string('country')->after('zip');
				$table->string('state')->after('zip');
				$table->string('city')->after('zip');
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
			Schema::table('businesses', function(Blueprint $table)
			{
				$table->dropColumn('zip');
				$table->dropColumn('country');
				$table->dropColumn('state');
				$table->dropColumn('city');
			});
		});
	}

}
