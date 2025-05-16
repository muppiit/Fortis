<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LeaveController;
use App\Http\Controllers\Api\UserController;
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

// Login
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
    });
});

// Attendance
Route::middleware('auth:api')->group(function () {
    Route::post('/clock-in', [AttendanceController::class, 'clockIn']);
    Route::post('/clock-out', [AttendanceController::class, 'clockOut']);
});

// Leave
Route::middleware('auth:api')->group(function () {
    Route::post('/leave/sick', [LeaveController::class, 'sickLeave']);
    Route::post('/leave/paid', [LeaveController::class, 'paidLeave']);
    Route::get('/leave/list', [LeaveController::class, 'listLeave']);
    Route::get('/leave/detail/{id}', [LeaveController::class, 'detailLeave']);
});

// Profile
Route::middleware('auth:api')->group(function () {
    Route::get('/user/profile', [UserController::class, 'profile']);
    Route::post('/user/edit-profile', [UserController::class, 'editProfile']);
});


