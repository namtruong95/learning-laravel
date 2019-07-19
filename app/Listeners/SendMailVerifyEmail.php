<?php

namespace App\Listeners;

use App\Events\UserRegistered;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Exception;

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
    public $queue = 'low';

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
        echo 'events listener: user registered: send email: ' . $event->user->email . "\n";
        throw new Exception('asasas');
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
