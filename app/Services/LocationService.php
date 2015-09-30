<?php namespace App\Services;

use App\Models\City;
use App\Models\State;
use App\Models\Country;

class LocationService {

    public static function find(array $data)
    {
        if(isset($data['city_id']) && $data['city_id'])
        {
            return City::where('id', '=', $data['city_id'])->get();
        }
        elseif($state = self::findState($data))
        {
            if(isset($data['zip_code']) && $data['zip_code'])
            {
                return City::select('*')
                    ->where('state_id', '=', $state->id)
                    ->where('zip_code', '=', $data['zip_code'])
                    ->get();
            }
            elseif(isset($data['city_name']) && $data['city_name'])
            {
                return City::select('*')
                    ->where('state_id', '=', $state->id)
                    ->where('name', '=', $data['city_name'])
                    ->get();
            }
        }
        return City::get();
    }

    /**
     * Create a new City instance.
     *
     * @param  array  $data
     * @return City
     */
    public static function create(array $data)
    {
        if($country = self::findCountry($data))
        {
            if($state = self::findState($data))
            {
                return City::create([
                    'state_id' => $state->id,
                    'name'     => $data['city_name'],
                    'zip_code' => $data['zip_code']
                ]);
            }
        }
        return false;
    }

    /**
     * Create a new State instance.
     *
     * @param  array  $data
     * @return State
     */
    public static function createState(array $data)
    {
        if($country = self::findCountry($data))
        {
            if(isset($data['state_name']) && $data['state_name'])
            {
                return State::create([
                    'country_id' => $country->id,
                    'name'       => $data['state_name'],
                    'code'       => (isset($data['state_code']) && $data['state_code']) ? $data['state_code'] : ""
                ]);
            }
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
        if(!($country = self::findCountry($data)))
        {
            return false;
        }

        if(isset($data['state_id']) && $data['state_id'])
        {
            return State::find($data['state_id']);
        }

        if(isset($data['zip_code']) && $data['zip_code'])
        {
            $city = City::join('states', 'city.state_id', '=', 'states.id')
                ->where("states.country_id", "=", $country->id)
                ->where("cities.zip_code", "=", $data['zip_code'])
                ->select("cities.*")
                ->get()
                ->first();
            if($city)
            {
                return $city->state;
            }
        }
        
        if(isset($data['state_code']) && $data['state_code'])
        {
            return State::select('states.*')
                ->where("country_id", "=", $country->id)
                ->where("code", "=", $data['state_code'])
                ->get()
                ->first();
        }
        elseif(isset($data['state_name']) && $data['state_name'])
        {
            return State::select('states.*')
                ->where("country_id", "=", $country->id)
                ->where("name", "=", $data['state_name'])
                ->get()
                ->first();;
        }
        else
        {
            return self::createState($data);
        }
    }
}
