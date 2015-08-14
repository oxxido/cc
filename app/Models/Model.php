<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;

abstract class Model extends BaseModel {

    public static function collectionFromArray($array = array())
    {
        $ids = [];
        foreach ($array as $row)
        {
            $ids[] = $row->id;
        }
        return self::whereIn('id', $ids)->get();
    }
}