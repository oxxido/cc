<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::table('businesses', function (Blueprint $table) {
                $table->renameColumn('telephone', 'phone');
                $table->dropForeign('businesses_owner_id_foreign');
                $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade')->onUpdate('cascade');
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
            Schema::table('businesses', function (Blueprint $table) {
                $table->renameColumn('phone', 'telephone');
                $table->dropForeign('businesses_owner_id_foreign');
                $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            });
        });
    }
}
