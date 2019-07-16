<?php
use Illuminate\Support\Facades\Route;

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

    Route::group(['middleware' => ['can:admin, App\User']], function () {
        Route::get('users', 'Api\UserController@list');
    });
});
