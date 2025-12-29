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
                            <li><a href="#"><i
                                        class='bx bx-calendar-week'></i>{{ Carbon\Carbon::parse($blog->published_date)->format('d M Y') }}
                                </a></li>
                            {{--                        <li><a href="#"><i class="bx bx-comment"></i>3</a></li>--}}
                            <li><a href="#"><i class="bx bx-user"></i>{{__('by')}} {{$blog->user->user_type}}</a></li>
                        </ul>
                        <div class="post-thumbnail">
                            <img src="{{ getFileLink('406x240', $blog->image) }}"
                                 alt="Blog Thumbnail">
                        </div>
                        <h3 class="post-title">{{$blog->title}}</h3>
                        <p>{!! $blog->description !!}</p>
                    </div>
                    @if(auth()->check())
                        <div class="comments-template comments-template-v2" id="comments_section">
                            <div class="comments-respond" id="comment-respond">
                                @if($blog->comments_count > 0 || !$comment)
                                    <h4 class="template-title"><span>{{ __('comments') }}</span></h4>
                                @endif
                                @if(!$comment)
                                    <form class="ajax_form" action="{{ route('blog.comment') }}" method="post">@csrf
                                        <div class="input-field m-b-20">
                                            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                            <textarea name="comment"></textarea>
                                            <p class="error comment_error text-danger"></p>
                                        </div>
                                        <div class="input-field">
                                            <button class="template-btn" type="submit">{{ __('post_comment') }}</button>
                                            @include('components.frontend_loading_btn', ['class' => 'template-btn'])
                                        </div>
                                    </form>
                                @endif
                                <div class="comment_list"></div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-lg-4">
                    <div class="blog-sidebar m-t-md-80 border-0 p-0">
                        <div class="widget blog-post-items-v3">
                            <h4 class="widget-title">{{__('you_may_also_like')}}</h4>
                            <div class="row">
                                @foreach($blogs as $liked_blog)
                                    <div class="col-lg-12 col-sm-6">
                                        <div class="blog-post-item">
                                            <div class="post-thumbnail">
                                                <a href="{{route('blog-details',['slug'=>$liked_blog->slug])}}">
                                                    <img src="{{ getFileLink('406x240', $liked_blog->image) }}"
                                                         alt="Blog Thumbnail">
                                                </a>
                                                <ul class="post-meta">
                                                    <li class="date"><a href="#"><i
                                                                class="fal fa-calendar"></i> {{ Carbon\Carbon::parse($liked_blog->published_date)->format('d M Y') }}
                                                        </a></li>
                                                </ul>
                                            </div>
                                            <div class="post-content">
                                                <h4 class="title">
                                                    <a href="{{route('blog-details',['slug'=>$liked_blog->slug])}}">{{ $liked_blog->title }}</a>
                                                </h4>
                                                <p class="content">
                                                    {{ $liked_blog->short_description }}
                                                </p>
                                                <div class="post-meta-wrapper">
                                                    <div class="left-content">
                                                        <ul class="post-meta">
                                                            {{--                                                    <li><a href="#"><i class="fal fa-comment-alt"></i> 203</a></li>--}}
                                                            <li><a href="#"><i
                                                                        class="fal fa-user"></i> {{__('by')}} {{$liked_blog->user->user_type}}
                                                                </a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="right-content">
                                                        <a href="{{route('blog-details',['slug'=>$liked_blog->slug])}}"
                                                           class="read-more-btn">{{__('read_more')}}<i
                                                                class="fas fa-long-arrow-right"></i></a>
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
                                    <a href="{{route('blog-details',['slug'=>$blog->slug])}}">
                                        <img src="{{ getFileLink('406x240', $blog->image) }}"
                                             alt="Blog Thumbnail">
                                    </a>
                                    <ul class="post-meta">
                                        <li class="date"><a href="{{route('blog-details',['slug'=>$blog->slug])}}"><i
                                                    class="fal fa-calendar"></i> {{ Carbon\Carbon::parse($featured_blog->published_date)->format('d M Y') }}
                                            </a></li>
                                    </ul>
                                </div>
                                <div class="post-content">
                                    <h4 class="title">
                                        <a href="{{route('blog-details',['slug'=>$blog->slug])}}">{{$featured_blog->title}}</a>
                                    </h4>
                                    <p class="content">
                                        {{$featured_blog->short_description}}
                                    </p>
                                    <div class="post-meta-wrapper">
                                        <div class="left-content">
                                            <ul class="post-meta">
                                                {{--                                    <li><a href="#"><i class="fal fa-comment-alt"></i> 203</a></li>--}}
                                                <li><a href="{{route('blog-details',['slug'=>$blog->slug])}}"><i
                                                            class="fal fa-user"></i>
                                                        By {{$featured_blog->user->user_type}}</a></li>
                                            </ul>
                                        </div>
                                        <div class="right-content">
                                            <a href="{{route('blog-details',['slug'=>$featured_blog->slug])}}"
                                               class="read-more-btn">{{__('read_more')}} <i
                                                    class="fas fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="blog-pagination-btn m-t-10">
                        <a href="{{ route('blog') }}" class="template-btn">{{__('see_more')}}<i
                                class="fas fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </section>
        <!--====== End Featured Blog Section ======-->
    @endif
@endsection
@push('js')
    <script>
        $(document).ready(function (){
            @if(auth()->check() && $blog->comments_count > 0)
                getComments();
            @endif
            $(document).on('click','.load_replies',function (){
                let comment_id = $(this).data('comment_id');
                let selector = $(this).closest('.reply_for_'+comment_id);
                selector.find('.load_replies').addClass('d-none');
                selector.find('.loading_button').removeClass('d-none');
                $.ajax({
                    url: "{{ route('blog.comment.replies') }}",
                    data: {comment_id: comment_id},
                    success: function (response) {
                        if (response.success) {
                            selector.find('.loading_button').addClass('d-none');
                            selector.html(response.html);
                        } else {
                            selector.find('.load_replies').addClass('d-none');
                            selector.find('.loading_button').removeClass('d-none');
                            toastr.error(response.error);
                        }
                    },
                });
            })
            $(document).on('click','.load_more',function (){
                let that = this;
                let page = parseInt($(this).data('page')) + 1;
                let url = $(this).data('url');
                let selector = $(this).closest('.comment_list');
                $(that).addClass('d-none');
                $(selector).find('.comment_load_more').removeClass('d-none');
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        page: page,
                    },
                    success: function (data) {
                        if (data.success) {
                            $(that).remove();
                            $(selector).find('.comment_load_more').remove();
                            selector.append(data.html);
                        } else {
                            $(that).find('a').removeClass('d-none');
                            selector.find('.comment_load_more').addClass('d-none');
                            toastr.error(data.error);
                        }
                    }
                });
            })
        })
        function getComments() {
            $.ajax({
                url: "{{ route('blog.comments', $blog->id) }}",
                success: function (response) {
                    if (response.success) {
                        $('.comment_list').append(response.html);
                    } else {
                        toastr.error(response.error);
                    }
                },
            });
        }
    </script>
@endpush
