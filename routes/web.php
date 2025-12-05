<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\AuthController;

// Authentication (simple controller-based)
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    // HRM Routes
    Route::get('employees/filter', [EmployeeController::class, 'filter']);
    Route::get('employees/check-email', [EmployeeController::class, 'checkEmail']);
    Route::resource('employees', EmployeeController::class);

    Route::get('departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('departments/create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('departments', [DepartmentController::class, 'store'])->name('departments.store');

    Route::get('skills', [SkillController::class, 'index'])->name('skills.index');
    Route::get('skills/create', [SkillController::class, 'create'])->name('skills.create');
    Route::post('skills', [SkillController::class, 'store'])->name('skills.store');
});
