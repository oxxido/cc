<?php namespace App\Models;

use App\Models\Model;

class Comment extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['business_commenter_id', 'product_id', 'comment', 'rating', 'score', 'status', 'show_on_website'];


    public function businessCommenter()
    {
        return $this->belongsTo('App\Models\BusinessCommenter', 'business_commenter_id', 'id');
    }

    /**
     * Get the Product record associated with the Comment.
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

}
