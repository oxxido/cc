<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ZIPCODENewTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function() {
            //DB:unprepared("");
            DB::unprepared(file_get_contents("/var/www/cc/database/sql/cities.sql"));
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
            Schema::drop('zipcodes');
        });
    }

}
