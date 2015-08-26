<?php namespace App\Services;

use App\Models\Owner;
use App\Models\User;
use Validator;

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
    public static function create(array $data)
    {
        return User::create([
			'first_name'      => $data['first_name'],
			'last_name'       => $data['last_name'],
			'email'           => $data['email'],
			'password'        => bcrypt($data['password']),
			'activation_code' => str_random(60)
		]);
    }

    public static function find($email)
    {
        return User::where('email', $email)->get()->first();
    }

    public static function makeOwner($user)
    {
        $owner = new Owner;
        $owner->id = $user->id;
        return $owner->save();
    }

    public static function notifyCreation($type, $data)
    {
        // Send welcome email etc
    }
}
