@extends('backend.layouts.master')
@section('title', __('android_setting'))
@section('content')
    <section class="android-settings-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('android_setting')}}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('mobile-settings.update') }}" method="post" class="form">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="android_current_version_code"
                                               class="form-label">{{__('current_version_code') }}</label>
                                        <input type="text" class="form-control rounded-2"
                                               id="android_current_version_code"
                                               placeholder="{{__('current_version_code') }}"
                                               name="android_current_version_code"
                                               value="{{ old('android_current_version_code') ? old('android_current_version_code') : setting('android_current_version_code') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="android_current_version_code_error error">{{ $errors->first('android_current_version_code') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Current Version Code -->

                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="android_current_version_name"
                                               class="form-label">{{__('current_version_name')}}</label>
                                        <input type="text" class="form-control rounded-2"
                                               id="android_current_version_name"
                                               placeholder="{{__('current_version_name') }}"
                                               name="android_current_version_name"
                                               value="{{ old('android_current_version_name') ? old('android_current_version_name') : setting('android_current_version_name') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="android_current_version_name_error error">{{ $errors->first('android_current_version_name') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Current Version Name -->

                                <div class="col-12">
                                    <div class="App-upload-link mb-30">
                                        <label for="android_app_url"
                                               class="form-label mb-1">{{__('app_url') }}</label>
                                        <input type="url" class="form-control rounded-2" id="android_app_url"
                                               placeholder="{{__('app_url') }}" name="android_app_url"
                                               value="{{ old('android_app_url') ? old('android_app_url') : setting('android_app_url') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="android_app_url_error error">{{ $errors->first('android_app_url') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End App URL -->

                                <div class="col-lg-12">
                                    <label for="android_whats_new" class="form-label">{{__('whats_new') }}</label>
                                    <div class="">
                                        <textarea class="form-control h-80"
                                                  placeholder="{{__('write_something_here') }}"
                                                  id="android_whats_new"
                                                  name="android_whats_new">{{  setting('android_whats_new') }}</textarea>
                                        {{-- <label for="android_whats_new">{{__('write_something_here') }} ...</label> --}}
                                        <div class="nk-block-des text-danger">
                                            <p class="android_whats_new_error error">{{ $errors->first('android_whats_new') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Description -->
                                <div class="d-flex justify-content-between align-items-center mt-30">
                                    <div class="d-flex gap-12">
                                        <label for="android_skippable">{{__('update_skipable') }}</label>
                                        <div class="setting-check">
                                            <input type="checkbox" value="1" id="android_skippable"
                                                   name="android_skippable" {{ setting('android_skippable') == 1 ? 'checked' : ''}}>
                                            <input type="hidden" value="android" name="mobile_app">
                                            <label for="android_skippable"></label>
                                        </div>
                                    </div>
                                    <!-- End Update Skipable -->
                                    <button type="submit" class="btn sg-btn-primary">{{__('update') }}</button>
                                    @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Android Settings Section -->
@endsection
