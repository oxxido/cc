<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailSuscribeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::create('mail_suscribe', function (Blueprint $table) {
                $table->integer('id')->unsigned()->primary();
                $table->integer('business_id')->unsigned();
                $table->foreign('business_id')->references('id')->on('businesses')->onUpdate('cascade');
                $table->integer('commenter_id')->unsigned();
                $table->foreign('commenter_id')->references('id')->on('commenters')->onUpdate('cascade');
                $table->tinyInteger('mail_type')->unsigned();
                $table->boolean('suscribe')->default(true);
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
            Schema::dropIfExists('mail_suscribe');
        });
    }
}
