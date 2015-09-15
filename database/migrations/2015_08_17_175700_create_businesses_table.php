<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::create('businesses', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('business_type_id')->unsigned();
                $table->foreign('business_type_id')->references('id')->on('business_types')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('organization_type_id')->unsigned();
                $table->foreign('organization_type_id')->references('id')->on('organization_types')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('city_id')->unsigned();
                $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('owner_id')->unsigned();
                $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('admin_id')->unsigned()->nullable();
                $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');
                $table->string('name');
                $table->text('description')->nullable();
                $table->string('address', 128)->nullable();
                $table->string('phone', 16)->nullable();
                $table->string('url', 128);
                $table->text('data')->nullable();
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
            Schema::dropIfExists('businesses');
        });
    }
}
