<?php namespace App\Models;

use App\Models\Model;

class Commenter extends Model {

    protected $table = 'commenters';
    protected $fillable = ['id', 'phone', 'note'];


    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'id');
    }

    public function businessCommenter()
    {
        return $this->hasMany('App\Models\BusinessCommenter', 'commenter_id', 'id');
    }


}
