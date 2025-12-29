<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\CourseController;
use App\Http\Controllers\Site\FrontendController;
use App\Http\Controllers\Site\InstructorController;
use App\Http\Controllers\Site\PaymentController;
use App\Http\Controllers\Site\ProfileController;
use App\Http\Controllers\Site\PurchaseController;
use App\Http\Controllers\Student\OrganizationController;
use App\Http\Controllers\Student\TicketController;
use App\Http\Controllers\Student\WishlistController;
use Illuminate\Support\Facades\Route;

// Frontend routes with locale prefix
try {
    $localePrefix = localeRoutePrefix();
} catch (\Exception $e) {
    $localePrefix = '';
}

Route::group(['prefix' => $localePrefix], function () {
    // Home route
    Route::get('/', [FrontendController::class, 'index'])->name('home');
    
    // Header search
    Route::get('header-search', [FrontendController::class, 'headerSearch'])->name('header.search');
    
    // Newsletter subscription
    Route::post('subscribe', [FrontendController::class, 'subscribe'])->name('subscribe');
    
    // Change app settings (language/currency)
    Route::post('change-app-setting', [HomeController::class, 'changeAppSetting'])->name('change.app.setting');
    
    // Courses routes
    Route::get('courses', [CourseController::class, 'course'])->name('courses');
    Route::get('category/{slug}/courses', [CourseController::class, 'categoryCourses'])->name('category.courses');
    Route::get('course/{slug}', [CourseController::class, 'courseDetails'])->name('course.details');
    
    // Cart routes
    Route::get('cart', [CartController::class, 'cartView'])->name('cart.view');
    Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add.cart');
    Route::post('apply-coupon', [CartController::class, 'applyCoupon'])->name('apply.coupon');
    
    // Checkout routes
    Route::get('checkout', [PurchaseController::class, 'checkout'])->name('checkout');
    Route::post('complete-order', [PurchaseController::class, 'completeOrder'])->name('complete.order');
    Route::get('free-course', [PurchaseController::class, 'completeOrder'])->name('free.course');
    
    // Blog routes
    Route::get('blog', [BlogController::class, 'showAllBlog'])->name('blog');
    Route::get('blog-feature', [BlogController::class, 'showAllBlogFeature'])->name('blog.feature');
    Route::get('blog/{slug}', [BlogController::class, 'blogDetails'])->name('blog-details');
    
    // Instructor routes
    Route::get('instructor', [InstructorController::class, 'instructor'])->name('instructor');
    Route::get('instructors', [InstructorController::class, 'instructor'])->name('instructors');
    Route::get('instructor/{slug}', [InstructorController::class, 'instructorDetails'])->name('instructor.details');
    Route::post('instructor-contact', [InstructorController::class, 'instructorContact'])->name('instructor.contact');
    
    // Instructor follow route (require authentication)
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::post('follow', [InstructorController::class, 'follow'])->name('follow');
    });
    
    // Organization routes
    Route::get('organization/{slug}', [OrganizationController::class, 'details'])->name('organization.details');
    
    // Payment gateway routes (require authentication)
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('stripe-redirect', [PaymentController::class, 'stripeRedirect'])->name('stripe.redirect');
        Route::get('mollie-redirect', [PaymentController::class, 'mollieRedirect'])->name('mollie.redirect');
        Route::get('skrill-redirect', [PaymentController::class, 'skrillRedirect'])->name('skrill.redirect');
        Route::get('sslcommerze-redirect', [PaymentController::class, 'sslRedirect'])->name('sslcommerze.redirect');
        Route::get('bkash-redirect', [PaymentController::class, 'bkashRedirect'])->name('bkash.redirect');
        Route::get('nagad-redirect', [PaymentController::class, 'nagadRedirect'])->name('nagad.redirect');
        Route::get('aamarpay-redirect', [PaymentController::class, 'aamarpayRedirect'])->name('aamarpay.redirect');
        Route::get('paytm-redirect', [PaymentController::class, 'paytmRedirect'])->name('paytm.redirect');
        Route::get('razorpay-redirect', [PaymentController::class, 'razorpayRedirect'])->name('razorpay.redirect');
        Route::get('flutterwave-redirect', [PaymentController::class, 'fwRedirect'])->name('flutterwave.redirect');
        Route::get('mercadopago-redirect', [PaymentController::class, 'mercadoPagoRedirect'])->name('mercadoPago.redirect');
        Route::get('midtrans-redirect', [PaymentController::class, 'midtransRedirect'])->name('midtrans.redirect');
        Route::get('telr-redirect', [PaymentController::class, 'telrRedirect'])->name('telr.redirect');
        Route::get('hitpay-redirect', [PaymentController::class, 'hitpayRedirect'])->name('hitpay.redirect');
        Route::get('uddokta-pay-redirect', [PaymentController::class, 'uddoktaPyRedirect'])->name('uddokta.pay.redirect');
    });
    
    // Student profile routes (require authentication)
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('my-profile', [ProfileController::class, 'myProfile'])->name('my-profile');
        Route::get('edit-profile', [ProfileController::class, 'editProfile'])->name('edit.profile');
        Route::get('purchase-courses', [ProfileController::class, 'purchaseCourses'])->name('course.purchase');
        Route::get('wishlist-courses', [WishlistController::class, 'wishlists'])->name('course.wishlist');
        Route::get('my-certificate', [ProfileController::class, 'certificate'])->name('course.certificate');
        Route::get('my-assignment', [ProfileController::class, 'myAssignment'])->name('my-assignment');
        Route::get('notification', [ProfileController::class, 'notification'])->name('notification');
        Route::get('setting', [ProfileController::class, 'profileSetting'])->name('setting');
        Route::get('meetings', [ProfileController::class, 'meeting'])->name('meetings');
        Route::get('wallet', [ProfileController::class, 'wallet'])->name('wallet');
        Route::get('support', [TicketController::class, 'support'])->name('help.support');
        Route::post('update-profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
        Route::post('onesignal-update-subscription', [ProfileController::class, 'oneSignalSubscribe'])->name('onesignal.update-subscription');
        Route::post('add-remove-wishlist', [WishlistController::class, 'addOrRemoveWishlist'])->name('add.remove.wishlist');
    });
});

