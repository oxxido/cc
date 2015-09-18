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

    public function businesses()
    {
        return $this->belongsToMany(Business::class)->withPivot('adder_id', 'request_feedback_automatically')->withTimestamps();
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
        $self = \DB::transaction(function() use($attributes) {
            $user = User::create($attributes);

            $self = new self($attributes);

            $self->id = $user->id;
            $self->save();
            $self->user()->associate($user);

            return $self;
        });

        return $self;
    }
}
