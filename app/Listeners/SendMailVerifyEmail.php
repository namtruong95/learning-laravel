<?php

namespace App\Listeners;

use App\Events\UserRegistered;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailVerifyEmail implements ShouldQueue
{
    use InteractsWithQueue;

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
    public $queue = 'default';

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        if (true) {
            $this->delete();
        }
    }

    public function shouldQueue(UserRegistered $event)
    {
        return true;
    }

    public function failed(UserRegistered $event, $exception)
    {
        echo 'failed: ' . $event->user->email;
        // handle fail job
    }
}
