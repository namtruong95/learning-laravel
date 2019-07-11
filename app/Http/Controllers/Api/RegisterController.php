<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $input = $request->all();
        dd($request);
        // $user = new User();
        // $user->name = $input['name'];
        // $user->email = $input['email'];
        // $user->password = $input['password'];

        // $user->save();

        return response()->json([
            'email' => 1,
            'password' => 2
        ]);
    }
}
