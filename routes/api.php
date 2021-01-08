<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Api\ApiTerminalController;
use App\Http\Controllers\Api\ApiRoleController;
use App\Http\Controllers\Api\ApiDepartmentController;
use App\Http\Controllers\Api\ApiPsSkillController;
use App\Http\Controllers\Api\ApiWowCategoryController;
use App\Http\Controllers\Api\ApiPsTrainingSessionController;
use App\Http\Controllers\Api\ApiPsTrainingSessionUserController;

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

        // Api Terminals Routes
        Route::get('terminals-all', [ApiTerminalController::class, 'getAll'])->name('api.terminals.all');
        Route::get('terminals', [ApiTerminalController::class, 'index'])->name('api.terminals.index');
        Route::get('terminals/{id}', [ApiTerminalController::class, 'show'])->name('api.terminals.show');
        Route::post('terminals', [ApiTerminalController::class, 'store'])->name('api.terminals.store');
        Route::put('terminals/{id}', [ApiTerminalController::class, 'update'])->name('api.terminals.update');
        Route::patch('terminals/{id}', [ApiTerminalController::class, 'update'])->name('api.terminals.update');
        Route::delete('terminals/{id}', [ApiTerminalController::class, 'destroy'])->name('api.terminals.destroy');

        // Api Roles Routes
        Route::get('roles', [ApiRoleController::class, 'index'])->name('api.roles.index');
        Route::get('roles/{id}', [ApiRoleController::class, 'show'])->name('api.roles.show');
        Route::post('roles', [ApiRoleController::class, 'store'])->name('api.roles.store');
        Route::put('roles/{id}', [ApiRoleController::class, 'update'])->name('api.roles.update');
        Route::patch('roles/{id}', [ApiRoleController::class, 'update'])->name('api.roles.update');
        Route::delete('roles/{id}', [ApiRoleController::class, 'destroy'])->name('api.roles.destroy');


        // Api Departments Routes
        Route::get('departments', [ApiDepartmentController::class, 'index'])->name('api.departments.index');
        Route::get('departments/{id}', [ApiDepartmentController::class, 'show'])->name('api.departments.show');
        Route::post('departments', [ApiDepartmentController::class, 'store'])->name('api.departments.store');
        Route::put('departments/{id}', [ApiDepartmentController::class, 'update'])->name('api.departments.update');
        Route::patch('departments/{id}', [ApiDepartmentController::class, 'update'])->name('api.departments.update');
        Route::delete('departments/{id}', [ApiDepartmentController::class, 'destroy'])->name('api.departments.destroy');

        // Api ps_skills Route
        Route::resource('ps_skills', ApiPsSkillController::class);
        Route::get('ps_skills-get-from-category/{category_id}', [ApiPsSkillController::class, 'getPsSkillsFromCategory'])->name('api.ps_skills.getFromCat');
        Route::get('ps_skills-get-experts/{skill_id}', [ApiPsSkillController::class, 'getExperts'])->name('api.ps_skills.getExperts');

        // Api wow_categories Route
        Route::resource('wow_categories', ApiWowCategoryController::class);
        Route::get('wow_categories-sidebar-menu', [ApiWowCategoryController::class, 'sideMenuCategories'])->name('api.wow_categories.getMenu');
        Route::get('wow_categories-from-name/{name}', [ApiWowCategoryController::class, 'showFromName'])->name('api.wow_categories.show.fromName');
        
        // Api ps_training_session Route
        Route::resource('ps_training_sessions', ApiPsTrainingSessionController::class);
        // Route::get('add-training-session', [ApiPsTrainingSessionController::class, 'addTrainingSession'])->name('api.ps_training_sessions.addTrainingSession');


        // Api ps_training_session_user Route
        Route::resource('ps_training_session_users', ApiPsTrainingSessionUserController::class);
    });
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });