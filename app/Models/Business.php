<?php namespace App\Models;

use App\Models\Model;

class Business extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'businesses';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'description', 'phone', 'url', 'address','business_type_id' ,'organization_type_id', 'city_id', 'owner_id', 'admin_id'];


    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['location'];

    protected $hidden = ['created_at','updated_at'];

    /**
     * Get the City record associated with the Business.
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id', 'id');
    }

    /**
     * Get the Admin record associated with the Business.
     */
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }

    /**
     * Get the BusinessType record associated with the Business.
     */
    public function businessType()
    {
        return $this->belongsTo('App\Models\BusinessType', 'business_type_id', 'id');
    }

    /**
     * Get the Country record associated with the Business.
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }

    /**
     * Get the OrganizationType record associated with the Business.
     */
    public function organizationType()
    {
        return $this->belongsTo('App\Models\OrganizationType', 'organization_type_id', 'id');
    }

    /**
     * Get the Owner record associated with the Business.
     */
    public function owner()
    {
        return $this->belongsTo('App\Models\Owner', 'owner_id', 'id');
    }

    /**
     * Get the Products records associated with the Business.
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'business_id', 'id');
    }

    /**
     * Mutator to get the location full text.
     *
     * @param  string  $value
     * @return string
     */
    public function getLocationAttribute()
    {
        return "{$this->address}, {$this->city->location}";
    }

    public function toArray()
    {
        $this->owner;
        $this->admin;
        $this->businessType;
        $this->organizationType;
        return parent::toArray();
    }
}
