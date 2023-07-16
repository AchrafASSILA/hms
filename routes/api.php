<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Section\SectionController;
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
    Route::get('get-trached-sections', [SectionController::class, 'getTrachedSections'], 'getTrachedSections');
    Route::post('update-section', [SectionController::class, 'updateSection']);
    Route::get('deleted-sections', [SectionController::class, 'deletedSections']);
    Route::delete('/remove-section-definitely/{id}', [SectionController::class, 'removeDefinitely']);
    Route::put('restore-section/{id}', [SectionController::class, 'restoreSection']);
});

Route::get('generate-excel-sections', [SectionController::class, 'generateExcelSections']);

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');
