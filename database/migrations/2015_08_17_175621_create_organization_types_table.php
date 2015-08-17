<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::create('organization_types', function (Blueprint $table) {
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
            Schema::dropIfExists('organization_types');
        });
    }

    private function types()
    {
        $sql = "
            INSERT INTO business_types (name) VALUES('Animal Shelter');
            INSERT INTO business_types (name) VALUES('Automotive Business');
            INSERT INTO business_types (name) VALUES('Child Care');
            INSERT INTO business_types (name) VALUES('Dry Cleaning or Laundry');
            INSERT INTO business_types (name) VALUES('Emergency Service');
            INSERT INTO business_types (name) VALUES('Employment Agency');
            INSERT INTO business_types (name) VALUES('Entertainment Business');
            INSERT INTO business_types (name) VALUES('Financial Service');
            INSERT INTO business_types (name) VALUES('Food Establishment');
            INSERT INTO business_types (name) VALUES('Government Office');
            INSERT INTO business_types (name) VALUES('Health And Beauty Business');
            INSERT INTO business_types (name) VALUES('Home And Construction Business');
            INSERT INTO business_types (name) VALUES('Internet Cafe');
            INSERT INTO business_types (name) VALUES('Library');
            INSERT INTO business_types (name) VALUES('Local Business');
            INSERT INTO business_types (name) VALUES('Lodging Business');
            INSERT INTO business_types (name) VALUES('Medical Organization');
            INSERT INTO business_types (name) VALUES('Professional Service');
            INSERT INTO business_types (name) VALUES('Radio Station');
            INSERT INTO business_types (name) VALUES('Real State Agent');
            INSERT INTO business_types (name) VALUES('Recycling Center');
            INSERT INTO business_types (name) VALUES('Self Storage');
            INSERT INTO business_types (name) VALUES('Shopping Center');
            INSERT INTO business_types (name) VALUES('Sports Activity Location');
            INSERT INTO business_types (name) VALUES('Store');
            INSERT INTO business_types (name) VALUES('Television Station');
            INSERT INTO business_types (name) VALUES('Tourist Information Center');
            INSERT INTO business_types (name) VALUES('Travel Agency');
		";

        return $sql;
    }
}
