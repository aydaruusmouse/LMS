<?php

use App\Http\Controllers\Api\Instructor\AuthController;
use App\Http\Controllers\Api\Instructor\CourseController;
use App\Http\Controllers\Api\Instructor\DashboardController;
use App\Http\Controllers\Api\Instructor\InstructorController;
use App\Http\Controllers\Api\Instructor\StudentController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['CheckApiKey']], function () {
    Route::post('instructor-register', [AuthController::class, 'register']);
    Route::post('instructor-login', [AuthController::class, 'login']);

    Route::group(['middleware' => ['jwt.verify'], 'prefix' => 'instructor'], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        //dashboard data
        Route::get('dashboard', [DashboardController::class, 'dashboard']);
        Route::get('get-stats', [DashboardController::class, 'getStats']);
        Route::get('enrollments', [DashboardController::class, 'enrollments']);
        //instructor profile
        Route::get('profile', [InstructorController::class, 'profile']);
        Route::post('update-profile', [InstructorController::class, 'updateProfile']);
        //courses
        Route::get('courses', [CourseController::class, 'courses']);
        Route::get('pending-courses', [CourseController::class, 'pendingCourses']);
        Route::get('courses-details/{id}', [CourseController::class, 'courseDetails']);
        Route::post('change-status/{id}', [CourseController::class, 'changeStatus']);
        Route::get('reviews', [CourseController::class, 'reviews']);
        Route::post('change-review-status/{id}', [CourseController::class, 'changeReviewStatus']);
        Route::get('category-courses/{id}', [CourseController::class, 'categoryCourses']);
        //students
        Route::get('students', [StudentController::class, 'students']);
        Route::get('student-profile/{id}', [StudentController::class, 'profile']);
        Route::get('student-courses/{id}', [StudentController::class, 'courses']);
        Route::get('student-certificates/{id}', [StudentController::class, 'certificates']);
        Route::get('student-followings/{id}', [StudentController::class, 'followingUser']);
    });
});
