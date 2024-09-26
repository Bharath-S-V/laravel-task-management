<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;

// Login form (common for both admin and user)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// User login
Route::post('/login/user', [AuthController::class, 'userLogin'])->name('login.user');

// Admin login
Route::post('/login/admin', [AuthController::class, 'adminLogin'])->name('login.admin');

// Middleware protected routes
Route::middleware(['auth'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/user', [AdminController::class, 'user'])->name('admin.user');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/admin/user/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('/admin/user/{id}', [UserController::class, 'update'])->name('admin.user.update');
    Route::get('/admin/task', [AdminController::class, 'task'])->name('admin.task');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/tasks/store', [TaskController::class, 'store'])->name('tasks.store');
    Route::post('/tasks/update', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/admin/notifications', [AdminController::class, 'getNotifications'])->name('admin.notifications');


    // User Dashboard
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/user/task', [UserController::class, 'task'])->name('user.task');
    Route::post('/tasks/{id}/complete', [UserController::class, 'completeTask'])->name('tasks.complete');
});





Route::get('/', function () {
    return view('welcome');
});
