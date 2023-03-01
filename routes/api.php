<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;


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

Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'create']);
    Route::get('/get_user', [AuthController::class, 'index']);
    Route::get('/get_attendance', [AttendanceController::class, 'index']);
    Route::get('/users/{id}', [AuthController::class, 'users']);



    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::post('/update/{id}', [AuthController::class, 'update']);
    });
    Route::prefix('attendance')->group(function () {
        Route::post('/absen', [AttendanceController::class, 'clockIn']);
    });
});
