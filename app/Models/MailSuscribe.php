<?php namespace App\Models;

class MailSuscribe extends Model
{
    const FEEDBACK_MAIL     = 1;
    const THANK_YOU_MAIL    = 2;
    const CALIFICATION_MAIL = 3;
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
    protected $fillable = ['mail_type', 'suscribe'];

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
