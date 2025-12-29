@extends('frontend.layouts.master')
@section('title', __('home'))
@section('content')
    <!--====== Start Profile Setting Section ======-->
    <section class="profile-setting-section p-t-50 p-b-80 p-b-md-50 p-b-sm-35 p-t-sm-30">
        <div class="container container-1278">
            <div class="row">
                @include('frontend.profile.sidebar')
                <div class="col-md-8">
                    <div class="profile-setting-wrapper m-b-30">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title-v3 color-dark m-b-40 m-b-sm-15">
                                    <h3>{{__('settings') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="setting-wrap">
                            <div class="subscription-setting m-b-20 m-b-sm-15">
                                <div class="setting-box">
                                    <h6>{{__('notification') }}</h6>
                                    <div class="setting-check">
                                        <input type="checkbox" class="status-change" id="notification"
                                               value="setting-status-change/notification" {{ setting('notification') == 1 ? 'checked' : ''}}>
                                        <label for="notification"></label>
                                    </div>
                                </div>
                                <div class="setting-box">
                                    <h6>{{__('subscribe_newsletter') }}</h6>
                                    <div class="setting-check">
                                        <input type="checkbox" class="status-change" id="subscribe_newsletter"
                                               value="setting-status-change/subscribe_newsletter" {{ setting('subscribe_newsletter') == 1 ? 'checked' : ''}}>
                                        <label for="subscribe_newsletter"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="subscription-setting m-b-20 m-b-sm-15">
                                <div class="setting-box">
                                    <h6>{{__('change_password') }}</h6>
                                    <div class="setting-check">
                                        <a href="{{ route('change.password') }}"
                                           class="template-btn bordered-btn-secondary nt-delete">{{__('change_password') }}</a>
                                    </div>
                                </div>
                                <div class="setting-box">
                                    <h6>{{__('delete_account') }}</h6>
                                    <div class="setting-check">
                                        @if(auth()->user()->is_deleted == 0)
                                            <a href="javascript:void(0)"
                                               onclick="delete_row('user/account',{{ auth()->user()->id }}, null)"
                                               class="template-btn bordered-btn-secondary nt-delete delete_row"
                                               data-toggle="tooltip"
                                               data-original-title="{{ __('Delete') }}">{{__('delete') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Profile Setting Section ======-->
@endsection
@include('frontend.common')
