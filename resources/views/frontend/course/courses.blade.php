@extends('frontend.layouts.master')
@section('title', __('course'))
@section('content')
    <!--====== Start Course Area ======-->
    <section class="course-area p-t-50 p-b-80 p-t-sm-30 p-b-sm-50">
        <div class="container container-1278">
            <div class="row">
                @include('frontend.course.header')
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="course-items-wrap">
                        <div class="row course_section_wrap {{ $style == 'list' ? 'course-items-v3 list-view' : 'course-items-v3 grid-view course-list' }}">
                            @if(count($courses)>0)
                                @foreach($courses as $key => $course)
                                    @include('frontend.course.component',['col' => 'col-lg-6'])
                                @endforeach
                            @else
                                @include('frontend.not_found',$data=['title'=> 'courses'])
                            @endif
                        </div>

                        @if($courses->nextPageUrl())
                            <div class="course-pagination text-align-center text-align-lg-start m-t-sm-10">
                                <a data-page="{{ $courses->currentPage() }}" href="javascript:void(0)"
                                   class="template-btn load_more">{{__('more_course') }}
                                    <i class="fas fa-long-arrow-right d-none d-sm-inline-block"></i></a>
                                @include('components.frontend_loading_btn', ['class' => 'template-btn see-more'])
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('frontend.course.sidebar')
                </div>
            </div>
        </div>
    </section>
    <!--====== End Course Area ======-->

    <!--====== Start Course Lesson Section ======-->
    @if($single_course_section)
        <section class="course-lesson-section color-bg-off-white p-t-80 p-b-80 p-b-sm-40 p-t-sm-40">
            <div class="container container-1278">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="common-heading m-b-35 m-b-sm-25 text-center">
                            <h3>{{__("single_course_with_lesson") }}</h3>
                            <p>{{ $single_course_section->contents['sub_title'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="row course-lesson-v2 course-lesson-slider-v2 slider-primary" data-aos="fade-up"
                     data-aos-delay="200" dir="{{ systemLanguage() ? systemLanguage()->text_direction : 'ltr' }}">
                    @if(count($single_course)>0)
                        @foreach($single_course as $key=> $course)
                            @include('frontend.course.single_course_component')
                        @endforeach
                    @else
                        @include('frontend.not_found',$data=['title'=> 'single course'])
                    @endif
                </div>
            </div>
        </section>
    @endif
    <!--====== End Course Lesson Section ======-->
@endsection
@push('js')
    <script>
        let style_type = '{{ $style }}';
        let page = 0;
        $(document).ready(function () {
            $(document).on('click', '.style_type', function () {
                style_type = $(this).data('style');
                $('.style_type').removeClass('active');
                $(this).addClass('active');
                changeUrl('style', style_type);
                page = 1;
                courseFilter();
            });
            $(document).on('change', '.course-sort', function () {
                let sorting = $(this).val();
                changeUrl('sorting', sorting);
                page = 1;
                courseFilter();
            });
            $(document).on('keyup', '.keyword', function () {
                let q = $(this).val();
                changeUrl('q', q);
                page = 1;
                courseFilter();
            });
            $(document).on('click', '.search-btn', function () {
                page = 1;
                courseFilter();
            });
            $(document).on('click', '.show-more', function () {
                let that = this;
                let page = parseInt($(this).data('page')) + 1;
                let url = $(this).data('url');
                let selector = $(this).closest('ul');
                $(that).find('a').addClass('d-none');
                $(selector).find('.loading_button').removeClass('d-none');
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        page: page,
                    },
                    success: function (data) {
                        if (data.success) {
                            $(that).remove();
                            selector.append(data.html);
                        } else {
                            $(that).find('a').removeClass('d-none');
                            selector.find('.loading_button').addClass('d-none');
                            toastr.error(data.error);
                        }
                    }
                });
            });
            //subject show more
            $(document).on('click', '.subject-more', function () {
                let that = this;
                let page = parseInt($(this).data('page')) + 1;
                let url = $(this).data('url');
                let selector = $(this).closest('ul');
                $(that).find('a').addClass('d-none');
                $(selector).find('.loading_button').removeClass('d-none');
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        page: page,
                    },
                    success: function (data) {
                        if (data.success) {
                            $(that).remove();
                            selector.append(data.html);
                        } else {
                            $(that).find('a').removeClass('d-none');
                            selector.find('.loading_button').addClass('d-none');
                            toastr.error(data.error);
                        }
                    }
                });
            });
            /*$(document).on('click', '.parent_category', function () {
                // let category_ids = [];
                let id = $(this).data('id');
                /!*$('.category_checkbox:checked').each(function () {
                    category_ids.push($(this).val());
                });*!/
                category_ids.push(id);
                changeUrl('category_ids', category_ids);
                page = 1;
                courseFilter();
            });*/
            $(document).on('change', '.category_checkbox', function () {
                let category_ids = [];
                $('.category_checkbox:checked').each(function () {
                    category_ids.push($(this).val());
                });
                changeUrl('category_ids', category_ids);
                page = 1;
                courseFilter();
            });
            $(document).on('change', '.subject_checkbox', function () {
                let subject_ids = [];

                $('.subject_checkbox:checked').each(function () {
                    subject_ids.push($(this).val());
                });
                changeUrl('subject_ids', subject_ids);
                page = 1;
                courseFilter();
            });
            $(document).on('change', '.price_checkbox', function () {
                let price = [];

                $('.price_checkbox:checked').each(function () {
                    price.push($(this).val());
                });
                changeUrl('price', price);
                page = 1;
                courseFilter();
            });
            $(document).on('change', '.level_checkbox', function () {
                let level_ids = [];

                $('.level_checkbox:checked').each(function () {
                    level_ids.push($(this).val());
                });
                changeUrl('level_ids', level_ids);
                page = 1;
                courseFilter();
            });
            $(document).on('change', '.rating_checkbox', function () {
                let rating = [];

                $('.rating_checkbox:checked').each(function () {
                    rating.push($(this).val());
                });
                changeUrl('rating', rating);
                page = 1;
                courseFilter();
            });
            $(document).on('click', '.load_more', function () {
                courseFilter('load_more');
            });
        });

        function courseFilter(load_more) {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            let style = urlParams.get('style');
            let sorting = urlParams.get('sorting');
            let q = urlParams.get('q');
            let category_ids = urlParams.get('category_ids');
            let subject_ids = urlParams.get('subject_ids');
            let price = urlParams.get('price');
            let level_ids = urlParams.get('level_ids');
            let rating = urlParams.get('rating');
            var that = $('.load_more');
            if (load_more == 'load_more') {
                page = parseInt(that.data('page')) + 1;
            }
            var btn_selector = $('.course-pagination');
            btn_selector.find('.loading_button').removeClass('d-none');
            that.addClass('d-none');


            $.ajax({
                url: "{{ route('courses') }}",
                type: "GET",
                data: {
                    style: style,
                    sorting: sorting,
                    q: q,
                    category_ids: category_ids,
                    price: price,
                    level_ids: level_ids,
                    subject_ids: subject_ids,
                    rating: rating,
                    page: page,
                },
                success: function (data) {
                    let selector = $('.course_section_wrap');
                    if (load_more == 'load_more') {
                        selector.append(data.courses);
                    } else {
                        selector.html(data.courses);
                    }
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

                    if (style_type == 'grid') {
                        $('.course-items-v3').removeClass('list-view').addClass('grid-view');
                    } else {
                        $('.course-items-v3').removeClass('grid-view').addClass('list-view');
                    }
                }
            });
        }

        function changeUrl(type, val) {
            var url = new URL(window.location.href);
            var params = new URLSearchParams(url.search);

            params.set(type, val);

            var newUrl = url.origin + url.pathname + '?' + params.toString();
            window.history.pushState({path: newUrl}, '', newUrl);
        }
    </script>
@endpush
