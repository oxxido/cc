<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
	protected $fillable = ['name', 'description', 'address', 'phone', 'website'];


    /**
     * Get the BusinessType record associated with the Business.
     */
    public function businessType()
    {
        return $this->belongsTo('App\Models\BusinessType', 'business_type_id', 'id');
    }

    /**
     * Get the City record associated with the Business.
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id', 'id');
    }

    /**
     * Get the OrganizationType record associated with the Business.
     */
    public function organizationType()
    {
        return $this->belongsTo('App\Models\OrganizationType', 'organization_id', 'id');
    }

    /**
     * Get the User record associated with the Business.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * Get the Products records associated with the Business.
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'businesses_id', 'id');
    }

}
