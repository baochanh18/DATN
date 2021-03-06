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
       Route::post('company/register', [\App\Http\Controllers\Api\AuthController::class, 'company_register']);
       Route::post('login', 'AuthController@login');
    });

    Route::post('searchjob', [\App\Http\Controllers\Api\JobController::class, 'search']);
    Route::get('cities', [\App\Http\Controllers\Api\DataController::class, 'city']);
    Route::get('categories', [\App\Http\Controllers\Api\DataController::class, 'category']);
    Route::get('jobs/{job}',[\App\Http\Controllers\Api\JobController::class, 'show']);
    Route::get('otherjob/{job}', [\App\Http\Controllers\Api\JobController::class, 'other_job']);
    Route::get('newestjob', [\App\Http\Controllers\Api\JobController::class, 'getnewest_job']);

    Route::group(['middleware' => 'jwt.auth'], function (){
        Route::get('users/me', 'UserController@me');
        //admin
        Route::post('users/userinfo', 'UserController@userinfo');
        Route::post('users/editstatus/{user}', 'UserController@editstatus');
        Route::post('users/companyinfo', 'UserController@companyinfo');
        Route::apiResource('users', 'UserController');
        Route::post('admin/jobs', [\App\Http\Controllers\Api\Admin\JobController::class, 'index']);
        Route::post('admin/jobs/pending', [\App\Http\Controllers\Api\Admin\JobController::class, 'pending']);
        Route::post('admin/jobs/all', [\App\Http\Controllers\Api\Admin\JobController::class, 'all']);

        //user
        Route::post('applycv/{job}', [\App\Http\Controllers\Api\ApplyCvController::class, 'store']);
        Route::post('savejob/{job}',[\App\Http\Controllers\Api\JobController::class, 'save_job']);
        Route::post('unsavejob/{job}',[\App\Http\Controllers\Api\JobController::class, 'unsave_job']);
        Route::get('getsavedjob',[\App\Http\Controllers\Api\JobController::class, 'getsaved_job']);
        Route::get('getappliedjob',[\App\Http\Controllers\Api\ApplyCvController::class, 'get_applied_job']);
        Route::get('getjobs',[\App\Http\Controllers\Api\JobController::class, 'getjobs']);
        Route::post('getappliedcv/{job}',[\App\Http\Controllers\Api\ApplyCvController::class, 'get_applied_cv']);
        Route::get('getappliedcv/{job}',[\App\Http\Controllers\Api\ApplyCvController::class, 'get_applied_cv']);
        Route::post('newjob',[\App\Http\Controllers\Api\JobController::class, 'store']);

        //preview job
        Route::get('previewjob/{job}',[\App\Http\Controllers\Api\PreviewJobController::class, 'show']);

        //job status
        Route::post('jobstatus/edit/{job}', [\App\Http\Controllers\Api\PreviewJobController::class, 'editjobstatus']);

        //company handle job
        Route::get('company/jobs/{job}', [\App\Http\Controllers\Api\Company\JobController::class, 'edit']);
        Route::post('company/jobs/{job}', [\App\Http\Controllers\Api\Company\JobController::class, 'update']);
        Route::delete('company/jobs/{job}', [\App\Http\Controllers\Api\Company\JobController::class, 'destroy']);

        //admin CRUD categories
        Route::post('admin/categories', [\App\Http\Controllers\Api\Admin\CategoryController::class, 'index']);
        Route::put('admin/categories/{job_category}', [\App\Http\Controllers\Api\Admin\CategoryController::class, 'update']);
        Route::delete('admin/categories/{job_category}', [\App\Http\Controllers\Api\Admin\CategoryController::class, 'destroy']);
        Route::post('admin/categories/new', [\App\Http\Controllers\Api\Admin\CategoryController::class, 'store']);
    });
});
