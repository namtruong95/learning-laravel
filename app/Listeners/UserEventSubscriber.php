<?php

namespace App\Listeners;

use App\Events\UserLogin;
use App\Events\UserRegistered;
use Illuminate\Events\Dispatcher;

class UserEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function onUserLogin(UserLogin $event)
    {
        echo 'user logged in: ' . $event->user->email;
    }

    /**
     * Handle user logout events.
     */

    public function onUserRegister(UserRegistered $event)
    {
        echo 'user registered: ' . $event->user->email;
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(
            UserLogin::class,
            'App\Listeners\UserEventSubscriber@onUserLogin'
        );

        // $events->listen(
        //     UserRegistered::class,
        //     'App\Listeners\UserEventSubscriber@onUserRegister'
        // );
    }
}
