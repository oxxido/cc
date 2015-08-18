<?php namespace App\Models;

class City extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'zip_code'];
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['location'];

    /**
     * Get the State record associated with the City.
     */
    public function state()
    {
        return $this->belongsTo('App\Models\State', 'state_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\Users', 'billings', 'city_id', 'user_id');
    }

    /**
     * Get the Billings records associated with the City.
     */
    public function billings()
    {
        return $this->hasMany('App\Models\Billing', 'city_id', 'id');
    }

    /**
     * Get the Businesses records associated with the City.
     */
    public function businesses()
    {
        return $this->hasMany('App\Models\Business', 'city_id', 'id');
    }

    /**
     * Mutator to get the location full text.
     *
     * @param  string  $value
     * @return string
     */
    public function getLocationAttribute()
    {
        return "{$this->name} {$this->zip_code} {$this->state->name}, {$this->state->country->name}";
    }

}
