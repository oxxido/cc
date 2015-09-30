<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            DB::table('states')->delete();

            DB::table('states')->insert($this->states());
        });
    }

    private function states()
    {
        $country_id = DB::table('countries')->where('code', 'US')->first()->id;

        $states = [
            ['uuid' => Uuid::generate(), 'code' => 'AL', 'country_id' => $country_id, 'name' => 'Alabama'],
            ['uuid' => Uuid::generate(), 'code' => 'AK', 'country_id' => $country_id, 'name' => 'Alaska'],
            ['uuid' => Uuid::generate(), 'code' => 'AS', 'country_id' => $country_id, 'name' => 'American Samoa'],
            ['uuid' => Uuid::generate(), 'code' => 'AZ', 'country_id' => $country_id, 'name' => 'Arizona'],
            ['uuid' => Uuid::generate(), 'code' => 'AR', 'country_id' => $country_id, 'name' => 'Arkansas'],
            ['uuid' => Uuid::generate(), 'code' => 'CA', 'country_id' => $country_id, 'name' => 'California'],
            ['uuid' => Uuid::generate(), 'code' => 'CO', 'country_id' => $country_id, 'name' => 'Colorado'],
            ['uuid' => Uuid::generate(), 'code' => 'CT', 'country_id' => $country_id, 'name' => 'Connecticut'],
            ['uuid' => Uuid::generate(), 'code' => 'DE', 'country_id' => $country_id, 'name' => 'Delaware'],
            ['uuid' => Uuid::generate(), 'code' => 'DC', 'country_id' => $country_id, 'name' => 'District Of Columbia'],
            ['uuid' => Uuid::generate(), 'code' => 'FM', 'country_id' => $country_id, 'name' => 'Federated States Of Micronesia'],
            ['uuid' => Uuid::generate(), 'code' => 'FL', 'country_id' => $country_id, 'name' => 'Florida'],
            ['uuid' => Uuid::generate(), 'code' => 'GA', 'country_id' => $country_id, 'name' => 'Georgia'],
            ['uuid' => Uuid::generate(), 'code' => 'GU', 'country_id' => $country_id, 'name' => 'Guam'],
            ['uuid' => Uuid::generate(), 'code' => 'HI', 'country_id' => $country_id, 'name' => 'Hawaii'],
            ['uuid' => Uuid::generate(), 'code' => 'ID', 'country_id' => $country_id, 'name' => 'Idaho'],
            ['uuid' => Uuid::generate(), 'code' => 'IL', 'country_id' => $country_id, 'name' => 'Illinois'],
            ['uuid' => Uuid::generate(), 'code' => 'IN', 'country_id' => $country_id, 'name' => 'Indiana'],
            ['uuid' => Uuid::generate(), 'code' => 'IA', 'country_id' => $country_id, 'name' => 'Iowa'],
            ['uuid' => Uuid::generate(), 'code' => 'KS', 'country_id' => $country_id, 'name' => 'Kansas'],
            ['uuid' => Uuid::generate(), 'code' => 'KY', 'country_id' => $country_id, 'name' => 'Kentucky'],
            ['uuid' => Uuid::generate(), 'code' => 'LA', 'country_id' => $country_id, 'name' => 'Louisiana'],
            ['uuid' => Uuid::generate(), 'code' => 'ME', 'country_id' => $country_id, 'name' => 'Maine'],
            ['uuid' => Uuid::generate(), 'code' => 'MH', 'country_id' => $country_id, 'name' => 'Marshall Islands'],
            ['uuid' => Uuid::generate(), 'code' => 'MD', 'country_id' => $country_id, 'name' => 'Maryland'],
            ['uuid' => Uuid::generate(), 'code' => 'MA', 'country_id' => $country_id, 'name' => 'Massachusetts'],
            ['uuid' => Uuid::generate(), 'code' => 'MI', 'country_id' => $country_id, 'name' => 'Michigan'],
            ['uuid' => Uuid::generate(), 'code' => 'MN', 'country_id' => $country_id, 'name' => 'Minnesota'],
            ['uuid' => Uuid::generate(), 'code' => 'MS', 'country_id' => $country_id, 'name' => 'Mississippi'],
            ['uuid' => Uuid::generate(), 'code' => 'MO', 'country_id' => $country_id, 'name' => 'Missouri'],
            ['uuid' => Uuid::generate(), 'code' => 'MT', 'country_id' => $country_id, 'name' => 'Montana'],
            ['uuid' => Uuid::generate(), 'code' => 'NE', 'country_id' => $country_id, 'name' => 'Nebraska'],
            ['uuid' => Uuid::generate(), 'code' => 'NV', 'country_id' => $country_id, 'name' => 'Nevada'],
            ['uuid' => Uuid::generate(), 'code' => 'NH', 'country_id' => $country_id, 'name' => 'New Hampshire'],
            ['uuid' => Uuid::generate(), 'code' => 'NJ', 'country_id' => $country_id, 'name' => 'New Jersey'],
            ['uuid' => Uuid::generate(), 'code' => 'NM', 'country_id' => $country_id, 'name' => 'New Mexico'],
            ['uuid' => Uuid::generate(), 'code' => 'NY', 'country_id' => $country_id, 'name' => 'New York'],
            ['uuid' => Uuid::generate(), 'code' => 'NC', 'country_id' => $country_id, 'name' => 'North Carolina'],
            ['uuid' => Uuid::generate(), 'code' => 'ND', 'country_id' => $country_id, 'name' => 'North Dakota'],
            ['uuid' => Uuid::generate(), 'code' => 'MP', 'country_id' => $country_id, 'name' => 'Northern Mariana Islands'],
            ['uuid' => Uuid::generate(), 'code' => 'OH', 'country_id' => $country_id, 'name' => 'Ohio'],
            ['uuid' => Uuid::generate(), 'code' => 'OK', 'country_id' => $country_id, 'name' => 'Oklahoma'],
            ['uuid' => Uuid::generate(), 'code' => 'OR', 'country_id' => $country_id, 'name' => 'Oregon'],
            ['uuid' => Uuid::generate(), 'code' => 'PW', 'country_id' => $country_id, 'name' => 'Palau'],
            ['uuid' => Uuid::generate(), 'code' => 'PA', 'country_id' => $country_id, 'name' => 'Pennsylvania'],
            ['uuid' => Uuid::generate(), 'code' => 'PR', 'country_id' => $country_id, 'name' => 'Puerto Rico'],
            ['uuid' => Uuid::generate(), 'code' => 'RI', 'country_id' => $country_id, 'name' => 'Rhode Island'],
            ['uuid' => Uuid::generate(), 'code' => 'SC', 'country_id' => $country_id, 'name' => 'South Carolina'],
            ['uuid' => Uuid::generate(), 'code' => 'SD', 'country_id' => $country_id, 'name' => 'South Dakota'],
            ['uuid' => Uuid::generate(), 'code' => 'TN', 'country_id' => $country_id, 'name' => 'Tennessee'],
            ['uuid' => Uuid::generate(), 'code' => 'TX', 'country_id' => $country_id, 'name' => 'Texas'],
            ['uuid' => Uuid::generate(), 'code' => 'UT', 'country_id' => $country_id, 'name' => 'Utah'],
            ['uuid' => Uuid::generate(), 'code' => 'VT', 'country_id' => $country_id, 'name' => 'Vermont'],
            ['uuid' => Uuid::generate(), 'code' => 'VI', 'country_id' => $country_id, 'name' => 'Virgin Islands'],
            ['uuid' => Uuid::generate(), 'code' => 'VA', 'country_id' => $country_id, 'name' => 'Virginia'],
            ['uuid' => Uuid::generate(), 'code' => 'WA', 'country_id' => $country_id, 'name' => 'Washington'],
            ['uuid' => Uuid::generate(), 'code' => 'WV', 'country_id' => $country_id, 'name' => 'West Virginia'],
            ['uuid' => Uuid::generate(), 'code' => 'WI', 'country_id' => $country_id, 'name' => 'Wisconsin'],
            ['uuid' => Uuid::generate(), 'code' => 'WY', 'country_id' => $country_id, 'name' => 'Wyoming']
        ];

        return $states;
    }
}
