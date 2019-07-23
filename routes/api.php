<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', 'Api\RegisterController@register');
    Route::post('login', 'Api\AuthController@login');
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::get('me', 'Api\AuthController@me');

    // api example call command send mail, can move this to controller
    Route::get('send-mail', function () {
        Artisan::call('email:send', [
            'userId' => 1,
            '--id' => [1, 2, 6],
            '--queue' => 'default'
        ]);
    });

    Route::group(['middleware' => ['can:admin, App\User']], function () {
        Route::get('users', 'Api\UserController@list');
    });

    Route::post('send-message', 'Api\SendMessageController@sendMessage');
});
