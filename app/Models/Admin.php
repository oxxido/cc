<?php namespace App\Models;

class Admin extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['name','email'];
    protected $hidden = ['user_id','owner_id','user'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the Owner record associated with the Admin.
     */
    public function owner()
    {
        return $this->belongsTo('App\Models\Owner', 'owner_id', 'id');
    }

    /**
     * Get the User record associated with the Admin.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * Get the Businesses records associated with the Admin.
     */
    public function businesses()
    {
        return $this->hasMany('App\Models\Business', 'admin_id', 'id');
    }

     /**
     * Mutator to get the user's full name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->user->name;
    }

     /**
     * Mutator to get the user's email.
     *
     * @param  string  $value
     * @return string
     */
    public function getEmailAttribute()
    {
        return $this->user->email;
    }
}
