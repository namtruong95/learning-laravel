<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Concerns\Token;

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

        if (! $token = auth()->setTTL($ttl)->attempt($data)) {
            return response()->json(['error' => 'Unauthorized'], 400);
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
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
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
        return response()->toJSON([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $ttl,
        ]);
    }
}
