<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::create('organization_types', function (Blueprint $table) {
                $table->increments('id');
                $table->string('uuid', 36)->unique();
                $table->string('name', 100);
            });
        });

        App::make(DatabaseSeeder::class)->call(OrganizationTypesTableSeeder::class);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::transaction(function () {
            Schema::dropIfExists('organization_types');
        });
    }
}
