<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\UserMainController;
use App\Http\Controllers\User\RoleController;
use App\Http\Controllers\User\UserController;


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

Route::get('/', [UserMainController::class, 'userType'])->defaults('_config', ['view' => 'welcome', 'redirect' => 'login'])->name('user.type');
Route::post('/', [UserMainController::class, 'userType'])->defaults('_config', ['view' => 'welcome', 'redirect' => 'login'])->name('user.type');


// Auth::routes();
/*
|--------------------------------------------------------------------------
| User Auth Proteced routes
|--------------------------------------------------------------------------
|
*/
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});


/*
|--------------------------------------------------------------------------
| User Login
|--------------------------------------------------------------------------
|*/
Route::get('login', [UserMainController::class, 'login'])->defaults('_config', ['view' => 'user.login', 'redirect' => 'user.type'])->name('login');
// Route::get('login-test', [UserMainController::class, 'loginTest'])->defaults('_config', ['view' => 'user.login-test', 'redirect' => 'user.type-test'])->name('login_test');

/*
|--------------------------------------------------------------------------
| User Logout
|--------------------------------------------------------------------------
|*/
Route::post('logout', [UserMainController::class, 'logout'])->defaults('_config', ['redirect' => 'login'])->name('logout');
