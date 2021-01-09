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
        Route::resource('users', ApiUserController::class);
        Route::get('get-members/{members_id}', [ApiUserController::class, 'getMemebers'])->name('api.terminals.all');

        // Api Terminals Routes
        Route::resource('terminals', ApiTerminalController::class);
        Route::get('terminals-all', [ApiTerminalController::class, 'getAll'])->name('api.terminals.all');

        // Api Roles Routes
        Route::resource('roles', ApiRoleController::class);

        // Api Departments Routes
        Route::resource('departments', ApiDepartmentController::class);

        // Api ps_skills Route
        Route::resource('ps-skills', ApiPsSkillController::class);
        Route::get('ps-skills-get-from-category/{category_id}', [ApiPsSkillController::class, 'getPsSkillsFromCategory'])->name('api.ps-skills.getFromCat');
        Route::get('ps-skills-get-experts/{skill_id}', [ApiPsSkillController::class, 'getExperts'])->name('api.ps-skills.getExperts');

        // Api wow_categories Route
        Route::resource('wow-categories', ApiWowCategoryController::class);
        Route::get('wow-categories-sidebar-menu', [ApiWowCategoryController::class, 'sideMenuCategories'])->name('api.wow-categories.getMenu');
        Route::get('wow-categories-from-name/{name}', [ApiWowCategoryController::class, 'showFromName'])->name('api.wow-categories.show.fromName');
        
        // Api ps_training_session Route
        Route::resource('ps-training-sessions', ApiPsTrainingSessionController::class);
        Route::get('get-ps-training-sessions-by-year/{year}', [ApiPsTrainingSessionController::class, 'getPsTrainingSessionsByYear'])->name('api.ps-training-sessions.getTrainingSessionsByYear');

        // Api ps_training_session_user Route
        Route::resource('ps-training-session-users', ApiPsTrainingSessionUserController::class);
    });
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });