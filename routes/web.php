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

Route::get('/', [UserMainController::class, 'userType'])->defaults('_config', ['view' => 'user.type', 'redirect' => 'login'])->name('user.type');
Route::post('/', [UserMainController::class, 'userType'])->defaults('_config', ['view' => 'welcome', 'redirect' => 'login'])->name('user.type');

// Auth::routes();

/*
|--------------------------------------------------------------------------
| User Auth Proteced routes
|--------------------------------------------------------------------------
|
*/
Route::group(['middleware' => ['auth']], function () {

    // Resources routes just for dev - Remove after complete api routes
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::get('dashboard', [UserMainController::class, 'dashboard'])->defaults('_config', ['view' => 'user.dashboard'])->name('user.dashboard');

    // Standard work
    Route::get('standard-work', [UserMainController::class, 'standardWork'])->defaults('_config', ['view' => 'user.standardWork.index'])->name('user.standardWork.index');
    Route::get('standard-work/safety-walk', [UserMainController::class, 'safetyWalk'])->defaults('_config', ['view' => 'user.standardWork.safetyWalk'])->name('user.standardWork.safetyWalk');
    Route::get('standard-work/safety-walk/leader-led', [UserMainController::class, 'leaderLed'])->defaults('_config', ['view' => 'user.standardWork.leaderLed'])->name('user.standardWork.safetyWalk.leaderLed');
    Route::get('standard-work/touch-point', [UserMainController::class, 'touchPoint'])->defaults('_config', ['view' => 'user.standardWork.touchPoint'])->name('user.standardWork.touchPoint');
    Route::get('standard-work/behavior-confirmation', [UserMainController::class, 'behaviorConfirmation'])->defaults('_config', ['view' => 'user.standardWork.behaviorConfirmation'])->name('user.standardWork.behaviorConfirmation');

    // Performance management
    Route::get('performance-mngt', [UserMainController::class, 'performanceMngt'])->defaults('_config', ['view' => 'user.performanceMngt.index'])->name('user.performanceMngt.index');
    Route::get('performance-mngt/terminal-perf', [UserMainController::class, 'terminalPerf'])->defaults('_config', ['view' => 'user.performanceMngt.terminalPerf'])->name('user.performanceMngt.terminalPerf');
    Route::get('performance-mngt/equipment-perf', [UserMainController::class, 'equipmentPerf'])->defaults('_config', ['view' => 'user.performanceMngt.equipmentPerf'])->name('user.performanceMngt.equipmentPerf');
    Route::get('performance-mngt/technical-perf', [UserMainController::class, 'technicalPerf'])->defaults('_config', ['view' => 'user.performanceMngt.technicalPerf'])->name('user.performanceMngt.technicalPerf');

    // Process design management
    Route::get('process-design-mngt', [UserMainController::class, 'processDesignMngt'])->defaults('_config', ['view' => 'user.processDesignMngt.index'])->name('user.processDesignMngt.index');
    Route::get('process-design-mngt/mavim', [UserMainController::class, 'mavim'])->defaults('_config', ['view' => 'user.processDesignMngt.mavim'])->name('user.processDesignMngt.mavim');
    Route::get('process-design-mngt/confluence', [UserMainController::class, 'confluence'])->defaults('_config', ['view' => 'user.processDesignMngt.confluence'])->name('user.processDesignMngt.confluence');

    // People and skills
    Route::get('people-and-skills', [UserMainController::class, 'peopleAndSkills'])->defaults('_config', ['view' => 'user.peopleAndSkills.index'])->name('user.peopleAndSkills.index');
    Route::get('people-and-skills/register-for-training', [UserMainController::class, 'registerForTraining'])->defaults('_config', ['view' => 'user.peopleAndSkills.registerForTraining'])->name('user.peopleAndSkills.registerForTraining');
    Route::get('people-and-skills/validate-training', [UserMainController::class, 'validateTraining'])->defaults('_config', ['view' => 'user.peopleAndSkills.validateTraining'])->name('user.peopleAndSkills.validateTraining');
    Route::get('people-and-skills/skill-matrix', [UserMainController::class, 'skillMatrix'])->defaults('_config', ['view' => 'user.peopleAndSkills.skillMatrix'])->name('user.peopleAndSkills.skillMatrix');
    Route::get('people-and-skills/experts', [UserMainController::class, 'experts'])->defaults('_config', ['view' => 'user.peopleAndSkills.experts'])->name('user.peopleAndSkills.experts');
    Route::get('people-and-skills/training-agenda', [UserMainController::class, 'trainingAgenda'])->defaults('_config', ['view' => 'user.peopleAndSkills.trainingAgenda'])->name('user.peopleAndSkills.trainingAgenda');
    Route::get('people-and-skills/add-training', [UserMainController::class, 'addTraining'])->defaults('_config', ['view' => 'user.peopleAndSkills.addTraining'])->name('user.peopleAndSkills.addTraining');
    Route::get('people-and-skills/training-progress', [UserMainController::class, 'trainingProgress'])->defaults('_config', ['view' => 'user.peopleAndSkills.trainingProgress'])->name('user.peopleAndSkills.trainingProgress');

    // Improvement mngt
    Route::get('improvement-mngt', [UserMainController::class, 'improvementMngt'])->defaults('_config', ['view' => 'user.improvementMngt.index'])->name('user.improvementMngt.index');
    Route::get('improvement-mngt/kaizen', [UserMainController::class, 'kaizen'])->defaults('_config', ['view' => 'user.improvementMngt.kaizen'])->name('user.improvementMngt.kaizen');
    Route::get('improvement-mngt/my-kaizens', [UserMainController::class, 'myKaizens'])->defaults('_config', ['view' => 'user.improvementMngt.myKaizens'])->name('user.improvementMngt.myKaizens');

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
