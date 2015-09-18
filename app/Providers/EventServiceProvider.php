<?php namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use App\Listeners\Comment\SendEmails;
use App\Models\OrganizationType;
use App\Events\Comment\Created;
use App\Models\SocialNetwork;
use App\Models\BusinessType;
use App\Models\Business;
use App\Models\Comment;
use App\Models\Country;
use App\Models\Product;
use App\Models\Model;
use App\Models\State;
use App\Models\City;
use App\Models\User;
use Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Created::class => [
            SendEmails::class
        ]
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        'App\Listeners\UserEmailEventListener',
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     *
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        Comment::created(function (Comment $comment) {
            Event::fire(Created::class, [$comment]);
        });

        User::creating(function ($model) {
            $this->assignUuid($model);
        });

        Product::creating(function ($model) {
            $this->assignUuid($model);
        });

        Business::creating(function ($model) {
            $this->assignUuid($model);
        });

        BusinessType::creating(function ($model) {
            $this->assignUuid($model);
        });

        OrganizationType::creating(function ($model) {
            $this->assignUuid($model);
        });

        SocialNetwork::creating(function ($model) {
            $this->assignUuid($model);
        });

        Country::creating(function ($model) {
            $this->assignUuid($model);
        });

        State::creating(function ($model) {
            $this->assignUuid($model);
        });

        City::creating(function ($model) {
            $this->assignUuid($model);
        });
    }

    protected function assignUuid(Model $model)
    {
        $uuid = \Uuid::generate();
        if ($model->uuid || $uuid) {
            $model->uuid = $model->uuid ?: $uuid;
        } else {
            return false;
        }
    }
}
