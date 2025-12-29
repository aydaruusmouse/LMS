@extends('frontend.layouts.master')
@section('title', __('about'))
@section('content')
    <!--====== Start Recently Viewed Courses Section ======-->
    <section class="recently-viewed-courses-section p-t-50 p-t-sm-30 p-b-50 p-b-md-20">
        <div class="container container-1278">
            <div class="row">
                @include('frontend.profile.sidebar')
                <div class="col-md-8">
                    <div class="recently-viewed-courses-wrapper">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title-v3 color-dark m-b-40 m-b-sm-20">
                                    <h3>{{__('recently_viewed') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="course-items-wrap">
                            <div class="row course-items-v3">
                                @if(count($recent_view_courses)>0)
                                    @foreach($recent_view_courses as $recent_view_course)
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="course-item">
                                                <a href="#" class="course-item-thumb">
                                                    <img
                                                        src="{{ getFileLink('402x248', $recent_view_course->course->image) }}"
                                                        alt="{{ $recent_view_course->course->title }}">
                                                    <span
                                                        class="course-badge">{{ $recent_view_course->course->category->lang_title }} </span>
                                                </a>
                                                <div class="course-item-body">
                                                    <ul class="course-item-info justify-content-end">
                                                        <li class="rating-review">
                                                            <span class="total-review"><i class="fas fa-star"></i> {{ number_format($recent_view_course->course->total_rating,2) }}</span>
                                                        </li>
                                                    </ul>
                                                    <h4 class="title">
                                                        <a href="{{ ($recent_view_course->course->slug ? route('course.details', $recent_view_course->course->slug): '#') }}">{{ $recent_view_course->course->title }}</a>
                                                    </h4>
                                                    <ul class="course-item-info">
                                                        <li>
                                                            <i class="fal fa-file-alt"></i> {{ $recent_view_course->course->total_lesson }} {{__('lessons') }}
                                                        </li>
                                                        <li>
                                                            <i class="fal fa-user-friends"></i> {{ $recent_view_course->course->total_enrolled }} {{__('enroll') }}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="course-item-footer">
                                                    <div
                                                        class="course-price">{{ get_price($recent_view_course->course->discount_amount, userCurrency()) }}</div>
                                                    <ul>
                                                        <li>
                                                            <a href="{{ ($recent_view_course->course->slug ? route('course.details', $recent_view_course->course->slug): '#') }}"
                                                               class="template-btn">{{__('details')}}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    @include('frontend.not_found',$data=['title'=> 'courses'])
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Recently Viewed Courses Section ======-->
@endsection
