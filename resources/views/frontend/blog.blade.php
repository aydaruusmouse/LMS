@extends('frontend.layouts.master')
@section('title', __('home'))
@section('content')
 <!--====== Start Blog Area ======-->
 <section class="blog-area p-t-50 p-b-50 p-t-sm-30 p-b-sm-20">
    <div class="container container-1278">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12">
                        <div class="blog-shorter justify-content-between m-b-40 m-b-sm-30">
                            <h4>{{__('all_posts')}}</h4>
                            <div class="toggle-icon d-inline-block d-lg-none">
                                <a href="#">
                                    <svg width="16" height="9" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.56602 8.65979C8.49251 8.73235 8.4052 8.78991 8.30909 8.82918C8.21298 8.86846 8.10995 8.88867 8.0059 8.88867C7.90185 8.88867 7.79882 8.86846 7.7027 8.82918C7.60659 8.78991 7.51928 8.73235 7.44577 8.65979L0.232512 1.55256C0.0864694 1.40902 0.00307242 1.21498 8.32058e-05 1.01175C-0.00290601 0.808527 0.0747488 0.612184 0.216508 0.464538L0.420191 0.252381C0.492535 0.176767 0.579488 0.116162 0.675941 0.0741272C0.772393 0.0320921 0.8764 0.00947666 0.981849 0.00760651C1.0873 0.0057373 1.19206 0.0246515 1.28999 0.0632401C1.38791 0.101829 1.47702 0.159312 1.55208 0.232313L8.0059 6.49522L14.4262 0.226579C14.5005 0.153811 14.5887 0.0962963 14.6858 0.0573702C14.7828 0.0184431 14.8867 -0.00111961 14.9914 -0.000185966C15.0962 0.000746727 15.1997 0.0221586 15.296 0.0628071C15.3922 0.103456 15.4794 0.162533 15.5523 0.236613L15.7764 0.464538C15.9213 0.611588 16.0016 0.808938 16 1.01389C15.9983 1.21885 15.9149 1.41493 15.7676 1.55972L8.56602 8.65979Z" fill="#666666"></path>
                                    </svg>
                                </a>
                            </div>
                            <div class="sort-right d-none d-lg-block">
                                <p>{{__('showing')}} {{ count($blogs) }} {{__('of')}} {{ $total_posts }} {{__('results')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blog-items-wrap blog-post-items-v3">
                    <div class="row blog_section_wrap checkbox_filtering">
                            @include('frontend.blogs.category_component')
                    </div>
                    <div class="blog-pagination-btn text-center text-lg-start m-t-10">
                        @if($blogs->nextPageUrl())
                            <div class="blog-pagination text-align-center text-align-lg-start m-t-sm-10">
                                <a data-page="{{ $blogs->currentPage() }}" href="javascript:void(0)"
                                   class="template-btn load_more">{{__('see_more') }}
                                    <i class="fas fa-long-arrow-right"></i></a>
                                @include('components.frontend_loading_btn', ['class' => 'template-btn see-more'])
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <form action="#" id="sorting_form">@csrf
                    <div class="blog-sidebar m-t-md-30">
                        <div class="widget widget-checklist">
                            <h4 class="widget-title-v2">{{__('blog_categories')}}</h4>
                            <ul class="widget-list-group">
                                <li>
                                    <label>
                                        <input type="checkbox" name="all_blog" class="filtering_btn categories_btn" value="1" >
                                        <span>{{__('all_blog')}}</span>
                                    </label>
                                </li>
                                @if(count($blog_categories)>0)
                                @foreach($blog_categories as $key => $categories)
                                <li>
                                    <label>
                                        <input type="checkbox" class="filtering_btn categories_btn" name="categories[]" value="{{$categories->id}}">
                                        <span>{{$categories->title}}</span>
                                    </label>
                                </li>
                                @endforeach
                                @else
                                    @include('frontend.not_found',$data=['title'=> 'blog categories'])
                                @endif
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--====== End Blog Area ======-->
 @if(count($featured_blogs) > 0)
    <!--====== Start Featured Blog Section ======-->
    <section class="featured-news-section p-t-80 p-b-80 p-t-sm-50 p-b-sm-50 color-bg-off-white">
        <div class="container container-1278">
            <div class="row blog-page-v2">
                <div class="col-12">
                    <div class="section-title-v3 m-b-sm-30 m-b-40">
                        <h3>{{__('featured_blog')}}</h3>
                    </div>
                </div>
            </div>
            <div class="row featured_blog_section blog-post-items-v3">
                @if(count($featured_blogs)>0)
                @foreach($featured_blogs as $featured_blog)
                <div class="col-lg-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ 200 * $loop->iteration}}">
                    <div class="blog-post-item">
                        <div class="post-thumbnail">
                            <a href="{{route('blog-details',['slug'=>$featured_blog->slug])}}">
                                <img src="{{ getFileLink('406x240', $featured_blog->image) }}"
                                     alt="Blog Thumbnail">
                            </a>
                            <ul class="post-meta">
                                <li class="date"><a href="{{route('blog-details',['slug'=>$featured_blog->slug])}}"><i class="fal fa-calendar"></i>{{ Carbon\Carbon::parse($featured_blog->published_date)->format('d M Y') }}</a></li>
                            </ul>
                        </div>
                        <div class="post-content">
                            <h4 class="title">
                                <a href="{{route('blog-details',['slug'=>$featured_blog->slug])}}">{{ $featured_blog->title }}</a>
                            </h4>
                            <p class="content">
                                {{ $featured_blog->short_description }}
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
                @else
                    @include('frontend.not_found',$data=['title'=> 'featured blog'])
                @endif




                <div class="blog-pagination-btn text-center text-lg-start m-t-10">
                    @if($featured_blogs->nextPageUrl())
                        <div class="blog-pagination text-align-center text-align-lg-start m-t-sm-10">
                            <a data-page="{{ $featured_blogs->currentPage() }}" href="javascript:void(0)"
                               class="template-btn load_more_feature">{{__('see_more') }}
                                <i class="fas fa-long-arrow-right"></i></a>
                            @include('components.frontend_loading_btn', ['class' => 'template-btn see-more'])
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </section>
    <!--====== End Featured Blog Section ======-->
 @endif
@endsection
@push('js')
    <script>
        $(document).on('click', '.load_more', function () {
            blog('load_more');
        });
        function blog(load_more) {
            var that = $('.load_more');
            if (load_more == 'load_more') {
                page = parseInt(that.data('page')) + 1;
            }
            var btn_selector = $('.blog-pagination');
            btn_selector.find('.loading_button').removeClass('d-none');
            that.addClass('d-none');


            $.ajax({
                url: "{{ route('blog') }}",
                type: "GET",
                data: {
                    page: page,
                },
                success: function (data) {
                    let selector = $('.blog_section_wrap');
                    selector.append(data.blogs);

                    $('.header').html(data.header);
                    that.data('page', page);
                    initAOS();
                    activeNiceSelect();
                    if (data.next_page) {
                        btn_selector.find('.loading_button').addClass('d-none');
                        that.removeClass('d-none');
                    } else {
                        btn_selector.find('.loading_button').addClass('d-none');
                        that.addClass('d-none');
                    }
                }
            });
        }

        $(document).on('click', '.load_more_feature', function () {
            feature_blog('load_more');
        });


        function feature_blog(load_more) {

            var that = $('.load_more_feature');
            if (load_more == 'load_more') {
                page = parseInt(that.data('page')) + 1;
            }
            var btn_selector = $('.blog-pagination');
            btn_selector.find('.loading_button').removeClass('d-none');
            that.addClass('d-none');

            $.ajax({
                url: "{{ route('blog.feature') }}",
                type: "GET",
                data: {
                    page: page,
                },
                success: function (data) {

                    let selector = $('.featured_blog_section');
                    selector.append(data.blogs);


                    $('.header').html(data.header);
                    that.data('page', page);
                    initAOS();
                    activeNiceSelect();
                    if (data.next_page) {
                        btn_selector.find('.loading_button').addClass('d-none');
                        that.removeClass('d-none');
                    } else {
                        btn_selector.find('.loading_button').addClass('d-none');
                        that.addClass('d-none');
                    }
                }
            });
        }


        $(document).on('change', '.filtering_btn', function (e) {
            e.preventDefault()
            let form = document.getElementById('sorting_form');
            let formData = new FormData(form);
            let url = "{{route('filter.blog')}}";

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData : false,
                contentType : false,

                success: function (response) {
                    if (response.success) {
                        $(".checkbox_filtering").html(response.html);
                    }
                },
                error: function (err) {
                    console.log(err);
                }
            });
        });
    </script>
@endpush
