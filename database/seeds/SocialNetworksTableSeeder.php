<?php

use Illuminate\Database\Seeder;

class SocialNetworksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //delete types table records
        DB::table('social_networks')->delete();

        //insert records
        DB::table('social_networks')->insert([
            ['name' => 'Facebook', 'logo' => '/facebook.jpg', 'url' => 'www.facebook.com'],
            ['name' => 'Twitter', 'logo' => '/twitter.jpg', 'url' => 'www.twitter.com']
         ]);
    }
}
