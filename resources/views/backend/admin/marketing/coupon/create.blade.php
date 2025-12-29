@extends('backend.layouts.master')
@section('title', __('create_coupon'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{ __('add_new_coupon') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('coupons.store') }}" method="POST" class="form">@csrf
                            <div class="row gx-20 add-coupon">
                                <input type="hidden" class="is_modal" value="0"/>
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="couponTitle" class="form-label">{{ __('coupon_title') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control rounded-2" id="couponTitle" name="title"
                                               placeholder="{{ __('enter_title') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="title_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Coupon Title -->
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="couponCode" class="form-label">{{ __('coupon_code') }} <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control rounded-2" id="couponCode" name="code"
                                               placeholder="{{ __('enter_coupon_code') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="code_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Coupon Code -->
                                <div class="col-lg-6">
                                    <div class="select-type-v2 mb-4">
                                        <label for="couponType"
                                               class="form-label">{{ __('select_coupon_type') }}</label>
                                        <select id="couponType" class="mb-3 without_search" name="type">
                                            <option value="global">{{ __('global') }}</option>
                                            <option value="course">{{ __('courses') }}</option>
                                            <option value="category">{{ __('category') }}</option>
                                            <option value="instructor">{{ __('instructor') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- End Select Coupon Type -->

                                <div class="col-lg-12 instructor_div type_div d-none">
                                    <div class="multi-select-v2 mb-4">
                                        <label for="selectInstructor"
                                               class="form-label">{{ __('select_instructor') }}</label>
                                        <select id="selectInstructor" name="instructor_ids[]" multiple
                                                class="multiple-select-1 form-select-lg rounded-0 mb-3"
                                                aria-label=".form-select-lg example">
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="instructor_ids_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Select Instructor -->
                                <div class="col-lg-12 category_div type_div d-none">
                                    <div class="multi-select-v2 mb-4">
                                        <label for="select_category"
                                               class="form-label">{{ __('select_category') }}</label>
                                        <select id="select_category" name="category_ids[]" multiple
                                                class="multiple-select-1 form-select-lg rounded-0 mb-3"
                                                aria-label=".form-select-lg example">
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="category_ids_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Select category -->
                                <div class="col-lg-12 course_div type_div d-none">
                                    <div class="multi-select-v2 mb-4">
                                        <label for="select_course" class="form-label">{{ __('select_course') }}</label>
                                        <select id="select_course" name="course_ids[]" multiple
                                                class="multiple-select-1 form-select-lg rounded-0 mb-3"
                                                aria-label=".form-select-lg example">
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="course_ids_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Select category -->

                                <div class="col-lg-6">
                                    <label for="discount" class="form-label">{{ __('discount') }} <span class="text-danger">*</span></label>
                                    <div class="phone-field d-flex align-items-center rounded-2">
                                        <div class="phone-number">
                                            <input type="number" id="discount" name="discount" placeholder="e.g.20">
                                        </div>
                                        <div>
                                            <select class="form-select form-select-lg mb-3 without_search"
                                                    aria-label=".form-select-lg example" name="discount_type">
                                                <option value="percent">{{ __('percent') }}</option>
                                                <option value="amount">{{ __('amount') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="nk-block-des text-danger">
                                        <p class="discount_error error"></p>
                                    </div>
                                </div>
                                <!-- End Discount Field -->
                                <div class="col-lg-6">
                                    <div class="mb-20">
                                        <label for="dateRangePicker"
                                               class="form-label">{{ __('coupon_period') }} <span class="text-danger">*</span></label>
                                        <input id="dateRangePicker" name="dateRange" type="text"
                                               class="form-control rounded-2" placeholder="{{ __('select_date') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="dateRange_error error"></p>
                                        </div>
                                    </div>
                                </div>

                                @include('backend.common.media-input',[
                                    'title' => __('banner'),
                                    'name'  => 'coupon_media_id',
                                    'col'   => 'col-12 mb-4',
                                    'size'  => '(828x490)',
                                    'label' => __('banner'),
                                    'image' => old('coupon_media_id')
                                ])

                                <div class="d-flex justify-content-end align-items-center mt-30">
                                    <button type="submit" class="btn sg-btn-primary">{{__('submit') }}</button>
                                    @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('backend.common.gallery-modal')
    <!-- End Oftions Section -->
@endsection
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ static_asset('admin/css/daterangepicker.css') }}">
@endpush
@push('js_asset')
    <!--====== media.js ======-->
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/moment.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/daterangepicker.js') }}"></script>
@endpush
@push('js')
    <script src="{{ static_asset('admin/js/media.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#dateRangePicker').daterangepicker({
                autoUpdateInput: false
            });
            searchInstructor($('#selectInstructor'));
            searchCourse($('#select_course'));
            searchCategory($('#select_category'));
            $(document).on('change', '#couponType', function () {
                let type = $(this).val();
                $('.type_div').addClass('d-none');
                $('.' + type + '_div').removeClass('d-none');
            });
        });
    </script>
@endpush
