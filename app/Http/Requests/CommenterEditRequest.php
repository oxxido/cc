<?php namespace App\Http\Requests;

use Illuminate\Routing\Route;

class CommenterEditRequest extends CommenterCreateRequest
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
        $route->setParameter('user', $route->commenter->user);
        $user_rules = UserEditRequest::baseRules($route);

        return array_merge(parent::baseRules(), $user_rules , self::selfRules());
    }

    public static function selfRules()
    {
        return CommenterCreateRequest::selfRules();
    }
}
