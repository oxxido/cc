<?php namespace App\Services;

use App\Models\Admin;
use App\Models\Business;
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

    public static function getCity(Request $request)
    {        
        $city_id = $request->input('city_id');
        $country_code = $request->input('country_code');
        $zip_code = $request->input('zip_code');
        if(!($city = LocationService::find($city_id, $zip_code, $country_code)))
        {
            $city = LocationService::create([
                'city_name'    => $request->input('city_name'),
                'state_name'   => $request->input('state_name'),
                'country_code' => $country_code,
                'zip_code'     => $zip_code
            ]);
        }
        return $city;
    }

    public static function getAdmin(Request $request, $user)
    {
        if($request->input('new_admin') == 1)
        {
            $user_admin_email = $request->input('admin_email');
            if(!($user_admin = UserService::find($user_admin_email)))
            {
                $password = str_random(8);
                $user_admin = UserService::create([
                    'first_name' => $request->input('admin_first_name'),
                    'last_name' => $request->input('admin_last_name'),
                    'email' => $user_admin_email,
                    'password' => $password,
                    'password_confirmation' => $password
                ]);
            }

            if($user_admin->isAdmin($user->id))
            {
                $admin = $user_admin->admin;
            }
            else
            {
                $admin = AdminService::create([
                    'owner_id' => $user->id,
                    'admin_id' => $user_admin->id
                ]);
            }
        }
        else
        {
            $admin = Admin::find($request->input('admin_id'));
        }
        return $admin;
    }

    /**
     * Create a new user instance after a valid registration.
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
