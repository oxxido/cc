<?php namespace App\Services;

use Validator;
use App\Models\BusinessCommenter;
use App\Models\Commenter;
use App\Models\Comment;
use Event;
use App\Events\UserEmailEvent;

class CommenterService {

    /**
     * Create a new commenter instance after a valid registration.
     *
     * @param  array $data
     *
     * @return Commenter
     */
    public static function createCommenter(array $data)
    {

        $rows = ['id' => $data['id']];

        if (isset($data['phone']) && $data['phone']) {
            $rows['phone'] = $data['phone'];
        }

        if (isset($data['note']) && $data['note']) {
            $rows['note'] = $data['note'];
        }

        $commenter = Commenter::create($rows);

        Event::fire(new UserEmailEvent($commenter->user, "commenter"));

        return $commenter;
    }

    /**
     * Create a new commenter instance after a valid registration.
     *
     * @param  array $data
     *
     * @return Commenter
     */
    public static function createBusinessCommenter(array $data)
    {
        $rows = [
            'commenter_id' => $data['commenter_id'],
            'business_id'  => $data['business_id']
        ];

        if (isset($data['adder_id']) && $data['adder_id']) {
            $rows['adder_id'] = $data['adder_id'];
        }

        return BusinessCommenter::create($rows);
    }

    public static function getCommenter(array $data)
    {
        $data['id'] = isset($data['id']) ? $data['id'] : false;
        if (!($data['id'] && $commenter = Commenter::find($data['id']))) {
            if (!($user_commenter = UserService::find($data['email']))) {
                $user_commenter = UserService::create([
                    'first_name' => $data['first_name'],
                    'last_name'  => $data['last_name'],
                    'email'      => $data['email'],
                    'password'   => str_random(8)
                ], true);
            }

            if (!$user_commenter->isCommenter()) {
                $commenter = self::createCommenter([
                    'id'    => $user_commenter->id,
                    'phone' => (isset($data['phone']) ? $data['phone'] : false),
                    'note'  => (isset($data['note']) ? $data['note'] : false)
                ]);
            } else {
                $commenter = $user_commenter->commenter;
            }
        }

        return $commenter;
    }

    public static function getBusinessCommenter(array $data)
    {
        $data['id'] = isset($data['id']) ? $data['id'] : false;
        if (!($data['id'] && $business_commenter = BusinessCommenter::find($data['id']))) {
            $business_commenter = BusinessCommenter::where('commenter_id', '=',
                $data['commenter_id'])->where('business_id', '=', $data['business_id'])->get()->first();

            if (!$business_commenter) {
                $business_commenter = self::createBusinessCommenter([
                    'commenter_id' => $data['commenter_id'],
                    'business_id'  => $data['business_id'],
                    'adder_id'     => (isset($data['adder_id']) ? $data['adder_id'] : false)
                ]);
            }
        }

        return $business_commenter;
    }
}
