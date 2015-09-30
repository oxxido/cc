<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialNetworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::create('social_networks', function (Blueprint $table) {
                $table->increments('id');
                $table->string('uuid', 36)->unique();
                $table->string('name', 128);
                $table->string('logo', 255);
                $table->string('url', 128);
            });
        });

        App::make(DatabaseSeeder::class)->call(SocialNetworksTableSeeder::class);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::transaction(function () {
            Schema::drop('social_networks');
        });
    }
}
