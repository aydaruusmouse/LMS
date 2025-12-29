@extends('backend.layouts.master')
@section('title', __('firebase_setting'))
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-lg-6 col-md-9">
                <h3 class="section-title">{{ __('firebase_setting') }}</h3>
                <div class="bg-white redious-border pt-30 p-20 p-sm-30">

                    <form action="{{ route('firebase.update') }}" method="post" class="form">@csrf
                        <div class="row gx-20">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="d-flex gap-12">
                                            <label for="google">{{ __('google') }}</label>
                                            <div class="setting-check">
                                                <input type="checkbox" value="1" id="google" name="is_google_login_activated" {{ setting('is_google_login_activated') == 1 ? 'checked' : '' }}>
                                                <label for="google"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="d-flex gap-12">
                                            <label for="facebook">{{ __('facebook') }}</label>
                                            <div class="setting-check">
                                                <input type="checkbox" value="1" id="facebook" name="is_facebook_login_activated" {{ setting('is_facebook_login_activated') == 1 ? 'checked' : '' }}>
                                                <label for="facebook"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="d-flex gap-12">
                                            <label for="twitter">{{ __('twitter') }}</label>
                                            <div class="setting-check">
                                                <input type="checkbox" value="1" id="twitter" name="is_twitter_login_activated" {{ setting('is_twitter_login_activated') == 1 ? 'checked' : '' }}>
                                                <label for="twitter"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="api_key" class="form-label">{{ __('api_key') }}</label>
                                    <input type="text" class="form-control rounded-2" id="api_key" name="api_key" placeholder="{{ __('api_key') }}" value="{{ stringMasking(setting('api_key'),'*') }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="api_key_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="auth_domain" class="form-label">{{ __('auth_domain') }}</label>
                                    <input type="text" class="form-control rounded-2" id="auth_domain" name="auth_domain" placeholder="{{ __('auth_domain') }}" value="{{ stringMasking(setting('auth_domain'),'*') }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="auth_domain_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="project_id" class="form-label">{{ __('project_id') }}</label>
                                    <input type="text" class="form-control rounded-2" id="project_id" name="project_id" placeholder="{{ __('project_id') }}" value="{{ stringMasking(setting('project_id'),'*') }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="project_id_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="storage_bucket" class="form-label">{{ __('storage_bucket') }}</label>
                                    <input type="text" class="form-control rounded-2" id="storage_bucket" name="storage_bucket" placeholder="{{ __('storage_bucket') }}" value="{{ stringMasking(setting('storage_bucket'),'*') }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="storage_bucket_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="messaging_sender_id" class="form-label">{{ __('messaging_sender_id') }}</label>
                                    <input type="text" class="form-control rounded-2" id="messaging_sender_id" name="messaging_sender_id" placeholder="{{ __('messaging_sender_id') }}" value="{{ stringMasking(setting('messaging_sender_id'),'*') }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="messaging_sender_id_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="app_id" class="form-label">{{ __('app_id') }}</label>
                                    <input type="text" class="form-control rounded-2" id="app_id" name="app_id" placeholder="{{ __('app_id') }}" value="{{ stringMasking(setting('app_id'),'*') }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="app_id_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="measurement_id" class="form-label">{{ __('measurement_id') }}</label>
                                    <input type="text" class="form-control rounded-2" id="measurement_id" name="measurement_id" placeholder="{{ __('measurement_id') }}" value="{{ stringMasking(setting('measurement_id'),'*') }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="measurement_id_error error"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-items-center mt-30">
                            <button type="submit" class="btn sg-btn-primary">{{ __('submit') }}</button>
                            @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
