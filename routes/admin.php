<?php

use App\Http\Controllers\Admin\AddonController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AiWriterController;
use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\AssignmentController;
use App\Http\Controllers\Admin\BadgeController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\CustomNotificationController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\Email\EmailController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\ExpertiseController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\LiveClassController;
use App\Http\Controllers\Admin\MarketingController;
use App\Http\Controllers\Admin\MediaLibraryController;
use App\Http\Controllers\Admin\MobileAppSetting\ApiKeyController;
use App\Http\Controllers\Admin\MobileAppSetting\MobileAppSettingController;
use App\Http\Controllers\Admin\MobileAppSetting\OnBoardController;
use App\Http\Controllers\Admin\MobileAppSetting\SliderController;
use App\Http\Controllers\Admin\OfflineMethodController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\OrganizationStaffController;
use App\Http\Controllers\Admin\OtpController;
use App\Http\Controllers\Admin\PackageSolutionController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PayoutController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\QuizQuestionController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ResourceController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\StudentFaqController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\SuccessStoryController;
use App\Http\Controllers\Admin\SystemSettingController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UtilityController;
use App\Http\Controllers\Admin\WalletRequestController;
use App\Http\Controllers\Admin\WebsiteSetting\FooterSettingController;
use App\Http\Controllers\Admin\WebsiteSetting\HeaderSettingController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

// Admin routes with locale prefix - wrapped in try-catch to handle database connection issues
$localePrefix = '';
try {
    // Only try to get locale prefix if database is available
    if (Schema::hasTable('languages') && Schema::hasTable('settings')) {
        $localePrefix = localeRoutePrefix();
    }
} catch (\Exception $e) {
    $localePrefix = '';
}

// Fallback admin route without locale prefix (in case localeRoutePrefix fails or returns empty)
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified', 'adminCheck', 'PermissionCheck']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard.fallback');
});

Route::group(['prefix' => $localePrefix], function () {
    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified', 'adminCheck', 'PermissionCheck']], function () {
        Route::resource('roles', RoleController::class)->except(['show']);
        Route::resource('badges', BadgeController::class)->except(['show']);
        Route::resource('blog-categories', BlogCategoryController::class)->except(['show']);
        Route::resource('certificates', CertificateController::class);
        Route::resource('offline-methods', OfflineMethodController::class);
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard')->middleware(['auth', 'verified']);

        Route::resource('cities', CityController::class)->except(['show']);
        Route::resource('contacts', ContactController::class)->except(['show']);
        Route::resource('coupons', CouponController::class)->except(['show']);

        Route::resource('languages', LanguageController::class)->except(['show', 'update']);
        Route::post('languages/update/{id}', [LanguageController::class, 'update'])->name('languages.update');
        Route::get('language/translations', [LanguageController::class, 'translationPage'])->name('language.translations.page');

        Route::resource('services', ServiceController::class)->except(['show']);
        Route::resource('stats', StateController::class)->except(['show']);
        Route::resource('staffs', StaffController::class);
        Route::resource('organizations', OrganizationController::class)->except(['destroy']);
        Route::resource('pages', PageController::class)->except(['show', 'update']);
        Route::post('pages/update/{id}', [PageController::class, 'update'])->name('pages.update');

        //    Manage Courses
        Route::resource('courses', CourseController::class);
        Route::get('courses/{course}/students', [CourseController::class, 'students'])->name('course.students');
        Route::get('courses/{course}/statistics', [CourseController::class, 'statistics'])->name('course.statistics');
        Route::post('course-publish', [CourseController::class, 'published'])->name('course.publish');

        Route::resource('level', LevelController::class)->except(['show', 'create']);
        Route::resource('tag', TagController::class)->except(['show', 'create']);
        Route::resource('category', CategoryController::class)->except(['show']);
        Route::resource('subjects', SubjectController::class)->except(['show']);
        Route::resource('sections', SectionController::class)->only(['store', 'edit', 'update', 'destroy']);
        Route::post('sections-order', [SectionController::class, 'sectionsOrder'])->name('course.sections.order');
        Route::resource('lessons', LessonController::class)->only(['store', 'edit', 'update', 'destroy']);
        Route::post('lessons-order', [LessonController::class, 'lessonOrder'])->name('section.lessons.order');
        Route::resource('faqs', FaqController::class)->only(['store', 'edit', 'update', 'destroy']);
        Route::resource('assignments', AssignmentController::class)->only(['store', 'edit', 'update', 'destroy']);
        Route::get('assignments-courses', [AssignmentController::class, 'assignmentsCourses'])->name('assignments.courses');

        Route::post('assignments-marks/{id}', [AssignmentController::class, 'assignmentMarks'])->name('assignments.marks.store');
        Route::get('submitted-student/{id}', [AssignmentController::class, 'studentList'])->name('submittedStudent.list');

        Route::get('assignments-list/{id}', [AssignmentController::class, 'assignmentsList'])->name('assignments.list');
        Route::resource('quizzes', QuizController::class)->only(['store', 'edit', 'update', 'destroy']);
        Route::get('exam-list/{slug}', [QuizController::class, 'quizList'])->name('exam.list');
        Route::get('exam-attend-list/{id}', [QuizController::class, 'examAttendList'])->name('exam.attend.list');
        Route::resource('quiz-questions', QuizQuestionController::class)->only(['store', 'edit', 'update', 'destroy']);
        Route::post('load-more-course', [AjaxController::class, 'loadInstructorCourse'])->name('load.more.course');

        Route::resource('books', BookController::class);
        Route::post('load-more-books', [AjaxController::class, 'loadInstructorBooks'])->name('load.more.books');

        Route::resource('expertise', ExpertiseController::class)->except(['show', 'create']);
        Route::resource('instructors', InstructorController::class);
        Route::resource('live-classes', LiveClassController::class)->only(['store', 'edit', 'update', 'destroy']);
        Route::resource('resources', ResourceController::class)->only(['store', 'edit', 'update', 'destroy']);
        Route::get('resources/{id}/download', [ResourceController::class, 'download'])->name('resources.download');

        //    manage students
        Route::resource('students', StudentController::class);
        Route::get('students/certificates/{id}', [StudentController::class, 'certificates'])->name('students.certificates');
        Route::get('students/instructors/{id}', [StudentController::class, 'instructors'])->name('students.instructors');
        Route::get('students/payments/{id}', [StudentController::class, 'payments'])->name('students.payments');
        Route::get('students/activity-logs/{id}', [StudentController::class, 'logs'])->name('students.activity.logs');
        Route::post('students-load-course', [StudentController::class, 'loadCourses'])->name('students.load.course');
        Route::post('students-load-certificates', [StudentController::class, 'loadCertificates'])->name('students.load.certificates');
        Route::get('certificates-download/{id}', [StudentController::class, 'certificateDownload'])->name('certificates.download');

        //blog posts
        Route::resource('blogs', BlogController::class)->except(['show']);
        Route::resource('blog-categories', BlogCategoryController::class)->except(['show']);

        Route::group(['as' => 'staffs.'], function () {
            Route::delete('staffs/delete/{id}', [StaffController::class, 'staffDelete'])->name('delete');
        });
        //book store
        Route::get('book-list', [BookController::class, 'index'])->name('backend.admin.book.index');

        /*----=========== Mobile app setting ======--------*/
        Route::resource('onboards', OnBoardController::class)->except(['show']);
        Route::resource('apikeys', ApiKeyController::class)->except(['show']);
        Route::get('android-setting', [MobileAppSettingController::class, 'androidSetting'])->name('android.setting');
        Route::get('ios-setting', [MobileAppSettingController::class, 'iosSetting'])->name('ios.setting');
        Route::get('mobile-home-screen', [MobileAppSettingController::class, 'homeScreenBuilder'])->name('mobile.home.screen');
        Route::get('mobile-gdpr', [MobileAppSettingController::class, 'gdpr'])->name('mobile.gdpr');
        Route::post('mobile-gdpr', [MobileAppSettingController::class, 'updateGdpr'])->name('mobile.gdpr');
        Route::resource('sliders', SliderController::class)->except(['show']);

        /*-----============ Email setting ========================= */
        Route::group(['as' => 'email.'], function () {
            Route::get('email/server-configuration', [EmailController::class, 'serverConfiguration'])->name('server-configuration');
            Route::put('email/server-configuration', [EmailController::class, 'serverConfigurationUpdate'])->name('server-configuration.update');
            Route::post('test/email', [EmailController::class, 'sendTestMail'])->name('test');
            Route::get('email/template', [EmailController::class, 'emailTemplate'])->name('template');
            Route::put('email-template/update', [EmailController::class, 'emailTemplateUpdate'])->name('template.update');
            Route::post('template-body', [EmailController::class, 'templateBody'])->name('template-body');
        });

        //media library
        Route::get('media-library', [MediaLibraryController::class, 'index'])->name('media-library.index');
        Route::post('add-media', [MediaLibraryController::class, 'store'])->name('media-library.store');
        Route::delete('delete-media', [MediaLibraryController::class, 'delete'])->name('media.destroy');

        Route::group(['prefix' => 'organizations'], function () {

            Route::delete('/{id}/delete', [OrganizationController::class, 'delete'])->name('organizations.delete');
            Route::get('/{org_id}/overview', [OrganizationController::class, 'overview'])->name('organizations.overview');
            Route::get('/{org_id}/payment', [OrganizationController::class, 'payment'])->name('organizations.payment');
            Route::get('/{org_id}/settings', [OrganizationController::class, 'settings'])->name('organizations.settings');
            Route::get('/{org_id}/courses', [CourseController::class, 'index'])->name('courses.organization');
            Route::get('/{org_id}/instructors', [InstructorController::class, 'index'])->name('instructors.organization');

            Route::get('/{org_id}/staff', [OrganizationStaffController::class, 'index'])->name('organizations.staff.index');
            Route::get('/{org_id}/staff/create', [OrganizationStaffController::class, 'create'])->name('organizations.staff.create');
            Route::post('/{org_id}/staff', [OrganizationStaffController::class, 'store'])->name('organizations.staff.store');
            Route::get('/{org_id}/staff/{id}/edit', [OrganizationStaffController::class, 'edit'])->name('organizations.staff.edit');

            Route::delete('/{org_id}/staff/{id}/delete', [OrganizationStaffController::class, 'delete'])->name('organizations.staff.delete');

            Route::put('/{org_id}/staff/{id}', [OrganizationStaffController::class, 'update'])->name('organizations.staff.update');

            Route::post('payouts/method-setting-update', [OrganizationController::class, 'paymentMethodUpdate'])->name('organizations.payouts.method-setting-update');
        });

        Route::group(['as' => 'users.'], function () {
            Route::post('user-status', [UserController::class, 'statusChange'])->name('status');
            Route::delete('users/delete/{id}', [UserController::class, 'instructorDelete'])->name('destroy');
        });
        Route::delete('delete-media', [MediaLibraryController::class, 'delete'])->name('media.destroy');

        //system setting
        Route::get('system-setting', [SystemSettingController::class, 'generalSetting'])->name('general.setting');
        Route::post('system-setting', [SystemSettingController::class, 'generalSettingUpdate'])->name('general.setting');

        Route::get('live-class-setting', [SystemSettingController::class, 'liveClassSetting'])->name('live.class.setting');
        Route::post('live-class-setting-store', [SystemSettingController::class, 'liveClassSettingSave'])->name('live.class.setting.store');

        //currency setting
        Route::resource('currencies', CurrencyController::class)->except(['show', 'update']);
        Route::post('currencies/update/{id}', [CurrencyController::class, 'update'])->name('currencies.update');
        Route::get('currencies/{id}/default-currency', [CurrencyController::class, 'setDefault'])->name('currencies.default-currency');
        Route::post('set-currency-format', [CurrencyController::class, 'setCurrencyFormat'])->name('set.currency.format');
        //cache
        Route::get('cache', [SystemSettingController::class, 'cache'])->name('admin.cache');
        Route::post('cache', [SystemSettingController::class, 'cacheUpdate'])->name('admin.cache');
        Route::get('cache-clear', [HomeController::class, 'cacheClear'])->name('cache.clear');
        //firebase setting
        Route::get('firebase', [SystemSettingController::class, 'firebase'])->name('admin.firebase');
        Route::post('firebase', [SystemSettingController::class, 'firebaseUpdate'])->name('admin.firebase');
        //firebase setting
        Route::get('refund-setting', [SystemSettingController::class, 'refund'])->name('admin.refund');
        Route::post('refund-setting', [SystemSettingController::class, 'saveRefundSetting'])->name('admin.refund');
        //preferences
        Route::get('preference', [SystemSettingController::class, 'preference'])->name('preference');

        //storage setting
        Route::get('storage-setting', [SystemSettingController::class, 'storageSetting'])->name('storage.setting');
        Route::post('storage-setting', [SystemSettingController::class, 'saveStorageSetting'])->name('storage.setting');

        //chat setting
        Route::get('chat-messenger', [SystemSettingController::class, 'chatMessenger'])->name('chat.messenger');
        Route::post('chat-messenger', [SystemSettingController::class, 'saveMessengerSetting'])->name('chat.messenger');

        //payment methods
        Route::get('payment-gateway', [SystemSettingController::class, 'paymentGateways'])->name('payment.gateway');
        Route::post('payment-gateway', [SystemSettingController::class, 'savePGSetting'])->name('payment.gateway');

        /*------==== wallet request ------------------======= */
        Route::get('wallet-request', [WalletRequestController::class, 'index'])->name('wallet.request');
        Route::post('wallet/status-change', [WalletRequestController::class, 'changeStatus'])->name('wallet.status.change');

        /*------==== Notification ------------------======= */
        //pusher notification
        Route::get('pusher-notification', [SystemSettingController::class, 'pusher'])->name('pusher.notification');
        Route::post('pusher-notification', [SystemSettingController::class, 'savePusherSetting'])->name('pusher.notification');
        //one signal notification
        Route::get('one-signal-notification', [SystemSettingController::class, 'oneSignal'])->name('onesignal.notification');
        Route::post('one-signal-notification', [SystemSettingController::class, 'saveOneSignalSetting'])->name('onesignal.notification');
        //custom notification
        Route::resource('custom-notification', CustomNotificationController::class)->except(['show']);

        //admin panel setting
        Route::get('panel-setting', [SystemSettingController::class, 'adminPanelSetting'])->name('admin.panel-setting');
        Route::post('panel-setting', [SystemSettingController::class, 'updateSetting'])->name('admin.panel-setting');
        // miscellaneous setting
        Route::get('miscellaneous-setting', [SystemSettingController::class, 'miscellaneousSetting'])->name('miscellaneous.setting');
        Route::post('miscellaneous-setting', [SystemSettingController::class, 'miscellaneousUpdate'])->name('miscellaneous.setting');

        //ai-setting
        Route::get('ai-writer-setting', [SystemSettingController::class, 'aiWriterSetting'])->name('ai_writer.setting');
        Route::post('ai-writer-setting', [AiWriterController::class, 'saveAiSetting'])->name('ai_writer.setting');
        Route::resource('countries', CountryController::class)->except(['create', 'show', 'update']);
        Route::post('countries/update/{id}', [CountryController::class, 'update'])->name('countries.update');
        Route::resource('states', StateController::class)->except(['create', 'show', 'update']);
        Route::post('states/update/{id}', [StateController::class, 'update'])->name('states.update');
        Route::resource('cities', CityController::class)->except(['create', 'show', 'update']);
        Route::post('cities/update/{id}', [CityController::class, 'update'])->name('cities.update');

        //otp setting
        Route::get('otp-setting', [OtpController::class, 'otpSetting'])->name('otp.setting');
        Route::post('otp-setting', [OtpController::class, 'saveOTP'])->name('otp.setting');
        Route::match(['get', 'post'], 'test-number-send', [OtpController::class, 'sendNumber'])->name('test.number.send');
        Route::get('sms-templates', [OtpController::class, 'smsTemplates'])->name('sms.templates');
        Route::post('sms-template', [OtpController::class, 'saveTemplate'])->name('save.template');

        //report
        Route::get('book-sale', [ReportController::class, 'bookSaleReport'])->name('backend.admin.report.book_sale');
        Route::get('course-sale', [ReportController::class, 'courseSaleReport'])->name('backend.admin.report.course_sale');
        Route::get('commission-history', [ReportController::class, 'commissionHistory'])->name('backend.admin.report.commission_history');
        Route::get('payment-history', [ReportController::class, 'paymentHistory'])->name('backend.admin.report.payment_history');
        Route::get('payout-history', [ReportController::class, 'payoutHistory'])->name('backend.admin.report.payout_history');
        Route::get('wishlist', [ReportController::class, 'wishlist'])->name('backend.admin.report.wishlist');

        //website setting
        Route::get('home-page', [WebsiteSettingController::class, 'homePage'])->name('home.page.builder');
        Route::post('home-page', [WebsiteSettingController::class, 'updateHomePage'])->name('home.page.builder');
        //website theme setting
        Route::get('website-themes', [WebsiteSettingController::class, 'themes'])->name('website.themes');
        Route::post('website-themes', [WebsiteSettingController::class, 'updateThemes'])->name('website.themes');
        //website theme options
        Route::get('theme-options', [WebsiteSettingController::class, 'themeOptions'])->name('theme.options');
        Route::post('theme-options', [WebsiteSettingController::class, 'updateThemesOptions'])->name('theme.options');

        //website header-menu
        Route::get('header-logo', [HeaderSettingController::class, 'headerLogo'])->name('header.logo');

        Route::get('header-topbar', [HeaderSettingController::class, 'headerTopbar'])->name('header.topbar');
        Route::get('header-menu', [HeaderSettingController::class, 'headerMenu'])->name('header.menu');

        //website hero
        Route::get('hero-section', [WebsiteSettingController::class, 'heroSection'])->name('hero.section');
        Route::post('hero-section', [WebsiteSettingController::class, 'updateHeroSection'])->name('hero.section');

        //website footer-content
        Route::get('footer-content', [FooterSettingController::class, 'footerContent'])->name('footer.content');

        Route::get('social-link-setting', [FooterSettingController::class, 'socialLinkSetting'])->name('footer.social-links');

        Route::post('social-link-setting', [FooterSettingController::class, 'saveSocialLinkSetting'])->name('footer.social-links');

        Route::get('newsletter-setting', [FooterSettingController::class, 'newsletterSetting'])->name('footer.newsletter-settings');

        Route::get('useful-link-setting', [FooterSettingController::class, 'usefulLinkSetting'])->name('footer.useful-links');

        Route::get('resource-link-setting', [FooterSettingController::class, 'resourceLinkSetting'])->name('footer.resource-links');

        Route::get('quick-link-setting', [FooterSettingController::class, 'quickLinkSetting'])->name('footer.quick-links');

        Route::get('apps-link-setting', [FooterSettingController::class, 'appsLinkSetting'])->name('footer.apps-links');

        Route::get('payment-banner-setting', [FooterSettingController::class, 'paymentbannerSetting'])->name('footer.payment-banner-settings');

        Route::get('copyright-setting', [FooterSettingController::class, 'copyrightSetting'])->name('footer.copyright');

        //website popup setting
        Route::get('website-popup', [WebsiteSettingController::class, 'popup'])->name('website.popup');
        Route::post('website-popup', [WebsiteSettingController::class, 'savePopupSetting'])->name('website.popup');

        //website popup setting
        Route::get('call-to-action', [WebsiteSettingController::class, 'callToAction'])->name('website.cta');
        Route::post('call-to-action', [WebsiteSettingController::class, 'saveCtaSetting'])->name('website.cta');

        //website popup setting
        Route::get('become-instructor-content', [WebsiteSettingController::class, 'instructorContent'])->name('website.instructor_content');
        Route::post('become-instructor-content', [WebsiteSettingController::class, 'saveInstructorContent'])->name('website.instructor_content');

        //website seo
        Route::get('website-seo', [WebsiteSettingController::class, 'seo'])->name('website.seo');
        Route::post('website-seo', [WebsiteSettingController::class, 'saveSeoSetting'])->name('website.seo');

        //website seo
        Route::get('google-setup', [WebsiteSettingController::class, 'google'])->name('google.setup');
        Route::post('google-setup', [WebsiteSettingController::class, 'saveGoogleSetup'])->name('google.setup');

        //custom js and css
        Route::get('custom-js', [WebsiteSettingController::class, 'customJs'])->name('custom.js');
        Route::get('custom-css', [WebsiteSettingController::class, 'customCss'])->name('custom.css');

        //facebook pixel
        Route::get('facebook-pixel', [WebsiteSettingController::class, 'fbPixel'])->name('fb.pixel');
        Route::post('facebook-pixel', [WebsiteSettingController::class, 'saveFbPixel'])->name('fb.pixel');

        //gdpr
        Route::get('gdpr', [WebsiteSettingController::class, 'gdpr'])->name('gdpr');
        Route::post('gdpr', [WebsiteSettingController::class, 'saveGdpr'])->name('gdpr');

        //success-story
        Route::resource('success-stories', SuccessStoryController::class)->except(['show']);

        //testimonials
        Route::resource('testimonials', TestimonialController::class)->except(['show']);

        //brands
        Route::resource('brands', BrandController::class)->except(['show']);

        /*------==== Marketing ------------------======= */
        //subscribers
        Route::resource('subscribers', SubscriberController::class)->only(['index', 'destroy']);
        //coupons
        Route::resource('coupons', CouponController::class)->except(['show']);
        //bulk sms
        Route::get('bulk-sms', [MarketingController::class, 'bulkSMS'])->name('bulk.sms');
        Route::post('bulk-sms', [MarketingController::class, 'sendBulkSms'])->name('bulk.sms');

        //server information
        Route::get('server-info', [UtilityController::class, 'serverInfo'])->name('server.info');
        Route::get('system-info', [UtilityController::class, 'serverInfo'])->name('system.info');
        Route::get('extension-library', [UtilityController::class, 'serverInfo'])->name('extension.library');
        Route::get('file-system-permission', [UtilityController::class, 'serverInfo'])->name('file.system.permission');

        //system update
        Route::get('system-update', [UtilityController::class, 'systemUpdate'])->name('system.update');
        Route::post('system-update', [UtilityController::class, 'downloadUpdate'])->name('system.update');

        //Support System
        Route::resource('tickets', TicketController::class)->except(['edit', 'destroy', 'show']);
        Route::get('tickets-update/{id}', [TicketController::class, 'update'])->name('tickets.update');
        Route::get('tickets/{id}', [TicketController::class, 'show'])->name('ticket.show');
        Route::post('ticket-reply', [TicketController::class, 'reply'])->name('ticket.reply');
        Route::get('ticket-reply-edit/{id}', [TicketController::class, 'replyEdit'])->name('ticket.reply.edit');
        Route::post('ticket-reply-update/{id}', [TicketController::class, 'replyUpdate'])->name('ticket.reply.update');
        Route::delete('ticket-reply-delete/{id}', [TicketController::class, 'replyDelete'])->name('ticket.reply.delete');
        Route::resource('departments', DepartmentController::class)->except(['show']);
        Route::resource('student-faqs', StudentFaqController::class)->except(['show']);

        //packages
        Route::resource('packages', PackageSolutionController::class)->except(['show']);
        Route::POST('packages/{subscribe}', [PackageSolutionController::class, 'PackageSubscribe'])->name('packages.subscribe');
        Route::get('packages/subscribe-list', [PackageSolutionController::class, 'PackageSubscribeList'])->name('packages.subscribe-list');

        //payouts route
        Route::resource('payouts', PayoutController::class)->except(['show']);
        Route::get('payouts/method-setting', [PayoutController::class, 'paymentMethod'])->name('payouts.method-setting');
        //        Route::post('payouts/method-setting-update', [PayoutController::class, 'instructorPaymentMethodUpdate'])->name('payouts.method-setting-update');

        Route::POST('payouts-complete/{id}', [PayoutController::class, 'paymentComplete'])->name('payouts.complete');
        Route::POST('payouts-approved/{id}', [PayoutController::class, 'paymentApproved'])->name('payouts.approved');
        Route::POST('payouts-declined/{id}', [PayoutController::class, 'paymentDecline'])->name('payouts.declined');

        //admin profile
        Route::get('profile', [AdminController::class, 'profile'])->name('user.profile');
        Route::patch('user-update', [AdminController::class, 'profileUpdate'])->name('user.update');
        Route::get('password-change', [AdminController::class, 'passwordChange'])->name('user.password-change');
        Route::post('password-update', [AdminController::class, 'passwordUpdate'])->name('user.password-update');
        //addons
        Route::resource('addon', AddonController::class)->only(['index', 'store']);

        //AI writer
        Route::get('ai-assistant', [AiWriterController::class, 'index'])->name('ai.assistant');
        Route::get('enrollments', [EnrollmentController::class, 'index'])->name('admin.enrollments');
        Route::post('bulk-enrollments', [EnrollmentController::class, 'store'])->name('bulk.enrollments');
        Route::delete('change/enrollment-status/{id}', [EnrollmentController::class, 'statusChange'])->name('enrollments.status');
        Route::get('enrollments/{id}', [EnrollmentController::class, 'statusChange'])->name('enrollments.show');
    });

    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified'], 'as' => 'languages.'], function () {
        Route::post('language-status', [LanguageController::class, 'statusChange'])->name('language-status');
        Route::post('language-direction-change', [LanguageController::class, 'directionChange'])->name('language-direction-change');

    });
    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified'], 'as' => 'users.'], function () {
        Route::get('users/verified/{verify}', [UserController::class, 'instructorVerified'])->name('verified');
        Route::get('users/ban/{id}', [UserController::class, 'instructorBan'])->name('ban');
    });
    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified'], 'as' => 'staffs.'], function () {
        Route::get('staffs/verified/{verify}', [StaffController::class, 'StaffVerified'])->name('verified');
        Route::get('staffs/bann/{id}', [StaffController::class, 'StaffBanned'])->name('bannUser');
    });
    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified']], function () {
        Route::post('generated-ai-content', [AiWriterController::class, 'generateContent'])->name('ai.content');
        Route::put('mobile-settings/update', [MobileAppSettingController::class, 'mobileSettingUpdate'])->name('mobile-settings.update');
        Route::post('update-home-screen', [MobileAppSettingController::class, 'updateHomeScreen'])->name('update.home.screen');
        Route::post('languages/{language}', [LanguageController::class, 'updateTranslations'])->name('admin.language.key.update');
        Route::delete('delete/home-section/{id}', [WebsiteSettingController::class, 'deleteHomeSection'])->name('delete.home.section');
        Route::post('update-footer-setting', [FooterSettingController::class, 'updateSetting'])->name('footer.update-setting');
        Route::post('update-footer-menu', [FooterSettingController::class, 'menuUpdate'])->name('footer.update-menu');
        Route::post('custom-css', [WebsiteSettingController::class, 'saveCustomCssAndJs'])->name('custom.css.js');
    });

    Route::post('apikeys/revoke', [ApiKeyController::class, 'revoke'])->name('apikeys.revoke');

    /* ajax request route without route permission for status */
    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified']], function () {
        Route::post('staffs-status', [StaffController::class, 'statusChange'])->name('staffs.status'); //staff status change
        Route::get('change-role', [StaffController::class, 'changeRole'])->name('staffs.change-role');
        Route::post('onboards-status', [OnBoardController::class, 'statusChange'])->name('onboards.status');
        Route::post('slider-status', [SliderController::class, 'statusChange'])->name('sliders.status');
        Route::post('organizations-status', [OrganizationController::class, 'statusChange'])->name('organizations.organizations-status');
        Route::post('currencies-status', [CurrencyController::class, 'statusChange'])->name('currencies.currencies-status');
        Route::post('countries-status', [CountryController::class, 'statusChange'])->name('countries.countries-status');
        Route::post('states-status', [StateController::class, 'statusChange'])->name('states.countries-status');
        Route::post('offline-method-status', [OfflineMethodController::class, 'statusChange'])->name('offline-method.status');
        Route::post('cities-status', [CityController::class, 'statusChange'])->name('cities.countries-status');
        Route::post('course-status', [CourseController::class, 'statusChange'])->name('course.status');
        Route::post('live-class-status', [LiveClassController::class, 'statusChange'])->name('live.class.status');
        Route::post('setting-status-change', [SystemSettingController::class, 'systemStatus'])->name('setting.status.change');
        Route::post('pages-status', [PageController::class, 'statusChange'])->name('page.status.change');
        Route::post('blog-category-status', [BlogCategoryController::class, 'statusChange'])->name('blog.category.status.change');
        Route::post('coupon-status', [CouponController::class, 'statusChange'])->name('coupon.status.change');
        Route::post('addon-status', [AddonController::class, 'statusChange'])->name('addon.status.change');
        Route::post('department-status', [DepartmentController::class, 'statusChange'])->name('department.status.change');
        Route::post('category-status', [CategoryController::class, 'statusChange'])->name('category.status.change');
        Route::post('category-feature', [CategoryController::class, 'featuredChange'])->name('category.feature.change');
        Route::post('subject-status', [SubjectController::class, 'statusChange'])->name('subject.status.change');
        Route::post('expertise-status', [ExpertiseController::class, 'statusChange'])->name('expertise.status.change');
        Route::post('level-status', [LevelController::class, 'statusChange'])->name('level.status.change');
        Route::post('tag-status', [TagController::class, 'statusChange'])->name('tag.status.change');
        Route::post('success-status', [SuccessStoryController::class, 'statusChange'])->name('success.status.change');
        Route::post('testimonial-status', [TestimonialController::class, 'statusChange'])->name('testimonial.status.change');
        Route::post('brand-status', [BrandController::class, 'statusChange'])->name('brand.status.change');
        Route::post('package-status', [PackageSolutionController::class, 'statusChange'])->name('package.status.change');
        Route::post('student-faq-status', [StudentFaqController::class, 'statusChange'])->name('student-faqs.status.change');
        Route::post('payout-status-change', [OrganizationController::class, 'methodStatus'])->name('payout.status.change');
        Route::post('payout-default-change', [OrganizationController::class, 'defaultMethod'])->name('payout.default.change');
    });
    //for ajax request
    Route::prefix('ajax')->as('ajax.')->middleware(['auth', 'verified'])->group(function () {
        Route::get('categories', [AjaxController::class, 'categories'])->name('categories');
        Route::get('users', [AjaxController::class, 'user'])->name('users');
        Route::get('instructors', [AjaxController::class, 'instructor'])->name('instructors');
        Route::get('organizations', [AjaxController::class, 'organizations'])->name('organizations');
        Route::get('success-stories', [AjaxController::class, 'successStory'])->name('stories');
        Route::get('selectedcourseID/{id}', [AjaxController::class, 'selectedCourse']);
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
