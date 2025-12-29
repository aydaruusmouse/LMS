<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Course;
use App\Models\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer(['frontend.layouts.header.header_one', 'frontend.layouts.header.header_two', 'frontend.layouts.header.header_three', 'frontend.cart'], function ($view) {
            if (auth()->check()) {
                $courses = Course::whereHas('carts', function ($query) {
                    $query->where('user_id', auth()->id());
                })->active()->get();
                if (addon_is_activated('book_store')) {
                    $books = Book::whereHas('carts', function ($query) {
                        $query->where('user_id', auth()->id());
                    })->active()->get();
                } else {
                    $books = [];
                }
            } else {
                $total_items = session()->get('carts');

                $course_ids  = $book_ids = [];

                if ($total_items) {
                    foreach ($total_items as $item) {
                        if ($item['type'] == 'course') {
                            $course_ids[] = $item['id'];
                        } else {
                            $book_ids[] = $item['id'];
                        }
                    }
                }
                $courses     = Course::whereIn('id', $course_ids)->get();
                $books       = addon_is_activated('book_store') ? Book::whereIn('id', $book_ids)->get() : [];
            }
            $carts = [
                'courses' => $courses,
                'books'   => $books,
            ];
            $view->with('carts', $carts);
        });
        View::composer(['frontend.layouts.header.header_one', 'frontend.layouts.header.header_two', 'frontend.layouts.header.header_three'], function ($view) {
            $view->with('categories', Category::with('language')->where('parent_id', 0)->where('type', 'course')->orderBy('ordering')->get());
        });
        View::composer(['frontend.profile.sidebar'], function ($view) {
            $view->with('count_notifications', Notification::where('user_id', auth()->id())->count());
        });
        View::composer(['frontend.home', 'frontend.layouts.master'], function ($view) {
            $section['header']      = 'header_one';
            $section['heroSection'] = 'hero_area_one';

            if (! empty(setting('header')) && setting('header') == 'header_two') {
                $section['header']      = 'header_two';
                $section['heroSection'] = 'hero_area_two';
            } elseif (! empty(setting('header')) && setting('header') == 'header_three') {
                $section['header']      = 'header_three';
                $section['heroSection'] = 'hero_area_three';
            }

            $view->with('section', $section);
        });
        view::composer(['backend.layouts.package_subscribe'], function ($view) {
            $notifications = Notification::latest()->with('user')->limit(5)->get();
            $view->with('notifications', $notifications);
        });
        view::composer(['frontend.layouts.base'], function ($view) {
            $meta = [
                'meta_title'          => setting('meta_title'),
                'meta_description'    => setting('meta_description'),
                'meta_keywords'       => setting('meta_keywords'),
                'meta_published_time' => now(),
                'meta_url'            => url()->current(),
                'meta_section'        => 'Home',
                'image_size'          => '1200',
                'meta_image'          => getFileLink('1200x630', setting('og_image')),
            ];

            if (request()->routeIs('instructor.details')) {
                $user                     = \App\Models\User::with('instructor')->whereHas('instructor', function ($query) {
                    $query->where('slug', request()->route()->parameters()['slug']);
                })->first();
                $instructor               = $user->instructor;

                $meta['meta_title']       = $user->name;
                $meta['meta_description'] = $user->about ?: $user->name.' Profile';
                $meta['meta_keywords']    = setting('meta_keywords').','.$user->name.','.$user->first_name.','.$user->last_name.','.$instructor->designation;
                $meta['meta_section']     = 'Instructor Profile';
                $meta['meta_image']       = getFileLink('417x384', $user->images);
                $meta['image_size']       = 300;
            }
            if (request()->routeIs('courses')) {
                $meta['meta_title']       = __('courses');
                $meta['meta_description'] = __('all_courses_page');
                $meta['meta_section']     = __('courses');
            }
            if (request()->routeIs('course.details')) {
                $course                   = Course::where('slug', request()->route()->parameters()['slug'])->first();
                $meta['meta_title']       = $course->meta_title ?: $course->title;
                $meta['meta_description'] = $course->meta_description ?: ($course->short_description ?: $course->description);
                $meta['meta_keywords']    = $course->meta_keywords ?: setting('meta_keywords').','.$course->title.','.$course->slug.','.$course->meta_title;
                $meta['meta_section']     = __('course');
                $meta['image_size']       = $course->meta_image ? 1200 : 400;
                $meta['meta_image']       = $course->meta_image ? getFileLink('1200x630', $course->meta_image) : getFileLink('402x248', $course->image);
            }
            if (request()->routeIs('blog')) {
                $meta['meta_title']       = __('blog');
                $meta['meta_description'] = __('all_blog_page');
                $meta['meta_section']     = __('blog');
            }
            if (request()->routeIs('blog-details')) {
                $blog                     = \App\Models\Blog::where('slug', request()->route()->parameters()['slug'])->first();
                $meta['meta_title']       = $blog->meta_title ?: $blog->title;
                $meta['meta_description'] = $blog->meta_description ?: ($blog->short_description ?: $blog->description);
                $meta['meta_keywords']    = $blog->meta_keywords ?: setting('meta_keywords').','.$blog->title.','.$blog->slug.','.$blog->meta_title;
                $meta['meta_section']     = __('blog');
                $meta['image_size']       = $blog->meta_image ? 1200 : 400;
                $meta['meta_image']       = $blog->meta_image ? getFileLink('1200x630', $blog->meta_image) : getFileLink('406x240', $blog->image);
            }
            $view->with('meta', $meta);
        });
    }
}
