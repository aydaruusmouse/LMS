<?php

use App\Models\Permission;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        $permission                                 = Permission::where('attribute', 'dashboard')->first();

        $permissions                                = $permission->keywords;

        $permissions['total instructor statistic']  = 'total_instructor_statistic';
        $permission->update([
            'keywords' => $permissions,
        ]);

        $permission                                 = Permission::where('attribute', 'courses')->first();
        $keywords                                   = $permission->keywords;
        foreach ($keywords as $key => $keyword) {
            if ($keyword == 'view_course_module' || $keyword == 'courses.store') {
                unset($keywords[$key]);
            }
        }
        $permission->update([
            'keywords' => $keywords,
        ]);

        $permission                                 = Permission::where('attribute', 'category')->first();

        $permissions                                = $permission->keywords;

        $permissions['view']                        = 'category.index';
        $permission->update([
            'keywords' => $permissions,
        ]);

        $permission                                 = Permission::where('attribute', 'cities')->first();

        $permissions                                = $permission->keywords;

        $permissions['view']                        = 'cities.index';
        $permission->update([
            'keywords' => $permissions,
        ]);
        $permission                                 = Permission::where('attribute', 'levels')->first();

        $permissions                                = [
            'view'   => 'level.index',
            'create' => 'level.create',
            'edit'   => 'level.edit',
            'delete' => 'level.destroy',
        ];
        $permission->update([
            'keywords' => $permissions,
        ]);
        $permission                                 = Permission::where('attribute', 'tags')->first();

        $permissions                                = [
            'view'   => 'tag.index',
            'create' => 'tag.create',
            'edit'   => 'tag.edit',
            'delete' => 'tag.destroy',
        ];
        $permission->update([
            'keywords' => $permissions,
        ]);
        $permission                                 = Permission::where('attribute', 'subjects')->first();

        $permissions                                = $permission->keywords;

        $permissions['view']                        = 'subjects.index';
        $permission->update([
            'keywords' => $permissions,
        ]);
        $permission                                 = Permission::where('attribute', 'faqs')->first();

        $permissions                                = $permission->keywords;

        $permissions['view']                        = 'faqs.index';
        $permission->update([
            'keywords' => $permissions,
        ]);
        $permission                                 = Permission::where('attribute', 'assignments')->first();

        $permissions                                = $permission->keywords;

        $permissions['view']                        = 'assignments.index';
        $permission->update([
            'keywords' => $permissions,
        ]);
        $permission                                 = Permission::where('attribute', 'quizzes')->first();

        $permissions                                = $permission->keywords;

        $permissions['view']                        = 'quiz.index';
        $permission->update([
            'keywords' => $permissions,
        ]);
        $permission                                 = Permission::where('attribute', 'quiz-questions')->first();

        $permissions                                = $permission->keywords;

        $permissions['view']                        = 'quiz-questions.index';
        $permission->update([
            'keywords' => $permissions,
        ]);
        $permission                                 = Permission::where('attribute', 'expertise')->first();

        $permissions                                = $permission->keywords;

        $permissions['view']                        = 'expertise.index';
        $permission->update([
            'keywords' => $permissions,
        ]);
        $permission                                 = Permission::where('attribute', 'subscribers')->first();

        $permissions                                = $permission->keywords;
        foreach ($permissions as $key => $keyword) {
            if ($keyword == 'subscribers') {
                unset($permissions[$key]);
            }
        }
        $permission->update([
            'keywords' => $permissions,
        ]);
        $permission                                 = Permission::where('attribute', 'packages')->first();
        $permissions                                = $permission->keywords;
        $permissions['view']                        = 'packages.index';
        $permission->update([
            'keywords' => $permissions,
        ]);

        $permission                                 = Permission::where('attribute', 'students')->first();

        $permissions                                = [
            'view'             => 'students.index',
            'create'           => 'students.create',
            'edit'             => 'students.edit',
            'profile'          => 'students.show',
            'enrolled courses' => 'students.courses',
            'certificates'     => 'students.certificates',
            'payment history'  => 'students.payments',
            'login history'    => 'students.activity.logs',
        ];
        $permission->update([
            'keywords' => $permissions,
        ]);

        $permission                                 = Permission::where('attribute', 'instructor')->first();
        $permissions                                = $permission->keywords;
        foreach ($permissions as $key => $keyword) {
            if ($keyword == 'instructors.store' || $keyword == 'instructors.update') {
                unset($permissions[$key]);
            }
        }
        $permissions['delete']                      = 'users.destroy';
        $permission->update([
            'keywords' => $permissions,
        ]);

        $permission                                 = Permission::where('attribute', 'organizations')->first();
        $permissions                                = $permission->keywords;
        foreach ($permissions as $key => $keyword) {
            if ($keyword == 'organizations.store' || $keyword == 'organizations.delete' || $keyword == 'organizations.edit') {
                unset($permissions[$key]);
            }
        }
        $permissions['delete']                      = 'organizations.delete';
        $permissions['staff']                       = 'organizations.staff.index';
        $permission->update([
            'keywords' => $permissions,
        ]);
        $permission                                 = Permission::where('attribute', 'Staff')->first();
        $permissions                                = $permission->keywords;
        foreach ($permissions as $key => $keyword) {
            if ($keyword == 'delete' || $keyword == 'roles.index' || $keyword == 'staffs.change-role') {
                unset($permissions[$key]);
            }
        }
        $permissions['delete']                      = 'staffs.delete';
        $permission->update([
            'keywords' => $permissions,
        ]);
        $permission                                 = Permission::where('attribute', 'media library')->first();
        $permissions                                = $permission->keywords;
        foreach ($permissions as $key => $keyword) {
            if ($keyword == 'media-library.store') {
                unset($permissions[$key]);
            }
        }
        $permissions['add media']                   = 'media-library.create';
        $permission->update([
            'keywords' => $permissions,
        ]);
        $permission                                 = Permission::where('attribute', 'payouts')->first();
        $permissions                                = $permission->keywords;
        foreach ($permissions as $key => $keyword) {
            if ($keyword == 'payouts.complete' || $keyword == 'payouts.approved' || $keyword == 'payouts.declined') {
                unset($permissions[$key]);
            }
        }
        $permission->update([
            'keywords' => $permissions,
        ]);
        $permission                                 = Permission::where('attribute', 'custom-notification')->first();
        $permissions                                = $permission->keywords;
        foreach ($permissions as $key => $keyword) {
            if ($keyword == 'custom-notification.edit') {
                unset($permissions[$key]);
            }
        }
        $permission->update([
            'keywords' => $permissions,
        ]);
        $permission                                 = Permission::where('attribute', 'Support System')->first();
        $permissions                                = $permission->keywords;
        foreach ($permissions as $key => $keyword) {
            if ($keyword == 'ticket.reply.update' || $keyword == 'tickets.update') {
                unset($permissions[$key]);
            }
        }
        $permission->update([
            'keywords' => $permissions,
        ]);
        $permission                                 = Permission::where('attribute', 'coupons')->first();
        $permissions                                = $permission->keywords;
        foreach ($permissions as $key => $keyword) {
            if ($keyword == 'coupons.store') {
                unset($permissions[$key]);
            }
        }
        $permissions['edit']                        = 'coupons.edit';
        $permission->update([
            'keywords' => $permissions,
        ]);
        $permission                                 = Permission::where('attribute', 'Api key')->first();
        $permissions                                = $permission->keywords;
        foreach ($permissions as $key => $keyword) {
            if ($keyword == 'apikeys.destroy') {
                unset($permissions[$key]);
            }
        }
        $permissions['revoke']                      = 'apikeys.revoke';
        $permission->update([
            'keywords' => $permissions,
        ]);

        $permission                                 = Permission::where('attribute', 'mobile App')->first();
        $permissions                                = $permission->keywords;
        foreach ($permissions as $key => $keyword) {
            if ($keyword == 'mobile-settings.update') {
                unset($permissions[$key]);
            }
        }
        $permissions['gdpr']                        = 'mobile.gdpr';
        $permission->update([
            'keywords' => $permissions,
        ]);
        $permission                                 = Permission::where('attribute', 'pages')->first();
        $permissions                                = $permission->keywords;
        foreach ($permissions as $key => $keyword) {
            if ($keyword == 'pages.update') {
                unset($permissions[$key]);
            }
        }
        $permission->update([
            'keywords' => $permissions,
        ]);

        $permission                                 = Permission::where('attribute', 'email')->first();
        $permissions                                = $permission->keywords;
        foreach ($permissions as $key => $keyword) {
            if ($keyword == 'email.server-configuration.update' || $keyword == 'auth-template.update') {
                unset($permissions[$key]);
            }
        }
        $permissions['update server configuration'] = 'email.server-configuration.edit';
        $permissions['update template']             = 'auth-template.edit';
        $permission->update([
            'keywords' => $permissions,
        ]);
        $permission                                 = Permission::where('attribute', 'utility')->first();
        $permissions                                = $permission->keywords;
        foreach ($permissions as $key => $keyword) {
            if ($keyword == 'system.update') {
                unset($permissions[$key]);
            }
        }
        $permissions['system update']               = 'system.edit';
        $permission->update([
            'keywords' => $permissions,
        ]);
        $permission                                 = Permission::where('attribute', 'system setting')->first();
        $permission->update([
            'keywords' => [
                'general Setting'     => 'general.setting',
                'cache setting'       => 'admin.cache',
                'preferences setting' => 'preference',
                'admin panel setting' => 'admin.panel-setting',
                'storage'             => 'storage.setting',
                'miscellaneous'       => 'miscellaneous.setting',
                'ai writer setting'   => 'ai_writer.setting',
                'refund setting'      => 'admin.refund',
            ],
        ]);
        $permission                                 = Permission::where('attribute', 'addons')->first();
        $permissions                                = [
            'view'    => 'addon.index',
            'install' => 'addon.create',
            'edit'    => 'addon.edit',
        ];

        $permission->update([
            'keywords' => $permissions,
        ]);
        $permission                                 = Permission::where('attribute', 'currencies')->first();
        $permissions                                = $permission->keywords;
        foreach ($permissions as $key => $keyword) {
            if ($keyword == 'currencies.update') {
                unset($permissions[$key]);
            }
        }
        $permissions['system update']               = 'system.edit';
        $permission->update([
            'keywords' => $permissions,
        ]);
        //delete unused permissions
        $deleted_permissions                        = [
            'accounts',
            'income',
            'expense',
            'transfer',
            'deposit',
            'system update',
            'server information',
            'books',
            'live-classes',
            'users',
            'badge',
            'cache setting',
            'admin panel setting',
            'storage setting',
            'storage',
            'miscellaneous',
            'miscellaneous setting',
            'ai writer setting',
            'refund setting',
            'preferences setting',
            'firebase setting',
            'chat messenger',
            'chat setting',
            'website popup setting',
            'website seo setting',
            'custom js and css',
            'facebook pixel',
            'gdpr',
        ];
        Permission::whereIn('attribute', $deleted_permissions)->delete();
        //create new permissions which are missing
        $now                                        = now();
        $insert_data                                = [
            [
                'name'       => 'Certificates',
                'attribute'  => 'certificates',
                'created_at' => $now,
                'updated_at' => $now,
                'keywords'   => json_encode([
                    'view' => 'certificates.index',
                    'edit' => 'certificates.edit',
                ]),
            ],
            [
                'name'       => 'Payment Gateway',
                'attribute'  => 'payment gateway',
                'created_at' => $now,
                'updated_at' => $now,
                'keywords'   => json_encode([
                    'update' => 'payment.gateway',
                ]),
            ],
            [
                'name'       => 'Wallet Request',
                'attribute'  => 'wallet request',
                'created_at' => $now,
                'updated_at' => $now,
                'keywords'   => json_encode([
                    'view'          => 'wallet.request',
                    'change status' => 'wallet.status.change',
                ]),
            ],
            [
                'name'       => 'Student Faqs',
                'attribute'  => 'student faqs',
                'created_at' => $now,
                'updated_at' => $now,
                'keywords'   => json_encode([
                    'view'   => 'student-faqs.index',
                    'create' => 'student-faqs.create',
                    'edit'   => 'student-faqs.edit',
                    'delete' => 'student-faqs.destroy',
                ]),
            ],
            [
                'name'       => 'Offline Payment',
                'attribute'  => 'offline payment',
                'created_at' => $now,
                'updated_at' => $now,
                'keywords'   => json_encode([
                    'view'   => 'offline-methods.index',
                    'create' => 'offline-methods.create',
                    'edit'   => 'offline-methods.edit',
                    'delete' => 'offline-methods.destroy',
                ]),
            ],
            [
                'name'       => 'Country',
                'attribute'  => 'country',
                'created_at' => $now,
                'updated_at' => $now,
                'keywords'   => json_encode([
                    'view'   => 'countries.index',
                    'create' => 'countries.create',
                    'edit'   => 'countries.edit',
                    'delete' => 'countries.destroy',
                ]),
            ],
            [
                'name'       => 'State',
                'attribute'  => 'state',
                'created_at' => $now,
                'updated_at' => $now,
                'keywords'   => json_encode([
                    'view'   => 'states.index',
                    'create' => 'states.create',
                    'edit'   => 'states.edit',
                    'delete' => 'states.destroy',
                ]),
            ],
            [
                'name'       => 'City',
                'attribute'  => 'city',
                'created_at' => $now,
                'updated_at' => $now,
                'keywords'   => json_encode([
                    'view'   => 'cities.index',
                    'create' => 'cities.create',
                    'edit'   => 'cities.edit',
                    'delete' => 'cities.destroy',
                ]),
            ],
        ];
        Permission::insert($insert_data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
