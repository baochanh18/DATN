<?php

use Illuminate\Http\Request;
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

Route::group([
    'namespace' => 'App\Http\Controllers\Api',
    ], function (){

    Route::group(['prefix'=>'auth'], function (){
       Route::post('register', 'AuthController@register');
       Route::post('login', 'AuthController@login');
    });

    Route::group(['middleware' => 'jwt.auth'], function (){
        Route::get('users/me', 'UserController@me');
        Route::apiResource('users', 'UserController');
    });
});
