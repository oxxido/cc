<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::create('comments', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('commenter_id')->unsigned();
                $table->foreign('commenter_id')->references('id')->on('commenters')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('product_id')->unsigned();
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
                $table->text('comment');
                $table->tinyInteger('rating')->default(0);
                $table->tinyInteger('score')->nullable();
                $table->tinyInteger('status')->nullable();
                $table->tinyInteger('show_on_website')->default(0);
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
            Schema::dropIfExists('comments');
        });
    }
}
