<?php namespace App\Models;

use App\Models\Model;

class Owner extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'owners';

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
    protected $hidden = ['created_at', 'updated_at', 'user', 'admins', 'businesses'];

    /**
     * Get the User record associated with the Owner.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id', 'id');
    }

    /**
     * Get the Admins records associated with the Owner.
     */
    public function admins()
    {
        return $this->hasMany('App\Models\Admin', 'owner_id', 'id');
    }

    /**
     * Get the Businesses records associated with the Owner.
     */
    public function businesses()
    {
        return $this->hasMany('App\Models\Business', 'owner_id', 'id');
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
