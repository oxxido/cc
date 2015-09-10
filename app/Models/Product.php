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
    protected $fillable = ['business_id', 'product', 'url'];

    protected $hidden = ['created_at','updated_at'];

    /**
     * Get the Business record associated with the Product.
     */
    public function business()
    {
        return $this->belongsTo('App\Models\Business', 'business_id', 'id');
    }

    public function businessCommenter()
    {
        return $this->belongsToMany('App\Models\BusinessCommenter', 'comments', 'product_id', 'commenter_id');
    }

    /**
     * Get the Comments records associated with the Product.
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'product_id', 'id');
    }

    /**
    * Mutator to get the user's full name.
    *
    * @param  string  $value
    * @return string
    */
    public function getHashAttribute()
    {
        return base64_encode("product_id=$this->id");
    }

    public function toArray()
    {
        $this->comments;
        $this->business;
        return parent::toArray();
    }
}
