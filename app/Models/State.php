<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'states';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the Country record associated with the State.
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }

    /**
     * Get the Cities records associated with the State.
     */
    public function cities()
    {
        return $this->hasMany('App\Models\City', 'state_id', 'id');
    }


}
