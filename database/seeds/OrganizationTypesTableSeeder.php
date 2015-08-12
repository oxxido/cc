<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class OrganizationTypesTableSeeder extends Seeder {

    public function run() {

        //delete organizations table records
        DB::table('organization_types')->delete();

        //insert records
        DB::table('organization_types')->insert([
            ['name' => 'Company'],
            ['name' => 'Corporation'],
            ['name' => 'Non profit'],
            ['name' => 'School'],
            ['name' => 'Office'],
            ['name' => 'Agency'],
            ['name' => 'Church'],
            ['name' => 'Event'],
            ['name' => 'Restaurant'],
            ['name' => 'Firm'],
            ['name' => 'Actual Company Name']
        ]);
    }
}