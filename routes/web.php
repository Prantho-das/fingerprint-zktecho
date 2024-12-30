<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::resource('employee',EmployeeController::class)
    ->middleware(['auth', 'verified']);
Route::resource( 'attendance',AttendanceController::class)
    ->middleware(['auth', 'verified']);

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
