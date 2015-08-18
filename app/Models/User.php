<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Models\Admin;

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
	protected $hidden = ['password', 'remember_token', 'activation_code', 'active', 'resent', 'created_at', 'updated_at'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['name'];


	public function accountIsActive($code)
	{
		if($user = User::where('activation_code', '=', $code)->first())
        {
    		$user->active = 1;
    		$user->activation_code = '';
            $user->save();
    		return $user;
        }
        return false;
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

    /**
     * Mutator to get the owner.
     *
     * @param  string  $value
     * @return string
     */
    public function getOwnerAttribute()
    {
        return $this->isOwner() ? $this->owners()->first() : false;
    }

    public function isAdmin($id)
    {
        return Admin::where('owner_id', $id)->where('admin_id', $this->id)->get()->first() ? true : false;
    }    

    public function isOwner()
    {
        return $this->owners->first() ? true : false;
    }    
}
