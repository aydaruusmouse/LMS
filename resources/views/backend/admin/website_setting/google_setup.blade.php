@extends('backend.layouts.master')
@section('title', __('google_setup'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('backend.admin.website_setting.sidebar_component')
            <div class="col-xxl-9 col-lg-8 col-md-8">
                <h3 class="section-title">{{ __('google_setup') }}</h3>
                <div class="bg-white redious-border pt-30 p-20 p-sm-30">
                    <div class="section-top">
                        <h6>{{ __('google_analytics') }}</h6>
                    </div>
                    <form action="{{ route('google.setup') }}" method="post" class="form">@csrf
                        <div class="row gx-20">

                            <div class="col-12">
                                <div class="d-flex gap-12 sandbox_mode_div mb-4">
                                    <input type="hidden" name="is_google_analytics_activated" value="{{ setting('is_google_analytics_activated') == 1 ? 1 : 0 }}">
                                    <label class="form-label" for="is_google_analytics_activated">{{ __('status') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="is_google_analytics_activated" class="sandbox_mode" {{ setting('is_google_analytics_activated') == 1 ? 'checked' : '' }}>
                                        <label for="is_google_analytics_activated"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="tracking_code" class="form-label">{{ __('tracking_code') }}</label>
                                    <input type="hidden" name="tracking_code" class="cross_origin_input" value="{{ setting('tracking_code') }}">
                                    <textarea class="form-control cross-origin" id="tracking_code"
                                              placeholder="<script>
    ......
</script>">{{ base64_decode(setting('tracking_code')) }}</textarea>
                                    <div class="nk-block-des text-danger">
                                        <p class="tracking_code_error error"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12"><h6 class="sub-title">{{ __('google_recaptcha') }}</h6></div>

                            <div class="col-12">
                                <div class="d-flex gap-12 sandbox_mode_div mb-4">
                                    <input type="hidden" name="is_recaptcha_activated" value="{{ setting('is_recaptcha_activated') == 1 ? 1 : 0 }}">
                                    <label class="form-label" for="is_recaptcha_activated">{{ __('status') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="is_recaptcha_activated" class="sandbox_mode" {{ setting('is_recaptcha_activated') == 1 ? 'checked' : '' }}>
                                        <label for="is_recaptcha_activated"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="recaptcha_Site_key"
                                           class="form-label">{{ __('site_key') }}</label>
                                    <input type="text" class="form-control rounded-2" id="recaptcha_Site_key"
                                           placeholder="{{ __('enter_site_key') }}" name="recaptcha_Site_key" value="{{ setting('recaptcha_Site_key') }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="recaptcha_Site_key_error error"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="recaptcha_secret"
                                           class="form-label">{{ __('secret_key') }}</label>
                                    <input type="text" class="form-control rounded-2" id="recaptcha_secret"
                                           placeholder="{{ __('enter_secret_key') }}" name="recaptcha_secret" value="{{ setting('recaptcha_secret') }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="recaptcha_secret_error error"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-start align-items-center">
                                <button type="submit" class="btn sg-btn-primary">{{ __('update') }}</button>
                                @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                            </div>
                        </div>
                    </form>
                    <!-- End Image Optimization -->
                </div>
            </div>
        </div>
    </div>
@endsection
