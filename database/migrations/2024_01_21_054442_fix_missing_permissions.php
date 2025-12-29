<?php

use App\Models\Permission;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permission                    = Permission::where('attribute', 'website setting')->first();

        $permission->update([
            'keywords' => [
                'website themes'     => 'website.themes',
                'theme options'      => 'theme.options',
                'header content'     => 'header.logo',
                'header topbar'      => 'header.topbar',
                'header menu'        => 'header.menu',
                'hero-section'       => 'hero.section',
                'Call to action'     => 'website.cta',
                'website popup'      => 'website.popup',
                'website-seo'        => 'website.seo',
                'custom css'         => 'custom.css',
                'custom js'          => 'custom.js',
                'instructor content' => 'website.instructor_content',
                'google setup'       => 'google.setup',
                'fb pixel'           => 'fb.pixel',
                'gdpr'               => 'gdpr',
                'firebase'           => 'admin.firebase',
                'chat messenger'     => 'chat.messenger',
                'home page builder'  => 'home.page.builder',
            ],
        ]);

        $permission                    = Permission::where('attribute', 'website footer content')->first();
        $permissions                   = $permission->keywords;
        foreach ($permissions as $key => $keyword) {
            if ($keyword == 'footer.social-links' || $keyword == 'footer.update-setting' || $keyword == 'footer.update-menu') {
                unset($permissions[$key]);
            }
        }
        $permissions['footer content'] = 'footer.social-links';
        $permission->update([
            'keywords' => $permissions,
        ]);

        Permission::create([
            'name'      => 'enrollment history',
            'attribute' => 'enrollment history',
            'keywords'  => [
                'index'         => 'admin.enrollments',
                'create'        => 'bulk.enrollments',
                'change status' => 'enrollments.status',
            ],
        ]);
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
