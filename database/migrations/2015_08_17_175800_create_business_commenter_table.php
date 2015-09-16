<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessCommenterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::create('business_commenter', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('business_id')->unsigned();
                $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('commenter_id')->unsigned();
                $table->foreign('commenter_id')->references('id')->on('commenters')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('adder_id')->unsigned()->nullable();
                $table->foreign('adder_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
                $table->timestamps();
                $table->unique(['business_id', 'commenter_id']);
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
            Schema::dropIfExists('business_commenter');
        });
    }
}
