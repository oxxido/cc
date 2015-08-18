<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessCommenter extends Model {

    protected $table = 'business_commenter';
    protected $fillable = ['added_by'];


    public function users()
    {
        return $this->belongsTo('App\Models\User', 'added_by', 'id');
    }

    public function businesses()
    {
        return $this->belongsTo('App\Models\Businesses', 'business_id', 'id');
    }

    public function commenters()
    {
        return $this->belongsTo('App\Models\Commenter', 'commenter_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'comments', 'commenter_id', 'product_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'commenter_id', 'id');
    }


}
