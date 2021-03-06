<?php namespace App\Models;

use App\Models\Model;

class Link extends Model {

    protected $table = 'links';
    protected $fillable = ['url', 'order', 'active'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['profile'];

    public function business()
    {
        return $this->belongsTo('App\Models\Business', 'business_id', 'id');
    }

    public function socialNetwork()
    {
        return $this->belongsTo('App\Models\SocialNetwork', 'social_network_id', 'id');
    }

    public function getProfileAttribute()
    {
        return "http://" . str_replace("%", $this->url, $this->socialNetwork->url);
    }

    public function toArray()
    {
        $this->socialNetwork;
        return parent::toArray();
    }
}
