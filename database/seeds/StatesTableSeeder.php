<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class StatesTableSeeder extends Seeder {

    public function run() {

        $country_id = DB::table('countries')->where('code', 'US')->first()->id;

        //delete types table records
        DB::table('states')->delete();

        //insert records
        DB::table('states')->insert([
            ['code' => 'AL', 'country_id' => $country_id, 'name' => 'Alabama'],
            ['code' => 'AK', 'country_id' => $country_id, 'name' => 'Alaska'],
            ['code' => 'AS', 'country_id' => $country_id, 'name' => 'American Samoa'],
            ['code' => 'AZ', 'country_id' => $country_id, 'name' => 'Arizona'],
            ['code' => 'AR', 'country_id' => $country_id, 'name' => 'Arkansas'],
            ['code' => 'CA', 'country_id' => $country_id, 'name' => 'California'],
            ['code' => 'CO', 'country_id' => $country_id, 'name' => 'Colorado'],
            ['code' => 'CT', 'country_id' => $country_id, 'name' => 'Connecticut'],
            ['code' => 'DE', 'country_id' => $country_id, 'name' => 'Delaware'],
            ['code' => 'DC', 'country_id' => $country_id, 'name' => 'District Of Columbia'],
            ['code' => 'FM', 'country_id' => $country_id, 'name' => 'Federated States Of Micronesia'],
            ['code' => 'FL', 'country_id' => $country_id, 'name' => 'Florida'],
            ['code' => 'GA', 'country_id' => $country_id, 'name' => 'Georgia'],
            ['code' => 'GU', 'country_id' => $country_id, 'name' => 'Guam'],
            ['code' => 'HI', 'country_id' => $country_id, 'name' => 'Hawaii'],
            ['code' => 'ID', 'country_id' => $country_id, 'name' => 'Idaho'],
            ['code' => 'IL', 'country_id' => $country_id, 'name' => 'Illinois'],
            ['code' => 'IN', 'country_id' => $country_id, 'name' => 'Indiana'],
            ['code' => 'IA', 'country_id' => $country_id, 'name' => 'Iowa'],
            ['code' => 'KS', 'country_id' => $country_id, 'name' => 'Kansas'],
            ['code' => 'KY', 'country_id' => $country_id, 'name' => 'Kentucky'],
            ['code' => 'LA', 'country_id' => $country_id, 'name' => 'Louisiana'],
            ['code' => 'ME', 'country_id' => $country_id, 'name' => 'Maine'],
            ['code' => 'MH', 'country_id' => $country_id, 'name' => 'Marshall Islands'],
            ['code' => 'MD', 'country_id' => $country_id, 'name' => 'Maryland'],
            ['code' => 'MA', 'country_id' => $country_id, 'name' => 'Massachusetts'],
            ['code' => 'MI', 'country_id' => $country_id, 'name' => 'Michigan'],
            ['code' => 'MN', 'country_id' => $country_id, 'name' => 'Minnesota'],
            ['code' => 'MS', 'country_id' => $country_id, 'name' => 'Mississippi'],
            ['code' => 'MO', 'country_id' => $country_id, 'name' => 'Missouri'],
            ['code' => 'MT', 'country_id' => $country_id, 'name' => 'Montana'],
            ['code' => 'NE', 'country_id' => $country_id, 'name' => 'Nebraska'],
            ['code' => 'NV', 'country_id' => $country_id, 'name' => 'Nevada'],
            ['code' => 'NH', 'country_id' => $country_id, 'name' => 'New Hampshire'],
            ['code' => 'NJ', 'country_id' => $country_id, 'name' => 'New Jersey'],
            ['code' => 'NM', 'country_id' => $country_id, 'name' => 'New Mexico'],
            ['code' => 'NY', 'country_id' => $country_id, 'name' => 'New York'],
            ['code' => 'NC', 'country_id' => $country_id, 'name' => 'North Carolina'],
            ['code' => 'ND', 'country_id' => $country_id, 'name' => 'North Dakota'],
            ['code' => 'MP', 'country_id' => $country_id, 'name' => 'Northern Mariana Islands'],
            ['code' => 'OH', 'country_id' => $country_id, 'name' => 'Ohio'],
            ['code' => 'OK', 'country_id' => $country_id, 'name' => 'Oklahoma'],
            ['code' => 'OR', 'country_id' => $country_id, 'name' => 'Oregon'],
            ['code' => 'PW', 'country_id' => $country_id, 'name' => 'Palau'],
            ['code' => 'PA', 'country_id' => $country_id, 'name' => 'Pennsylvania'],
            ['code' => 'PR', 'country_id' => $country_id, 'name' => 'Puerto Rico'],
            ['code' => 'RI', 'country_id' => $country_id, 'name' => 'Rhode Island'],
            ['code' => 'SC', 'country_id' => $country_id, 'name' => 'South Carolina'],
            ['code' => 'SD', 'country_id' => $country_id, 'name' => 'South Dakota'],
            ['code' => 'TN', 'country_id' => $country_id, 'name' => 'Tennessee'],
            ['code' => 'TX', 'country_id' => $country_id, 'name' => 'Texas'],
            ['code' => 'UT', 'country_id' => $country_id, 'name' => 'Utah'],
            ['code' => 'VT', 'country_id' => $country_id, 'name' => 'Vermont'],
            ['code' => 'VI', 'country_id' => $country_id, 'name' => 'Virgin Islands'],
            ['code' => 'VA', 'country_id' => $country_id, 'name' => 'Virginia'],
            ['code' => 'WA', 'country_id' => $country_id, 'name' => 'Washington'],
            ['code' => 'WV', 'country_id' => $country_id, 'name' => 'West Virginia'],
            ['code' => 'WI', 'country_id' => $country_id, 'name' => 'Wisconsin'],
            ['code' => 'WY', 'country_id' => $country_id, 'name' => 'Wyoming"']
         ]);
    }
}
