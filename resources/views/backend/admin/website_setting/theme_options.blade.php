@extends('backend.layouts.master')
@section('title', __('theme_options'))
@section('content')
    <!-- Product Details -->
    <div class="container-fluid">
        <div class="row">
            @include('backend.admin.website_setting.sidebar_component')
            <div class="col-xxl-9 col-lg-8 col-md-8">
                <h3 class="section-title">{{ __('theme_options') }}</h3>
                <div class="bg-white redious-border p-20 p-sm-30">
                    <form action="{{ route('theme.options') }}" method="post" class="form">@csrf
                        <div class="row">
                            <div class="pageTitle">
                                <h6 class="sub-title">{{ __('headers') }}</h6>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-sm-12">
                                <div class="custom-radio mb-4">
                                    <label>
                                        <input type="radio" name="header" value="header_one" {{ setting('header') == 'header_one' ? 'checked' : '' }}>
                                        <div class="website-theme header-section">
                                            <div class="website-thumb">
                                                <img src="{{ static_asset('admin/img/theme/header1.png') }}" alt="Theme">
                                            </div>

                                            <div class="website-theme-active">
                                                <span class="check-icon"><i class="las la-check"></i></span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <!-- End Header Section 1 -->

                            <div class="col-xl-4 col-lg-6 col-sm-12">
                                <div class="custom-radio mb-4">
                                    <label>
                                        <input type="radio" name="header" value="header_two" {{ setting('header') == 'header_two' ? 'checked' : '' }}>
                                        <div class="website-theme header-section">
                                            <div class="website-thumb">
                                                <img src="{{ static_asset('admin/img/theme/header2.png') }}" alt="Theme">
                                            </div>

                                            <div class="website-theme-active">
                                                <span class="check-icon"><i class="las la-check"></i></span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <!-- End Header Section 2 -->

                            <div class="col-xl-4 col-lg-6 col-sm-12">
                                <div class="custom-radio mb-4">
                                    <label>
                                        <input type="radio" name="header" value="header_three" {{ setting('header') == 'header_three' ? 'checked' : '' }}>
                                        <div class="website-theme header-section">
                                            <div class="website-thumb">
                                                <img src="{{ static_asset('admin/img/theme/header3.png') }}" alt="Theme">
                                            </div>

                                            <div class="website-theme-active">
                                                <span class="check-icon"><i class="las la-check"></i></span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <!-- End Header Section 2 -->

                            <div class="pageTitle">
                                <h6 class="sub-title">{{ __('footer') }}</h6>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-sm-12">
                                <div class="custom-radio mb-4">
                                    <label>
                                        <input type="radio" name="footer" value="footer_one" {{ setting('footer') == 'footer_one' ? 'checked' : '' }}>
                                        <div class="website-theme header-section">
                                            <div class="website-thumb">
                                                <img src="{{ static_asset('admin/img/theme/footer.png') }}" alt="Theme">
                                            </div>

                                            <div class="website-theme-active">
                                                <span class="check-icon"><i class="las la-check"></i></span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <!-- End Header Section 1 -->

                            <div class="col-xl-4 col-lg-6 col-sm-12">
                                <div class="custom-radio mb-4">
                                    <label>
                                        <input type="radio" name="footer" value="footer_two" {{ setting('footer') == 'footer_two' ? 'checked' : '' }}>
                                        <div class="website-theme header-section">
                                            <div class="website-thumb">
                                                <img src="{{ static_asset('admin/img/theme/footer.png') }}" alt="Theme">
                                            </div>

                                            <div class="website-theme-active">
                                                <span class="check-icon"><i class="las la-check"></i></span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <!-- End Header Section 2 -->

                            <div class="col-xl-4 col-lg-6 col-sm-12">
                                <div class="custom-radio mb-4">
                                    <label>
                                        <input type="radio" name="footer" value="footer_three" {{ setting('footer') == 'footer_three' ? 'checked' : '' }}>
                                        <div class="website-theme header-section">
                                            <div class="website-thumb">
                                                <img src="{{ static_asset('admin/img/theme/footer.png') }}" alt="Theme">
                                            </div>
                                            <div class="website-theme-active">
                                                <span class="check-icon"><i class="las la-check"></i></span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <!-- End Header Section 2 -->
                        </div>

                        <div class="row">
                            <div class="pageTitle">
                                <h6 class="sub-title">{{ __('typography_settings') }}</h6>
                            </div>
                            <div class="col-xl-6 col-lg-12">
                                <div class="select-type-v2 mb-4 ">
                                    <label class="form-label">{{ __('headline_font') }}</label>
                                    <select class="form-select form-select-lg mb-3 with_search" name="header_font" id="header_font">
                                        <option value="">{{ __('select_fonts') }}</option>
                                        @foreach(google_fonts_list() as $font_name => $font_family)
                                            <option value="{{ $font_name }}" data-family="{{ $font_family }}" {{ setting('header_font') == $font_name ? 'selected' : '' }}><span>{{ $font_family }}</span></option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-12">
                                <div class="select-type-v2 mb-4 ">
                                    <label class="form-label">{{ __('body_font') }}</label>
                                    <select class="form-select form-select-lg mb-3 with_search" name="body_font" id="body_font">
                                        <option value="">{{ __('select_fonts') }}</option>
                                        @foreach(google_fonts_list() as $font_name => $font_family)
                                            <option value="{{ $font_name }}" data-family="{{ $font_family }}" {{ setting('body_font') == $font_name ? 'selected' : '' }}><span>{{ $font_family }}</span></option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- End Body Font -->

<!--                            <div class="col-lg-6">
                                <label for="bodyFontSize" class="form-label">{{ __('body_font_size') }}</label>
                                <input type="text" class="form-control rounded-2" id="bodyFontSize"
                                       name="body_font_size" value="{{ setting('body_font_size') ? : '14' }}">
                            </div>-->
                            <!-- End Body Font Size -->

                            <div class="pageTitle">
                                <h6 class="sub-title">{{ __('color_settings') }}</h6>
                            </div>

                            <div class="col mb-4">
                                <label for="theme_color" class="form-label">{{ __('theme_color') }}</label>
                                <select class="form-select form-select-lg mb-3 with_search" name="theme_color">
                                    <option @if(setting('theme_color') == 'default') selected @endif value="default">{{ __('default') }}</option>
                                    <option @if(setting('theme_color') == 'blue') selected @endif value="blue">{{ __('blue') }}</option>
                                    <option @if(setting('theme_color') == 'cyan') selected @endif value="cyan">{{ __('cyan') }}</option>
                                    <option @if(setting('theme_color') == 'maroon') selected @endif value="maroon">{{ __('maroon') }}</option>
                                    <option @if(setting('theme_color') == 'orange') selected @endif value="orange">{{ __('orange') }}</option>
                                    <option @if(setting('theme_color') == 'olive') selected @endif value="olive">{{ __('olive') }}</option>
                                    <option @if(setting('theme_color') == 'red') selected @endif value="red">{{ __('red') }}</option>
                                    <option @if(setting('theme_color') == 'pink') selected @endif value="pink">{{ __('pink') }}</option>
                                    <option @if(setting('theme_color') == 'purple') selected @endif value="purple">{{ __('purple') }}</option>
                                    <option @if(setting('theme_color') == 'red') selected @endif value="red">{{ __('red') }}</option>
                                    <option @if(setting('theme_color') == 'royal-blue') selected @endif value="royal-blue">{{ __('royal_blue') }}</option>
                                    <option @if(setting('theme_color') == 'yellow') selected @endif value="yellow">{{ __('yellow') }}</option>
                                </select>
                            </div>

{{--                            <div class="col-lg-6 mb-4">--}}
{{--                                <label for="primaryColor" class="form-label">{{ __('primary_color') }}</label>--}}
{{--                                <div class="colorpicker_wrapper">--}}
{{--                                    <div class="input-append color colorpicker-component" data-color-format="auto">--}}
{{--                                        <input id="primaryColor" type="text" class="input-medium form-control rounded-2"--}}
{{--                                               value="{{ setting('primary_color') ? : '#4E9F3D' }}" name="primary_color">--}}
{{--                                        <span class="color_picker_trick">a</span>--}}
{{--                                        <span class="add-on"><i--}}
{{--                                                style="background-color: {{ setting('primary_color') ? : '#4E9F3D' }};"></i></span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <!-- End Primary Color -->

{{--                            <div class="col-lg-6 mb-4">--}}
{{--                                <label for="secondaryColor" class="form-label">{{ __('secondary_color') }}</label>--}}
{{--                                <div class="colorpicker_wrapper">--}}
{{--                                    <div class="input-append color colorpicker-component" data-color-format="auto">--}}
{{--                                        <input id="secondaryColor" type="text"--}}
{{--                                               class="input-medium form-control rounded-2"--}}
{{--                                               value="{{ setting('secondary_color') ? : '#333333' }}" name="secondary_color">--}}
{{--                                        <span class="color_picker_trick">a</span>--}}
{{--                                        <span class="add-on"><i--}}
{{--                                                style="background-color: {{ setting('secondary_color') ? : '#333333' }};"></i></span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <!-- End Secondary Color -->

{{--                            <div class="col-lg-6 mb-4">--}}
{{--                                <label for="linkColor" class="form-label">{{ __('link_color') }}</label>--}}
{{--                                <div class="colorpicker_wrapper">--}}
{{--                                    <div class="input-append color colorpicker-component" data-color-format="auto">--}}
{{--                                        <input id="linkColor" type="text" class="input-medium form-control rounded-2"--}}
{{--                                               value="{{ setting('link_color') ? : '#4E9F3D' }}" name="link_color">--}}
{{--                                        <span class="color_picker_trick">a</span>--}}
{{--                                        <span class="add-on"><i--}}
{{--                                                style="background-color: {{ setting('link_color') ? : '#4E9F3D' }};"></i></span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <!-- End Link Color -->

{{--                            <div class="col-lg-6 mb-4">--}}
{{--                                <label for="hoverColor" class="form-label">{{ __('hover_color') }}</label>--}}
{{--                                <div class="colorpicker_wrapper">--}}
{{--                                    <div class="input-append color colorpicker-component" data-color-format="auto">--}}
{{--                                        <input id="hoverColor" type="text" class="input-medium form-control rounded-2"--}}
{{--                                               value="{{ setting('hover_color') ? : '#333333' }}" name="hover_color">--}}
{{--                                        <span class="color_picker_trick">a</span>--}}
{{--                                        <span class="add-on"><i--}}
{{--                                                style="background-color: {{ setting('hover_color') ? : '#333333' }};"></i></span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <!-- End Hover Color -->

{{--                            <div class="pageTitle">--}}
{{--                                <h6 class="sub-title">{{ __('course_header_background') }}</h6>--}}
{{--                            </div>--}}

{{--                            <div class="col-xl-3 col-lg-6 mb-4">--}}
{{--                                <label for="color1" class="form-label">{{ __('1st_color') }}</label>--}}
{{--                                <div class="colorpicker_wrapper">--}}
{{--                                    <div class="input-append color colorpicker-component" data-color-format="auto">--}}
{{--                                        <input id="color1" type="text" class="input-medium form-control rounded-2"--}}
{{--                                               value="{{ setting('course_header_bg_color1') ? : '#012A32' }}" name="course_header_bg_color1">--}}
{{--                                        <span class="color_picker_trick">a</span>--}}
{{--                                        <span class="add-on"><i--}}
{{--                                                style="background-color: {{ setting('course_header_bg_color1') ? : '#012A32' }};"></i></span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-xl-3 col-lg-6 mb-4">--}}
{{--                                <label for="color2" class="form-label">{{ __('2nd_color') }}</label>--}}
{{--                                <div class="colorpicker_wrapper">--}}
{{--                                    <div class="input-append color colorpicker-component" data-color-format="auto">--}}
{{--                                        <input id="color2" type="text" class="input-medium form-control rounded-2"--}}
{{--                                               value="{{ setting('course_header_bg_color2') ? : '#00594A' }}" name="course_header_bg_color2">--}}
{{--                                        <span class="color_picker_trick">a</span>--}}
{{--                                        <span class="add-on"><i--}}
{{--                                                style="background-color: {{ setting('course_header_bg_color2') ? : '#00594A' }};"></i></span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-xl-3 col-lg-6 mb-4">--}}
{{--                                <label for="color3" class="form-label">{{ __('3rd_color') }}</label>--}}
{{--                                <div class="colorpicker_wrapper">--}}
{{--                                    <div class="input-append color colorpicker-component" data-color-format="auto">--}}
{{--                                        <input id="color3" type="text" class="input-medium form-control rounded-2"--}}
{{--                                               value="{{ setting('course_header_bg_color3') ? : '#00737E' }}" name="course_header_bg_color3">--}}
{{--                                        <span class="color_picker_trick">a</span>--}}
{{--                                        <span class="add-on"><i--}}
{{--                                                style="background-color: {{ setting('course_header_bg_color3') ? : '#00737E' }};"></i></span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-xl-3 col-lg-6 mb-4">--}}
{{--                                <label for="color4" class="form-label">{{ __('4th_color') }}</label>--}}
{{--                                <div class="colorpicker_wrapper">--}}
{{--                                    <div class="input-append color colorpicker-component" data-color-format="auto">--}}
{{--                                        <input id="color4" type="text" class="input-medium form-control rounded-2"--}}
{{--                                               value="{{ setting('course_header_bg_color4') ? : '#01735D' }}" name="course_header_bg_color4">--}}
{{--                                        <span class="color_picker_trick">a</span>--}}
{{--                                        <span class="add-on"><i--}}
{{--                                                style="background-color: {{ setting('course_header_bg_color4') ? : '#01735D' }};"></i></span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="pageTitle">
                                <h6 class="sub-title">{{ __('favicon') }}</h6>
                            </div>
                            <div class="col-lg-12 input_file_div mb-4">
                                <div class="mb-3">
                                    <label class="form-label mb-1">{{__('icon') }}</label>
                                    <label for="favicon"
                                           class="file-upload-text">
                                            <p>1 File Choosen</p>
                                            <span class="file-btn">{{__('choose_file') }}</span></label>
                                    <input class="d-none file_picker" type="file" id="favicon" name="favicon">
                                    <div class="nk-block-des text-danger">
                                        <p class="favicon_error error">{{ $errors->first('favicon') }}</p>
                                    </div>
                                </div>
                                <div class="selected-files d-flex flex-wrap gap-20">
                                    <div class="selected-files-item">
                                        @php
                                            $icon = setting('favicon');
                                        @endphp
                                        @if($icon)
                                            <img class="selected-img" src="{{ ($icon != [] && @is_file_exists($icon['image_96x96_url'])) ? static_asset($icon['image_96x96_url']) : static_asset('images/default/favicon/favicon-96x96.png') }}" alt="favicon">
                                        @else
                                            <img class="selected-img" src="{{ static_asset('images/default/favicon/favicon-96x96.png') }}" alt="favicon">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="pageTitle">
                                <h6 class="sub-title">{{ __('preloader') }}</h6>
                            </div>

                            <div class="d-flex gap-12 sandbox_mode_div mb-4">
                                <input type="hidden" name="disable_preloader" value="{{ setting('disable_preloader') == 1 ? 1 : 0 }}">
                                <label class="form-label"
                                       for="disable_preloader">{{ __('disable_preloader') }}</label>
                                <div class="setting-check">
                                    <input type="checkbox" value="1" id="disable_preloader"
                                           class="sandbox_mode" {{ setting('disable_preloader') == 1 ? 'checked' : '' }}>
                                    <label for="disable_preloader"></label>
                                </div>
                            </div>


                            <div class="col-lg-12 input_file_div">
                                <div class="mb-3">
                                    <label class="form-label mb-1">{{__('preloader_logo') }}</label>
                                    <label for="preloader_logo"
                                           class="file-upload-text">
                                            <p>1 File Choosen</p>
                                            <span class="file-btn">{{__('choose_file') }}</span></label>
                                    <input class="d-none file_picker" type="file" id="preloader_logo" name="preloader_logo">
                                    <div class="nk-block-des text-danger">
                                        <p class="preloader_logo_error error">{{ $errors->first('preloader_logo') }}</p>
                                    </div>
                                </div>
                                <div class="selected-files d-flex flex-wrap gap-20">
                                    <div class="selected-files-item">
                                        @php
                                            $preloader_logo = setting('preloader_logo');
                                        @endphp
                                        @if($preloader_logo)
                                            <img class="selected-img" src="{{ getFileLink('original_image',setting('preloader_logo')) }}" alt="preloader_logo">
                                        @else
                                            <img class="selected-img" src="{{ static_asset('images/default/logo/preloader.png') }}" alt="preloader_logo">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-start align-items-center mt-30">
                                <button type="submit" class="btn sg-btn-primary">{{ __('update') }}</button>
                                @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js_asset')
    <script src="{{ static_asset('admin/js/bootstrap-colorpicker.min.js') }}"></script>
@endpush
@push('css_asset')
    <link href="{{ static_asset('admin/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
@endpush
@push('js')
    <script>
        $(document).ready(function () {
            $('div.colorpicker-component').colorpicker();
            var ColorPickedDom = null;
            $('div.colorpicker_wrapper').on('click', 'div.colorpicker-component span.color_picker_trick', function (e) {
                ColorPickedDom = $(this).parent();
                $(ColorPickedDom).colorpicker('show');
            });

            $(document).on('change', '#header_font', function () {
                let family = $(this).find(':selected').data('family');
                let url = "https://fonts.googleapis.com/css2?family="+family+":wght@100;200;300;400;500;700;800;900&display=swap";
                $('.header_font_url').val(url);
            });
            $(document).on('change', '#body_font', function () {
                let family = $(this).find(':selected').data('family');
                let url = "https://fonts.googleapis.com/css2?family="+family+":wght@100;200;300;400;500;700;800;900&display=swap";
                $('.body_font_url').val(url);
            });
        });
    </script>
@endpush
