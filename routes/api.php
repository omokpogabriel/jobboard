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
    Route::get('/', [\App\Http\Controllers\Api\UserController::class,'index']);
    Route::POST('/register', [\App\Http\Controllers\Api\UserController::class,'register'])->name('register');
    Route::POST('/logout', [\App\Http\Controllers\Api\UserController::class,'logout'])->name('logout');
    Route::POST('/login', [\App\Http\Controllers\Api\UserController::class,'login'])->name('login');

    Route::POST('/my/jobs', [\App\Http\Controllers\Api\JobPostController::class,'createJob'])->name('createjob')->middleware(['api']);

});
