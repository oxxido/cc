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

