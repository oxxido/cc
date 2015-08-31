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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['commenter'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['business_commenter_id', 'product_id', 'comment', 'rating', 'score', 'status', 'show_on_website'];

    protected $hidden = ['created_at', 'updated_at', 'show_on_website', 'product_id', 'business_commenter_id'];

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

    public function getCommenterAttribute()
    {
        return User::join('commenters','users.id', '=', 'commenters.id')
            ->join('business_commenter','commenters.id', '=', 'business_commenter.commenter_id')
            ->join('comments','business_commenter.id', '=', 'comments.business_commenter_id')
            ->where('comments.id', '=', $this->id)
            ->select('users.*', 'commenters.phone', 'commenters.note')
            ->get()
            ->first();
    }

    public function toArray()
    {
        //$this->commenter;
        return parent::toArray();
    }

}
