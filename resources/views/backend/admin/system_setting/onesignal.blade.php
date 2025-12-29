@extends('backend.layouts.master')
@section('title', __('onesignal_notification'))
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-lg-6 col-md-9">
                <h3 class="section-title">{{ __('onesignal_notification') }}</h3>
                <div class="bg-white redious-border pt-30 p-20 p-sm-30">

                    <form action="{{ route('onesignal.notification') }}" method="post" class="form">@csrf
                        <div class="row gx-20">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="onesignal_app_id" class="form-label">{{ __('app_id') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-2" id="onesignal_app_id" name="onesignal_app_id" placeholder="{{ __('enter_app_id') }}" value="{{ stringMasking(setting('onesignal_app_id'),'*') }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="onesignal_app_id_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="onesignal_rest_api_key" class="form-label">{{ __('rest_api_key') }}</label>
                                    <input type="text" class="form-control rounded-2" id="onesignal_rest_api_key" name="onesignal_rest_api_key" placeholder="{{ __('enter_rest_api_key') }}" value="{{ stringMasking(setting('onesignal_rest_api_key'),'*') }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="onesignal_rest_api_key_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="safari_web_id" class="form-label">{{ __('safari_web_id') }}</label>
                                    <input type="text" class="form-control rounded-2" id="safari_web_id" name="safari_web_id" placeholder="{{ __('enter_safari_web_id') }}" value="{{ stringMasking(setting('safari_web_id'),'*') }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="safari_web_id_error error"></p>
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
