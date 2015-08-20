<?php namespace App\Services;

use App\Models\City;
use App\Models\State;
use App\Models\Country;

class LocationService {

    public static function find($city_id, $zip_code, $country_code)
    {
        if($city_id)
        {
            return City::find($city_id);
        }
        return City::join('states', 'cities.state_id', '=', 'states.id')
            ->join('countries', function ($join)  use ($country_code){
                $join->on('states.country_id', '=', 'countries.id')
                     ->where('countries.code', '=', $country_code);
            })
            ->where('cities.zip_code', '=', $zip_code)
            ->select('cities.*')
            ->get();
    }

    /**
     * Create a new City instance.
     *
     * @param  array  $data
     * @return City
     */
    public static function create(array $data)
    {
        $country = Country::where("code", "=", $data['country_code'])->get()->first();
        $state = State::create([
            'country_id' => $country->id,
            'name'       => $data['state_name']
        ]);
        return City::create([
            'state_id' => $state->id,
            'name'     => $data['city_name'],
            'zip_code' => $data['zip_code']
        ]);
    }
}
