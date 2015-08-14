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
	protected $fillable = ['fist_name', 'last_name', 'email', 'password'];

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
		$user = User::where('activation_code', '=', $code)->first();
		$user->active = 1;
		$user->activation_code = '';
		if($user->save())
		{
			\Auth::login($user);
		}
		return true;
	}

    /**
     * Get the Admins records associated with the User.
     */
    public function admins()
    {
        return $this->hasMany('App\Models\Admin', 'user_id', 'id');
    }

    /**
     * Get the Billings records associated with the User.
     */
    public function billings()
    {
        return $this->hasMany('App\Models\Billing', 'user_id', 'id');
    }

    /**
     * Get the Owners records associated with the User.
     */
    public function owners()
    {
        return $this->hasMany('App\Models\Owner', 'user_id', 'id');
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
     * Mutator to get the user's full name.
     *
     * @param  string  $value
     * @return string
     */
    public function getOwnerAttribute()
    {
        return $this->owners()->first();
    }
}
