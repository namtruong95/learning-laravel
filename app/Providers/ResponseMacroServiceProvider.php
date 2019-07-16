<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($value) {
            return Response::json($value);
        });

        Response::macro('created', function ($value) {
            return Response::json($value, 200);
        });

        Response::macro('error', function ($value) {
            return Response::json($value, 400);
        });

        Response::macro('unauthorized', function ($value) {
            return Response::json($value, 401);
        });

        Response::macro('validator', function ($value) {
            return Response::json($value, 422);
        });
    }
}
