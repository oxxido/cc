<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::create('cities', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('state_id')->unsigned();
                $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade')->onUpdate('cascade');
                $table->string('uuid', 36)->unique();
                $table->string('name', 100);
                $table->string('zip_code', 8);
            });

            App::make(DatabaseSeeder::class)->call(CitiesTableSeeder::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::transaction(function () {
            Schema::drop('cities');
        });
    }
}
