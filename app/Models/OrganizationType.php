<?php namespace App\Models;

class OrganizationType extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'organization_types';

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
     * Get the Businesses records associated with the OrganizationType.
     */
    public function businesses()
    {
        return $this->hasMany('App\Models\Business', 'organization_id', 'id');
    }

}
