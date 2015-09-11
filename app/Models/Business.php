<?php namespace App\Models;

use App\Models\Model;

class Business extends Model
{
    const CONFIG_NOTIFICATIONS_FREQUENCY_HOURLY  = 1;
    const CONFIG_NOTIFICATIONS_FREQUENCY_DAILY   = 2;
    const CONFIG_NOTIFICATIONS_FREQUENCY_WEEKLY  = 3;
    const CONFIG_NOTIFICATIONS_FREQUENCY_MONTHLY = 4;

    protected $configs;

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
    protected $fillable = [
        'name',
        'description',
        'phone',
        'url',
        'address',
        'business_type_id',
        'organization_type_id',
        'city_id',
        'owner_id',
        'admin_id',
        'data'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['location'];

    protected $hidden = [
        'created_at',
        'updated_at',
        'business_type_id',
        'organization_type_id',
        'city_id',
        'owner_id',
        'admin_id',
        'data'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'object',
    ];

    public static function configNotificationsFrequencies($only_keys = false)
    {
        $frequencies = [
            self::CONFIG_NOTIFICATIONS_FREQUENCY_HOURLY  => trans('business.fields.notifications.frequency_hourly'),
            self::CONFIG_NOTIFICATIONS_FREQUENCY_DAILY   => trans('business.fields.notifications.frequency_daily'),
            self::CONFIG_NOTIFICATIONS_FREQUENCY_WEEKLY  => trans('business.fields.notifications.frequency_weekly'),
            self::CONFIG_NOTIFICATIONS_FREQUENCY_MONTHLY => trans('business.fields.notifications.frequency_monthly'),
        ];

        return $only_keys ? array_keys($frequencies) : $frequencies;
    }

    public static function configNotificationFrequencyText($frequency)
    {
        $frequencies = self::configNotificationsFrequency();

        return isset($frequencies[$frequency]) ? $frequencies[$frequency] : 'Invalid frequency';
    }

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

    public function links()
    {
        return $this->hasMany('App\Models\Link', 'business_id', 'id');
    }

    /**
     * Mutator to get the location full text.
     *
     * @return string
     */
    public function getLocationAttribute()
    {
        return "{$this->address}, {$this->city->location}";
    }

    /**
     * Mutator to get the location full text.
     *
     * @return string
     */
    public function getConfigAttribute()
    {
        if (!$this->configs) {
            $this->configs = $this->data ? $this->data : new \stdClass;
        }

        return $this->configs;
    }

    /**
     * Mutator to get the location full text.
     *
     * @return string
     */
    public function setConfigAttribute($value)
    {
        $this->configs = $value;
    }

    public function toArray()
    {
        $this->owner;
        $this->admin;
        $this->businessType;
        $this->organizationType;

        return parent::toArray();
    }

    public function save(array $options = [])
    {
        if ($this->configs) {
            $this->data = $this->configs;
        }
        parent::save($options);
    }

    /**
     * Get the SocialNetworks records associated with the Businesses.
     */
    public function socialNetworks()
    {
        return $this->belongsToMany('App\Models\SocialNetwork', 'links', 'business_id',
            'social_network_id')->withPivot('id', 'url', 'order', 'active')->withTimestamps();
    }

    /**
     * Mutator to get the location full text.
     *
     * @return string
     */
    public function getSocialNetworksAttribute()
    {
        return $this->socialNetworks()->get();
    }
}
