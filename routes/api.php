<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\HomeController;

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

Route::prefix('v1/')->group(function(){

    //Without auth routes.  
    Route::post('login', [AuthController::class, 'login']);
    Route::post('verify/otp', [AuthController::class, 'verify']);
    Route::post('register', [RegisterController::class, 'register']);

    //With auth routes.
    Route::group(['middleware' => 'token.validate'], function(){

        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('profile', [ProfileController::class, 'get']);
    });
});


