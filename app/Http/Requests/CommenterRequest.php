<?php namespace App\Http\Requests;

class CommenterRequest extends UserRequest
{
    public function attributes()
    {
        return self::baseAttributes();
    }

    public static function baseAttributes()
    {
        $attributes = [
            'phone' => trans('commenter.fields.phone'),
            'note'  => trans('commenter.fields.note'),
            'city'  => trans('commenter.fields.city'),
        ];

        return array_merge(parent::baseAttributes(), $attributes);
    }
}
