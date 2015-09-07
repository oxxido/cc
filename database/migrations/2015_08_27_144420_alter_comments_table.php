<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCommentsTable extends Migration
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
                $table->dropForeign('comments_commenter_id_foreign');
                $table->renameColumn('commenter_id', 'business_commenter_id');
                $table->foreign('business_commenter_id')->references('id')->on('business_commenter')->onDelete('cascade')->onUpdate('cascade');                
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
                $table->dropForeign('comments_business_commenter_id_foreign');
                $table->renameColumn('business_commenter_id', 'commenter_id');
                $table->foreign('commenter_id')->references('id')->on('business_commenter')->onDelete('cascade')->onUpdate('cascade');
            });
        });
    }
}
