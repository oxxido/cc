<?php

use App\Models\User;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
$factory->define(User::class, function ($faker) {
    return [
        'uuid'           => Uuid::generate(),
        'first_name'     => $faker->firstName,
        'last_name'      => $faker->lastName,
        'email'          => $faker->unique()->email,
        'password'       => \Hash::make($faker->password),
        'remember_token' => null,
        'active'         => true,
        'created_at'     => Carbon::now(),
        'updated_at'     => Carbon::now()
    ];
});
