<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::create('countries', function (Blueprint $table) {
                $table->increments('id');
                $table->string('uuid', 36)->unique();
                $table->string('name', 100);
                $table->string('code', 2)->unique();
            });

            //App::make(DatabaseSeeder::class)->call(CountriesTableSeeder::class);
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
            Schema::drop('countries');
        });
    }
}
