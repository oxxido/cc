<?php namespace App\Models;

use App\Models\Model;

class Link extends Model {

    protected $table = 'links';
    protected $fillable = ['url', 'order', 'active'];


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

}
