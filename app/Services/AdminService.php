<?php namespace App\Services;

use App\Models\User;
use App\Models\Admin;
use Validator;
use Event;
use App\Events\AdminCreation;

class AdminService {

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validator(array $data)
    {
        return Validator::make($data, array(
            'first_name'     => 'required',
            'last_name'      => 'required',
            'email'          => 'required'
        ));
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Admin
     */
    public static function create(array $data)
    {
        $admin = Admin::create([
            'owner_id' => $data['owner_id'],
            'admin_id' => $data['admin_id']
        ]);
        Event::fire(new AdminCreation($admin));
        return $admin;
    }

    public static function getAdmin(array $data)
    {
        $data['id'] = isset($data['id']) ? $data['id'] : false;
        if(!($data['id'] && $admin = Admin::find($data['id'])))
        {
            if(!($user_admin = UserService::find($data['email'])))
            {
                $data['password'] = str_random(8);
                $user_admin = UserService::create([
                    'first_name' => $data['first_name'],
                    'last_name'  => $data['last_name'],
                    'email'      => $data['email'],
                    'password'   => $data['password']
                ]);
            }

            if($user_admin->isAdmin($data['owner_id']))
            {
                $admin = $user_admin->admin($data['owner_id']);
            }
            else
            {
                $admin = AdminService::create([
                    'owner_id' => $data['owner_id'],
                    'admin_id' => $user_admin->id
                ]);
            }
        }
        return $admin;
    }
}
