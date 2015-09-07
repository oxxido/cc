<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

include "OrganizationTypesTableSeeder.php";
include "BusinessTypesTableSeeder.php";
include "LocationsSeeder.php";
include "SocialNetworksTableSeeder.php";

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('OrganizationTypesTableSeeder');

        $this->call('BusinessTypesTableSeeder');

        $this->call('SocialNetworksTableSeeder');

        $this->call('LocationsSeeder');
        
    }

}

