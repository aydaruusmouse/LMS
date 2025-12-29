@extends('backend.layouts.master')
@section('title', __('edit_coupon'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('edit_coupon') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <div class="row">
                            <form>
                                <div class="col-lg-12">
                                    <input type="hidden" name="r" value="{{ url()->current() }}" class="r">
                                    <div class="mb-4">
                                        <label for="lang" class="form-label">{{__('language') }}</label>
                                        <select id="lang"
                                                class="form-select form-select-lg mb-3 with_search" name="lang">
                                            <option value="">{{__('select_language') }}</option>
                                            @foreach($languages as $language)
                                                <option
                                                    value="{{ $language->locale }}" {{ $lang == $language->locale ? 'selected' : '' }}>{{ $language->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="lang_error error">{{ $errors->first('lang') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('coupons.update',$coupon->id) }}" class="form-validate form"
                                  method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <input type="hidden" name="id" value="{{ $coupon->id }}">
                                    <input type="hidden" value="{{ $lang }}" name="lang">
                                    <input type="hidden"
                                           value="{{ $coupon_language->translation_null == 'not-found' ? '' : $coupon_language->id }}"
                                           name="translate_id">
                                    <input type="hidden" class="is_modal" value="0"/>
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="couponTitle" class="form-label">{{ __('coupon_title') }} <span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control rounded-2" id="couponTitle"
                                                   name="title"
                                                   placeholder="{{ __('enter_title') }}"
                                                   value="{{ $coupon_language->title }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="title_error error"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Coupon Title -->
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="couponCode" class="form-label">{{ __('coupon_code') }} <span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control rounded-2" id="couponCode"
                                                   name="code"
                                                   placeholder="{{ __('enter_coupon_code') }}"
                                                   value="{{ $coupon->code }}">
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
                                                <option
                                                    value="global" {{ $coupon->type == 'global' ? 'selected' : '' }}>{{ __('global') }}</option>
                                                <option
                                                    value="course" {{ $coupon->type == 'course' ? 'selected' : '' }}>{{ __('courses') }}</option>
                                                <option
                                                    value="category" {{ $coupon->type == 'category' ? 'selected' : '' }}>{{ __('category') }}</option>
                                                <option
                                                    value="instructor" {{ $coupon->type == 'instructor' ? 'selected' : '' }}>{{ __('instructor') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- End Select Coupon Type -->

                                    <div class="col-lg-12 instructor_div type_div {{ $coupon->type == 'instructor' ? '' : 'd-none' }}">
                                        <div class="multi-select-v2 mb-4">
                                            <label for="selectInstructor"
                                                   class="form-label">{{ __('select_instructor') }}</label>
                                            <select id="selectInstructor" name="instructor_ids[]" multiple
                                                    class="multiple-select-1 form-select-lg rounded-0 mb-3"
                                                    aria-label=".form-select-lg example">
                                                @foreach($instructors as $instructor)
                                                    <option
                                                        value="{{ $instructor->id }}" {{ $coupon->instructor_ids && in_array($instructor->id,$coupon->instructor_ids) ? 'selected' : '' }}>{{ $instructor->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="nk-block-des text-danger">
                                                <p class="instructor_ids_error error"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Select Instructor -->
                                    <div class="col-lg-12 category_div type_div {{ $coupon->type == 'category' ? '' : 'd-none' }}"">
                                        <div class="multi-select-v2 mb-4">
                                            <label for="select_category"
                                                   class="form-label">{{ __('select_category') }}</label>
                                            <select id="select_category" name="category_ids[]" multiple
                                                    class="multiple-select-1 form-select-lg rounded-0 mb-3"
                                                    aria-label=".form-select-lg example">
                                                @foreach($categories as $category)
                                                    <option
                                                        value="{{ $category->id }}" {{ $coupon->category_ids && in_array($category->id,$coupon->category_ids) ? 'selected' : '' }}>{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                            <div class="nk-block-des text-danger">
                                                <p class="category_ids_error error"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Select category -->
                                    <div class="col-lg-12 course_div type_div {{ $coupon->type == 'course' ? '' : 'd-none' }}"">
                                        <div class="multi-select-v2 mb-4">
                                            <label for="select_course"
                                                   class="form-label">{{ __('select_course') }}</label>
                                            <select id="select_course" name="course_ids[]" multiple
                                                    class="multiple-select-1 form-select-lg rounded-0 mb-3"
                                                    aria-label=".form-select-lg example">
                                                @foreach($courses as $course)
                                                    <option
                                                        value="{{ $course->id }}" {{ $coupon->course_ids && in_array($course->id,$coupon->course_ids) ? 'selected' : '' }}>{{ $course->title }}</option>
                                                @endforeach
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
                                                <input type="number" id="discount" name="discount" placeholder="e.g.20"
                                                       value="{{ $coupon->discount }}">
                                            </div>
                                            <div>
                                                <select class="form-select form-select-lg mb-3 without_search"
                                                        aria-label=".form-select-lg example" name="discount_type">
                                                    <option
                                                        value="percent" {{ $coupon->type == 'percent' ? 'selected' : '' }}>{{ __('percent') }}</option>
                                                    <option
                                                        value="amount" {{ $coupon->type == 'amount' ? 'selected' : '' }}>{{ __('amount') }}</option>
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
                                        'image' => $coupon->image,
                                        'edit'  => $coupon,
                                        'image_object'  => $coupon->image,
                                        'media_id'  => $coupon->coupon_media_id,
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
        </div>
    </section>
    @include('backend.common.gallery-modal')
@endsection

@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ static_asset('admin/css/daterangepicker.css') }}">
@endpush
@push('js_asset')
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/moment.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/daterangepicker.js') }}"></script>
@endpush
@push('js')
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#dateRangePicker').daterangepicker({
                startDate: '{{ Carbon\Carbon::parse($coupon->start_date)->format('m/d/Y') }}',
                endDate: '{{ Carbon\Carbon::parse($coupon->end_date)->format('m/d/Y') }}',
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
