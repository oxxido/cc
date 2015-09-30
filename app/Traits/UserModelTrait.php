<?php namespace App\Traits;

use App\Models\User;

trait UserModelTrait
{
    public static function stub()
    {
        $self = new self();
        $self->relations['user'] = new User();

        return $self;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function getUuidAttribute()
    {
        return $this->user->uuid;
    }

    public function getEmailAttribute()
    {
        return $this->user->email;
    }

    public function getFirstNameAttribute()
    {
        return $this->user->first_name;
    }

    public function getLastNameAttribute()
    {
        return $this->user->last_name;
    }

    public function getPasswordAttribute()
    {
        return $this->user->password;
    }

    public function getActivationCodeAttribute()
    {
        return $this->user->activation_code;
    }

    public function getActiveAttribute()
    {
        return $this->user->active;
    }

    public function getResentAttribute()
    {
        return $this->user->resent;
    }

    public function getRememberTokenAttribute()
    {
        return $this->user->remember_token;
    }

    public function getCreatedAtAttribute()
    {
        return $this->user->created_at;
    }

    public function getUpdatedAtAttribute()
    {
        return $this->user->updated_at;
    }

    public function getNameAttribute()
    {
        return $this->user->name;
    }

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->uuid;
    }
}
