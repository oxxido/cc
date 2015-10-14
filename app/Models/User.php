<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'activation_code','active'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'activation_code', 'active', 'resent', 'created_at', 'updated_at', 'admins', 'owner', 'commenter'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['name'];

    public function owner()
    {
        return $this->hasOne('App\Models\Owner', 'id', 'id');
    }

    public function commenter()
    {
        return $this->hasOne('App\Models\Commenter', 'id', 'id');
    }

    /**
     * Get the Admins records associated with the User record.
     */
    public function admins()
    {
        return $this->hasMany('App\Models\Admin', 'admin_id', 'id');
    }

    /**
     * Get the Billings records associated with the User record.
     */
    public function billings()
    {
        return $this->hasMany('App\Models\Billing', 'user_id', 'id');
    }

    /**
     * Get the Owner record associated with the User record.
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'id');
    }

    /**
     * Mutator to get the user's full name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function isAdmin($owner_id = false)
    {
        if($owner_id)
            return $this->admin($owner_id) ? true : false;
        else
            return $this->admins->first() ? true : false;
    }

    public function isOwner()
    {
        return $this->owner ? true : false;
    }

    public function isCommenter()
    {
        return $this->commenter ? true : false;
    }

    public function admin($owner_id = false)
    {
        if($owner_id)
            return Admin::where('owner_id', $owner_id)->where('admin_id', $this->id)->get()->first();
        else
            return $this->admins;
    }
}
