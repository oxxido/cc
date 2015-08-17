<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::create('business_types', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 100);
            });
            DB::unprepared($this->types());
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
            Schema::dropIfExists('business_types');
        });
    }

    private function types()
    {
        $sql = "
            INSERT INTO business_types (name) VALUES('Actual Company Name');
            INSERT INTO business_types (name) VALUES('Agency');
            INSERT INTO business_types (name) VALUES('Church');
            INSERT INTO business_types (name) VALUES('Company');
            INSERT INTO business_types (name) VALUES('Corporation');
            INSERT INTO business_types (name) VALUES('Event');
            INSERT INTO business_types (name) VALUES('Firm');
            INSERT INTO business_types (name) VALUES('Non Profit');
            INSERT INTO business_types (name) VALUES('Office');
            INSERT INTO business_types (name) VALUES('Restaurant');
            INSERT INTO business_types (name) VALUES('School');
		";

        return $sql;
    }
}
