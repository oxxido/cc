<?php namespace App\Models;

use App\Models\Model;

class BusinessCommenter extends Model {

    protected $table = 'business_commenter';
    protected $fillable = ['business_id', 'commenter_id', 'added_by'];


    public function adder()
    {
        return $this->belongsTo('App\Models\User', 'adder_id', 'id');
    }

    public function businesse()
    {
        return $this->belongsTo('App\Models\Businesses', 'business_id', 'id');
    }

    public function commenter()
    {
        return $this->belongsTo('App\Models\Commenter', 'commenter_id', 'id');
    }

}
