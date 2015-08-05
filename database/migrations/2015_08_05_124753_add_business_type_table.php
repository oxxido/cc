<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBusinessTypeTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function() {
            Schema::create('types', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('name', 64);
                $table->timestamps();
            });
            Schema::create('business_type', function(Blueprint $table)
            {
                $table->increments('id');
                $table->integer('type_id')->unsigned();
                $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('business_id')->unsigned();
                $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade')->onUpdate('cascade');
                $table->unique(['type_id', 'business_id']);
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
        DB::transaction(function() {
            Schema::drop('business_type');
            Schema::drop('types');
        });
    }

}
