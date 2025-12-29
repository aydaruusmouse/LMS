<?php

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 151);
            $table->string('attribute')->nullable();
            $table->mediumtext('keywords')->nullable();
            $table->timestamps();
        });

        $attributes       = [
            'roles'                  => [
                'view'   => 'roles.index',
                'create' => 'roles.create',
                'edit'   => 'roles.edit',
                'delete' => 'roles.destroy',
            ],
            'badge'                  => [
                'create' => 'badges.create',
                'edit'   => 'badges.edit',
                'delete' => 'badges.destroy',
            ],
            'blog_categories'        => [
                'view'   => 'blog-categories.index',
                'create' => 'blog-categories.create',
                'edit'   => 'blog-categories.edit',
                'delete' => 'blog-categories.destroy',
            ],
            'cities'                 => [
                'create' => 'cities.create',
                'edit'   => 'cities.edit',
                'delete' => 'cities.destroy',
            ],
            'contacts'               => [
                'create' => 'contacts.create',
                'edit'   => 'contacts.edit',
                'delete' => 'contacts.destroy',
            ],
            'coupons'                => [
                'view'   => 'coupons.index',
                'create' => 'coupons.create',
                'store'  => 'coupons.store',
                'delete' => 'coupons.destroy',
            ],
            'languages'              => [
                'view'                  => 'languages.index',
                'create'                => 'languages.create',
                'edit'                  => 'languages.edit',
                'delete'                => 'languages.destroy',
                'languages update'      => 'languages.update',
                'language translations' => 'language.translations.page',
                'update Trans'          => 'admin.language.key.update',
            ],
            'services'               => [
                'create' => 'services.create',
                'edit'   => 'services.edit',
                'delete' => 'services.destroy',
            ],
            'stats'                  => [
                'create' => 'stats.create',
                'edit'   => 'stats.edit',
                'delete' => 'stats.destroy',
            ],
            'Staff'                  => [
                'create'      => 'staffs.create',
                'view'        => 'staffs.index',
                'edit'        => 'staffs.edit',
                'roles'       => 'roles.index',
                'staffDelete' => 'delete',
                'changeRole'  => 'staffs.change-role',
            ],
            'organizations'          => [
                'view'                 => 'organizations.index',
                'show'                 => 'organizations.show',
                'create'               => 'organizations.create',
                'edit'                 => 'organizations.edit',
                'store'                => 'organizations.store',
                'organizations delete' => 'organizations.delete',
                'overview'             => 'organizations.overview',
                'payment'              => 'organizations.payment',
                'settings'             => 'organizations.settings',
                'courses'              => 'courses.organization',
                'instructors'          => 'instructors.organization',
                'payouts'              => 'organizations.payouts.method-setting-update',
            ],
            'pages'                  => [
                'view'         => 'pages.index',
                'create'       => 'pages.create',
                'edit'         => 'pages.edit',
                'delete'       => 'pages.destroy',
                'pages update' => 'pages.update',
            ],
            'courses'                => [
                'view course module' => 'view_course_module',
                'view'               => 'courses.index',
                'create'             => 'courses.create',
                'store'              => 'courses.store',
                'published'          => 'course.publish',
                'edit'               => 'courses.edit',
                'delete'             => 'courses.destroy',
                'course students'    => 'course.students',
                'course statistics'  => 'course.statistics',
            ],
            'levels'                 => [
                'create' => 'levels.create',
                'edit'   => 'levels.edit',
                'delete' => 'levels.destroy',
            ],
            'tags'                   => [
                'create' => 'tags.create',
                'edit'   => 'tags.edit',
                'delete' => 'tags.destroy',
            ],

            'AI'                     => [
                'view' => 'ai.writer',
            ],

            'category'               => [
                'create' => 'category.create',
                'edit'   => 'category.edit',
                'delete' => 'category.destroy',
            ],

            'subjects'               => [
                'create' => 'subjects.create',
                'edit'   => 'subjects.edit',
                'delete' => 'subjects.destroy',
            ],

            'sections'               => [
                'create'         => 'sections.create',
                'edit'           => 'sections.edit',
                'delete'         => 'sections.destroy',
                'sections order' => 'course.sections.order',
            ],
            'lessons'                => [
                'create'        => 'lessons.create',
                'edit'          => 'lessons.edit',
                'delete'        => 'lessons.destroy',
                'lessons order' => 'section.lessons.order',
            ],
            'faqs'                   => [
                'create' => 'faqs.create',
                'edit'   => 'faqs.edit',
                'delete' => 'faqs.destroy',
            ],
            'assignments'            => [
                'create' => 'assignments.create',
                'edit'   => 'assignments.edit',
                'delete' => 'assignments.destroy',
            ],
            'quizzes'                => [
                'create' => 'quizzes.create',
                'edit'   => 'quizzes.edit',
                'delete' => 'quizzes.destroy',
            ],
            'quiz-questions'         => [
                'create' => 'quiz-questions.create',
                'edit'   => 'quiz-questions.edit',
                'delete' => 'quiz-questions.destroy',
            ],
            'books'                  => [
                'edit'      => 'books.edit',
                'delete'    => 'books.destroy',
                'book list' => 'backend.admin.book.index',
            ],
            'expertise'              => [
                'create' => 'expertise.create',
                'edit'   => 'expertise.edit',
                'delete' => 'expertise.destroy',
            ],
            'instructor'             => [
                'view'   => 'instructors.index',
                'create' => 'instructors.create',
                'edit'   => 'instructors.edit',
                'show'   => 'instructors.show',
                'store'  => 'instructors.store',
                'update' => 'instructors.update',
                'delete' => 'instructors.destroy',
            ],
            'live-classes'           => [
                'create' => 'live-classes.create',
                'edit'   => 'live-classes.edit',
                'delete' => 'live-classes.destroy',
            ],
            'students'               => [
                'view student faq'           => 'student-faqs.index',
                'view'                       => 'students.index',
                'create'                     => 'students.create',
                'edit'                       => 'students.edit',
                'students certificates'      => 'students.certificates',
                'students instructors'       => 'students.instructors',
                'students payments'          => 'students.payments',
                'students activity'          => 'students.activity.logs',
                'students load-course'       => 'students.load.course',
                'students-load-certificates' => 'students.load.certificates',
            ],
            'blogs'                  => [
                'view'   => 'blogs.index',
                'create' => 'blogs.create',
                'edit'   => 'blogs.edit',
                'delete' => 'blogs.destroy',
            ],
            'On Board'               => [
                'view'   => 'onboards.index',
                'create' => 'onboards.create',
                'edit'   => 'onboards.edit',
                'delete' => 'onboards.destroy',
            ],
            'Api key'                => [
                'view'   => 'apikeys.index',
                'create' => 'apikeys.create',
                'edit'   => 'apikeys.edit',
                'delete' => 'apikeys.destroy',
            ],
            'mobile App'             => [
                'android'            => 'android.setting',
                'ios'                => 'ios.setting',
                'update'             => 'mobile-settings.update',
                'mobile home screen' => 'mobile.home.screen',
            ],
            'slider'                 => [
                'view'   => 'sliders.index',
                'create' => 'sliders.create',
                'edit'   => 'sliders.edit',
                'delete' => 'sliders.destroy',
            ],
            'email'                  => [
                'server configuration'        => 'email.server-configuration',
                'update server configuration' => 'email.server-configuration.update',
                'email template'              => 'email.template',
                'update template'             => 'auth-template.update',
            ],
            'media library'          => [
                'media'        => 'media-library.index',
                'add-media'    => 'media-library.store',
                'delete-media' => 'media.destroy',
            ],
            'users'                  => [
                'users verified' => 'verified',
                'users ban'      => 'ban',
                'user status'    => 'status',
                'users delete'   => 'delete',
                'delete-media'   => 'media.destroy',
            ],
            'system setting'         => [
                'general Setting' => 'general.setting',
                'currency'        => 'currencies.index',

            ],
            'currencies'             => [
                'view'                => 'currencies.index',
                'create'              => 'currencies.create',
                'edit'                => 'currencies.edit',
                'delete'              => 'currencies.destroy',
                'currencies update'   => 'currencies.update',
                'default currency'    => 'currencies.default-currency',
                'set currency format' => 'set.currency.format',
            ],
            'cache setting'          => [
                'cache'        => 'admin.cache',
                'cache update' => 'cache.update',
            ],
            'firebase setting'       => [
                'firebase'        => 'admin.firebase',
                'firebase Update' => 'firebase.update',
            ],

            'storage setting'        => [
                'storage setting' => 'storage.setting',
            ],

            'chat messenger'         => [
                'chat messenger' => 'chat.messenger',
            ],

            'refund setting'         => [
                'refund setting' => 'admin.refund',
            ],

            'miscellaneous setting'  => [
                'miscellaneous setting' => 'miscellaneous.setting',
                'miscellaneous update'  => 'admin.miscellaneous.update',
            ],

            'ai writer setting'      => [
                'ai writer setting' => 'ai_writer.setting',
            ],

            'preferences setting'    => [
                'preference' => 'preference',
            ],
            'storage'                => [
                'storage Setting' => 'storage.setting',
            ],
            'chat setting'           => [
                'chat Messenger' => 'chat.messenger',
            ],
            'payment methods'        => [
                'payouts method setting' => 'payouts.method-setting',
                'payment Gateways'       => 'payment.gateway',
            ],
            'Notification'           => [
                'pusher notification'     => 'pusher.notification',
                'one signal notification' => 'onesignal.notification',
            ],
            'custom-notification'    => [
                'view'   => 'custom-notification.index',
                'create' => 'custom-notification.create',
                'edit'   => 'custom-notification.edit',
                'delete' => 'custom-notification.destroy',
            ],
            'admin panel setting'    => [
                'admin Panel Setting' => 'admin.panel-setting',
                'update Setting'      => 'admin.panel-setting.update',
            ],
            'miscellaneous'          => [
                'miscellaneous setting' => 'miscellaneous.setting',
                'miscellaneous Update'  => 'admin.miscellaneous.update',
            ],

            'otp'                    => [
                'otp setting'  => 'otp.setting',
                'smsTemplates' => 'sms.templates',
                'saveTemplate' => 'save.template',
            ],
            'report'                 => [
                'book sale'          => 'backend.admin.report.book_sale',
                'course-sale'        => 'backend.admin.report.course_sale',
                'commission-history' => 'backend.admin.report.commission_history',
                'payment-history'    => 'backend.admin.report.payment_history',
                'payout-history'     => 'backend.admin.report.payout_history',
                'wishlist'           => 'backend.admin.report.wishlist',
            ],

            'website setting'        => [
                'home Page'             => 'home.page.builder',
                'update Home Page'      => 'update.home.page.builder',
                'website themes'        => 'website.themes',
                'theme options'         => 'theme.options',
                'update themes'         => 'update.themes',
                'Call to action'        => 'website.cta',
                'website setting popup' => 'website_setting.popup',
                'header logo'           => 'header.logo',
                'header content'        => 'header.content',
                'call to action'        => 'website_setting.cta',
                'header topbar'         => 'header.topbar',
                'header menu'           => 'header.menu',
                'hero-section'          => 'hero.section',
                'website-seo'           => 'website_setting.seo',
                'google setup'          => 'website_setting.google_setup',
                'custom css'            => 'website_setting.custom_css',
                'facebook pixel'        => 'website_setting.fb_pixel',
                'gdpr'                  => 'website_setting.gdpr',

            ],

            'website footer content' => [
                'footer content'         => 'footer.content',
                'social link setting'    => 'footer.social-links',
                'newsletter setting'     => 'footer.newsletter-settings',
                'useful link setting'    => 'footer.useful-links',
                'resource link setting'  => 'footer.resource-links',
                'quick link setting'     => 'footer.quick-links',
                'apps link setting'      => 'footer.apps-links',
                'payment banner setting' => 'footer.payment-banner-settings',
                'copyright setting'      => 'footer.copyright',
                'update footer setting'  => 'footer.update-setting',
                'update footer menu'     => 'footer.update-menu',
            ],

            'website popup setting'  => [
                'website popup' => 'website.popup',
            ],

            'website seo setting'    => [
                'website seo'  => 'website.seo',
                'google-setup' => 'google.setup',
            ],

            'custom js and css'      => [
                'custom js'            => 'custom.js',
                'custom css'           => 'custom.css',
                'save Custom CssAndJs' => 'custom.css.js',
            ],

            'facebook pixel'         => [
                'facebook-pixel' => 'fb.pixel',
            ],

            'gdpr'                   => [
                'gdpr' => 'gdpr',
            ],

            'success story'          => [
                'view'   => 'success-stories.index',
                'create' => 'success-stories.create',
                'edit'   => 'success-stories.edit',
                'delete' => 'success-stories.destroy',
            ],

            'testimonials'           => [
                'view'   => 'testimonials.index',
                'create' => 'testimonials.create',
                'edit'   => 'testimonials.edit',
                'delete' => 'testimonials.destroy',
            ],

            'brand'                  => [
                'view'   => 'brands.index',
                'create' => 'brands.create',
                'edit'   => 'brands.edit',
                'delete' => 'brands.destroy',
            ],

            'subscribers'            => [
                'view'   => 'subscribers.index',
                'create' => 'subscribers.create',
                'delete' => 'subscribers.destroy',
            ],

            'bulk sms'               => [
                'bulk sms' => 'bulk.sms',
            ],

            'server information'     => [
                'server info'            => 'server.info',
                'system info'            => 'system.info',
                'extension library'      => 'extension.library',
                'file system permission' => 'file.system.permission',
            ],

            'system update'          => [
                'system update' => 'system.update',
            ],

            'Support System'         => [
                'view'                => 'tickets.index',
                'create'              => 'tickets.create',
                'tickets update'      => 'tickets.update',
                'ticket reply'        => 'ticket.reply',
                'ticket reply edit'   => 'ticket.reply.edit',
                'ticket-reply-update' => 'ticket.reply.update',
                'ticket-reply-delete' => 'ticket.reply.delete',
            ],
            'departments'            => [
                'view'   => 'departments.index',
                'create' => 'departments.create',
                'edit'   => 'departments.edit',
                'delete' => 'departments.destroy',
            ],

            'packages'               => [
                'create'             => 'packages.create',
                'edit'               => 'packages.edit',
                'delete'             => 'packages.destroy',
                'packages-subscribe' => 'packages.subscribe',
            ],

            'accounts'               => [
                'bank accounts'       => 'bank-accounts.index',
                'view'                => 'accounts.index',
                'create'              => 'accounts.create',
                'edit'                => 'accounts.edit',
                'delete'              => 'accounts.destroy',
                'transaction history' => 'backend.admin.account.transaction_history',
            ],

            'income'                 => [
                'view'   => 'incomes.index',
                'create' => 'income.create',
                'edit'   => 'income.edit',
                'delete' => 'income.destroy',
            ],

            'expense'                => [
                'view'   => 'expenses.index',
                'create' => 'expense.create',
                'edit'   => 'expense.edit',
                'delete' => 'expense.destroy',
            ],

            'transfer'               => [
                'view'   => 'transfers.index',
                'create' => 'transfer.create',
                'edit'   => 'transfer.edit',
                'delete' => 'transfer.destroy',
            ],

            'deposit'                => [
                'create' => 'deposit.create',
                'edit'   => 'deposit.edit',
                'delete' => 'deposit.destroy',
            ],

            'payouts'                => [
                'view'                          => 'payouts.index',
                'create'                        => 'payouts.create',
                'edit'                          => 'payouts.edit',
                'delete'                        => 'payouts.destroy',
                'payouts method setting'        => 'payouts.method-setting',
                'payouts method setting update' => 'payouts.method-setting-update',
                'payouts complete'              => 'payouts.complete',
                'payouts-approved'              => 'payouts.approved',
                'payouts declined'              => 'payouts.declined',
            ],

            'categories'             => [
                'view category' => 'categories.index',
                'create'        => 'categories.create',
                'edit'          => 'categories.edit',
                'delete'        => 'categories.destroy',
            ],

            'expertises'             => [
                'view'   => 'expertise.index',
                'create' => 'expertises.create',
                'edit'   => 'expertises.edit',
                'delete' => 'expertises.destroy',
            ],

            'dashboard'              => [
                'dashboard'                => 'admin.dashboard',
                'dashboard statistics'     => 'dashboard_statistic',
                'total enrolment'          => 'view_enrolment_statistic',
                'total earning'            => 'view_total_earning',
                'total organization'       => 'view_total_organization',
                'total Course'             => 'view_total_course',
                'new student count'        => 'new_student_count',
                'new course count'         => 'view_new_course_count',
                'total sale statistic'     => 'total_sale_statistic',
                'total student statistic'  => 'total_student_statistic',
                'recent payout list'       => 'recent_payout_list',
                'best selling course list' => 'best_selling_course_list',
                'best instructor list'     => 'best_instructor_list',
                'manpower information'     => 'view_manpower_information',
                'sale information'         => 'sale_information',
                'earning statistic'        => 'view_earning_statistic',
            ],

            'addons'                 => [
                'view'   => 'addon.index',
                'create' => 'addon.create',
                'edit'   => 'addon.edit',
                'delete' => 'addon.destroy',
                'index'  => 'addon.index',
            ],

            'organization-panel'     => [
                'manage course'      => 'manage_course',
                'manage student'     => 'manage_student',
                'manage instructor'  => 'manage_instructor',
                'manage staff'       => 'manage_staff',
                'manage certificate' => 'mnage_certificate',
                'manage statement'   => 'manage_statement',
                'manage finance'     => 'finance',
            ],

            'utility'                => [
                'system update'          => 'system.update',
                'server information'     => 'server.info',
                'system info'            => 'system.info',
                'extension-library'      => 'extension.library',
                'file-system-permission' => 'file.system.permission',
            ],

        ];

        $admin_permission = [];

        Permission::whereNotNull('id')->delete();

        User::find(4)->update([
            'permissions' => ['admin.dashboard'],
        ]);

        foreach ($attributes as $key => $attribute) {
            $permission            = new Permission;
            $permission->name      = str_replace('_', ' ', $key);
            $permission->attribute = $key;
            $permission->keywords  = $attribute;
            $permission->save();
            foreach ($attribute as $index => $permit) {
                $admin_permission[] = trim($permit);
            }
            $user                  = User::first();
            $user->permissions     = $admin_permission;
            $user->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
};
