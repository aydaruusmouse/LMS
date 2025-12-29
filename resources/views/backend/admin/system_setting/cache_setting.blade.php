@extends('backend.layouts.master')
@section('title', __('cache_setting'))
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-lg-6 col-md-9">
                <h3 class="section-title">{{ __('cache_setting') }}</h3>
                <div class="bg-white redious-border pt-30 p-20 p-sm-30">

                    <form action="{{ route('admin.cache') }}" method="post" class="form">@csrf
                        <div class="row gx-20">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="cache_status" class="form-label">{{ __('cache_status') }}</label>
                                    <select class="form-select form-select-lg mb-3 without_search" name="is_cache_enabled" id="cache_status">
                                        <option value="disable"
                                            {{ old('is_cache_enabled') == 'disable' ? 'selected' : (setting('is_cache_enabled' == 'disable') ? 'selected' : '') }}
                                        >{{ __('disable') }}</option>
                                            <option value="enable"
                                                {{ old('is_cache_enabled') == 'enable' ? 'selected' : (setting('is_cache_enabled') == 'enable' ? 'selected' : '') }}>{{ __('enable') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12 default_cache_div {{ setting('is_cache_enabled') == 'enable' ? '' : 'd-none' }}">
                                <div class="mb-4">
                                    <label for="default_cache" class="form-label">{{ __('default_cache') }}</label>
                                    <div class="select-type-v2">
                                        <select class="form-select form-select-lg mb-3 without_search" name="default_cache" id="default_cache">
                                            <option value="file"
                                                {{ old('default_cache') == 'file' ? 'selected' : (setting('default_cache') == 'file' ? 'selected' : '') }}>{{ __('file') }}</option>
                                            <option value="redis"
                                                {{ old('default_cache') == 'redis' ? 'selected' : (setting('default_cache') == 'redis' ? 'selected' : '') }}>{{ __('redis') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 redis_div {{ setting('default_cache') == 'redis' && setting('is_cache_enabled') == 'enable' ? '' : 'd-none' }}">
                                <div class="mb-4">
                                    <label for="redis_host" class="form-label">{{ __('redis_host') }}</label>
                                    <input id="redis_host" type="text" name="redis_host" placeholder="{{ __('enter_redis_host') }}" class="form-control rounded-2" value="{{ setting('redis_host') }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="redis_host_error error"></p>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-12 redis_div {{ setting('default_cache') == 'redis' && setting('is_cache_enabled') == 'enable' ? '' : 'd-none' }}">
                                <div class="mb-4">
                                    <label for="redis_password" class="form-label">{{ __('redis_password') }}</label>
                                    <input type="password" class="form-control rounded-2" id="redis_password" placeholder="{{ __('enter_redis_password') }}" name="redis_password" value="{{ stringMasking(setting('redis_password'),'*',0) }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="redis_password_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 redis_div {{ setting('default_cache') == 'redis' && setting('is_cache_enabled') == 'enable' ? '' : 'd-none' }}">
                                <div class="mb-4">
                                    <label for="redis_port" class="form-label">{{ __('redis_port') }}</label>
                                    <input type="text" class="form-control rounded-2" id="redis_port" name="redis_port" placeholder="{{ __('enter_redis_port') }}" value="{{ setting('redis_port') }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="redis_port_error error"></p>
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

@push('js')
    <script>
        $(document).ready(function () {
            $(document).on('change','#cache_status', function () {
                if ($(this).val() == 'enable') {
                    $('.default_cache_div').removeClass('d-none');
                } else {
                    $('.default_cache_div').addClass('d-none');
                    $('.redis_div').addClass('d-none');
                }
            });
            $(document).on('change','#default_cache', function () {
                if ($(this).val() == 'redis') {
                    $('.redis_div').removeClass('d-none');
                } else {
                    $('.redis_div').addClass('d-none');
                }
            });
        });
    </script>
@endpush
