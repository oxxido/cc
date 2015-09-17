<?php namespace App\Models;

use App\Traits\UserModel;

class Owner extends Model
{
    use UserModel;

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
    protected $appends = ['name', 'email'];

    protected $hidden = ['created_at', 'updated_at', 'user', 'admins', 'businesses'];

    public $incrementing = false;

    /**
     * Get the Admins records associated with the Owner.
     */
    public function admins()
    {
        return $this->hasMany(Admin::class);
    }

    /**
     * Get the Businesses records associated with the Owner.
     */
    public function businesses()
    {
        return $this->hasMany(Business::class);
    }
}
