<?php namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

class ModelCollection extends Collection
{
    public function ids()
    {
        $ids = [];

        foreach ($this->all() as $key => $model) {
            if (null !== $model->id) {
                $ids[$model->id] = $model->id;
            }
        }

        return $ids;
    }
}
