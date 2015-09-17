<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use App\Services\ModelCollection;

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

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param array $models
     *
     * @return ModelCollection
     */
    public function newCollection(array $models = [])
    {
        return new ModelCollection($models);
    }
}
