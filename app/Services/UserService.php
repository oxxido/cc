<?php namespace App\Services;

use Validator;
use App\Models\User;
use App\Models\Owner;

use Event;
use App\Events\UserEmailEvent;

class UserService {

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validator(array $data)
    {
        return Validator::make($data, [
			'first_name' => 'required|max:255',
			'last_name'  => 'required|max:255',
			'email'      => 'required|email|max:255|unique:users',
			'password'   => 'required|confirmed|min:6'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public static function create(array $data, $send_password = false)
    {
        $user = User::create([
            'first_name'      => $data['first_name'],
            'last_name'       => $data['last_name'],
            'email'           => $data['email'],
            'password'        => bcrypt($data['password']),
            'activation_code' => str_random(60)
        ]);
        Event::fire(new UserEmailEvent($user, "user", ["send_password" => $send_password, "password" => $data['password']]));
        notification_csv("New user created. Email sent to " . $data['email']);
        return $user;
    }

    public static function find($email)
    {
        return User::where('email', $email)->get()->first();
    }

    public static function createOwner($user)
    {
        $owner = new Owner;
        $owner->id = $user->id;
        $owner->save();
        Event::fire(new UserEmailEvent($user, "owner"));
        return $owner;
    }

    public static function update($id, array $data)
    {
        $user = User::find($id);
        foreach ($data as $key => $value)
        {
            $user->setAttribute($key, $value);
        }
        $user->save();
        return $user;
    }
}
