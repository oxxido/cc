<?php namespace App\Services;

use Validator;
use App\Models\BusinessCommenter;
use App\Models\Commenter;
use App\Models\Comment;
use Event;
use App\Events\UserEmailEvent;

class FeedbackService
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validator(array $data)
    {
        $rules = [
            'rating'     => 'required',
            'comment'    => 'required:max:500'
        ];

        if(!($user = \Auth::user()))
        {
            $rules = array_merge($rules, [
                'first_name' => 'required',
                'last_name'  => 'required',
                'email'      => 'required',
            ]);
        }
        return Validator::make($data, $rules);
    }

    /**
     * Create a new commenter instance after a valid registration.
     *
     * @param  array $data
     *
     * @return Commenter
     */
    public static function createComment(array $data)
    {
        $rows = [
            'business_commenter_id' => $data['business_commenter_id'],
            'product_id'            => $data['product_id'],
            'comment'               => $data['comment'],
            'rating'                => $data['rating']
        ];

        if (isset($data['score']) && $data['score']) {
            $rows['score'] = $data['score'];
        }

        if (isset($data['status']) && $data['status']) {
            $rows['status'] = $data['status'];
        }

        if (isset($data['show_on_website']) && $data['show_on_website']) {
            $rows['show_on_website'] = $data['show_on_website'];
        }

        return Comment::create($rows);
    }

}


