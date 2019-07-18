<?php

namespace App\Listeners;

use App\Events\UserRegistered;

// use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Artisan;

class SendMailVerifyEmail implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {

        Artisan::call('email:send', [
            'userId' => $event->user->id,
            '--queue' => 'default'
        ]);
    }

    public function failed(UserRegistered $event, $exception)
    {
        // handle fail job
    }
}
