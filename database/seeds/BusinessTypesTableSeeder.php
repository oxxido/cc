<?php

use Illuminate\Database\Seeder;

class BusinessTypesTableSeeder extends Seeder
{
    public function run()
    {

        DB::table('business_types')->delete();

        DB::table('business_types')->insert([
            ['uuid' => Uuid::generate(), 'name' => 'Actual Company Name'],
            ['uuid' => Uuid::generate(), 'name' => 'Agency'],
            ['uuid' => Uuid::generate(), 'name' => 'Church'],
            ['uuid' => Uuid::generate(), 'name' => 'Company'],
            ['uuid' => Uuid::generate(), 'name' => 'Corporation'],
            ['uuid' => Uuid::generate(), 'name' => 'Event'],
            ['uuid' => Uuid::generate(), 'name' => 'Firm'],
            ['uuid' => Uuid::generate(), 'name' => 'Non Profit'],
            ['uuid' => Uuid::generate(), 'name' => 'Office'],
            ['uuid' => Uuid::generate(), 'name' => 'Restaurant'],
            ['uuid' => Uuid::generate(), 'name' => 'School'],
        ]);
    }
}
