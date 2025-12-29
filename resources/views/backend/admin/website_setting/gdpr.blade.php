@extends('backend.layouts.master')
@section('title', __('custom_gdpr'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website_setting.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <h3 class="section-title">{{ __('custom_gdpr') }}</h3>
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
                        <form action="{{ route('gdpr') }}" method="POST" class="form">@csrf
                            <div class="row gx-20">
                                <input type="hidden" value="0" class="is_modal" name="is_modal">
                                <input type="hidden" value="{{ $lang }}" name="site_lang">
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="cookies_agreement_title"
                                               class="form-label">{{ __('title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="cookies_agreement_title"
                                               name="cookies_agreement_title" placeholder="{{ __('title') }}"
                                               value="{{ setting('cookies_agreement_title') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="error cookies_agreement_error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label class="form-label">{{ __('cookies_agreement_text') }}</label>
                                        <textarea class="form-control" id="product-update-editor"
                                                  name="cookies_agreement" placeholder="{{ __('enter_cookies_agreement_text') }}">{{ setting('cookies_agreement',$lang) }}</textarea>
                                        <div class="nk-block-des text-danger">
                                            <p class="error cookies_agreement_error"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-12 sandbox_mode_div mb-4">
                                    <input type="hidden" name="cookies_status" value="{{ setting('cookies_status') == 1 ? 1 : 0 }}">
                                    <label class="form-label"
                                           for="cookies_status">{{ __('cookies_agreement_text') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="cookies_status"
                                               class="sandbox_mode" {{ setting('cookies_status') == 1 ? 'checked' : '' }}>
                                        <label for="cookies_status"></label>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="select-type-v2 mb-4 ">
                                        <label for="privacy_agreement" class="form-label">{{ __('privacy') }}</label>
                                        <select class="form-select form-select-lg mb-3 with_search"
                                                name="privacy_agreement" id="privacy_agreement">
                                            @foreach($pages as $page)
                                                <option value="{{ $page->id }}" {{ setting('privacy_agreement') && $page->id == setting('privacy_agreement') ? 'selected' : '' }}>{{ $page->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="select-type-v2 mb-4 ">
                                        <label for="term_agreements" class="form-label">{{ __('terms_condition') }}</label>
                                        <select class="form-select form-select-lg mb-3 with_search"
                                                name="terms_agreement" id="term_agreements">
                                            @foreach($pages as $page)
                                                <option value="{{ $page->id }}" {{ setting('terms_agreement') && $page->id == setting('terms_agreement') ? 'selected' : '' }}>{{ $page->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="select-type-v2 mb-4 ">
                                        <label for="payment_agreement" class="form-label">{{ __('payment_method') }}</label>
                                        <select class="form-select form-select-lg mb-3 with_search"
                                                name="payment_agreement" id="payment_agreement">
                                            @foreach($pages as $page)
                                                <option value="{{ $page->id }}" {{ setting('payment_agreement') && $page->id == setting('payment_agreement') ? 'selected' : '' }}>{{ $page->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="select-type-v2 mb-4 ">
                                        <label for="refund_agreement" class="form-label">{{ __('refund_policy') }}</label>
                                        <select class="form-select form-select-lg mb-3 with_search"
                                                name="refund_agreement" id="refund_agreement">
                                            @foreach($pages as $page)
                                                <option value="{{ $page->id }}" {{ setting('refund_agreement') && $page->id == setting('refund_agreement') ? 'selected' : '' }}>{{ $page->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- End Show In -->
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
