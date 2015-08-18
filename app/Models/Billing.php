<?php namespace App\Models;

class Billing extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'billings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['address', 'phone', 'price'];


    /**
     * Get the City record associated with the Billing.
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id', 'id');
    }

    /**
     * Get the User record associated with the Billing.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

}
