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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix'=>"/v1/"], function(){
    Route::GET('/', [\App\Http\Controllers\Api\UserController::class,'index']);
    Route::POST('/register', [\App\Http\Controllers\Api\UserController::class,'register'])->name('register');

    Route::POST('/login', [\App\Http\Controllers\Api\UserController::class,'login'])->name('login');
    Route::GET('/jobs/{job_id}', [\App\Http\Controllers\Api\JobPostController::class, 'showJob'])->name('showjob');
    Route::GET('/jobs/', [\App\Http\Controllers\Api\JobPostController::class, 'showAllJobs'])->name('showalljob');
    Route::POST('/job/{job_id}/apply', [\App\Http\Controllers\Api\JobApplicationController::class, 'apply'])
            ->name('apply');
    Route::POST('/logout', [\App\Http\Controllers\Api\UserController::class,'logout'])->name('logout');


    Route::group(['middleware'=>'biz_user'], function() {

        Route::POST('/my/jobs', [\App\Http\Controllers\Api\JobPostController::class, 'createJob'])->name('createjob');
        Route::DELETE('/my/jobs/{job_id}', [\App\Http\Controllers\Api\JobPostController::class, 'deleteJob'])->name('deletejob');
        Route::GET('/my/jobs', [\App\Http\Controllers\Api\JobPostController::class, 'showMyJobs'])->name('showmyjobs');
        Route::PATCH('/my/jobs/{id}', [\App\Http\Controllers\Api\JobPostController::class, 'updatemyJobs'])->name('updatemyjobs');
        Route::GET('my/jobs/{job_id}/applications', [\App\Http\Controllers\Api\JobApplicationController::class, 'applications'])
            ->name('myjobapplications');
        Route::GET('my/jobs/applications', [\App\Http\Controllers\Api\JobApplicationController::class, 'allapplications'])
            ->name('jobapplications');


    });

});
