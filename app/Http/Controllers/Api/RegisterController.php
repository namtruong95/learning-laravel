<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Events\UserRegistered;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = new User();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role = User::ROLE_USER;

        $user->save();
        event(new UserRegistered($user));
        return response()->created($user);
    }
}
