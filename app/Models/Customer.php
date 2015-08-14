<?php namespace App\Models;

class Customer extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'note'];

    /**
     * The Products records associated with the Customer.
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'comments', 'customer_id', 'product_id');
    }

    /**
     * Get the Comments records associated with the Customer.
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'customer_id', 'id');
    }

}
