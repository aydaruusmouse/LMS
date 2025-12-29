@extends('backend.layouts.master')
@section('title', __('apps_link_settings'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website_setting.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <h3 class="section-title">{{ __('apps_link_settings') }}</h3>
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
                                    <input type="hidden" name="show_apps_link" value="{{ setting('show_apps_link') == 1 ? 1 : 0 }}">
                                    <label class="form-label"
                                           for="show_apps_link">{{ __('show_apps_link') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="show_apps_link" name="show_apps_link"
                                               class="sandbox_mode" {{ setting('show_apps_link') == 1 ? 'checked' : '' }}>
                                        <label for="show_apps_link"></label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="title" class="form-label">{{__('title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="title" name="apps_link_title"
                                               placeholder="{{ __('enter_title') }}" value="{{ setting('apps_link_title', $lang) }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="title_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="description" class="form-label">{{__('description') }}</label>
                                        <textarea class="form-control" id="description" name="apps_link_description" placeholder="{{ __('enter_description') }}">{{ setting('apps_link_description',$lang) }}</textarea>
                                        <div class="nk-block-des text-danger">
                                            <p class="description_error error">{{ $errors->first('description') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <div class="d-flex align-items-center gap-2">
                                            <label for="play_store_link" class="form-label">{{__('play_store_link') }}</label>

                                            <span class="info-content">
                                                <i class="las la-info-circle" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="{{__('For remove the link keep this field blank')}}"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control rounded-2" id="play_store_link" name="play_store_link"
                                               placeholder="{{ __('enter_play_store_link') }}" value="{{ setting('play_store_link')}}">
                                        <div class="nk-block-des text-danger">
                                            <p class="play_store_link_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="">

                                        <div class="d-flex align-items-center gap-2">
                                            <label for="app_store_link" class="form-label">{{__('app_store_link') }}</label>
                                            <span class="info-content">
                                                <i class="las la-info-circle" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="{{__('For remove the link keep this field blank')}}"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control rounded-2" id="app_store_link" name="app_store_link"
                                               placeholder="{{ __('enter_app_store_link') }}" value="{{ setting('app_store_link')}}">
                                        <div class="nk-block-des text-danger">
                                            <p class="app_store_link_error error"></p>
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
