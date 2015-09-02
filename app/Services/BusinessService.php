<?php namespace App\Services;

use App\Models\Admin;
use App\Models\Business;
use App\Models\Product;
use App\Services\UserService;
use App\Services\AdminService;
use App\Services\LocationService;
use Illuminate\Http\Request;
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
        return Validator::make($data, array(
            'name'                 => 'required',
            'name'                 => 'required',
            'url'                  => 'required|url',
            'organization_type_id' => 'required',
            'business_type_id'     => 'required',

            'admin_id'             => 'required_if:new_admin,0',
            'admin_first_name'     => 'required_if:new_admin,1',
            'admin_last_name'      => 'required_if:new_admin,1',
            'admin_email'          => 'required_if:new_admin,1',

            'country_code'         => 'required',
            'city_id'              => 'required_if:new_city,0',
            'city_name'            => 'required_if:new_city,1',
            'state_name'           => 'required_if:new_city,1',
            'zip_code'             => 'required_if:new_city,1',
            'city_name'            => 'required_if:new_city,1',
            'address'              => 'required'
        ));
    }

    public static function getCity(array $data)
    {
        if(!($city = LocationService::find($data['city_id'], $data['zip_code'], $data['country_code'])->first()))
        {
            $city = LocationService::create([
                'city_name'    => $data['city_name'],
                'state_name'   => $data['state_name'],
                'country_code' => $data['country_code'],
                'zip_code'     => $data['zip_code']
            ]);
        }
        return $city;
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
        $business = Business::create($data);
        $business->config = self::defaultConfig("default", $business);
        $business->save();
        $product = new Product();
        $product->business_id = $business->id;
        $product->save();

        return $business;
    }

    public static function defaultConfig($type, $business, $request = false)
    {
        $default = [
            'feedback' => [
                'includeSocialLinks' => true,
                'includePhone'       => false,
                'positiveThreshold'  => 3,
                'pageTitle'          => $business->name,
                'logoUrl'            => asset('images/logo-example.png'),
                'bannerUrl'          => asset('images/landscape.jpg'),
                'starsStyle'         => 'default'
            ],
            'testimonial' => [
                'includeFeedback' => true
            ],
            'notification' => [
                'name' => 'value'
            ],
            'email' => [
                'name' => 'value'
            ],
            'kiosk' => [
                'name' => 'value'
            ]
        ];

        if($type == "default")
        {
            return json_decode(json_encode($default));
        }

        $config = isset($business->config->$type) ? $business->config->$type : new \stdClass;
        foreach($default[$type] as $name => $value)
        {
            $config->$name = $request->input($name) ? $request->input($name) : (($request->old($name) && $request->old($name) !== false) ? $request->old($name) : ((isset($config->$name) && $config->$name) ? $config->$name : $value));
        }
        //echo"<pre>";print_r($request->all());exit();
        return $config;
    }
}
