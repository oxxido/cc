<?php namespace App\Models;

class MailSuscribe extends Model
{
    const MAIL_TYPE_QT      = 2;
    const FEEDBACK_MAIL     = 1;
    const THANK_YOU_MAIL    = 2; //for positive and negative feedback
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mail_suscribe';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['business_id', 'commenter_id', 'mail_type'];

    public $timestamps = true;

    public function business()
    {
        return $this->belongsTo('App\Models\Business', 'business_id', 'id');
    }

    public function commenter()
    {
        return $this->belongsTo('App\Models\Commenter', 'commenter_id', 'id');
    }

}
