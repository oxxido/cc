<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Commenters extends Model {

    protected $table = 'commenters';
    protected $fillable = ['phone', 'note'];


    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'id');
    }

    public function businessCommenter()
    {
        return $this->hasMany('App\Models\BusinessCommenter', 'commenter_id', 'id');
    }


}
