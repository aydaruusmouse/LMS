<?php

use App\Http\Controllers\Admin\OrganizationController as AdminOrganizationController;
use App\Http\Controllers\Organization\AjaxController;
use App\Http\Controllers\Organization\AssignmentController;
use App\Http\Controllers\Organization\CertificateController;
use App\Http\Controllers\Organization\CourseController;
use App\Http\Controllers\Organization\ExpertiseController;
use App\Http\Controllers\Organization\FaqController;
use App\Http\Controllers\Organization\InstructorController;
use App\Http\Controllers\Organization\LessonController;
use App\Http\Controllers\Organization\LiveClassController;
use App\Http\Controllers\Organization\MediaLibraryController;
use App\Http\Controllers\Organization\OrganizationController;
use App\Http\Controllers\Organization\OrganizationDashboardController;
use App\Http\Controllers\Organization\PayoutController;
use App\Http\Controllers\Organization\QuizController;
use App\Http\Controllers\Organization\QuizQuestionController;
use App\Http\Controllers\Organization\SectionController;
use App\Http\Controllers\Organization\StaffController;
use App\Http\Controllers\Organization\StudentController;
use App\Http\Controllers\Organization\TicketController;
use App\Http\Controllers\Organization\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => localeRoutePrefix().'/organization'], function () {
    Route::get('/', [OrganizationDashboardController::class, 'index'])->name('dashboard');

    //    Manage Courses
    Route::resource('courses', CourseController::class);
    Route::post('course-status', [CourseController::class, 'statusChange'])->name('status');
    Route::get('courses/{course}/students', [CourseController::class, 'students'])->name('course.students');
    Route::get('courses/{course}/statistics', [CourseController::class, 'statistics'])->name('course.statistics');
    Route::resource('sections', SectionController::class)->only(['store', 'edit', 'update', 'destroy']);
    Route::post('sections-order', [SectionController::class, 'sectionsOrder'])->name('course.sections.order');
    Route::resource('lessons', LessonController::class)->only(['store', 'edit', 'update', 'destroy']);
    Route::post('lessons-order', [LessonController::class, 'lessonOrder'])->name('section.lessons.order');
    Route::resource('faqs', FaqController::class)->only(['store', 'edit', 'update', 'destroy']);
    Route::resource('assignments', AssignmentController::class)->only(['store', 'edit', 'update', 'destroy']);
    Route::resource('quizzes', QuizController::class)->only(['store', 'edit', 'update', 'destroy']);
    Route::resource('quiz-questions', QuizQuestionController::class)->only(['store', 'edit', 'update', 'destroy']);
    Route::post('load-more-course', [AjaxController::class, 'loadInstructorCourse'])->name('load.more.course');
    Route::post('load-more-books', [AjaxController::class, 'loadInstructorBooks'])->name('load.more.books');
    Route::resource('expertise', ExpertiseController::class)->except(['show', 'create']);
    Route::resource('instructors', InstructorController::class);
    Route::resource('staff', StaffController::class);
    Route::resource('live-classes', LiveClassController::class)->only(['store', 'edit', 'update', 'destroy']);

    //Organization Staff profile
    Route::get('profile', [OrganizationDashboardController::class, 'profile'])->name('profile.index');
    Route::patch('update', [OrganizationDashboardController::class, 'profileUpdate'])->name('profile.update');
    Route::get('password-change', [OrganizationDashboardController::class, 'passwordChange'])->name('profile.password-change');
    Route::post('password-update', [OrganizationDashboardController::class, 'passwordUpdate'])->name('profile.password-update');

    //user route
    Route::get('users/verified/{verify}', [UserController::class, 'instructorVerified'])->name('users.verified');
    Route::get('users/ban/{id}', [UserController::class, 'instructorBan'])->name('users.ban');
    Route::post('user-status', [UserController::class, 'statusChange'])->name('users.status');
    Route::delete('users/delete/{id}', [UserController::class, 'instructorDelete'])->name('users.delete');

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
    Route::delete('delete-media', [MediaLibraryController::class, 'delete'])->name('media.destroy');

    //organization
    Route::resource('organizations', OrganizationController::class)->except(['destroy']);
    Route::get('edit-organization', [OrganizationController::class, 'settings'])->name('organizations.edit');
    Route::get('overview/{org_id}', [OrganizationController::class, 'overview'])->name('organizations.overview');

    //payout
    Route::get('payout', [PayoutController::class, 'index'])->name('payout');

    Route::get('payout-request', [PayoutController::class, 'create'])->name('payout.create');
    Route::post('payout-store', [PayoutController::class, 'store'])->name('payout.store');


    Route::get('payout-setting', [InstructorController::class, 'payout'])->name('payout-setting');
    Route::post('payouts/method-setting-update', [AdminOrganizationController::class, 'paymentMethodUpdate'])->name('payouts.method-setting-update');
    Route::post('payout-status-change', [AdminOrganizationController::class, 'methodStatus'])->name('payout.status.change');
    Route::post('payout-default-change', [AdminOrganizationController::class, 'defaultMethod'])->name('payout.default.change');

    Route::resource('certificates', CertificateController::class);

    //media library
    Route::get('media-library', [MediaLibraryController::class, 'index'])->name('media-library.index');
    Route::post('add-media', [MediaLibraryController::class, 'store'])->name('media-library.store');
    Route::delete('delete-media', [MediaLibraryController::class, 'delete'])->name('media.destroy');

    /* ajax request route without route permission for status */
    Route::group(['prefix' => 'instructors'], function () {
        Route::post('course-status', [CourseController::class, 'statusChange'])->name('course.status');
        Route::post('live-class-status', [LiveClassController::class, 'statusChange'])->name('live.class.status');
        Route::post('expertise-status', [ExpertiseController::class, 'statusChange'])->name('expertise.status.change');
    });

    //for ajax request
    Route::prefix('instructor-ajax')->as('ajax.')->group(function () {
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
