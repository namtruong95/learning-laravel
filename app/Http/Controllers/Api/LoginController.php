<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $input = $request->all();
        dd($input);
        // $user = new User();
        // $user->name = $input['name'];
        // $user->email = $input['email'];
        // $user->password = $input['password'];

        // $user->save();

        return response()->json([
            'email' => $input['email'],
            'password' => $input['password']
        ]);
    }
}
