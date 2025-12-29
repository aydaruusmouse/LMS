@extends('backend.layouts.master')
@section('title', __('website_seo'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website_setting.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <h3 class="section-title">{{ __('seo_setting') }}</h3>
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
                        <form action="{{ route('website.seo') }}" method="POST" class="form">@csrf
                            <input type="hidden" value="0" class="is_modal" name="is_modal">
                            <input type="hidden" value="{{ $lang }}" name="site_lang">
                            <div class="row gx-20">
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="authorName" class="form-label">{{ __('author_name') }}</label>
                                        <input type="text" class="form-control rounded-2" id="authorName" value="{{ setting('author_name') }}" name="author_name" placeholder="{{ __('enter_author_name') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="author_name_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                @include('components.meta-fields',[
                                    'meta_title'        => setting('meta_title',$lang),
                                    'meta_description'  => setting('meta_description',$lang),
                                    'meta_keywords'     => setting('meta_keywords',$lang),
                                    'meta_image'        => setting('meta_image'),
                                    'is_input'          => 1
                                ])

                                @include('components.og-fields',[
                                    'og_title'        => setting('og_title',$lang),
                                    'og_description'  => setting('og_description',$lang),
                                    'og_image'        => setting('og_image')
                                ])

                                <!-- End Meta Image -->

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
{{--    @include('backend.common.gallery-modal')--}}
@endsection
{{--@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@push('js_asset')
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/ai_writer.js') }}"></script>
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
@endpush--}}
