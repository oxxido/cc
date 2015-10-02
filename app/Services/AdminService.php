<?php namespace App\Services;

use App\Models\User;
use App\Models\Admin;
use Validator;
use Event;
use App\Events\UserEmailEvent;

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
        notification_csv("User {$admin->user->email} asigned as admin");

        if($admin->user->id != $data['owner_id']) {
            Event::fire(new UserEmailEvent($admin->user, "admin"));

            notification_csv("Email send to {$admin->user->email} for new admin");
        }
        return $admin;
    }

    public static function getAdmin(array $data)
    {
        $data['id'] = isset($data['id']) ? $data['id'] : false;
        if(!($data['id'] && $admin = Admin::find($data['id'])))
        {
            $user_admin_by_email = $data['email'] ? UserService::find($data['email']) : false;
            $user_admin_by_id = (isset($data['user_admin_id']) && $data['user_admin_id']) ?  User::find($data['user_admin_id']) : false;
            $user_admin = $user_admin_by_id ? $user_admin_by_id : ($user_admin_by_email ? $user_admin_by_email : false);

            if(!$user_admin)
            {
                $user_admin = UserService::create([
                    'first_name' => $data['first_name'],
                    'last_name'  => $data['last_name'],
                    'email'      => $data['email'],
                    'password'   => str_random(8)
                ], true);
            }
            else
            {
                notification_csv("User {$data['email']} was found");
            }

            if($user_admin->isAdmin($data['owner_id']))
            {
                $admin = $user_admin->admin($data['owner_id']);
                notification_csv("User {$data['email']} is already an admin");
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
