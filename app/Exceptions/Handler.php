<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {

        $statusCode  = 400;
        $errors      = [];
        $message     = 'has error';

        switch (true) {
            case $e instanceof ValidationException:
                $message = 'errors validation';
                $statusCode = 422;
                $errors = $e->errors();
                break;

            case $e instanceof AuthenticationException:
                $message = 'Unauthenticated';
                $statusCode = 401;
                break;

            case $e instanceof NotFoundHttpException:
                $message = 'Route Not Found';
                $statusCode = $e->getStatusCode();
                break;

            case $e instanceof AuthorizationException:
                $message = 'Unauthorization';
                $statusCode = 403;
                break;

            case $e instanceof MaintenanceModeException:
                $message = 'server has been maintain!';
                $statusCode = 503;
                break;

            default:
                break;
        }

        return $request->accepts(['application/json', '*/*'])
            ? response()->json([
                'message' => $message,
                'errors'  => $errors,
                ], $statusCode)
            : response($message, 400);
    }
}
