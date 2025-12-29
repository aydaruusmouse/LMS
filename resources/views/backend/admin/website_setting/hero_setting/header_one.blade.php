@extends('backend.layouts.master')
@section('title', __('hero_section_content'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website_setting.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <h3 class="section-title">{{ __('hero_section_content') }}</h3>
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
                        <form action="{{ route('hero.section') }}" method="POST" class="form" enctype="multipart/form-data">@csrf
                            <div class="row gx-20">
                                <input type="hidden" value="0" class="is_modal" name="is_modal">
                                <input type="hidden" value="{{ $lang }}" name="site_lang">
                                <!-- End Select Field without search -->
                                <div class="col-12 col-lg-12">
                                    <div class="mb-4">
                                        <label for="hero_title" class="form-label">{{ __('title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="hero_title"
                                               placeholder="{{ __('enter_title') }}" name="hero_title" value="{{ setting('hero_title',$lang) }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="hero_title_error error">{{ $errors->first('lang') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-12">
                                    <div class="mb-4">
                                        <label for="hero_subtitle" class="form-label">{{ __('subtitle') }}</label>
                                        <input type="text" class="form-control rounded-2" id="hero_subtitle"
                                               placeholder="{{ __('enter_subtitle') }}" name="hero_subtitle" value="{{ setting('hero_subtitle',$lang) }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="hero_subtitle_error error">{{ $errors->first('lang') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="hero_description" class="form-label">{{ __('hero_description') }}</label>
                                        <textarea class="form-control" id="hero_description"
                                                  name="hero_description" placeholder="{{ __('hero_description') }}">{{ setting('hero_description',$lang) }}</textarea>
                                        <div class="nk-block-des text-danger">
                                            <p class="hero_description_error error">{{ $errors->first('lang') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-12 sandbox_mode_div mb-4">
                                    <input type="hidden" name="hero_main_action_btn_enable" value="{{ setting('hero_main_action_btn_enable') == 1 ? 1 : 0 }}">
                                    <label class="form-label"
                                           for="hero_main_action_btn_enable">{{ __('action_btn') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="hero_main_action_btn_enable"
                                               class="sandbox_mode" {{ setting('hero_main_action_btn_enable') == 1 ? 'checked' : '' }}>
                                        <label for="hero_main_action_btn_enable"></label>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-12">
                                    <div class="mb-4">
                                        <label for="hero_main_action_btn_label" class="form-label">{{ __('btn_label') }}</label>
                                        <input type="text" class="form-control rounded-2" id="hero_main_action_btn_label"
                                               placeholder="{{ __('enter_btn_label') }}" name="hero_main_action_btn_label" value="{{ setting('hero_main_action_btn_label',$lang) }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="hero_main_action_btn_label_error error">{{ $errors->first('lang') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-12">
                                    <div class="mb-4">
                                        <label for="hero_main_action_btn_url" class="form-label">{{ __('btn_url') }}</label>
                                        <input type="text" class="form-control rounded-2" id="hero_main_action_btn_url"
                                               placeholder="{{ __('enter_btn_url') }}" name="hero_main_action_btn_url" value="{{ setting('hero_main_action_btn_url',$lang) }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="hero_main_action_btn_url_error error">{{ $errors->first('lang') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-12 sandbox_mode_div mb-4">
                                    <input type="hidden" name="hero_secondary_action_btn_enable" value="{{ setting('hero_secondary_action_btn_enable') == 1 ? 1 : 0 }}">
                                    <label class="form-label"
                                           for="hero_secondary_action_btn_enable">{{ __('secondary_action_btn') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="hero_secondary_action_btn_enable"
                                               class="sandbox_mode" {{ setting('hero_secondary_action_btn_enable') == 1 ? 'checked' : '' }}>
                                        <label for="hero_secondary_action_btn_enable"></label>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-12">
                                    <div class="mb-4">
                                        <label for="hero_secondary_action_btn_label" class="form-label">{{ __('secondary_btn_label') }}</label>
                                        <input type="text" class="form-control rounded-2" id="hero_secondary_action_btn_label"
                                               placeholder="{{ __('enter_btn_label') }}" name="hero_secondary_action_btn_label" value="{{ setting('hero_secondary_action_btn_label',$lang) }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="hero_secondary_action_btn_label_error error">{{ $errors->first('lang') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-12">
                                    <div class="mb-4">
                                        <label for="hero_secondary_action_btn_url" class="form-label">{{ __('secondary_btn_url') }}</label>
                                        <input type="text" class="form-control rounded-2" id="hero_secondary_action_btn_url"
                                               placeholder="{{ __('enter_btn_url') }}" name="hero_secondary_action_btn_url" value="{{ setting('hero_secondary_action_btn_url',$lang) }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="hero_secondary_action_btn_url_error error">{{ $errors->first('lang') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 input_file_div mb-3">
                                    <div class="mb-3">
                                        <label for="image1" class="form-label mb-1">{{ __('image') }}1 (240x240)</label>
                                        <label for="image1" class="file-upload-text">
                                            <p>1 File Choosen</p>
                                            <span class="file-btn">{{ __('choose_file') }}</span>
                                        </label>
                                        <input class="d-none file_picker" type="file" name="header1_hero_image1" id="image1">
                                    </div>
                                    <div class="selected-files d-flex flex-wrap gap-20">
                                        <div class="selected-files-item">
                                            <img class="selected-img" src="{{  getFileLink('80x80',setting('header1_hero_image1')) }}" alt="favicon">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 input_file_div mb-3">
                                    <div class="mb-3">
                                        <label for="image2" class="form-label mb-1">{{ __('image') }}2 (196x196)</label>
                                        <label for="image2" class="file-upload-text">
                                            <p>1 File Choosen</p>
                                            <span class="file-btn">{{ __('choose_file') }}</span>
                                        </label>
                                        <input class="d-none file_picker" type="file" name="header1_hero_image2" id="image2">
                                    </div>
                                    <div class="selected-files d-flex flex-wrap gap-20">
                                        <div class="selected-files-item">
                                            <img class="selected-img" src="{{  getFileLink('80x80',setting('header1_hero_image2')) }}" alt="favicon">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 input_file_div mb-3">
                                    <div class="mb-3">
                                        <label for="image3" class="form-label mb-1">{{ __('image') }}3 (284x284)</label>
                                        <label for="image3" class="file-upload-text">
                                            <p>1 File Choosen</p>
                                            <span class="file-btn">{{ __('choose_file') }}</span>
                                        </label>
                                        <input class="d-none file_picker" type="file" name="header1_hero_image3" id="image3">
                                    </div>
                                    <div class="selected-files d-flex flex-wrap gap-20">
                                        <div class="selected-files-item">
                                            <img class="selected-img" src="{{  getFileLink('80x80',setting('header1_hero_image3')) }}" alt="favicon">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 input_file_div mb-3">
                                    <div class="mb-3">
                                        <label for="image4" class="form-label mb-1">{{ __('image') }}4 (212x212)</label>
                                        <label for="image4" class="file-upload-text">
                                            <p>1 File Choosen</p>
                                            <span class="file-btn">{{ __('choose_file') }}</span>
                                        </label>
                                        <input class="d-none file_picker" type="file" name="header1_hero_image4" id="image4">
                                    </div>
                                    <div class="selected-files d-flex flex-wrap gap-20">
                                        <div class="selected-files-item">
                                            <img class="selected-img" src="{{  getFileLink('80x80',setting('header1_hero_image4')) }}" alt="favicon">
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

