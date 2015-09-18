<?php namespace App\Http\Requests;

class UserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return self::baseAttributes();
    }

    public static function baseAttributes()
    {
        return [
            'first_name'            => trans('user.fields.first_name'),
            'last_name'             => trans('user.fields.last_name'),
            'email'                 => trans('user.fields.email'),
            'password'              => trans('user.fields.password'),
            'password_confirmation' => trans('user.fields.password_confirmation'),
            'current_password'      => trans('user.fields.current_password'),
        ];
    }
}
