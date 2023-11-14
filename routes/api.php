<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Section\SectionController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\WebApp\AppController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => ['auth:sanctum']], function () {
    // logout route api code here
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('updateProfile', [AuthController::class, 'updateProfile'])->name('updateProfile');
    Route::resource('sections', SectionController::class);
    Route::resource('doctors', DoctorController::class);
    Route::get('/links', [AppController::class, 'getLinks'],);
    Route::get('get-trached-sections', [SectionController::class, 'getTrachedSections'], 'getTrachedSections');
    Route::get('get-doctors-count', [DashboardController::class, 'getDoctorsCount']);
    Route::get('get-active-sections-count', [DashboardController::class, 'getActiveSectionsCount']);
    Route::get('get-deactive-sections-count', [DashboardController::class, 'getDeactiveSectionsCount']);
    Route::get('get-users-count', [DashboardController::class, 'getUsersCount']);
    Route::get('active-sections', [SectionController::class, 'activeSections']);
    Route::post('update-section', [SectionController::class, 'updateSection']);
    Route::get('deleted-sections', [SectionController::class, 'deletedSections']);
    Route::delete('/remove-section-definitely/{id}', [SectionController::class, 'removeDefinitely']);
    Route::put('restore-section/{id}', [SectionController::class, 'restoreSection']);
    Route::put('activate-user/{id}', [UserController::class, 'activateUser']);
    Route::post('add-section/{id}', [DoctorController::class, 'addSection']);
    Route::post('change-password/{id}', [UserController::class, 'changePassword']);
    Route::put('desactivate-user/{id}', [UserController::class, 'desactivateUser']);
});

Route::get('generate-excel-sections', [SectionController::class, 'generateExcelSections']);

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');
