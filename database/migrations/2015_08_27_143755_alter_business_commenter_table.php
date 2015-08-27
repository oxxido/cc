<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBusinessCommenterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::table('business_commenter', function (Blueprint $table) {
                $table->dropForeign('business_commenter_added_by_foreign');
                $table->renameColumn('added_by', 'adder_id');
                $table->foreign('adder_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');                
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
            Schema::table('business_commenter', function (Blueprint $table) {
                $table->dropForeign('business_commenter_adder_id_foreign');
                $table->renameColumn('adder_id', 'added_by');
                $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');                
            });
        });
    }
}
