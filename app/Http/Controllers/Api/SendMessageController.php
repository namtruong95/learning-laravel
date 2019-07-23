<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendMessageRequest;
use App\Notifications\RocketChatNotification;

class SendMessageController extends Controller
{
    public function sendMessage(SendMessageRequest $request)
    {
        $data = $request->validated();

        $user = auth()->user();

        $user->notify(new RocketChatNotification($data['message']));

        return response()->success(['success' => true]);
    }
}
