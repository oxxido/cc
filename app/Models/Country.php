<?php namespace App\Models;

class Country extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'countries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'code'];
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;

    /**
     * Get the Billings records associated with the Country.
     */
    public function billings()
    {
        return $this->hasMany('App\Models\Billing', 'country_id', 'id');
    }

    /**
     * Get the Businesses records associated with the Country.
     */
    public function businesses()
    {
        return $this->hasMany('App\Models\Business', 'country_id', 'id');
    }

    /**
     * Get the States records associated with the Country.
     */
    public function states()
    {
        return $this->hasMany('App\Models\State', 'country_id', 'id');
    }

}
