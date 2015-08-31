<?php namespace App\Models;

use App\Models\Model;

class Commenter extends Model {

    protected $table = 'commenters';
    protected $fillable = ['id', 'phone', 'note'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'id');
    }

    public function businessCommenter()
    {
        return $this->hasMany('App\Models\BusinessCommenter', 'commenter_id', 'id');
    }

    public function toArray()
    {
        $this->user;
        return parent::toArray();
    }

}
