<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\User;

class SendMailVerifyEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 2;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 10;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        echo 'job: user registered: ' . $this->user->email . "\n";
    }

    public function failed(\Exception $exception)
    {
        // handle fail job
        echo 'job failed: ' . $this->user->email . "\n";
        echo $exception;

        $this->delete();
    }
}
