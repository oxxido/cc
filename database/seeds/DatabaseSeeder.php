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

        $this->call(OrganizationTypesTableSeeder::class);
        $this->call(BusinessTypesTableSeeder::class);
        $this->call(SocialNetworksTableSeeder::class);
        $this->call(LocationsSeeder::class);

        switch (App::environment()) {
            case 'production':
                break;
            case 'local':
                //break;
            case 'development':
                //break;
            case 'testing':
                //break;
            case 'staging':
                //break;
            default:
                $this->call(UsersTableSeeder::class);
                break;
        }


        Model::reguard();
    }

}

