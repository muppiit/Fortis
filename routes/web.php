<?php

use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LeaveController;
use Illuminate\Support\Facades\Route;

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
// LOGIN 
Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
});


// user
Route::middleware(['auth', 'role:super_super_admin,super_admin,admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/user/create', [DashboardController::class, 'createUser'])->name('create-user');
    Route::post('/user/store', [DashboardController::class, 'storeUser'])->name('store-user');
    Route::get('/user/edit/{nip}', [DashboardController::class, 'editUser'])->name('edit-user');
    Route::put('/user/update/{nip}', [DashboardController::class, 'updateUser'])->name('update-user');
    Route::delete('/user/delete/{nip}', [DashboardController::class, 'destroyUser'])->name('delete-user');
});

//Roles
Route::middleware(['auth', 'role:super_super_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('roles', [DashboardController::class, 'listRoles'])->name('roles.index');
    Route::get('roles/create', [DashboardController::class, 'createRole'])->name('roles.create');
    Route::post('roles', [DashboardController::class, 'storeRole'])->name('roles.store');
    Route::get('roles/{id}/edit', [DashboardController::class, 'editRole'])->name('roles.edit');
    Route::put('roles/{id}', [DashboardController::class, 'updateRole'])->name('roles.update');
    Route::delete('roles/{id}', [DashboardController::class, 'deleteRole'])->name('roles.delete');
});

//Departments
Route::prefix('admin')->middleware(['auth', 'role:super_super_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('departments', [DashboardController::class, 'departmentsIndex'])->name('departments.index');
    Route::get('departments/create', [DashboardController::class, 'departmentsCreate'])->name('departments.create');
    Route::post('departments', [DashboardController::class, 'departmentsStore'])->name('departments.store');
    Route::get('departments/{id}/edit', [DashboardController::class, 'departmentsEdit'])->name('departments.edit');
    Route::put('departments/{id}', [DashboardController::class, 'departmentsUpdate'])->name('departments.update');
    Route::delete('departments/{id}', [DashboardController::class, 'departmentsDestroy'])->name('departments.destroy');
});

// Team Departments
Route::prefix('admin')->middleware(['auth', 'role:super_super_admin,super_admin'])->name('admin.')->group(function () {
    Route::get('team_departments', [DashboardController::class, 'teamDepartmentsIndex'])->name('team_departments.index');
    Route::get('team_departments/create', [DashboardController::class, 'teamDepartmentsCreate'])->name('team_departments.create');
    Route::post('team_departments', [DashboardController::class, 'teamDepartmentsStore'])->name('team_departments.store');
    Route::get('team_departments/{id}/edit', [DashboardController::class, 'teamDepartmentsEdit'])->name('team_departments.edit');
    Route::put('team_departments/{id}', [DashboardController::class, 'teamDepartmentsUpdate'])->name('team_departments.update');
    Route::delete('team_departments/{id}', [DashboardController::class, 'teamDepartmentsDestroy'])->name('team_departments.destroy');
});

// Attendance
Route::middleware(['auth', 'role:super_super_admin,super_admin,admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('attendances', [AttendanceController::class, 'index'])->name('attendances.index');
});
Route::middleware(['auth', 'role:super_super_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('attendance/update-working-hours', [AttendanceController::class, 'updateWorkingHours'])->name('attendance.update-working-hours');
});

// Leave
Route::middleware(['auth', 'role:super_super_admin,super_admin,admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('leaves', [LeaveController::class, 'index'])->name('leaves.index');
    Route::get('leaves/{id}', [LeaveController::class, 'show'])->name('leaves.show');
    Route::post('leaves/{id}/update-status', [LeaveController::class, 'updateStatus'])->name('leaves.updateStatus');
});







// //gak guna
// Route::get('/admin/create-user', [AdminDashboardController::class, 'showCreateUserForm'])
//     ->name('admin.create.user.form')
//     ->middleware('admin.session');

// Route::post('/admin/create-user', [AdminDashboardController::class, 'createUser'])
//     ->name('admin.create.user')
//     ->middleware('admin.session');


// // ATTENDANCE
// Route::get('/admin/attendances', [AttendanceController::class, 'index'])->name('admin.attendances');

// // LEAVE
// Route::get('/admin/leaves', [LeaveController::class, 'index'])->name('admin.leaves.index');
// Route::get('/admin/leaves/{id}', [LeaveController::class, 'show'])->name('admin.leaves.show');
// Route::post('/admin/leaves/{id}/status', [LeaveController::class, 'updateStatus'])->name('admin.leaves.updateStatus');



// // SUPER ADMIN
// Route::get('/superadmin/dashboard', [SuperAdminDashboardController::class, 'index'])
//     ->name('superadmin.dashboard')
//     ->middleware('admin.session');
