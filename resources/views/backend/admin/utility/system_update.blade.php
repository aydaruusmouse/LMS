@extends('backend.layouts.master')
@section('title', __('system_update'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="section-title">{{ __('system_update') }}</h3>
                <div class="bg-white redious-border p-20 p-sm-30">
                    <div class="alert fade show d-none alert_div" role="alert">
                        <strong></strong> <span></span>
                    </div>
                    <div class="row">
                        <div class="pageTitle">
                            <h6 class="sub-title">{{ __('version_info') }}</h6>
                        </div>
                        <div class="col-lg-6">
                            <div class="card mb-20 text-center">
                                <div class="card-body">
                                    <h5 class="card-title">{{ __('your_version') }}</h5>
                                    <p class="card-text">{{ 'v'.setting('version_code') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card mb-20 text-center">
                                <div class="card-body">
                                    <h5 class="card-title">{{ __('latest_version') }}</h5>
                                    <p class="card-text">{{ $next_version_code }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            @if(!$is_old)
                                <div class="alert alert-success center">
                                    <p><i class="bx bx-check-circle"></i> {{ __('you_are_using_the_latest_version') }}
                                    </p>
                                </div>
                            @else
                                <h6 class="mb-20">{{ __('update_hints') }}:</h6>
                                <ul class="mb-40">
                                    <li>1. {{ __('update_step_1') }}</li>
                                    <li>2. {{ __('update_step_2') }} <a href="{{ route('preference') }}" target="_blank"
                                                                        class="text-decoration-underline sg-text-primary">{{ __('preferences') }}</a>
                                    </li>
                                    <li>3. {{ __('review_the') }} <a href="https://codecanyon.net/item/yoori-laravel-vue-multivendor-pwa-ecommerce-cms-php-script/37142846#item-description__change-log"
                                                                     target="_blank" class="text-decoration-underline sg-text-primary">{{ __('change_log') }}</a>
                                    </li>
                                </ul>
                                <button type="button" class="btn btn-pink w-100" id="download_update" data-version="{{ $next_version }}"
                                        data-url="{{ route('system.update') }}">{{ __('update_your_version') }}</button>
                                @include('backend.common.loading-btn',['class'=>'btn btn-pink w-100','id' => "preloader"] )
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
