@extends('backend.layouts.master')
@section('title', __('copyright_settings'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website_setting.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <h3 class="section-title">{{ __('copyright_settings') }}</h3>
                    <div class="default-tab-list default-tab-list-v2  bg-white redious-border website-setting-social-link p-20 p-sm-30">
                        @include('backend.admin.website_setting.component.footer_setting_sidebar')
                        <form id="lang">
                            <div class="row gx-20">
                                <div class="col-12">
                                    <input type="hidden" name="r" value="{{ url()->current() }}" class="r">
                                    <div class="select-type-v2 mb-40">
                                        <select class="form-select form-select-lg mb-3 with_search selectric lang" name="site_lang">
                                            @foreach(app('languages') as $language)
                                                <option value="{{ $language->locale }}" {{ $language->locale == $lang ? 'selected' : '' }}>{{ $language->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form action="{{ route('footer.update-setting') }}" method="POST" class="form">@csrf
                            <input type="hidden" name="site_lang" value="{{$lang}}">
                            <div class="row gx-20">
                                <div class="d-flex gap-12 sandbox_mode_div mb-4">
                                    <input type="hidden" name="show_copyright" value="{{ setting('show_copyright') == 1 ? 1 : 0 }}">
                                    <label class="form-label"
                                           for="show_copyright">{{ __('show_copyright') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="show_copyright"
                                               class="sandbox_mode" {{ setting('show_copyright') == 1 ? 'checked' : '' }}>
                                        <label for="show_copyright"></label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="title" class="form-label">{{__('copyright_title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="title" name="copyright_title"
                                               placeholder="{{ __('enter_title') }}" value="{{ setting('copyright_title',$lang)}}">
                                        <div class="nk-block-des text-danger">
                                            <p class="title_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 input_file_div">
                                    <div class="mb-3">
                                        <label for="copyrightLogoUpload" class="form-label mb-1">{{ __('copyright_logo') }} (683x66)</label>
                                        <label for="copyrightLogoUpload" class="file-upload-text">
                                            <p>1 File Choosen</p>
                                            <span class="file-btn">{{ __('choose_file') }}</span>
                                        </label>
                                        <input class="d-none file_picker" type="file" name="copyright_logo" id="copyrightLogoUpload">
                                    </div>
                                    <div class="selected-files d-flex flex-wrap gap-20">
                                        <div class="selected-files-item">
                                            <img class="selected-img" src="{{ setting('copyright_logo') && @is_file_exists(setting('copyright_logo')['original_image']) ? get_media(setting('copyright_logo')['original_image']) : getFileLink('80x80',[]) }}" alt="favicon">
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
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@push('js_asset')
    <!--====== media.js ======-->
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
@endpush
@push('js')
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
@endpush
