<?php

use Illuminate\Database\Seeder;
use App\Models\Owner;
use App\Models\User;
use App\Models\Admin;

class UsersTableSeeder extends Seeder
{
    const SEEDED = 3;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $user           = factory(User::class)->make();
            $user->email    = env('TEST_OWNER_EMAIL', 'owner@user.com');
            $user->password = Hash::make(env('TEST_OWNER_PASSWORD', 'secret'));
            $user->save();
            $user->owner()->save(new Owner());
            $admin = new Admin();
            $admin->admin_id = $user->id;
            $admin->owner_id = $user->id;
            $admin->save();

            for ($i = 0; $i < self::SEEDED - 1; $i++) {
                $user = factory(User::class)->make();
                $user->save();
            }
        });
    }
}
