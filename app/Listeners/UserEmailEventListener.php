<?php

namespace App\Listeners;

use App\Services\EmailService;
use App\Events\UserEmailEvent;

class UserEmailEventListener
{
    /**
     * Handle user email event
     */
    public function userEmail(UserEmailEvent $event)
    {
        switch ($event->role) {
            case 'user':
                EmailService::instance()->userCreation($event->user, $event->options);
                break;
            
            case 'owner':
                EmailService::instance()->ownerCreation($event->user, $event->options);
                break;

            case 'admin':
                EmailService::instance()->adminCreation($event->user, $event->options);
                break;

            case 'commenter':
                EmailService::instance()->commenterCreation($event->user, $event->options);
                break;
        }
    }
    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\UserEmailEvent',
            'App\Listeners\UserEmailEventListener@userEmail'
        );

    }

}