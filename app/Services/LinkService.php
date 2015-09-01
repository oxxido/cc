<?php namespace App\Services;

use App\Models\Admin;
use App\Models\Business;
use App\Models\SocialNetwork;
use App\Services\UserService;
use App\Services\AdminService;
use App\Services\LocationService;
use Illuminate\Http\Request;
use Validator;

class LinkService {

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validator(array $data)
    {
        return Validator::make($data, array(
            'business_id'          => 'required',
            'social_network_id'    => 'required',

            'url'                  => 'required|url',
            'order'                => 'required',
            'active'               => 'required'
        ));
    }

    public static function getSocialNetwork(array $data)
    {
        //if(!($social = SocialNetwork::find($data['social_network_id'])->first()))
        if(!($social = SocialNetwork::where('id', '=', $data['social_network_id'])->first()))
        {
            //social network not found
        }
        return $social;
    }

    public static function getBusiness(array $data)
    {
        if(!($business = Business::where('id', '=', $data['business_id'])->first()))
        {
            //social network not found
        }
        return $business;
    }

    /**
     * Update user instance after a valid registration.
     *
     * @param  array  $data
     * @return Business
     */
    public static function update($id, array $data)
    {
        $business = Business::find($id);
        foreach ($data as $key => $value)
        {
            $business->setAttribute($key, $value);
        }
        $business->save();
        return $business;
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
