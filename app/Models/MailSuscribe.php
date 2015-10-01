<?php namespace App\Models;

class MailSuscribe extends Model
{
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

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $hidden = ['commenter_id', 'created_at', 'updated_at'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['profile'];

    public function business()
    {
        return $this->belongsTo('App\Models\Business', 'business_id', 'id');
    }

    public function commenter()
    {
        return $this->belongsTo('App\Models\Commenter', 'commenter_id', 'id');
    }

}
