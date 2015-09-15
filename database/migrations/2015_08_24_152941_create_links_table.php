<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::create('links', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('business_id')->unsigned();
                $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('social_network_id')->unsigned();
                $table->foreign('social_network_id')->references('id')->on('social_networks')->onDelete('cascade')->onUpdate('cascade');
                $table->string('uuid', 36)->unique();
                $table->string('url');
                $table->integer('order');
                $table->tinyInteger('active')->default(0);
                $table->timestamps();
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
        DB::transaction(function () {
            Schema::drop('links');
        });
    }
}
