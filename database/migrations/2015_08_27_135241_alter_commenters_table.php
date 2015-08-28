<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCommentersTable extends Migration
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
                $table->dropForeign('commenters_id_foreign');
                $table->increments('id')->change();
                $table->foreign('id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');                
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
                $table->dropForeign('commenters_id_foreign');
                $table->integer('id')->unsigned()->change();
                $table->foreign('id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');                
            });
        });
    }
}
