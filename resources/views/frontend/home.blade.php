@extends('frontend.layouts.master')
@section('title', __('home'))
@section('base.content')
    <!--====== Start Hero Area ======-->
    @include('frontend.layouts.header.'.$section['header'])
    @include('frontend.homePage.hero_area.'.$section['heroSection'])
    <!--====== End Hero Area ======-->
    @foreach($sections as $key=> $section)
        <!--====== Start Top Courses Section ======-->
        @if($section->section == 'top_courses')
            @include('frontend.homePage.top_course')
        @endif
        <!--====== End Top Courses Section ======-->

        @if($section->section == 'fun_fact')
            <!--====== Start Achievement Section ======-->
            @include('frontend.homePage.achievment', compact('section'))
            <!--====== End Achievement Section ======-->
        @endif
        <!--====== Start Course Subject Section ======-->
        @if($section->section == 'subject')
            @include('frontend.homePage.subject')
        @endif
        <!--====== End Course Subject Section ======-->

        <!--====== Start Pricing Section ======-->
{{--        @if($section->section == 'service_pricing')--}}
{{--            @include('frontend.homePage.pricing')--}}
{{--        @endif--}}
        <!--====== End Pricing Section ======-->

        <!--====== Start Success Story Section ======-->
        @if($section->section == 'success_story')
            @include('frontend.homePage.success')
        @endif
        <!--====== End Success Story Section ======-->

        <!--====== Start Counter Section ======-->
        @if($section->section == 'counter_section')
            @include('frontend.homePage.counter')
        @endif
        <!--====== End Counter Section ======-->

        <!--====== Start Our Instructor Section ======-->
        @if($section->section == 'instructors')
            @include('frontend.homePage.instructor')
        @endif
        <!--====== End Our Instructor Section ======-->

        <!--====== Start Lesson with Mentor Section ======-->
        @if($section->section == 'lesson_with_mentor')
            @include('frontend.homePage.lesson_with_mentor')
        @endif
        <!--====== End Lesson with Mentor Section ======-->

        <!--====== Start Recent Videos Section ======-->
        @if($section->section == 'video_slider')
            @include('frontend.homePage.video', compact('section'))
        @endif
        <!--====== End Recent Videos Section ======-->
        <!--====== Start Course Lesson Section ======-->
        @if($section->section == 'single_course')
            @include('frontend.homePage.single_course')
        @endif
        <!--====== End Course Lesson Section ======-->
        <!--====== Start Featured Course Section ======-->
        @if($section->section == 'featured_course')
            @include('frontend.homePage.featured_course')
        @endif
        <!--====== End Featured Course Section ======-->

        <!--====== Start Featured Blog Section ======-->
        @if($section->section == 'blog_news')
            @include('frontend.homePage.blog_news')
        @endif
        <!--====== End Featured Blog Section ======-->

        <!--====== start Student testimonial Section ======-->
        @if($section->section == 'testimonial')
            @include('frontend.homePage.testimonial')
        @endif
        <!--====== End Student testimonial Section ======-->

        <!--====== Start Become Instructor Section ======-->
        @if(!Auth::check() || auth()->user()->role_id == 3)
            @if($section->section == 'become_instructor')
                @include('frontend.homePage.become_instructor', compact('section'))
            @endif
        @endif
        <!--====== End Become Instructor Section ======-->

        <!--====== Start Brands Section ======-->
        @if($section->section == 'partner_logo')
            @include('frontend.homePage.partner', compact('section'))
        @endif
        <!--====== End Brands Section ======-->
    @endforeach

    @include('frontend.homePage.cta')

    @include('frontend.layouts.footer')
@endsection

