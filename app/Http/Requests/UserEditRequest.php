<?php namespace App\Http\Requests;

use Illuminate\Routing\Route;

class UserEditRequest extends UserRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return self::baseRules($this->route);
    }

    public static function baseRules(Route $route)
    {
        $create_rules = UserCreateRequest::baseRules();

        $rules = [
            'email'      => 'required|email|max:255|unique:users,email,' . $route->user->uuid . ',uuid',
            'password'   => 'min:6|confirmed',
        ];

        return array_merge($create_rules, $rules);
    }
}
