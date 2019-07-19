<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSMSVerifyPhone implements ShouldQueue
{
    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    public $connection = 'redis';

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'high';

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 2;

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        echo 'events listener: user registered: send SMS: ' . $event->user->name . "\n";
    }

    public function shouldQueue(UserRegistered $event)
    {
        return $event->user->isAdmin();
    }

    public function failed(UserRegistered $event, $exception)
    {
        echo 'failed: ' . $event->user->email . "\n";
        // $this->delete();
        // handle fail event
    }
}
