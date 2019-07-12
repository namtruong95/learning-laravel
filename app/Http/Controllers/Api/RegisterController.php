<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $input = $request->all();
        $user = new User();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        $user->role = 2;

        $user->save();

        return response()->json($user);
    }
}
