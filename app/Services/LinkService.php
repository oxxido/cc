<?php namespace App\Services;

use App\Models\Business;
use App\Models\SocialNetwork;
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
            'social_network_id'    => 'required',
            //'order'                => 'required',
            'url'                  => 'required'
        ));
    }
    
}
