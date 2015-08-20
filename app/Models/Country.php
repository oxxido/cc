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
     * Get the States records associated with the Country.
     */
    public function states()
    {
        return $this->hasMany('App\Models\State', 'country_id', 'id');
    }

    public static function all($columns = array())
    {
        return parent::all()->sortBy('name');
    }

}
