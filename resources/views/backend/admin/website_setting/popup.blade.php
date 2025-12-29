@extends('backend.layouts.master')
@section('title', __('website_popup'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website_setting.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <h3 class="section-title">{{ __('website_popup') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form>
                            <div class="row">
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
                            </div>
                        </form>
                        <form action="{{ route('website.popup') }}" method="POST" class="form">@csrf
                            <div class="row gx-20">
                                <input type="hidden" value="0" class="is_modal" name="is_modal">
                                <input type="hidden" value="{{ $lang }}" name="site_lang">
                                <!-- End Select Field without search -->
                                <div class="col-12 col-lg-12">
                                    <div class="mb-4">
                                        <label for="popup_title" class="form-label">{{ __('title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="popup_title"
                                               placeholder="{{ __('enter_title') }}" name="popup_title" value="{{ setting('popup_title',$lang) }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="popup_title_error error">{{ $errors->first('lang') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Title -->

                                <div class="col-lg-12">
                                    <div class="select-type-v2 mb-4 ">
                                        <label for="popup_show_in" class="form-label">{{ __('show_in') }}</label>
                                        <select class="form-select form-select-lg mb-3 without_search"
                                                name="popup_show_in" id="popup_show_in">
                                            <option value="home_page" {{ setting('popup_show_in') == 'home_page' ? 'selected' : '' }}>{{ __('home_page') }}</option>
                                            <option value="all_page" {{ setting('popup_show_in') == 'all_page' ? 'selected' : '' }}>{{ __('all_page') }}</option>
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="popup_show_in_error error">{{ $errors->first('lang') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Show In -->

                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="popup_description" class="form-label">{{ __('popup_description') }}</label>
                                        <textarea class="form-control" id="popup_description"
                                                  name="popup_description" placeholder="{{ __('popup_description') }}">{{ setting('popup_description',$lang) }}</textarea>
                                        <div class="nk-block-des text-danger">
                                            <p class="popup_description_error error">{{ $errors->first('lang') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Popup Description -->

                                <div class="col-lg-12 input_file_div mb-3">
                                    <div class="mb-3">
                                        <label for="popup_image" class="form-label mb-1">{{ __('image') }} (500x500)</label>
                                        <label for="popup_image" class="file-upload-text">
                                            <p></p>
                                            <span class="file-btn">{{ __('choose_file') }}</span>
                                        </label>
                                        <input class="d-none file_picker" type="file" name="popup_image" id="popup_image">
                                    </div>
                                    <div class="selected-files d-flex flex-wrap gap-20">
                                        <div class="selected-files-item">
                                            <img class="selected-img" src="{{  getFileLink('80x80',setting('popup_image')) }}" alt="favicon">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Popup Image -->

                                <div class="d-flex gap-12 sandbox_mode_div mb-4">
                                    <input type="hidden" name="site_popup_status" value="{{ setting('site_popup_status') == 0 ? 0 : 1 }}">
                                    <label class="form-label"
                                           for="site_popup_status">{{ __('status') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="site_popup_status"
                                               class="sandbox_mode" {{ setting('site_popup_status') == 0 ? '' : 'checked' }}>
                                        <label for="site_popup_status"></label>
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
    </section>
    @include('backend.common.gallery-modal')
@endsection
@push('js')
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
@endpush
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@push('js_asset')
    <!--====== media.js ======-->
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
@endpush
