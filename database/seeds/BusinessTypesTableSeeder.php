<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BusinessTypesTableSeeder extends Seeder {

    public function run() {

        //delete types table records
        DB::table('business_types')->delete();

        //insert records
        DB::table('business_types')->insert([
            ['name' => 'Local Business'],
            ['name' => 'Animal Shelter'],
            ['name' => 'Automotive Business'],
            ['name' => 'Child Care'],
            ['name' => 'Dry Cleaning Or Loundry'],
            ['name' => 'Emergency Service'],
            ['name' => 'Employment Agency'],
            ['name' => 'Entertainment Business'],
            ['name' => 'Financial Service'],
            ['name' => 'Food Establishment'],
            ['name' => 'Government Office'],
            ['name' => 'Health And Beauty Business'],
            ['name' => 'Home And Construction Business'],
            ['name' => 'Internet Cafe'],
            ['name' => 'Library'],
            ['name' => 'Lodging Business'],
            ['name' => 'Medical Organization'],
            ['name' => 'Professional Service'],
            ['name' => 'Radio Station'],
            ['name' => 'Real State Agent'],
            ['name' => 'Recycling Center'],
            ['name' => 'Self Storage'],
            ['name' => 'Shopping Center'],
            ['name' => 'Sport Activity Location'],
            ['name' => 'Store'],
            ['name' => 'Television Station'],
            ['name' => 'Tourist Information Center'],
            ['name' => 'Travel Agency']
         ]);
    }
}

