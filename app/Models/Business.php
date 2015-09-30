<?php namespace App\Models;

class Business extends Model
{
    const CONFIG_NOTIFICATIONS_FREQUENCY_HOURLY  = 1;
    const CONFIG_NOTIFICATIONS_FREQUENCY_DAILY   = 2;
    const CONFIG_NOTIFICATIONS_FREQUENCY_WEEKLY  = 3;
    const CONFIG_NOTIFICATIONS_FREQUENCY_MONTHLY = 4;

    protected $configs;

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
        return $this->belongsTo(City::class);
    }

    /**
     * Get the Admin record associated with the Business.
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * Get the BusinessType record associated with the Business.
     */
    public function businessType()
    {
        return $this->belongsTo(BusinessType::class);
    }

    /**
     * Get the Country record associated with the Business.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the OrganizationType record associated with the Business.
     */
    public function organizationType()
    {
        return $this->belongsTo(OrganizationType::class);
    }

    /**
     * Get the Owner record associated with the Business.
     */
    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    /**
     * Get the Products records associated with the Business.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function links()
    {
        return $this->hasMany(Link::class);
    }

    public function commenters()
    {
        return $this->belongsToMany(Commenter::class)->withPivot('adder_id', 'request_feedback_automatically');
    }

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->uuid;
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
        return $this->belongsToMany(SocialNetwork::class, 'links')->withPivot('id', 'url', 'order', 'active')->withTimestamps();
    }

    public function isOwner(User $user)
    {
        return $user->id == $this->owner_id;
    }

    public function isAdmin(User $user)
    {
        return $this->admin? $this->admin->admin_id == $user->id: false;
    }

    public function hasRights(User $user)
    {
        return $this->isOwner($user) || $this->isAdmin($user);
    }
}
