<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(CountriesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(BusinessTypesTableSeeder::class);
        $this->call(OrganizationTypesTableSeeder::class);
        $this->call(SocialNetworksTableSeeder::class);

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

