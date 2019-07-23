<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Channels\RocketChatChannel;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class RocketChatNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [RocketChatChannel::class];
    }

    public function toRocketChat($notifiable)
    {
        return "user `{$notifiable->name}` send: \n" . $this->message;
    }
}
