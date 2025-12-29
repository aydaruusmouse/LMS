@extends('backend.layouts.master')
@section('title', __('social_link_settings'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website_setting.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <h3 class="section-title">{{ __('social_link') }}</h3>
                    <div class="default-tab-list default-tab-list-v2  bg-white redious-border activeItem-bd-none p-20 p-sm-30">
                    @include('backend.admin.website_setting.component.footer_setting_sidebar')
                        <form action="{{ route('footer.update-setting') }}" method="POST" class="form">@csrf
                            <div class="row gx-20">
                                <div class="d-flex gap-12 sandbox_mode_div mb-4">
                                    <input type="hidden" name="show_social_links" value="{{ setting('show_social_links') == 1 ? 1 : 0 }}">
                                    <label class="form-label"
                                           for="show_social_links">{{ __('show_social_links') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="show_social_links"
                                               class="sandbox_mode" {{ setting('show_social_links') == 1 ? 'checked' : '' }}>
                                        <label for="show_social_links"></label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <div class="d-flex align-items-center gap-2">
                                            <label for="facebook" class="form-label">{{__('facebook') }}</label>
                                            <span class="info-content">
                                                <i class="las la-info-circle" data-bs-container="body" data-bs-trigger="hover" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="{{__('Leave the the field blank if you don\'t want to display it')}}"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control rounded-2" id="facebook" name="facebook_link"
                                               placeholder="{{ __('enter_facebook_link') }}" value="{{ setting('facebook_link') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="facebook_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="twitter" class="form-label">{{__('twitter') }}</label>
                                        <input type="text" class="form-control rounded-2" id="twitter" name="twitter_link"
                                               placeholder="{{ __('enter_twitter_link') }}" value="{{ setting('twitter_link') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="twitter_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="instagram" class="form-label">{{__('instagram') }}</label>
                                        <input type="text" class="form-control rounded-2" id="instagram" name="instagram_link"
                                               placeholder="{{ __('enter_instagram_link') }}" value="{{ setting('instagram_link') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="instagram_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="youtube" class="form-label">{{__('youtube') }}</label>
                                        <input type="text" class="form-control rounded-2" id="youtube" name="youtube_link"
                                               placeholder="{{ __('enter_youtube_link') }}" value="{{ setting('youtube_link') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="youtube_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="">
                                        <label for="linkedin" class="form-label">{{__('linkedin') }}</label>
                                        <input type="text" class="form-control rounded-2" id="linkedin" name="linkedin_link"
                                               placeholder="{{ __('enter_linkedin_link') }}" value="{{ setting('linkedin_link') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="linkedin_error error"></p>
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
