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
                        <div class="row gx-20">
                            <div class="col-12">
                                <div class="mb-4">
                                    <label for="title" class="form-label">{{__('topbar_phone') }}</label>
                                    <input type="text" class="form-control rounded-2" id="title" name="topbar_phone"
                                           placeholder="{{ __('enter_phone') }}" value="{{ setting('topbar_phone',app()->getLocale())}}">
                                    <div class="nk-block-des text-danger">
                                        <p class="title_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-4">
                                    <label for="title" class="form-label">{{__('topbar_email') }}</label>
                                    <input type="text" class="form-control rounded-2" id="title" name="topbar_email"
                                           placeholder="{{ __('enter_email') }}" value="{{ setting('topbar_email',app()->getLocale())}}">
                                    <div class="nk-block-des text-danger">
                                        <p class="title_error error"></p>
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
    @push('js_asset')
        <script src="{{ static_asset('admin/js/jquery.nestable.min.js') }}"></script>
    @endpush
