<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BUSINESSESAddFields extends Migration {

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
				$table->string('owner_first_name')->after('link');
				$table->string('owner_last_name');
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
				$table->dropColumn('owner_first_name');
				$table->dropColumn('owner_last_name');
			});
		});
	}

}
