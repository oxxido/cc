<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCommentsTableAddIp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::table('comments', function (Blueprint $table) {
                $table->string('ip',15)->nullable()->after('show_on_website');
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
            Schema::table('comments', function (Blueprint $table) {
                $table->dropColumn('ip');
            });
        });
    }
}
