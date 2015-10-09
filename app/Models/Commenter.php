<?php namespace App\Models;

use App\Traits\UserModelTrait;

class Commenter extends Model
{
    use UserModelTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'city_id', 'phone', 'note'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $hidden = ['city_id', 'created_at', 'updated_at'];

    public $incrementing = false;

    /**
     * Get the City record associated with the Commenter.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function businessCommenters()
    {
        return $this->hasMany(BusinessCommenter::class);
    }

    public function businessCommenter($business_id)
    {
        return $this->businessCommenters()->whereBusinessId($business_id)->first();
    }

    public function businesses()
    {
        return $this->belongsToMany(Business::class)->withPivot('id', 'adder_id', 'request_feedback_automatically', 'feedback_requests_sent')->withTimestamps();
    }

    public function toArray()
    {
        $this->user;
        $this->city;

        return parent::toArray();
    }

    public static function make($attributes = [])
    {
        $self = null;

        if (isset($attributes['email'])) {
            $self = \DB::transaction(function() use($attributes) {
                if (!($user = User::whereEmail($attributes['email'])->first())) {
                    $user = User::create($attributes);
                }

                $attributes['id'] = $user->id;
                $self = $user->commenter?: self::create($attributes);
                $self->user()->associate($user);

                return $self;
            });
        }

        return $self;
    }

    public function mailSuscribe()
    {
        return $this->hasMany(MailSuscribe::class);
    }

    public function suscriptionUrl()
    {
        return \URL::to("commenter/suscription/$this->uuid");
    }
}
