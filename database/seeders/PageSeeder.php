<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageLanguage;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = Page::create([
            'id'         => 100,
            'title'      => 'Privacy Policy',
            'content'    => 'Privacy Policy Content',
            'type'       => 'error_page_404',
            'link'       => '#',
            'meta_title' => 'Meta Title',
            'status'     => '1',
        ]);

        PageLanguage::create([
            'page_id'       => $page->id,
            'lang'          => 'en',
            'title'         => $page->title,
            'content'       => $page->content,
            'meta_title'    => $page->meta_title,
            'meta_keywords' => $page->meta_keywords,
        ]);

        $page = Page::create([
            'id'         => 101,
            'title'      => 'Terms And Conditions',
            'content'    => 'Terms And Conditions Content',
            'type'       => 'error_page_403',
            'link'       => '#',
            'meta_title' => 'Meta Title',
            'status'     => '1',
        ]);

        PageLanguage::create([
            'page_id'       => $page->id,
            'lang'          => 'en',
            'title'         => $page->title,
            'content'       => $page->content,
            'meta_title'    => $page->meta_title,
            'meta_keywords' => $page->meta_keywords,
        ]);

        $page = Page::create([
            'id'         => 102,
            'title'      => 'About Us',
            'content'    => 'About Us Content',
            'type'       => 'error_page_500',
            'link'       => '#',
            'meta_title' => 'Meta Title',
            'status'     => '1',
        ]);

        PageLanguage::create([
            'page_id'       => $page->id,
            'lang'          => 'en',
            'title'         => $page->title,
            'content'       => $page->content,
            'meta_title'    => $page->meta_title,
            'meta_keywords' => $page->meta_keywords,
        ]);

        $page = Page::create([
            'id'         => 103,
            'title'      => 'Help And Support',
            'content'    => 'Help And Support Content',
            'type'       => 'error_page_500',
            'link'       => '#',
            'meta_title' => 'Meta Title',
            'status'     => '1',
        ]);

        PageLanguage::create([
            'page_id'       => $page->id,
            'lang'          => 'en',
            'title'         => $page->title,
            'content'       => $page->content,
            'meta_title'    => $page->meta_title,
            'meta_keywords' => $page->meta_keywords,
        ]);

    }
}
