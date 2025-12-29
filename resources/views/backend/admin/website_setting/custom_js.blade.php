@extends('backend.layouts.master')
@section('title', __('custom_css'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('backend.admin.website_setting.sidebar_component')
            <div class="col-xxl-9 col-lg-8 col-md-8">
                <h3 class="section-title">{{ __('custom_css') }}</h3>
                <div class="bg-white redious-border pt-30 p-20 p-sm-30">
                    <form action="{{ route('custom.css.js') }}" method="post" class="form">@csrf
                        <div class="row gx-20">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="custom_header_script" class="form-label">{{ __('header_script') }}</label>
                                    <input type="hidden" name="custom_header_script" class="cross_origin_input" value="{{ setting('custom_header_script') }}">
                                    <textarea class="form-control cross-origin" id="custom_header_script"
                                              placeholder="<script>
    ......
</script>">{{ base64_decode(setting('custom_header_script')) }}</textarea>
                                    <div class="nk-block-des text-danger">
                                        <p class="custom_header_script_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="custom_header_script" class="form-label">{{ __('footer_script') }}</label>
                                    <input type="hidden" name="custom_footer_script" class="cross_origin_input" value="{{ setting('custom_footer_script') }}">
                                    <textarea class="form-control cross-origin" id="custom_footer_script"
                                              placeholder="<script>
    ......
</script>">{{ base64_decode(setting('custom_footer_script')) }}</textarea>
                                    <div class="nk-block-des text-danger">
                                        <p class="custom_footer_script_error error"></p>
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
