<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LeaveController;
use App\Http\Controllers\Api\MeetingController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

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
    Route::post('/attendance/clock-in', [AttendanceController::class, 'clockIn']);
    Route::post('/attendance/clock-out', [AttendanceController::class, 'clockOut']);
});

// Leave
Route::middleware('auth:api')->group(function () {
    Route::post('/leave/apply', [LeaveController::class, 'apply']);
    Route::get('/leave/my', [LeaveController::class, 'myLeaves']);
});

// User Profile
Route::middleware('auth:api')->group(function () {
    Route::get('/profile', [UserController::class, 'profile']);
    Route::put('/profile', [UserController::class, 'updateProfile']);
});

//meeting
Route::middleware('auth:api')->group(function () {
    Route::get('/departments', [MeetingController::class, 'getDepartments']);
    Route::get('/departments/{id}/teams', [MeetingController::class, 'getTeamDepartments']);
    Route::post('/teams/users', [MeetingController::class, 'getUsersFromTeams']);
    Route::post('/meetings', [MeetingController::class, 'store']);
});
