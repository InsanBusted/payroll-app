<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::post('/profile/employee', [ProfileController::class, 'updateEmployee'])->name('profile.employee');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Management — superadmin only
    Route::middleware('superadmin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // Role Management
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

    // Employee Management
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

    // Master Jabatan
    Route::get('/jabatans', [JabatanController::class, 'index'])->name('jabatans.index');
    Route::post('/jabatans', [JabatanController::class, 'store'])->name('jabatans.store');
    Route::put('/jabatans/{jabatan}', [JabatanController::class, 'update'])->name('jabatans.update');
    Route::delete('/jabatans/{jabatan}', [JabatanController::class, 'destroy'])->name('jabatans.destroy');

    // Master Area
    Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');
    Route::post('/areas', [AreaController::class, 'store'])->name('areas.store');
    Route::put('/areas/{area}', [AreaController::class, 'update'])->name('areas.update');
    Route::delete('/areas/{area}', [AreaController::class, 'destroy'])->name('areas.destroy');

    // Setting Gaji
    Route::get('/setting-gaji', [App\Http\Controllers\SettingGajiController::class, 'index'])->name('setting_gaji.index');
    Route::put('/setting-gaji/{settingGaji}', [App\Http\Controllers\SettingGajiController::class, 'update'])->name('setting_gaji.update');

    // Employee Kinerja
    Route::get('/kinerjas', [App\Http\Controllers\EmployeeKinerjaController::class, 'index'])->name('kinerjas.index');
    Route::post('/kinerjas', [App\Http\Controllers\EmployeeKinerjaController::class, 'store'])->name('kinerjas.store');
    Route::post('/kinerjas/import', [App\Http\Controllers\EmployeeKinerjaController::class, 'importExcel'])->name('kinerjas.import');
    Route::put('/kinerjas/{kinerja}', [App\Http\Controllers\EmployeeKinerjaController::class, 'update'])->name('kinerjas.update');
    Route::delete('/kinerjas/{kinerja}', [App\Http\Controllers\EmployeeKinerjaController::class, 'destroy'])->name('kinerjas.destroy');

    // Staff — hanya bisa akses kinerja milik sendiri
    Route::middleware('staff')->group(function () {
        Route::get('/staff/kinerja', [App\Http\Controllers\StaffKinerjaController::class, 'index'])->name('staff.kinerja');
    });
});

require __DIR__.'/auth.php';
