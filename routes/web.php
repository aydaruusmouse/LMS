<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Site\AuthController;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\CourseController;
use App\Http\Controllers\Site\FrontendController;
use App\Http\Controllers\Site\InstructorController;
use App\Http\Controllers\Site\PaymentController;
use App\Http\Controllers\Site\ProfileController;
use App\Http\Controllers\Site\PurchaseController;
use App\Http\Controllers\Site\ReviewController;
use App\Http\Controllers\Student\OrganizationController;
use App\Http\Controllers\Student\TicketController;
use App\Http\Controllers\Student\WishlistController;
use Illuminate\Support\Facades\Route;

Route::any('env-editor', function () {
    \Illuminate\Support\Facades\Log::info('env-editor', []);

    return redirect('/');
})->where('anything', '.*');
Route::any('env-editor/key', function () {
    \Illuminate\Support\Facades\Log::info('env-editor-key', []);
    return redirect('/');
})->where('anything', '.*');

Route::group(['prefix' => localeRoutePrefix()], function () {
    Route::get('/', [FrontendController::class, 'index'])->name('home');
    Route::get('/home2', [FrontendController::class, 'home2'])->name('home2');
    Route::get('/home3', [FrontendController::class, 'home3'])->name('home3');
    Route::match(['get', 'post'], 'app-setting', [HomeController::class, 'changeAppSetting'])->name('change.app.setting');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::get('cache-clear', [HomeController::class, 'cacheClear'])->name('cache.clear');

    /*--------------------=================================== Frontend route ===========================================*/

    /*===================authentication route=============*/
    Route::group(['prefix' => 'student', 'as' => 'student.'], function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('sign-up', [AuthController::class, 'signUp'])->name('sign_up');
    });
    Route::get('activation/{email}/{code}', [AuthController::class, 'activation']);
    Route::get('password-forgot', [AuthController::class, 'forgotPassword'])->name('password.forgot');
    Route::post('password-forgot', [AuthController::class, 'forgot'])->name('forgot.password-email');
    Route::get('confirm-otp/{email}/{otp}', [AuthController::class, 'confirmOtp']);
    Route::get('confirm-password-otp', [AuthController::class, 'passwordOtpSubmit'])->name('confirm.password.otp-submit');
    Route::post('confirm.password-update', [AuthController::class, 'passwordUpdate'])->name('confirm.password-update');
    /*===================authentication route=============*/

    /*===================instructor route=============*/
    Route::group(['prefix' => 'instructors'], function () {
        Route::get('/', [InstructorController::class, 'instructor'])->name('instructors');
        Route::get('/signUp', [AuthController::class, 'signUp'])->name('instructor.sign_up');
        Route::post('/contact', [InstructorController::class, 'instructorContact'])->name('instructor.contact');
        Route::get('/register', [AuthController::class, 'signUp'])->name('instructor.register');
        Route::post('follow', [InstructorController::class, 'follow'])->name('follow');
    });
    Route::get('instructors/{slug}', [InstructorController::class, 'instructorDetails'])->name('instructor.details');
    Route::get('instructor-courses', [InstructorController::class, 'loadCourses'])->name('instructor.courses');
    Route::get('instructor-books', [InstructorController::class, 'loadBooks'])->name('instructor.books');
    Route::get('instructor-blogs', [InstructorController::class, 'loadBlogs'])->name('instructor.blogs');

    Route::post('socialLogin', [AuthController::class, 'socialLogin'])->name('social.login');

    Route::group(['middleware' => 'studentCheck'], function () {
        Route::match(['get', 'post'], 'checkout', [PurchaseController::class, 'checkout'])->name('checkout');
        Route::get('user/invoice/{trx_id}', [PurchaseController::class, 'invoice'])->name('user.invoice');
        Route::match(['get', 'post'], 'user/complete-order', [PurchaseController::class, 'completeOrder'])->name('complete.order');
        Route::get('user/download-invoice/{trx_id}', [PurchaseController::class, 'downloadInvoice'])->name('download.invoice');
        Route::get('free-course', [PurchaseController::class, 'completeOrder'])->name('free.course');
        Route::post('onesignal/update-subscription', [ProfileController::class, 'oneSignalSubscribe'])->name('onesignal.update-subscription');

        //payment redirection
        Route::post('paypal-redirect', [PaymentController::class, 'paypalRedirect'])->name('paypal.redirect');
        Route::get('stripe/redirect', [PaymentController::class, 'stripeRedirect'])->name('stripe.redirect');
        Route::get('mollie/redirect', [PaymentController::class, 'mollieRedirect'])->name('mollie.redirect');
        Route::get('skrill/redirect', [PaymentController::class, 'skrillRedirect'])->name('skrill.redirect');
        Route::match(['post', 'get'], 'sslcommerze/redirect', [PaymentController::class, 'sslRedirect'])->name('sslcommerze.redirect');
        Route::get('bkash/redirect', [PaymentController::class, 'bkashRedirect'])->name('bkash.redirect');
        Route::get('bkash/execute', [PaymentController::class, 'bkashExecute']);
        Route::get('nagad/redirect', [PaymentController::class, 'nagadRedirect'])->name('nagad.redirect');
        Route::get('nagad/callback', [PaymentController::class, 'nagadVerify'])->name('nagad.callback');
        Route::get('aamarpay/redirect', [PaymentController::class, 'aamarpayRedirect'])->name('aamarpay.redirect');
        Route::get('paytm/redirect', [PaymentController::class, 'paytmRedirect'])->name('paytm.redirect');
        Route::post('paytm/success', [PaymentController::class, 'payTmSuccess'])->name('payTm.success');
        Route::get('razorpay/redirect', [PaymentController::class, 'razorpayRedirect'])->name('razorpay.redirect');
        Route::get('flutter-wave/redirect', [PaymentController::class, 'fwRedirect'])->name('fw.redirect');
        //google pay
        Route::get('mercadopago/redirect', [PaymentController::class, 'mercadoPagoRedirect'])->name('mercadoPago.redirect');
        //jazzcash
        Route::get('midtrans/redirect', [PaymentController::class, 'midtransRedirect'])->name('midtrans.redirect');
        Route::get('telr/redirect', [PaymentController::class, 'telrRedirect'])->name('telr.redirect');
        Route::get('iyzico/redirect', [PaymentController::class, 'iyzicoRedirect'])->name('iyzico.redirect');
        Route::get('iyzico/retrieve', [PaymentController::class, 'retrieveIyzico'])->name('iyzico.callback');
        Route::get('hitpay/redirect', [PaymentController::class, 'hitpayRedirect'])->name('hitpay.redirect');
        Route::get('uddokta-pay/redirect', [PaymentController::class, 'uddoktaPyRedirect'])->name('uddokta.pay.redirect');
        Route::POST('process/pg-data', [PaymentController::class, 'pgProcess'])->name('process.pg');

        /*============== Profile login ===========================*/
        Route::get('dashboard', [ProfileController::class, 'myProfile'])->name('my-profile');
        Route::get('my-profile', [ProfileController::class, 'myProfile']);
        Route::get('edit-profile', [ProfileController::class, 'editProfile'])->name('edit.profile');
        Route::post('profile-update', [ProfileController::class, 'updateProfile'])->name('profile-update');
        Route::post('apply-coupon', [CartController::class, 'applyCoupon'])->name('apply.coupon');
        Route::get('delete-apply-coupon/{id}', [CartController::class, 'deleteAppliedCoupon'])->name('delete.applied.coupon');

        Route::group(['as' => 'course.'], function () {
            Route::get('purchase-courses', [ProfileController::class, 'purchaseCourses'])->name('purchase');
            Route::get('recently-viewed-courses', [ProfileController::class, 'recentlyViewedCourses'])->name('recently-viewed');
            Route::get('wishlist-courses', [WishlistController::class, 'wishlists'])->name('wishlist');
            Route::get('my-certificate', [ProfileController::class, 'certificate'])->name('certificate');
            Route::get('certificate/{id}', [ProfileController::class, 'certificateShow'])->name('certificate-show');
            Route::get('certificate-download/{id}', [ProfileController::class, 'certificateDownload'])->name('certificate-download');
        });
        Route::post('add-remove-wishlist', [WishlistController::class, 'addOrRemoveWishlist'])->name('add.remove.wishlist');

        Route::group(['as' => 'book.'], function () {
            Route::get('purchase-book', [ProfileController::class, 'purchaseBook'])->name('purchase');
            Route::get('recently-viewed-book', [ProfileController::class, 'recentlyViewedBook'])->name('recently-viewed');
            Route::get('wishlist-book', [ProfileController::class, 'wishlistBook'])->name('wishlist');
        });
        Route::get('notification', [ProfileController::class, 'notification'])->name('notification');
        Route::post('notification', [ProfileController::class, 'notificationUpdate'])->name('notification.update');
        Route::post('delete', [ProfileController::class, 'notificationDelete'])->name('notification.delete');
        Route::get('setting', [ProfileController::class, 'profileSetting'])->name('setting');
        Route::post('setting-status-change', [ProfileController::class, 'systemStatus'])->name('setting.status.change');
        Route::post('user/account', [ProfileController::class, 'accountDelete']);
        Route::get('change-password', [AuthController::class, 'changePassword'])->name('change.password');
        Route::post('change-password', [AuthController::class, 'changePasswordUpdate'])->name('change.password-update');
        Route::get('wallet', [ProfileController::class, 'wallet'])->name('wallet');
        Route::match(['get', 'post'], 'user/recharge-wallet', [ProfileController::class, 'walletRecharge'])->name('recharge.wallet');
        Route::get('meetings', [ProfileController::class, 'meeting'])->name('meetings');
        Route::get('my-assignment', [ProfileController::class, 'myAssignment'])->name('my-assignment');
        Route::get('assignment-details/{slug}]', [ProfileController::class, 'assignmentDetails'])->name('assignment.details');
        Route::post('assignment-submit', [ProfileController::class, 'assignmentSubmit'])->name('assignment.submit');
        Route::post('assignment-submit-delete', [ProfileController::class, 'submittedAssignmentDelete'])->name('assignment.submit.delete');
        /*============== Profile login ===========================*/

        Route::get('my-course/{slug}', [CourseController::class, 'myCourse'])->name('my-course');
        Route::get('my-quiz/{slug}', [CourseController::class, 'myQuiz'])->name('my-quiz');
        Route::post('my-answer', [CourseController::class, 'quizAnswerSubmit'])->name('quiz-answer');
        Route::post('save-progress', [CourseController::class, 'saveProgress'])->name('save-progress');
        Route::get('course/{course}/lesson/{slug}', [CourseController::class, 'lessonDetails'])->name('lesson.details');
        Route::get('course/resource', [CourseController::class, 'courseResource'])->name('resource.details');
        Route::get('answers/{slug}', [CourseController::class, 'showQuizAnswer'])->name('quiz-answer.show');
        Route::post('course-refund', [PurchaseController::class, 'refund'])->name('course.refund');
        Route::get('support', [TicketController::class, 'support'])->name('help.support');
        Route::resource('support-tickets', TicketController::class);
        Route::post('support-tickets-reply', [TicketController::class, 'reply'])->name('support-tickets.reply');
        Route::get('download-resource/{id}', [ProfileController::class, 'resourceDownload'])->name('download.resource');

        Route::get('course-list', [CourseController::class, 'courseList'])->name('course.list');
        Route::get('quiz-list/{slug}', [CourseController::class, 'quizList'])->name('quiz.list');
    });

    Route::post('subscribe', [FrontendController::class, 'subscribe'])->name('subscribe');

    /*===================== Course Route ==============================*/

    Route::get('courses', [CourseController::class, 'course'])->name('courses');
    Route::get('category/{slug}', [CourseController::class, 'categoryCourses'])->name('category.courses');
    Route::get('load-category', [CourseController::class, 'loadCategory'])->name('load.category');
    Route::get('load.levels', [CourseController::class, 'loadLevel'])->name('load.levels');
    Route::get('course/{slug}', [CourseController::class, 'courseDetails'])->name('course.details');
    Route::post('store-comment', [ReviewController::class, 'storeComment'])->name('store.comment');
    Route::get('load-more-reviews', [ReviewController::class, 'reviews'])->name('load.reviews');
    Route::get('load-subject', [CourseController::class, 'loadSubject'])->name('load.subject');

    Route::post('header-search', [FrontendController::class, 'headerSearch'])->name('header.search');

    Route::get('organizations/{slug}', [OrganizationController::class, 'details'])->name('organization.details');
    Route::get('organization-load-instructor', [OrganizationController::class, 'loadInstructor'])->name('organization.instructor');
    Route::get('organization-load-course', [OrganizationController::class, 'loadCourse'])->name('organization.course');

    /*===================== blog Route ==============================*/
    Route::get('blog', [BlogController::class, 'showAllBlog'])->name('blog');
    Route::get('blog/feature', [BlogController::class, 'showAllBlogFeature'])->name('blog.feature');
    Route::post('filter-blogs', [BlogController::class, 'filterBlog'])->name('filter.blog');
    Route::get('blog/{slug}', [BlogController::class, 'blogDetails'])->name('blog-details');

    Route::group(['middleware' => 'auth'], function () {
        Route::post('blog-comment', [BlogController::class, 'comment'])->name('blog.comment');
        Route::get('blog-comments/{id}', [BlogController::class, 'comments'])->name('blog.comments');
        Route::post('comment-reply', [BlogController::class, 'reply'])->name('blog.comment.reply');
        Route::get('comment-replies', [BlogController::class, 'replies'])->name('blog.comment.replies');
    });

    //web setting change
    Route::post('update-website-setting', [FrontendController::class, 'UpdateWebsiteSetting'])->name('update.website-setting');

    Route::get('book', function () {
        return view('frontend.book');
    })->name('book');

    Route::get('book-category', function () {
        return view('frontend.book_category');
    })->name('book.category');

    Route::get('book-details', function () {
        return view('frontend.book_details');
    })->name('book.details');

    //add to cart route
    Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add.cart');
    Route::get('item/remove', [CartController::class, 'itemRemove']);
    Route::get('cart-view', [CartController::class, 'cartView'])->name('cart.view');

    //dynamic page route
    Route::get('page/{link}', [FrontendController::class, 'page']);

    //will be deleted soon
    Route::get('welcome', function () {
        return view('frontend.welcome');
    });
});

require __DIR__.'/auth.php';
