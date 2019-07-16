<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send {userId} {--id=*} {--queue=}';

    /**
     * The console send email to user.
     *
     * @var string
     */
    protected $description = 'send email to user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // handle send mail
        $userId = $this->argument('userId');
        $user = User::find($userId);

        $options = $this->options();
        $ids = $options['id'];

        $users = User::find($ids);

        // send mail using optional argument
        if ($users->isNotEmpty()) {
            echo 'users count = ' . $users->count() . "\n";
        }

        // send mail using argument
        if (isset($user)) {
            echo 'email sent to: ' . $user->email . "\n";
        }
    }
}
