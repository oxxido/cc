<?php namespace App\Models;

class SocialNetwork extends Model
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'social_networks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'logo', 'url'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;

	/**
     * Get the Businesses records associated with the SocialNetworks.
     */
    public function businesses()
    {
        return $this->belongsToMany('App\Models\Business', 'links', 'social_network_id', 'business_id')
                        ->withPivot('id', 'url', 'order', 'active')
                        ->withTimestamps();
    }

    public function links()
    {
        return $this->hasMany('App\Models\Link', 'social_network_id', 'id');
    }

    public static function all($columns = array())
    {
        return parent::all()->sortBy('name');
    }

}
