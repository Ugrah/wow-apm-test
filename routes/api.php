<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Api\ApiRoleController;

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
    Route::post('login', [ApiAuthController::class, 'login'])->name('api.login');
    Route::post('register', [ApiAuthController::class, 'register'])->name('api.register');

    // Login test via api
    Route::post('login-test', [ApiAuthController::class, 'login'])->name('api.login-test');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('user', [ApiAuthController::class, 'user'])->name('api.user');

        // Api Users Routes
        Route::get('users', [ApiUserController::class, 'index'])->name('api.users.index');
        Route::get('users/{id}', [ApiUserController::class, 'show'])->name('api.users.show');
        Route::post('users', [ApiUserController::class, 'store'])->name('api.users.store');
        Route::put('users/{id}', [ApiUserController::class, 'update'])->name('api.users.update');
        Route::patch('users/{id}', [ApiUserController::class, 'update'])->name('api.users.update');
        Route::delete('users/{id}', [ApiUserController::class, 'destroy'])->name('api.users.destroy');

        // Api Roles Routes
        Route::get('roles', [ApiRoleController::class, 'index'])->name('api.roles.index');
        Route::get('roles/{id}', [ApiRoleController::class, 'show'])->name('api.roles.show');
        Route::post('roles', [ApiRoleController::class, 'store'])->name('api.roles.store');
        Route::put('roles/{id}', [ApiRoleController::class, 'update'])->name('api.roles.update');
        Route::patch('roles/{id}', [ApiRoleController::class, 'update'])->name('api.roles.update');
        Route::delete('roles/{id}', [ApiRoleController::class, 'destroy'])->name('api.roles.destroy');

    });
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });