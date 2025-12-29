<?php

use App\Models\Role;
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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->text('permissions')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0 inactive, 1 active');
            $table->timestamps();
        });
        $now  = now();
        Role::create([
            'name'        => 'Admin',
            'slug'        => 'admin',
            'permissions' => [
                'roles.create', 'roles.edit', 'roles.destroy', 'badges.create', 'badges.edit', 'badges.destroy', 'blog-categories.create',
                'blog-categories.edit', 'blog-categories.destroy', 'cities.create', 'cities.edit', 'cities.destroy', 'contacts.create',
                'contacts.edit', 'contacts.destroy', 'coupons.create', 'coupons.store', 'coupons.destroy', 'languages.create', 'languages.edit',
                'languages.destroy', 'languages.update', 'language.translations.page', 'admin.language.key.update', 'services.create', 'services.edit',
                'services.destroy', 'stats.create', 'stats.edit', 'stats.destroy', 'staffs.create', 'staffs.edit', 'staffs.destroy', 'organizations.create',
                'organizations.edit', 'organizations.destroy', 'organizations.delete', 'organizations.overview', 'organizations.payment', 'organizations.settings',
                'courses.organization', 'instructors.organization', 'organizations.payouts.method-setting-update', 'pages.create', 'pages.edit', 'pages.destroy',
                'pages.update', 'courses.create', 'courses.edit', 'courses.destroy', 'course.students', 'course.statistics', 'levels.create', 'levels.edit', 'levels.destroy',
                'tags.create', 'tags.edit', 'tags.destroy', 'category.create', 'category.edit', 'category.destroy', 'subjects.create', 'subjects.edit', 'subjects.destroy',
                'sections.create', 'sections.edit', 'sections.destroy', 'course.sections.order', 'lessons.create', 'lessons.edit', 'lessons.destroy', 'section.lessons.order',
                'faqs.create', 'faqs.create', 'faqs.edit', 'faqs.destroy', 'assignments.create', 'assignments.edit', 'assignments.destroy', 'quizzes.create', 'quizzes.edit',
                'quizzes.destroy', 'quiz-questions.create', 'quiz-questions.edit', 'quiz-questions.destroy', 'books.edit', 'books.destroy', 'backend.admin.book.index',
                'expertise.create', 'expertise.edit', 'expertise.destroy', 'instructors.create', 'instructors.edit', 'instructors.destroy', 'live-classes.create',
                'live-classes.edit', 'live-classes.destroy', 'students.create', 'students.edit', 'students.show', 'students.certificates', 'students.instructors', 'students.payments',
                'students.activity.logs', 'students.load.course', 'students.load.certificates', 'blogs.create', 'blogs.edit', 'blogs.destroy', 'onboards.create',
                'onboards.edit', 'onboards.destroy', 'apikeys.create', 'apikeys.edit', 'apikeys.destroy', 'android.setting', 'ios.setting', 'mobile-settings.update',
                'sliders.create', 'sliders.edit', 'sliders.destroy', 'email.server-configuration', 'email.server-configuration.update', 'email.template', 'auth-template.update',
                'media-library.index', 'media-library.store', 'media.destroy', 'verified', 'ban', 'status', 'delete', 'media.destroy', 'general.setting', 'general.setting-update',
                'currencies.create', 'currencies.edit', 'currencies.destroy', 'currencies.update', 'currencies.default-currency', 'set.currency.format', 'admin.cache',
                'cache.update', 'admin.firebase', 'firebase.update', 'preference', 'storage.setting', 'chat.messenger', 'payment.gateway', 'pusher.notification', 'onesignal.notification',
                'custom-notification.create', 'custom-notification.edit', 'custom-notification.destroy', 'admin.panel-setting', 'admin.panel-setting.update',
                'miscellaneous.setting', 'admin.miscellaneous.update', 'otp.setting', 'sms.templates', 'save.template', 'backend.admin.report.book_sale',
                'backend.admin.report.course_sale', 'backend.admin.report.commission_history', 'backend.admin.report.payment_history', 'backend.admin.report.payout_history',
                'backend.admin.report.wishlist', 'home.page.builder', 'update.home.page.builder', 'website.themes', 'theme.options', 'header.logo', 'header.content',
                'header.topbar', 'header.menu', 'hero.section', 'footer.content', 'footer.social-links', 'footer.newsletter-settings', 'footer.useful-links',
                'footer.resource-links', 'footer.quick-links', 'footer.apps-links', 'footer.payment-banner-settings', 'footer.copyright', 'footer.update-setting',
                'footer.update-menu', 'website.popup', 'website.seo', 'google.setup', 'custom.js', 'custom.css', 'custom.css.js', 'fb.pixel', 'gdpr', 'success-stories.create',
                'success-stories.edit', 'success-stories.destroy', 'testimonials.create', 'testimonials.edit', 'testimonials.destroy', 'brands.create', 'brands.edit',
                'brands.destroy', 'subscribers.create', 'subscribers.destroy', 'bulk.sms', 'server.info', 'system.info', 'extension.library', 'file.system.permission',
                'system.update', 'tickets.create', 'tickets.update', 'ticket.reply', 'ticket.reply.edit', 'ticket.reply.update', 'ticket.reply.delete', 'departments.create',
                'departments.edit', 'departments.destroy', 'packages.create', 'packages.edit', 'packages.destroy', 'packages.subscribe', 'accounts.create', 'accounts.edit',
                'accounts.destroy', 'backend.admin.account.transaction_history', 'income.create', 'income.edit', 'income.destroy', 'expense.create', 'expense.edit',
                'expense.destroy', 'transfer.create', 'transfer.edit', 'transfer.destroy', 'deposit.create', 'deposit.edit', 'deposit.destroy', 'payouts.create',
                'payouts.edit', 'payouts.destroy', 'payouts.method-setting', 'payouts.method-setting-update', 'payouts.complete', 'payouts.approved', 'payouts.declined',
                'categories.create', 'categories.edit', 'categories.destroy', 'expertises.create', 'expertises.edit', 'expertises.destroy', 'admin.dashboard', 'mobile.home.screen',
                'addon.index', 'addon.create',
            ],
        ]);
        Role::create([
            'name'        => 'Instructor',
            'slug'        => 'instructor',
            'permissions' => [
                'instructors.create', 'instructors.edit', 'payouts.create', 'payouts.edit', 'payouts.destroy', 'payouts.method-setting',
                'payouts.method-setting-update', 'students.create', 'students.show', 'students.edit', 'students.certificates', 'students.instructors', 'students.payments',
                'students.activity.logs', 'students.load.course', 'students.load.certificates', 'courses.organization', 'courses.create',
                'courses.destroy', 'course.students', 'course.statistics', 'sections.create', 'sections.edit', 'sections.destroy', 'course.sections.order', 'lessons.create',
                'lessons.edit', 'lessons.destroy', 'section.lessons.order', 'faqs.create', 'faqs.create', 'faqs.edit', 'faqs.destroy', 'assignments.create', 'assignments.edit',
                'assignments.destroy', 'quizzes.create', 'quizzes.edit', 'quizzes.destroy', 'quiz-questions.create', 'quiz-questions.edit', 'quiz-questions.destroy',
                'expertise.create', 'expertise.edit', 'expertise.destroy',
            ],
        ]);
        $data = [
            [
                'name'        => 'Student',
                'slug'        => 'student',
                'created_at'  => $now,
                'updated_at'  => $now,
                'permissions' => '[]',
            ],
            [
                'name'        => 'Staff',
                'slug'        => 'staff',
                'created_at'  => $now,
                'updated_at'  => $now,
                'permissions' => '[]',
            ],
            [
                'name'        => 'organization-staff',
                'slug'        => 'organization-staff',
                'created_at'  => $now,
                'updated_at'  => $now,
                'permissions' => '[]',
            ],
        ];
        Role::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
