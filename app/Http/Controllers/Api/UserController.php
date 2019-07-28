<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function list(Request $request)
    {
        $data = User::all();

        return response()->success([
            'data' => $data
        ]);
    }

    public function profile()
    {
        $user = auth()->user();

        if (! empty($user->avatar_url)) {
            $user->avatar_url = Storage::url($user->avatar_url);
        }

        return response()->success($user);
    }
}
