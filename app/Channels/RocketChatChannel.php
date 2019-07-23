<?php

namespace App\Channels;

use App\Notifications\RocketChatNotification;
use App\Concerns\SendRocketChat;

class RocketChatChannel
{
    use SendRocketChat;

    /**
     * Send the given notification.
     *
     * @param  mixed $notifiable
     * @param  \App\Notifications\RocketChatNotification $notification
     * @return void
     */
    public function send($notifiable, RocketChatNotification $notification)
    {
        $message = $notification->toRocketChat($notifiable);
        $this->sendRocketChat($message);
    }
}
