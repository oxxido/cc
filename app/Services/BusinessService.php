<?php namespace App\Services;

use App\Models\Business;
use Validator;

class BusinessService {

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validator(array $data)
    {
        return Validator::make($data, [
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Business
     */
    public static function create(array $data)
    {
        return Business::create($data);
    }
}
