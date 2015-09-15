<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class OrganizationTypesTableSeeder extends Seeder {

    public function run() {

        DB::table('organization_types')->delete();

        DB::table('organization_types')->insert([
            ['uuid' => Uuid::generate(), 'name' => 'Animal Shelter'],
            ['uuid' => Uuid::generate(), 'name' => 'Automotive Business'],
            ['uuid' => Uuid::generate(), 'name' => 'Child Care'],
            ['uuid' => Uuid::generate(), 'name' => 'Dry Cleaning or Laundry'],
            ['uuid' => Uuid::generate(), 'name' => 'Emergency Service'],
            ['uuid' => Uuid::generate(), 'name' => 'Employment Agency'],
            ['uuid' => Uuid::generate(), 'name' => 'Entertainment Business'],
            ['uuid' => Uuid::generate(), 'name' => 'Financial Service'],
            ['uuid' => Uuid::generate(), 'name' => 'Food Establishment'],
            ['uuid' => Uuid::generate(), 'name' => 'Government Office'],
            ['uuid' => Uuid::generate(), 'name' => 'Health And Beauty Business'],
            ['uuid' => Uuid::generate(), 'name' => 'Home And Construction Business'],
            ['uuid' => Uuid::generate(), 'name' => 'Internet Cafe'],
            ['uuid' => Uuid::generate(), 'name' => 'Library'],
            ['uuid' => Uuid::generate(), 'name' => 'Local Business'],
            ['uuid' => Uuid::generate(), 'name' => 'Lodging Business'],
            ['uuid' => Uuid::generate(), 'name' => 'Medical Organization'],
            ['uuid' => Uuid::generate(), 'name' => 'Professional Service'],
            ['uuid' => Uuid::generate(), 'name' => 'Radio Station'],
            ['uuid' => Uuid::generate(), 'name' => 'Real State Agent'],
            ['uuid' => Uuid::generate(), 'name' => 'Recycling Center'],
            ['uuid' => Uuid::generate(), 'name' => 'Self Storage'],
            ['uuid' => Uuid::generate(), 'name' => 'Shopping Center'],
            ['uuid' => Uuid::generate(), 'name' => 'Sports Activity Location'],
            ['uuid' => Uuid::generate(), 'name' => 'Store'],
            ['uuid' => Uuid::generate(), 'name' => 'Television Station'],
            ['uuid' => Uuid::generate(), 'name' => 'Tourist Information Center'],
            ['uuid' => Uuid::generate(), 'name' => 'Travel Agency'],
        ]);
    }
}
