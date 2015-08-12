<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
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
	protected $hidden = ['password', 'remember_token'];
	
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
     * Get the Billings records associated with the User.
     */
    public function billings()
    {
        return $this->hasMany('App\Models\Billing', 'user_id', 'id');
    }

    /**
     * Get the Businesses records associated with the User.
     */
    public function businesses()
    {
        return $this->hasMany('App\Models\Business', 'user_id', 'id');
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
}
