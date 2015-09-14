<?php namespace App\Models;

class Commenter extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'commenters';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'city_id', 'phone', 'note'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $hidden = ['city_id', 'created_at', 'updated_at'];

    public $incrementing = false;

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'id');
    }

    /**
     * Get the City record associated with the Commenter.
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id', 'id');
    }

    public function businessCommenter()
    {
        return $this->hasMany('App\Models\BusinessCommenter', 'commenter_id', 'id');
    }

    public function toArray()
    {
        $this->user;
        $this->city;

        return parent::toArray();
    }
}
