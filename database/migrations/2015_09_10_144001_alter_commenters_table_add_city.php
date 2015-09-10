<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCommentersTableAddCity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::table('commenters', function (Blueprint $table) {
                $table->integer('city_id')->unsigned()->nullable()->after('note');
                $table->foreign('city_id')->references('id')->on('cities')->onUpdate('cascade');
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
            Schema::table('commenters', function (Blueprint $table) {
                $table->dropForeign('commenters_city_id_foreign');
                $table->dropColumn('city_id');
            });
        });
    }
}
