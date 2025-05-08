<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\SuperAdminDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('admin.login');
});
// LOGIN ADMIN
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


// ADMIN
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard')
    ->middleware('admin.session');
    
Route::get('/admin/create-user', [AdminDashboardController::class, 'showCreateUserForm'])
    ->name('admin.create.user.form')
    ->middleware('admin.session');

Route::post('/admin/create-user', [AdminDashboardController::class, 'createUser'])
    ->name('admin.create.user')
    ->middleware('admin.session');



// SUPER ADMIN
Route::get('/superadmin/dashboard', [SuperAdminDashboardController::class, 'index'])
    ->name('superadmin.dashboard')
    ->middleware('admin.session');
