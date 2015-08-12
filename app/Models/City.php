<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'zip_code'];
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * Get the State record associated with the City.
     */
    public function state()
    {
        return $this->belongsTo('App\Models\State', 'state_id', 'id');
    }

    /**
     * The Users records associated with the City.
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'billings', 'city_id', 'user_id');
    }

    /**
     * Get the Billings records associated with the City.
     */
    public function billings()
    {
        return $this->hasMany('App\Models\Billing', 'city_id', 'id');
    }

    /**
     * Get the Businesses records associated with the City.
     */
    public function businesses()
    {
        return $this->hasMany('App\Models\Business', 'city_id', 'id');
    }

    public static function collectionFromResultset($resultset)
    {
        $ids = [];
        foreach ($resultset as $row)
        {
            $ids[] = $row->id;
        }
        return self::whereIn('id', $ids)->get();
    }
}
