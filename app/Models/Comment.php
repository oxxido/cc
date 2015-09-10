<?php namespace App\Models;

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
    protected $appends = ['commenter', 'created'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['business_commenter_id', 'product_id', 'comment', 'ip', 'rating', 'score', 'status', 'show_on_website'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'show_on_website', 'product_id', 'business_commenter_id'];

    /**
     * Get the Business Commenter record associated with the Comment.
     */
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

    public function getCreatedAttribute()
    {
        return date("M j, Y", strtotime($this->attributes['created_at']));
    }

    public function getRatingAttribute()
    {
        return $this->attributes['rating'] / 2;
    }

    public function setRatingAttribute($value)
    {
        $this->attributes['rating'] = floatval($value) * 2;
    }

    public function getCommenterAttribute()
    {
        $user = User::join('commenters','users.id', '=', 'commenters.id')
            ->join('business_commenter','commenters.id', '=', 'business_commenter.commenter_id')
            ->join('comments','business_commenter.id', '=', 'comments.business_commenter_id')
            ->where('comments.id', '=', $this->id)
            ->select('users.id')
            ->get()
            ->first();
        return Commenter::find($user->id);
    }

    public function toArray()
    {
        return parent::toArray();
    }

}
