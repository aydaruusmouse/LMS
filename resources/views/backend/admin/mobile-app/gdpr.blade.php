@extends('backend.layouts.master')
@section('title', __('custom_gdpr'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-12">
                    <h3 class="section-title">{{ __('custom_gdpr') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('mobile.gdpr') }}" method="POST" class="form">@csrf
                            <div class="row gx-20">
                                <input type="hidden" value="0" class="is_modal" name="is_modal">
                                <div class="col-lg-12">
                                    <div class="select-type-v2 mb-4 ">
                                        <label for="privacy_agreement" class="form-label">{{ __('privacy') }}</label>
                                        <select class="form-select form-select-lg mb-3 with_search"
                                                name="mobile_privacy" id="mobile_privacy">
                                            <option value="">{{ __('select_page') }}</option>
                                            @foreach($pages as $page)
                                                <option value="{{ $page->id }}" {{ setting('mobile_privacy') == $page->id ? 'selected' : '' }}>{{ $page->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="select-type-v2 mb-4 ">
                                        <label for="term_agreements" class="form-label">{{ __('terms_condition') }}</label>
                                        <select class="form-select form-select-lg mb-3 with_search"
                                                name="mobile_terms" id="mobile_terms">
                                            <option value="">{{ __('select_page') }}</option>
                                            @foreach($pages as $page)
                                                <option value="{{ $page->id }}" {{ setting('mobile_terms') == $page->id ? 'selected' : '' }}>{{ $page->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="select-type-v2 mb-4 ">
                                        <label for="payment_agreement" class="form-label">{{ __('about_us') }}</label>
                                        <select class="form-select form-select-lg mb-3 with_search"
                                                name="mobile_about_us" id="mobile_about_us">
                                            <option value="">{{ __('select_page') }}</option>
                                            @foreach($pages as $page)
                                                <option value="{{ $page->id }}" {{ setting('mobile_about_us') == $page->id ? 'selected' : '' }}>{{ $page->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="select-type-v2 mb-4 ">
                                        <label for="refund_agreement" class="form-label">{{ __('help_support') }}</label>
                                        <select class="form-select form-select-lg mb-3 with_search"
                                                name="mobile_help" id="mobile_help">
                                            <option value="">{{ __('select_page') }}</option>
                                            @foreach($pages as $page)
                                                <option value="{{ $page->id }}" {{ setting('mobile_help') == $page->id ? 'selected' : '' }}>{{ $page->title }}</option>
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
