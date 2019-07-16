<?php

namespace App\Concerns;

class Token
{
    public static function getTTL(string $guard)
    {
        return config("jwt.${guard}.ttl", config('jwt.ttl'));
    }
}
