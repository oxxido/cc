<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBusinessTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::transaction(function() {
			Schema::table('business_types', function(Blueprint $table)
			{
				$table->bigIncrements('id')->change();
				$table->string('name', 100)->change();
				$table->dropColumn('created_at');
				$table->dropColumn('updated_at');
			});

			Schema::table('organization_types', function(Blueprint $table)
			{
				$table->bigIncrements('id')->change();
				$table->string('name', 100)->change();
				$table->dropColumn('created_at');
				$table->dropColumn('updated_at');
			});

			Schema::table('businesses', function(Blueprint $table)
			{
				$table->renameColumn('telephone', 'phone');
				$table->renameColumn('link', 'url');
				$table->renameColumn('zip', 'zipcode');
				$table->renameColumn('city', 'cityname');
			});
			Schema::table('businesses', function(Blueprint $table)
			{
				//$table->dropForeign('businesses_users_id_foreign');
				$table->dropColumn('users_id');
				$table->dropColumn('owner_first_name');
				$table->dropColumn('owner_last_name');
				$table->dropColumn('country');

				$table->bigIncrements('id')->change();
				$table->string('name', 100)->change();
				$table->string('zipcode', 8)->change();
				$table->string('state', 100)->change();
				$table->string('cityname', 100)->change();

				$table->bigInteger('city_id')->after('id')->nullable()->unsigned();
				$table->bigInteger('country_id')->after('id')->unsigned();
				$table->bigInteger('organization_type_id')->after('id')->nullable()->unsigned();
				$table->bigInteger('business_type_id')->after('id')->nullable()->unsigned();
				$table->bigInteger('admin_id')->after('id')->unsigned();
				$table->bigInteger('owner_id')->after('id')->unsigned();

				$table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade')->onUpdate('cascade');
				$table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');
				$table->foreign('business_type_id')->references('id')->on('business_types')->onUpdate('cascade');
				$table->foreign('organization_type_id')->references('id')->on('organization_types')->onUpdate('cascade');
				$table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade');
				$table->foreign('city_id')->references('id')->on('cities')->onUpdate('cascade');
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
			Schema::table('business_types', function(Blueprint $table)
			{
				$table->increments('id')->change();
				$table->string('name', 64)->change();
				$table->timestamps();
			});

			Schema::table('organization_types', function(Blueprint $table)
			{
				$table->increments('id')->change();
				$table->string('name', 64)->change();
				$table->timestamps();
			});

			Schema::table('businesses', function(Blueprint $table)
			{
				$table->renameColumn('phone', 'telephone');
				$table->renameColumn('url', 'link');
				$table->renameColumn('zipcode', 'zip');
				$table->renameColumn('cityname', 'city');
			});
			Schema::table('businesses', function(Blueprint $table)
			{
				$table->integer('users_id')->unsigned();
				$table->string('owner_first_name')->after('link');
	        	$table->string('owner_last_name');
				$table->string('country')->after('zip');
				//$table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

				$table->increments('id')->change();
				$table->string('name')->change();
				$table->integer('zip')->change();
				$table->string('state')->change();
				$table->string('city')->change();

				$table->dropForeign('businesses_owner_id_foreign');
				$table->dropForeign('businesses_admin_id_foreign');
				$table->dropForeign('businesses_business_type_id_foreign');
				$table->dropForeign('businesses_organization_type_id_foreign');
				$table->dropForeign('businesses_country_id_foreign');
				$table->dropForeign('businesses_city_id_foreign');

				$table->dropColumn('city_id');
				$table->dropColumn('country_id');
				$table->dropColumn('organization_type_id');
				$table->dropColumn('business_type_id');
				$table->dropColumn('admin_id');
				$table->dropColumn('owner_id');
			});
		});
	}

}
