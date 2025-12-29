@extends('backend.layouts.master')
@section('title', __('newsletter_settings'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website_setting.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <h3 class="section-title">{{ __('newsletter_settings') }}</h3>
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
                                    <input type="hidden" name="show_newsletter" value="{{ setting('show_newsletter') == 1 ? 1 : 0 }}">
                                    <label class="form-label"
                                           for="show_newsletter">{{ __('show_newsletter') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="show_newsletter"
                                               class="sandbox_mode" {{ setting('show_newsletter') == 1 ? 'checked' : '' }}>
                                        <label for="show_newsletter"></label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="title" class="form-label">{{__('newsletter_title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="title" name="newsletter_title"
                                               placeholder="{{ __('enter_title') }}" value="{{ setting('newsletter_title',$lang) }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="title_error error"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="footer_logo_description" class="form-label">{{__('footer_logo_description') }}</label>
                                        <input type="text" class="form-control rounded-2" id="footer_logo_description" name="footer_logo_description"
                                               placeholder="{{ __('enter_title') }}" value="{{ setting('footer_logo_description',$lang) }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="footer_logo_description error"></p>
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
