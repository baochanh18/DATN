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

    Route::post('searchjob', [\App\Http\Controllers\Api\JobController::class, 'search']);
    Route::get('cities', [\App\Http\Controllers\Api\DataController::class, 'city']);
    Route::get('categories', [\App\Http\Controllers\Api\DataController::class, 'category']);
    Route::get('jobs/{job}',[\App\Http\Controllers\Api\JobController::class, 'show']);
    Route::get('otherjob/{job}', [\App\Http\Controllers\Api\JobController::class, 'other_job']);


    Route::group(['middleware' => 'jwt.auth'], function (){
        Route::get('users/me', 'UserController@me');
        Route::post('users/userinfo', 'UserController@userinfo');
        Route::post('users/editstatus/{user}', 'UserController@editstatus');
        Route::post('users/companyinfo', 'UserController@companyinfo');
        Route::apiResource('users', 'UserController');

        Route::post('applycv/{job}', [\App\Http\Controllers\Api\ApplyCvController::class, 'store']);
        Route::post('savejob/{job}',[\App\Http\Controllers\Api\JobController::class, 'save_job']);
        Route::post('unsavejob/{job}',[\App\Http\Controllers\Api\JobController::class, 'unsave_job']);
        Route::get('getsavedjob',[\App\Http\Controllers\Api\JobController::class, 'getsaved_job']);
        Route::get('getappliedjob',[\App\Http\Controllers\Api\ApplyCvController::class, 'get_applied_job']);
    });
});
