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
            $business->$key = $value;
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
                'includeSocialLinks'   => true,
                'includePhone'         => false,
                'positiveThreshold'    => 3,
                'pageTitle'            => '',
                'logoUrl'              => asset('images/logo-example.png'),
                'bannerUrl'            => asset('images/landscape.jpg'),
                'starsStyle'           => 'default',
                'positiveText' => 'Thanks you for your feedback. It is very important to us to hear your feedback and it allow us to serve you better.

[REVIEW_LINKS]

Have a great day!

[YOUR_NAME]',
                'negativeText' => 'Thanks you for your feedback

Whenever we see feedback that is not outstanding, we like to follow up to see what we could have done better.

We will contact you to address the situation in any way we can.
                ',
            ],
            'testimonial' => [
                'includeFeedback' => true
            ],
            'notification' => [],
            'email' => [],
            'kiosk' => []
        ];

        if($type == "default")
        {
            return json_decode(json_encode($default));
        }
        elseif($type == "all")
        {
             $config = new \stdClass;
            foreach ($default as $name => $value)
            {
                $config->$name = self::defaultConfigByType($name, $business, $request, $default);
            }
            return $config;
        }
        else
        {
            return self::defaultConfigByType($type, $business, $request, $default);
        }
    }

    private static function defaultConfigByType($type, $business, $request, $default)
    {
        $config = isset($business->config->$type) ? $business->config->$type : new \stdClass;
        foreach($default[$type] as $name => $value)
        {
            if($request->input($name))
            {
                $config->$name = $request->input($name);
            }
            elseif($request->old($name) && $request->old($name) !== false)
            {
                $config->$name = $request->old($name);
            }
            elseif(isset($config->$name) && $config->$name !== "")
            {
                $config->$name = $config->$name;
            }
            else
            {
                $config->$name = $value;
            }
        }
        return $config;
    }

    public static function tagsReplace($options = array())
    {
        $parsed = str_replace("\r\n", "<br>", $options['text']);
        $parsed = str_replace("\n", "<br>", $parsed);

        $parsed = str_replace("[YOUR_NAME]", $options['business']->owner->name, $parsed);

        if(isset($options["part"]) && $options["part"] == "header")
        {
            $parsed = strpos($parsed, "[REVIEW_LINKS]") ? substr($parsed, 0, strpos($parsed, "[REVIEW_LINKS]")) : $parsed;
        }

        if(isset($options["part"]) && $options["part"] == "footer")
        {
            $parsed = strpos($parsed, "[REVIEW_LINKS]") ? substr($parsed, (strpos($parsed, "[REVIEW_LINKS]") + strlen("[REVIEW_LINKS]"))) : "";
        }

        return $parsed;
    }
}
