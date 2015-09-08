<?php

namespace App\Listeners;

use App\Services\EmailService;
use App\Events\AdminCreation;
use App\Events\OwnerCreation;
use App\Events\CommenterCreation;
use App\Events\UserCreation;

class UserEventListener
{
    /**
     * Handle admin creation event
     */
    public function adminCreation(AdminCreation $event)
    {
        $user = $event->admin->user;
        EmailService::instance()->adminCreation([
            'to' => $user->email,
            'data' => [
                'name' => $user->name
            ]
        ]);
    }

    /**
     * Handle owner creation event
     */
    public function ownerCreation(OwnerCreation $event)
    {
        $user = $event->owner->user;
        EmailService::instance()->ownerCreation([
            'to' => $user->email,
            'data' => [
                'name' => $user->name
            ]
        ]);
    }

    /**
     * Handle commenter creation event
     */
    public function commenterCreation(CommenterCreation $event)
    {
        $user = $event->commenter->user;
        EmailService::instance()->commenterCreation([
            'to' => $user->email,
            'data' => [
                'name' => $user->name
            ]
        ]);
    }

    /**
     * Handle commenter creation event
     */
    public function userCreation(UserCreation $event)
    {
        $user = $event->user;
        EmailService::instance()->userCreation([
            'to' => $user->email,
            'data' => [
                'name' => $user->name,
                'code' => $user->activation_code
            ]
        ]);
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
            'App\Events\AdminCreation',
            'App\Listeners\UserEventListener@adminCreation'
        );

        $events->listen(
            'App\Events\OwnerCreation',
            'App\Listeners\UserEventListener@ownerCreation'
        );

        $events->listen(
            'App\Events\CommenterCreation',
            'App\Listeners\UserEventListener@commenterCreation'
        );

        $events->listen(
            'App\Events\UserCreation',
            'App\Listeners\UserEventListener@userCreation'
        );
    }

}