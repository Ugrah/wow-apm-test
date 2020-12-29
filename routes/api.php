<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;

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

Route::group(['middleware' => 'cors'], function () {
    Route::post('login', [UserController::class, 'login'])->name('api.login');
    Route::post('register', [UserController::class, 'register'])->name('api.register');

    // Login test via api
    Route::post('login-test', [AuthController::class, 'login'])->name('api.login-test');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('user', [UserController::class, 'user'])->name('api.user');
    });
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });