<?php

use App\Http\Controllers\Api\Student\ApiController;
use App\Http\Controllers\Api\Student\AssignmentController;
use App\Http\Controllers\Api\Student\AuthController;
use App\Http\Controllers\Api\Student\BookController;
use App\Http\Controllers\Api\Student\CartController;
use App\Http\Controllers\Api\Student\CategoryController;
use App\Http\Controllers\Api\Student\CertificateController;
use App\Http\Controllers\Api\Student\ChatSystemController;
use App\Http\Controllers\Api\Student\CouponController;
use App\Http\Controllers\Api\Student\CourseController;
use App\Http\Controllers\Api\Student\InstructorController;
use App\Http\Controllers\Api\Student\LiveClassController;
use App\Http\Controllers\Api\Student\NotificationController;
use App\Http\Controllers\Api\Student\OrderController;
use App\Http\Controllers\Api\Student\OrganizationController;
use App\Http\Controllers\Api\Student\QuizeController;
use App\Http\Controllers\Api\Student\ReviewController;
use App\Http\Controllers\Api\Student\WishlistController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['CheckApiKey'])->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('email-verify', [AuthController::class, 'emailVerify']);
    Route::post('resend-email-otp', [AuthController::class, 'resendEmailOtp']);
    Route::post('register-by-phone', [AuthController::class, 'registerByPhone']);
    Route::post('verify-phone-otp', [AuthController::class, 'phoneVerify']);
    Route::post('resend-phone-otp', [AuthController::class, 'resendPhoneOtp']);
    Route::post('social-login', [AuthController::class, 'socialLogin']);
    Route::post('get-login-otp', [AuthController::class, 'getLoginOtp']);
    Route::post('verify-login-otp', [AuthController::class, 'verifyLoginOtp']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('get-verification-otp', [AuthController::class, 'forgotPassword']);
    Route::post('verify-otp', [AuthController::class, 'verifyOtp']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);

    Route::prefix('user')->middleware('jwt.verify')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('profile', [UserController::class, 'profile']);
        Route::post('update-profile', [UserController::class, 'updateProfile']);
        Route::post('change-password', [UserController::class, 'changePassword']);
        Route::get('delete-account', [UserController::class, 'destroy']);
        Route::get('my-courses', [CourseController::class, 'myCourse']);
        Route::get('course-sections/{id}', [CourseController::class, 'sections']);
        Route::get('lesson/{id}', [CourseController::class, 'lessonDetails']);
        Route::post('write-review', [ReviewController::class, 'writeReview']);
        Route::post('save-progress', [CourseController::class, 'saveProgress']);
        Route::get('my-resources/{id}', [CourseController::class, 'myResources']);
        Route::get('invoice-download', [OrderController::class, 'downloadInvoice']);

        //add email
        Route::post('add-email', [UserController::class, 'addEmail']);
        Route::post('verify-profile-email', [UserController::class, 'verifyMail']);

        Route::post('add-phone', [UserController::class, 'addPhone']);
        Route::post('verify-profile-phone', [UserController::class, 'verifyPhone']);
        Route::post('add-social-site', [UserController::class, 'addSocial']);

        // Wishlist
        Route::get('my-wishlists', [WishlistController::class, 'wishlists']);
        Route::post('add-remove-wishlist', [WishlistController::class, 'addOrRemoveWishlist']);

        Route::get('follow-unfollow/{id}', [InstructorController::class, 'followUnfollow']);

        //cart
        Route::get('carts', [CartController::class, 'index']);
        Route::post('add-to-cart', [CartController::class, 'addToCart']);
        Route::delete('carts/{id}', [CartController::class, 'delete']);

        //certificates
        Route::get('certificates', [CertificateController::class, 'certificates']);
        Route::get('certificates/{id}', [CertificateController::class, 'certificateShow']);
        Route::get('certificate-download/{id}', [CertificateController::class, 'certificateDownload']);

        //chat system
        Route::get('instructors', [ChatSystemController::class, 'instructors']);
        Route::get('messages', [ChatSystemController::class, 'messages']);
        Route::post('send-message', [ChatSystemController::class, 'sendMessage']);

        //coupon
        Route::get('coupons', [CouponController::class, 'index']);
        Route::post('apply-coupon', [CouponController::class, 'applyCoupon']);

        //order
        Route::get('order-histories', [OrderController::class, 'orderHistory']);
        Route::get('order/{id}', [OrderController::class, 'orderDetails']);
        Route::post('confirm-order', [OrderController::class, 'confirmOrder']);
        Route::get('make-payment', [OrderController::class, 'payment']);

        //quize
        Route::post('sections', [QuizeController::class, 'courseSections']);
        Route::post('quizzes', [QuizeController::class, 'courseQuiz']);
        Route::post('questions', [QuizeController::class, 'quizQuestions']);

        Route::get('notifications', [NotificationController::class, 'index']);
        Route::post('delete-notification', [NotificationController::class, 'destroy']);
        //meetings
        Route::get('student/meeting', [LiveClassController::class, 'meetings']);
        //assignments
        Route::get('my-assignments', [AssignmentController::class, 'myAssignments']);
        Route::post('submit-assignment', [AssignmentController::class, 'submitAssignment']);

    });

    Route::get('configs', [ApiController::class, 'configs']);
    Route::get('home-screen', [ApiController::class, 'home']);
    Route::get('explore', [ApiController::class, 'explore']);
    Route::get('search-courses', [CourseController::class, 'searchCourses']);
    Route::get('latest-courses', [CourseController::class, 'latestCourses']);
    Route::get('course/{id}', [CourseController::class, 'courseDetails']);
    Route::get('reviews', [ReviewController::class, 'reviews']);
    Route::get('on-boards', [ApiController::class, 'onBoards']);
    Route::get('book/{id}', [BookController::class, 'bookDetails']);
    Route::get('book-store', [BookController::class, 'bookStore']);
    Route::get('latest-books', [BookController::class, 'latestBooks']);
    Route::get('categories', [CategoryController::class, 'categories']);
    Route::get('category-courses/{id}', [CategoryController::class, 'courses']);

    Route::prefix('instructor')->group(function () {
        Route::get('profile/{id}', [InstructorController::class, 'profile']);
        Route::get('students/{id}', [InstructorController::class, 'students']);
        Route::get('courses/{id}', [InstructorController::class, 'courses']);
    });
    Route::prefix('organization')->group(function () {
        Route::get('profile/{id}', [OrganizationController::class, 'profile']);
        Route::get('instructors/{id}', [OrganizationController::class, 'instructors']);
        Route::get('courses/{id}', [OrganizationController::class, 'courses']);
    });
});

Route::match(['post', 'get'], 'complete-order', [OrderController::class, 'completeOrder'])->name('api.complete.order');
Route::get('payment-success', [OrderController::class, 'paymentSuccess'])->name('api.payment.success');
