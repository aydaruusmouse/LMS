<?php

use App\Http\Controllers\Instructor\AjaxController;
use App\Http\Controllers\Instructor\AssignmentController;
use App\Http\Controllers\Instructor\CertificateController;
use App\Http\Controllers\Instructor\CourseController;
use App\Http\Controllers\Instructor\ExpertiseController;
use App\Http\Controllers\Instructor\FaqController;
use App\Http\Controllers\Instructor\InstructorController;
use App\Http\Controllers\Instructor\InstructorDashboardController;
use App\Http\Controllers\Instructor\LessonController;
use App\Http\Controllers\Instructor\LiveClassController;
use App\Http\Controllers\Instructor\MediaLibraryController;
use App\Http\Controllers\Instructor\QuizController;
use App\Http\Controllers\Instructor\QuizQuestionController;
use App\Http\Controllers\Instructor\ResourceController;
use App\Http\Controllers\Instructor\SectionController;
use App\Http\Controllers\Instructor\StudentController;
use App\Http\Controllers\Instructor\TicketController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => localeRoutePrefix().'/instructor'], function () {
    Route::get('/', [InstructorDashboardController::class, 'index'])->name('dashboard');

    //    Manage Courses
    Route::resource('courses', CourseController::class)->except('destroy');
    Route::post('course-status', [CourseController::class, 'statusChange'])->name('status');
    Route::get('courses/{course}/students', [CourseController::class, 'students'])->name('course.students');
    Route::get('courses/{course}/statistics', [CourseController::class, 'statistics'])->name('course.statistics');
    Route::resource('sections', SectionController::class)->only(['store', 'edit', 'update', 'destroy']);
    Route::post('sections-order', [SectionController::class, 'sectionsOrder'])->name('course.sections.order');
    Route::resource('lessons', LessonController::class)->only(['store', 'edit', 'update', 'destroy']);
    Route::post('lessons-order', [LessonController::class, 'lessonOrder'])->name('section.lessons.order');
    Route::resource('faqs', FaqController::class)->only(['store', 'edit', 'update', 'destroy']);

    Route::resource('assignments', AssignmentController::class)->only(['store', 'edit', 'update', 'destroy']);
    Route::get('assignments-list/{id}', [AssignmentController::class, 'assignmentList'])->name('assignments.list');
    Route::get('submitted-student/{id}', [AssignmentController::class, 'studentList'])->name('submittedStudent.list');
    Route::post('assignments-marks/{id}', [AssignmentController::class, 'assignmentMarks'])->name('assignments.marks.store');

    Route::resource('quizzes', QuizController::class)->only(['store', 'edit', 'update', 'destroy']);
    Route::get('exam-list/{slug}', [QuizController::class, 'quizList'])->name('exam.list');
    Route::get('exam-attend-list/{id}', [QuizController::class, 'examAttendList'])->name('exam.attend.list');
    Route::resource('quiz-questions', QuizQuestionController::class)->only(['store', 'edit', 'update', 'destroy']);

    Route::post('load-more-course', [AjaxController::class, 'loadInstructorCourse'])->name('load.more.course');
    Route::post('load-more-books', [AjaxController::class, 'loadInstructorBooks'])->name('load.more.books');
    Route::resource('expertise', ExpertiseController::class)->except(['show', 'create']);
    Route::resource('instructors', InstructorController::class);
    Route::resource('live-classes', LiveClassController::class)->only(['store', 'edit', 'update', 'destroy']);
    Route::resource('resources', ResourceController::class)->only(['store', 'edit', 'update', 'destroy']);
    Route::get('resources/{id}/download', [ResourceController::class, 'download'])->name('resources.download');

    //instructor profile
    Route::get('profile', [InstructorDashboardController::class, 'profile'])->name('user.profile');
    Route::post('user-update', [InstructorDashboardController::class, 'profileUpdate'])->name('user.update');
    Route::get('password-change', [InstructorDashboardController::class, 'passwordChange'])->name('user.password-change');
    Route::post('password-update', [InstructorDashboardController::class, 'passwordUpdate'])->name('user.password-update');

    //expertise
    Route::resource('expertise', ExpertiseController::class)->except(['show', 'create']);
    //ticket
    Route::resource('tickets', TicketController::class)->except(['edit', 'destroy']);
    //manage students
    Route::resource('students', StudentController::class)->except(['destroy']);
    Route::get('students/certificates/{id}', [StudentController::class, 'certificates'])->name('students.certificates');
    Route::get('students/instructors/{id}', [StudentController::class, 'instructors'])->name('students.instructors');
    Route::get('students/payments/{id}', [StudentController::class, 'payments'])->name('students.payments');
    Route::get('students/activity-logs/{id}', [StudentController::class, 'logs'])->name('students.activity.logs');
    Route::post('students-load-course', [StudentController::class, 'loadCourses'])->name('students.load.course');
    Route::post('students-load-certificates', [StudentController::class, 'loadCertificates'])->name('students.load.certificates');
    Route::get('certificates-download/{id}', [StudentController::class, 'certificateDownload'])->name('certificates.download');

    //media library
    Route::get('media-library', [MediaLibraryController::class, 'index'])->name('media-library.index');
    Route::post('add-media', [MediaLibraryController::class, 'store'])->name('media-library.store');
    Route::delete('delete-media', [MediaLibraryController::class, 'delete'])->name('media.destroy')->middleware('PermissionCheck:media_delete');

    Route::resource('certificates', CertificateController::class);

    Route::get('certificate/{id}', [CertificateController::class, 'create'])->name('create.certificate');

    Route::post('certificate-store/{id}', [CertificateController::class, 'store'])->name('store.certificate');

    Route::get('assignment-courses', [AssignmentController::class, 'assignmentCourses'])->name('assignment.courses');

    //media library
    Route::get('media-library', [MediaLibraryController::class, 'index'])->name('media-library.index');
    Route::post('add-media', [MediaLibraryController::class, 'store'])->name('media-library.store');
    Route::delete('delete-media', [MediaLibraryController::class, 'delete'])->name('media.destroy');

    //for ajax request
    Route::prefix('instructor-ajax')->as('ajax.')->middleware(['auth', 'verified'])->group(function () {
        Route::get('categories', [AjaxController::class, 'categories'])->name('categories');
        Route::get('users', [AjaxController::class, 'user'])->name('users');
        Route::get('instructors', [AjaxController::class, 'instructor'])->name('instructors');
        Route::get('organizations', [AjaxController::class, 'organizations'])->name('organizations');
        Route::get('success-stories', [AjaxController::class, 'successStory'])->name('stories');
        Route::get('subjects', [AjaxController::class, 'subjects'])->name('subjects');
        Route::get('lessons', [AjaxController::class, 'lessons'])->name('lessons');
        Route::get('courses', [AjaxController::class, 'courses'])->name('courses');
        Route::get('blogs', [AjaxController::class, 'blogs'])->name('blogs');
        Route::get('books', [AjaxController::class, 'getBooks'])->name('books');
        Route::get('states-by-country', [AjaxController::class, 'getStates'])->name('states');
        Route::get('cities-by-state', [AjaxController::class, 'getCities'])->name('cities');
        Route::post('organizations-balanceCheck', [PayoutController::class, 'balanceCheck'])->name('organizations-balanceCheck');
    });

});
