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
                                    <label for="custom_css" class="form-label">{{ __('css') }}</label>
                                    <input type="hidden" name="custom_css" class="cross_origin_input" value="{{ setting('custom_css') }}">
                                    <textarea class="form-control cross-origin" id="custom_css"
                                              placeholder="body{
background-color : red !important;
}">{{ base64_decode(setting('custom_css')) }}</textarea>
                                    <div class="nk-block-des text-danger">
                                        <p class="custom_css_error error"></p>
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
