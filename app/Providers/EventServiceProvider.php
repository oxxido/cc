<?php namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use App\Events\Comment\Created as EventCommentCreated;
use App\Listeners\Comment\SendEmails as ListenersCommentSendEmails;
use App\Models\Comment;
use Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        EventCommentCreated::class => [
            ListenersCommentSendEmails::class
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
            Event::fire(EventCommentCreated::class, [$comment]);
        });
    }
}
