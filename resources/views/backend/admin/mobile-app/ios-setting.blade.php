@extends('backend.layouts.master')
@section('title', __('ios_setting'))
@section('content')
        <section class="android-settings-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="section-title">{{__('ios_setting')}}</h3>
                        <div class="bg-white redious-border p-20 p-sm-30">
                            <form action="{{ route('mobile-settings.update') }}" method="post"
                                  class="form">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="ios_current_version_code"
                                                   class="form-label">{{__('current_version_code') }}</label>
                                            <input type="text" class="form-control rounded-2"
                                                   id="ios_current_version_code"
                                                   name="ios_current_version_code"
                                                   value="{{ old('ios_current_version_code') ? old('ios_current_version_code') : setting('ios_current_version_code') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="ios_current_version_code_error error">{{ $errors->first('ios_current_version_code') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Current Version Code -->

                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="ios_current_version_name"
                                                   class="form-label">{{__('current_version_name')}}</label>
                                            <input type="text" class="form-control rounded-2"
                                                   id="ios_current_version_name"
                                                   name="ios_current_version_name"
                                                   value="{{ old('ios_current_version_name') ? old('ios_current_version_name') : setting('ios_current_version_name') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="ios_current_version_name_error error">{{ $errors->first('ios_current_version_name') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Current Version Name -->

                                    <div class="col-12">
                                        <div class="App-upload-link mb-30">
                                            <label for="ios_app_url" class="form-label mb-1">{{__('app_url') }}</label>
                                            <input type="url" class="form-control rounded-2" id="ios_app_url"
                                                   name="ios_app_url"
                                                   value="{{ old('ios_app_url') ? old('ios_app_url') : setting('ios_app_url') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="ios_app_url_error error">{{ $errors->first('ios_app_url') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End App URL -->

                                    <div class="col-lg-12">
                                        <label for="ios_whats_new" class="form-label">{{__('whats_new') }}</label>
                                        <div class="">
                                            <textarea class="form-control h-80"
                                                      id="ios_whats_new"
                                                      name="ios_whats_new">{{  setting('ios_whats_new') }}</textarea>
                                            {{-- <label for="ios_whats_new">{{__('write_something_here') }} ...</label> --}}
                                            <div class="nk-block-des text-danger">
                                                <p class="ios_whats_new_error error">{{ $errors->first('ios_whats_new') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Description -->
                                    @if(hasPermission('mobile-settings.update'))
                                        <div class="d-flex justify-content-between align-items-center mt-30">
                                            <div class="d-flex gap-12">
                                                <label for="ios_skippable">{{__('update_skipable') }}</label>
                                                <div class="setting-check">
                                                    <input type="checkbox" value="1" id="ios_skippable"
                                                           name="ios_skippable" {{ setting('ios_skippable') == 1 ? 'checked' : ''}}>
                                                    <input type="hidden" value="ios" name="mobile_app">
                                                    <label for="ios_skippable"></label>
                                                </div>
                                            </div>
                                            <!-- End Update Skipable -->
                                            <button type="submit" class="btn sg-btn-primary">{{__('update') }}</button>
                                            @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Android Settings Section -->
@endsection
