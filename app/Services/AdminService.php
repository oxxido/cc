<?php namespace App\Services;

use App\Models\User;
use App\Models\Admin;
use Validator;

class AdminService {

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Admin
     */
    public static function create(array $data)
    {
        return Admin::create([
            'owner_id' => $data['owner_id'],
            'admin_id' => $data['admin_id']
        ]);
    }
}
