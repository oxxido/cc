<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::create('business_types', function (Blueprint $table) {
                $table->increments('id');
                $table->string('uuid', 36)->unique();
                $table->string('name', 100);
            });
        });

        //App::make(DatabaseSeeder::class)->call(BusinessTypesTableSeeder::class);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::transaction(function () {
            Schema::dropIfExists('business_types');
        });
    }
}
