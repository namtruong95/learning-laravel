<?php

namespace App\Concerns;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

trait SendRocketChat
{
    /**
     * @param string $url
     * @param string $msg
     */
    public function requestWithCurl(string $url, string $msg)
    {
        $data = [
            'message' => [
                'rid' => env('ROCKET_RID'),
                'msg' => $msg,
            ],
        ];

        $data_string = json_encode($data);

        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt(
            $handle,
            CURLOPT_HTTPHEADER,
            [
                'Content-Type: application/json',
                'X-Auth-Token: ' . env('ROCKET_X_AUTH_TOKEN'),
                'X-User-Id: ' . env('ROCKET_X_USER_ID'),
            ]
        );

        $res =  curl_exec($handle);

        curl_close($handle);

        return $res;
    }

    /**
     * @param string $msg
     */
    public function sendRocketChat(string $msg)
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => env('ROCKET_BASE_URI'),
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);

        $headers = [
            'Content-Type' => 'application/json',
            'X-Auth-Token' => env('ROCKET_X_AUTH_TOKEN'),
            'X-User-Id' => env('ROCKET_X_USER_ID'),
        ];

        $body = [
            'message' => [
                'rid' => env('ROCKET_RID'),
                'msg' => $msg,
            ],
        ];

        $response = $client->post('chat.sendMessage', [
            'headers' => $headers,
            RequestOptions::JSON => $body
        ]);

        \Log::debug($response->getBody()->getContents());
    }
}
