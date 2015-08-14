<?php namespace App\Models;

class BusinessType extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'business_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;


    /**
     * Get the Businesses records associated with the BusinessType.
     */
    public function businesses()
    {
        return $this->hasMany('App\Models\Business', 'business_type_id', 'id');
    }

}
