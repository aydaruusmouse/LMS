@extends('frontend.layouts.master')
@section('title', __('about'))
@section('content')
    <!--====== Start Wishlist Courses Section ======-->
    <section class="wishlist-courses-section p-t-50 p-t-sm-30 p-b-50 p-b-md-20">
        <div class="container container-1278">
            <div class="row">
                @include('frontend.profile.sidebar')
                <div class="col-md-8">
                    <div class="wishlist-courses-wrapper">
                        @include('frontend.profile.components.wishlist_header')
                        <div class="course-items-wrap">
                            <div class="row course-items-v3">
                                @if(count($course_wishlist) > 0)
                                    @foreach($course_wishlist as $course)
                                        @include('frontend.profile.components.wishlist')
                                    @endforeach
                                @else
                                    @include('frontend.not_found',['title'=> 'course'])
                                @endif
                            </div>
                            @if($course_wishlist->nextPageUrl())
                                <div class="course-pagination text-center text-align-lg-start m-t-sm-10">
                                    <a data-page="{{ $course_wishlist->currentPage() }}"
                                       data-url="{{ url()->current() }}" href="javascript:void(0)"
                                       class="template-btn load_more">{{__('more_course') }}
                                        <i class="fas fa-long-arrow-right d-none d-sm-inline-block"></i></a>
                                    @include('components.frontend_loading_btn', ['class' => 'template-btn see-more'])
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Wishlist Courses Section ======-->
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.wishlist-sdfsfdicon', function () {
                var $this = $(this);
                var course_id = $this.data('course-id');
                var wishlist_id = $this.data('wishlist-id');
                var url = '{{ route('add.remove.wishlist') }}';
                var data = {
                    'course_id': course_id,
                    'wishlist_id': wishlist_id,
                };
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    success: function (response) {
                        if (response.success) {
                            $this.closest('.course-item').remove();
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    }
                });
            });
            $(document).on('click', '.load_more', function () {
                var that = $('.load_more');
                var btn_selector = $('.course-pagination');
                btn_selector.find('.loading_button').removeClass('d-none');
                that.addClass('d-none');
                let url = that.data('url');
                let page = parseInt(that.data('page')) + 1;
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        page: page,
                    },
                    success: function (data) {
                        let selector = $('.course-items-v3');
                        selector.append(data.courses);
                        $('.header').html(data.header);
                        that.data('page', page);
                        initAOS();
                        if (data.next_page) {
                            btn_selector.find('.loading_button').addClass('d-none');
                            that.removeClass('d-none');
                        } else {
                            btn_selector.find('.loading_button').addClass('d-none');
                            that.addClass('d-none');
                        }
                    }
                });
            });
        });
    </script>
@endpush
