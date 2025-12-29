@extends('backend.layouts.master')
@section('title', __('payment_method_banner_settings'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website_setting.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <h3 class="section-title">{{ __('payment_method_banner_settings') }}</h3>
                    <div class="default-tab-list default-tab-list-v2  bg-white redious-border website-setting-social-link p-20 p-sm-30">
                        @include('backend.admin.website_setting.component.footer_setting_sidebar')
                        <form action="{{ route('footer.update-setting') }}" method="POST" class="form">@csrf
                            <div class="row gx-20">
                                <div class="d-flex gap-12 sandbox_mode_div mb-4">
                                    <input type="hidden" name="show_payment_method_banner" value="{{ setting('show_payment_method_banner') == 1 ? 1 : 0 }}">
                                    <label class="form-label"
                                           for="show_payment_method_banner">{{ __('show_payment_method_banner') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="show_payment_method_banner"
                                               class="sandbox_mode" {{ setting('show_payment_method_banner') == 1 ? 'checked' : '' }}>
                                        <label for="show_payment_method_banner"></label>
                                    </div>
                                </div>

                                <div class="col-lg-12 input_file_div">
                                    <div class="mb-3">
                                        <label for="paymentBannerUpload" class="form-label mb-1">{{ __('payment_method_banner') }} (683x66)</label>
                                        <label for="paymentBannerUpload" class="file-upload-text">
                                            <p>1 File Choosen</p>
                                            <span class="file-btn">{{ __('choose_file') }}</span>
                                        </label>
                                        <input class="d-none file_picker" type="file" name="payment_method_banner" id="paymentBannerUpload">
                                    </div>
                                    <div class="selected-files d-flex flex-wrap gap-20">
                                        <div class="selected-files-item">
                                            <img class="selected-img" src="{{ setting('payment_method_banner') && @is_file_exists(setting('payment_method_banner')['original_image']) ? get_media(setting('payment_method_banner')['original_image']) : getFileLink('80x80',[]) }}" alt="favicon">
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
@endsection
@push('js')
    <script src="{{ static_asset('admin/js/countries.js') }}"></script>
@endpush
