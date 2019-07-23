<?php

namespace App\Concerns;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class SendRocketChat
{
    /**
     * @param string $msg
     */
    public static function sendRocketChat(string $msg)
    {
        $client = new Client([
            'base_uri' => config('rocket.base_uri'),
            'timeout'  => 2.0,
        ]);

        $headers = [
            'Content-Type' => 'application/json',
            'X-Auth-Token' => config('rocket.x_auth_token'),
            'X-User-Id' => config('rocket.x_user_id'),
        ];

        $body = [
            'message' => [
                'rid' => config('rocket.room_id'),
                'msg' => $msg,
            ],
        ];

        return $client->post('chat.sendMessage', [
            'headers' => $headers,
            RequestOptions::JSON => $body
        ]);
    }
}
