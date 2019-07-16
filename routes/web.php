<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['can:admin, App\User']], function () {
        Route::get('/page-1', 'Page1Controller@index')->name('page1');
    });

    Route::group(['middleware' => ['can:user, App\User']], function () {
        Route::get('/page-2', 'Page2Controller@index')->name('page2');
    });

    Route::group(['middleware' => ['auth.admin']], function () {
        Route::get('/page-3', 'Page3Controller@index')->name('page3');
    });

    Route::group(['middleware' => ['auth.user']], function () {
        Route::get('/page-4', 'Page4Controller@index')->name('page4');
    });
});
