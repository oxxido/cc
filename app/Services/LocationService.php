<?php namespace App\Services;

use App\Models\City;
use App\Models\State;
use App\Models\Country;

class LocationService {

    public static function find(array $data)
    {
        $city_id = isset($data['city_id']) ? $data['city_id'] : false;
        $city_name = isset($data['city_name']) ? $data['city_name'] : false;
        $zip_code = isset($data['zip_code']) ? $data['zip_code'] : false;
        $state_code = isset($data['state_code']) ? $data['state_code'] : false;
        $state_name = isset($data['state_name']) ? $data['state_name'] : false;
        $country_code = isset($data['country_code']) ? $data['country_code'] : false;
        $country_name = isset($data['country_name']) ? $data['country_name'] : false;

        if($city_id)
        {
            return City::where('id', '=', $city_id)->get();
        }
    
        if($zip_code)
        {
            return City::select('cities.*')
                ->join('states', 'cities.state_id', '=', 'states.id')
                ->join('countries', function ($join)  use ($country_code, $country_name) {
                    if($country_code)
                    {
                        $join->on('states.country_id', '=', 'countries.id')
                             ->where('countries.code', '=', $country_code);
                    }
                    elseif ($country_name)
                    {
                        $join->on('states.country_id', '=', 'countries.id')
                             ->where('countries.name', '=', $country_name);
                    }
                })
                ->where('cities.zip_code', '=', $zip_code)
                ->get();
        }
        elseif($city_name && ($state_code || $state_name))
        {
            return  City::select('cities.*')
                ->join('states', function ($join)  use ($state_code, $state_name) {
                    if($state_code)
                    {
                        $join->on('cities.state_id', '=', 'states.id')
                             ->where('states.code', '=', $state_code);
                    }
                    elseif ($state_name)
                    {
                        $join->on('cities.state_id', '=', 'states.id')
                             ->where('states.name', '=', $state_name);
                    }
                })
                ->join('countries', function ($join)  use ($country_code, $country_name) {
                    if($country_code)
                    {
                        $join->on('states.country_id', '=', 'countries.id')
                             ->where('countries.code', '=', $country_code);
                    }
                    elseif ($country_name)
                    {
                        $join->on('states.country_id', '=', 'countries.id')
                             ->where('countries.name', '=', $country_name);
                    }
                })
                ->where('cities.name', '=', $city_name)
                ->get();
        }
        else
        {
            return City::get();
        }
    }

    /**
     * Create a new City instance.
     *
     * @param  array  $data
     * @return City
     */
    public static function create(array $data)
    {
        if($country = $this->findCountry($data) && $state = $this->findState($data))
        {
            return City::create([
                'state_id' => $state->id,
                'name'     => $data['city_name'],
                'zip_code' => $data['zip_code']
            ]);
        }
        return false;
    }

    public static function findCountry(array $data)
    {
        if(isset($data['country_id']))
        {
            return Country::find($data['country_id']);
        }
        elseif(isset($data['country_code']))
        {
            return Country::where("code", "=", $data['country_code'])->get()->first();
        }
        elseif(isset($data['country_name']))
        {
            return Country::where("name", "=", $data['country_name'])->get()->first();
        }
        else
        {
            return false;
        }
    }

    public static function findState(array $data)
    {
        if(!($country = $this->findCountry($data)))
        {
            return false;
        }

        if(isset($data['state_id']))
        {
            return State::find($data['state_id']);
        }
        elseif(isset($data['state_code']))
        {
            return State::select('states.*')
                ->where("country_id", "=", $country->id)
                ->where("code", "=", $data['state_code'])
                ->get()
                ->first();
        }
        elseif(isset($data['state_name']))
        {
            return State::select('states.*')
                ->where("country_id", "=", $country->id)
                ->where("name", "=", $data['state_name'])
                ->get()
                ->first();;
        }
        else
        {
            return State::create([
                'country_id' => $country->id,
                'name'       => isset($data['state_name']) ? $data['state_name'] : false,
                'code'       => isset($data['state_code']) ? $data['state_code'] : false
            ]);;
        }
    }
}
