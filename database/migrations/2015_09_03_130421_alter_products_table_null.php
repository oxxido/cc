<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProductsTableNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::table('products', function (Blueprint $table) {
                $table->string('product',45)->nullable()->change();
                $table->string('url',255)->nullable()->change();
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
            Schema::table('products', function (Blueprint $table) {
                $table->string('product',45)->change();
                $table->string('url',255)->change();
            });
        });
    }
}
