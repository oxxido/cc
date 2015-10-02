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
        elseif($states = self::findState($data))
        {
            $state_ids = [];

            if(is_a($states, "App\Models\State"))
            {
                $state_ids[] = $states->id;
            }
            else
            {
                foreach ($states as $state)
                {
                    $state_ids[] = $state->id;
                }
            }

            if(isset($data['zip_code']) && $data['zip_code'])
            {
                return City::select('*')
                    ->whereIn('state_id', $state_ids)
                    ->where('zip_code', '=', $data['zip_code'])
                    ->get();
            }
            elseif(isset($data['city_name']) && $data['city_name'])
            {
                return City::select('*')
                    ->whereIn('state_id', $state_ids)
                    ->where('name', '=', $data['city_name'])
                    ->get();
            }
        }
        return new ModelCollection();
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
            if($state = self::findState($data, true))
            {
                return City::create([
                    'state_id' => $state->id,
                    'name'     => $data['city_name'],
                    'zip_code' => $data['zip_code'] ? $data['zip_code'] : ""
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
        elseif(isset($data['country_code']) && $data['country_code'])
        {
            return Country::whereCode($data['country_code'])->get()->first();
        }
        elseif(isset($data['country_name']) && $data['country_name'])
        {
            return Country::whereName($data['country_name'])->get()->first();
        }
        else
        {
            return false;
        }
    }

    public static function findState(array $data, $one = true)
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
            $states = State::join('cities', 'states.id', '=', 'cities.state_id')
                ->where("states.country_id", "=", $country->id)
                ->where("cities.zip_code", "=", $data['zip_code'])
                ->select("states.*")
                ->get();

            if($states->count())
                return $one ? $states->first() : $states;
        }
        
        if(isset($data['state_code']) && $data['state_code'])
        {
            $states = State::select('states.*')
                ->where("country_id", "=", $country->id)
                ->where("code", "=", $data['state_code'])
                ->get();

            if($states->count())
                return $one ? $states->first() : $states;
        }
        if(isset($data['state_name']) && $data['state_name'])
        {
            $states = State::select('states.*')
                ->where("country_id", "=", $country->id)
                ->where("name", "=", $data['state_name'])
                ->get();

            if($states->count())
                return $one ? $states->first() : $states;
        }
        return self::createState($data);
    }
}
