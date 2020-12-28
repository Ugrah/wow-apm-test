<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\UserMainController;


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

Route::get('/', [UserMainController::class, 'userType'])->defaults('_config', ['view' => 'welcome'])->name('user.type');



/*
|--------------------------------------------------------------------------
| User Login
|--------------------------------------------------------------------------
|*/
Route::get('login', [UserMainController::class, 'login'])->defaults('_config', ['view' => 'user.login'])->name('login');
Route::post('login', [UserMainController::class, 'signin'])->defaults('_config', ['redirect' => 'user.type'])->name('login');
