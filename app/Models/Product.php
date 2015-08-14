<?php namespace App\Models;

class Product extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product', 'url'];

    /**
     * Get the Business record associated with the Product.
     */
    public function business()
    {
        return $this->belongsTo('App\Models\Business', 'business_id', 'id');
    }

    /**
     * The Customers records associated with the Product.
     */
    public function customers()
    {
        return $this->belongsToMany('App\Models\Customer', 'comments', 'product_id', 'customer_id');
    }

    /**
     * Get the Comments records associated with the Product.
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'product_id', 'id');
    }

}
