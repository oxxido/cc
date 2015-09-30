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
                $table->integer('business_commenter_id')->unsigned();
                $table->foreign('business_commenter_id')->references('id')->on('business_commenter')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('product_id')->unsigned();
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
                $table->string('uuid', 36)->unique();
                $table->text('comment');
                $table->tinyInteger('rating')->default(0);
                $table->tinyInteger('score')->nullable();
                $table->tinyInteger('status')->nullable();
                $table->tinyInteger('show_on_website')->default(0);
                $table->string('ip', 15)->nullable();
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
