<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    protected $fillable = ['comment', 'rating', 'score', 'status', 'show_on_website'];


    public function businessCommenter()
    {
        return $this->belongsTo('App\businessCommenter', 'commenter_id', 'id');
    }

    /**
     * Get the Product record associated with the Comment.
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

}
