<?php namespace App\Models;

class BusinessCommenter extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'business_commenter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['business_id', 'commenter_id', 'added_by'];

    public $timestamps = true;


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
