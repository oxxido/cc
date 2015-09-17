<?php namespace App\Models;

use App\Traits\UserModel;

class Admin extends Model
{
    use UserModel;

    public function user()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['admin_id', 'owner_id', 'request_feedback_automatically'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['name', 'email'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $hidden = ['admin_id', 'owner_id'];

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
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    /**
     * Get the User record associated with the Admin.
     */
    public function admin()
    {
        return $this->belongsTo(User::class, $this->user_fk);
    }

    /**
     * Get the Businesses records associated with the Admin.
     */
    public function businesses()
    {
        return $this->hasMany(Business::class, 'admin_id');
    }

    public function toArray()
    {
        $this->user;

        return parent::toArray();
    }
}
