@extends('backend.layouts.master')
@section('title', __('header_content'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website_setting.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <h3 class="section-title">{{ __('header_content') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <div class="default-tab-list default-tab-list-v2  bg-white redious-border p-20 p-sm-30">
                            @include('backend.admin.website_setting.component.header_setting_menu')
                            <form action="{{ route('footer.update-setting') }}" method="POST" class="form">@csrf
                                <input type="hidden" name="menu_name" value="header_menu">
                                <div class="row gx-20">
                                    <div class="col-lg-12 input_file_div mb-4">
                                        <div class="mb-3">
                                            <label class="form-label mb-1">{{__('light_logo')}} (100X36)</label>
                                            <label for="light_logo"
                                                   class="file-upload-text">
                                                <p>1 {{ __('file_selected') }}</p>
                                                <span class="file-btn">{{__('choose_file') }}</span></label>
                                            <input class="d-none file_picker" type="file" id="light_logo"
                                                   name="light_logo">
                                            <div class="nk-block-des text-danger">
                                                <p class="light_logo_error error">{{ $errors->first('light_logo') }}</p>
                                            </div>
                                        </div>
                                        <div class="selected-files d-flex flex-wrap gap-20">
                                            <div class="selected-files-item">
                                                <img class="selected-img"
                                                     src="{{ getFileLink('original_image',setting('light_logo')) }}"
                                                     alt="light_logo">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 input_file_div">
                                        <div class="mb-3">
                                            <label class="form-label mb-1">{{__('dark_logo') }} (100X36)</label>
                                            <label for="dark_logo"
                                                   class="file-upload-text">
                                                <p>1 {{ __('file_selected') }}</p>
                                                <span class="file-btn">{{__('choose_file') }}</span></label>
                                            <input class="d-none file_picker" type="file" id="dark_logo"
                                                   name="dark_logo">
                                            <div class="nk-block-des text-danger">
                                                <p class="dark_logo_error error">{{ $errors->first('dark_logo') }}</p>
                                            </div>
                                        </div>
                                        <div class="selected-files d-flex flex-wrap gap-20">
                                            <div class="selected-files-item">
                                                <img class="selected-img"
                                                     src="{{ getFileLink('original_image',setting('dark_logo')) }}"
                                                     alt="dark_logo">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-30">
                                        <button type="submit" class="btn sg-btn-primary">{{ __('update') }}</button>
                                        @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('backend.admin.website_setting.component.new_menu')
@endsection
