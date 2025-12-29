<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\EnrollmentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/

Route::middleware(['auth', 'verified', 'adminCheck'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
        
        // Enrollments
        Route::get('enrollments', [EnrollmentController::class, 'index'])->name('enrollments');
        Route::post('enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');
    });

// Courses routes (without admin. prefix in name to match sidebar expectations)
Route::middleware(['auth', 'verified', 'adminCheck'])
    ->prefix('admin')
    ->group(function () {
        Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
        Route::get('courses/create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('courses', [CourseController::class, 'store'])->name('courses.store');
        Route::get('courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        Route::put('courses/{id}', [CourseController::class, 'update'])->name('courses.update');
        Route::delete('courses/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');
    });

