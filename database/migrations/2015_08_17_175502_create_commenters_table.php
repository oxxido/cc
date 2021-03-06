<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::create('commenters', function (Blueprint $table) {
                $table->integer('id')->unsigned()->primary();
                $table->foreign('id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
                $table->string('phone', 16);
                $table->string('note')->nullable();
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
            Schema::dropIfExists('commenters');
        });
    }
}
