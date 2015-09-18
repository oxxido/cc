<?php namespace App\Http\Requests;

class CommenterCreateRequest extends CommenterRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return self::baseRules();
    }

    public static function baseRules()
    {
        $user_rules = UserCreateRequest::baseRules();
        unset($user_rules['password']);
        return array_merge($user_rules, self::selfRules());
    }

    public static function selfRules()
    {
        return [
            'phone' => 'digits:10',
            'city'  => 'exists:cities'
        ];
    }
}
