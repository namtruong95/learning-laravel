<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Concerns\Token;
use App\Events\UserRegistered;
use App\Jobs\SendMailVerifyEmail;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {

        $data = $request->validated();
        $guard = 'admin';
        $ttl = Token::getTTL($guard);

        $user1 = User::find(1);
        $user2 = User::find(2);

        SendMailVerifyEmail::dispatch($user1);

        event(new UserRegistered($user2));

        if (! $token = auth()->setTTL($ttl)->attempt($data)) {
            return response()->error(['message' => 'email or password is invalid']);
        }

        return $this->respondWithToken($token, $ttl);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->success(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->success(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $token = auth()->setTTL(60)->refresh();

        return $this->respondWithToken($token, 60);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     * @param int $ttl
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, int $ttl)
    {
        return response()->success([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $ttl,
        ]);
    }
}
