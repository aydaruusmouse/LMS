@extends('frontend.layouts.master')
@section('title', __('home'))
@section('content')
<!--====== Start Blog Standard Loop ======-->
<section class="blog-area p-t-50 p-t-sm-30 p-b-80 p-b-md-30">
    <div class="container container-1278">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-details-content blog-details-content-v2">
                   <ul class="post-meta">
                        <li><a href="#"><i class='bx bx-calendar-week'></i>{{ Carbon\Carbon::parse($blog->published_date)->format('d M Y') }}</a></li>
{{--                        <li><a href="#"><i class="bx bx-comment"></i>3</a></li>--}}
                        <li><a href="#"><i class="bx bx-user"></i>{{__('by')}} {{$blog->user->user_type}}</a></li>
                   </ul>
                   <div class="post-thumbnail">
                       <img src="{{ getFileLink('406x240', $blog->image) }}"
                            alt="Blog Thumbnail">
                   </div>
                   <h3 class="post-title">{{$blog->title}}</h3>
                   <p>{{$blog->description}}</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog-sidebar m-t-md-80 border-0 p-0">
                    <div class="widget blog-post-items-v3">
                        <h4 class="widget-title">{{__('you_may_also_like')}}</h4>
                        <div class="row">
                            @foreach( $blogs as $blog)
                            <div class="col-lg-12 col-sm-6">
                                <div class="blog-post-item">
                                    <div class="post-thumbnail">
                                        <a href="{{route('blog-details',['slug'=>$blog->slug])}}">
                                            <img src="{{ getFileLink('406x240', $blog->image) }}"
                                                 alt="Blog Thumbnail">
                                        </a>
                                        <ul class="post-meta">
                                            <li class="date"><a href="#"><i class="fal fa-calendar"></i> {{ Carbon\Carbon::parse($blog->published_date)->format('d M Y') }}</a></li>
                                        </ul>
                                    </div>
                                    <div class="post-content">
                                        <h4 class="title">
                                            <a href="{{route('blog-details',['slug'=>$blog->slug])}}">{{ $blog->title }}</a>
                                        </h4>
                                        <p class="content">
                                            {{ $blog->short_description }}
                                        </p>
                                        <div class="post-meta-wrapper">
                                            <div class="left-content">
                                                <ul class="post-meta">
{{--                                                    <li><a href="#"><i class="fal fa-comment-alt"></i> 203</a></li>--}}
                                                    <li><a href="#"><i class="fal fa-user"></i> {{__('by')}} {{$blog->user->user_type}}</a></li>
                                                </ul>
                                            </div>
                                            <div class="right-content">
                                                <a href="{{route('blog-details',['slug'=>$blog->slug])}}" class="read-more-btn">{{__('read_more')}}<i class="fas fa-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== End Start Blog Standard Loop ======-->
@if(count($featured_blogs) > 0)
    <!--====== Start Featured Blog Section ======-->
    <section class="featured-news-section p-t-80 p-b-80 color-bg-off-white">
        <div class="container container-1278">
            <div class="row">
                <div class="col-12">
                    <div class="section-title-v3 m-b-40">
                        <h3>{{__('featured_blog')}}</h3>
                    </div>
                </div>
            </div>
            <div class="row blog-post-items-v3">
                @foreach($featured_blogs as $featured_blog)
                <div class="col-lg-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ 200 * $loop->iteration}}">
                    <div class="blog-post-item">
                        <div class="post-thumbnail">
                            <a href="blog-details-2.html">
                                <img src="{{ getFileLink('406x240', $blog->image) }}"
                                     alt="Blog Thumbnail">
                            </a>
                            <ul class="post-meta">
                                <li class="date"><a href="#"><i class="fal fa-calendar"></i> {{ Carbon\Carbon::parse($featured_blog->published_date)->format('d M Y') }}</a></li>
                            </ul>
                        </div>
                        <div class="post-content">
                            <h4 class="title">
                                <a href="blog-details-2.html">{{$featured_blog->title}}</a>
                            </h4>
                            <p class="content">
                                {{$featured_blog->short_description}}
                            </p>
                            <div class="post-meta-wrapper">
                                <div class="left-content">
                                    <ul class="post-meta">
    {{--                                    <li><a href="#"><i class="fal fa-comment-alt"></i> 203</a></li>--}}
                                        <li><a href="#"><i class="fal fa-user"></i> By {{$featured_blog->user->user_type}}</a></li>
                                    </ul>
                                </div>
                                <div class="right-content">
                                    <a href="{{route('blog-details',['slug'=>$featured_blog->slug])}}" class="read-more-btn">{{__('read_more')}} <i class="fas fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="blog-pagination-btn m-t-10">
                    <a href="#" class="template-btn">{{__('see_more')}}<i class="fas fa-long-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Featured Blog Section ======-->
@endif
@endsection
