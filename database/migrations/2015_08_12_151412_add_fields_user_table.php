<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('businesses', function(Blueprint $table)
		{
			$table->dropForeign('businesses_users_id_foreign');
		});	

		Schema::table('users', function(Blueprint $table)
		{
			$table->renameColumn('name', 'first_name');
			$table->bigIncrements('id')->change();
		});
		Schema::table('users', function(Blueprint $table)
		{
			$table->string('first_name', 100)->change();
			$table->string('last_name', 100)->after('first_name');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
			{
				$table->renameColumn('first_name', 'name');
				$table->increments('id')->change();
			});

		Schema::table('users', function(Blueprint $table)
			{
				$table->string('name')->change();
				$table->dropColumn('last_name');
			});

		Schema::table('businesses', function(Blueprint $table)
		{
			$table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
		});	
	}

}
