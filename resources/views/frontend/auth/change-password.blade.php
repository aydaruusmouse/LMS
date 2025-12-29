@extends('frontend.layouts.master')
@section('title', __('change_password'))
@section('content')
<!--====== Start Change Password Section ======-->
<section class="change-password-section p-t-130 p-b-75 p-b-sm-50 p-t-md-90 p-t-sm-40">
    <div class="container container-1278">
        <div class="form-internal">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-5 col-lg-8 col-md-10">
                    <div class="user-form-container m-t-40 m-t-sm-0">
                        <div class="form-shape">
                            <svg width="140" height="140" class="image-1" viewBox="0 0 140 140" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g opacity="0.5">
                                    <rect width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect y="15" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect y="30" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect y="45" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect y="60" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect y="75" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect y="90" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect y="105" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect y="120" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect y="135" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="15" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="15" y="15" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="15" y="30" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="15" y="45" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="15" y="60" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="15" y="75" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="15" y="90" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="15" y="105" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="15" y="120" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="15" y="135" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="30" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="30" y="15" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="30" y="30" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="30" y="45" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="30" y="60" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="30" y="75" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="30" y="90" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="30" y="105" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="30" y="120" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="30" y="135" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="45" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="45" y="15" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="45" y="30" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="45" y="45" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="45" y="60" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="45" y="75" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="45" y="90" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="45" y="105" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="45" y="120" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="45" y="135" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="60" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="60" y="15" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="60" y="30" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="60" y="45" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="60" y="60" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="60" y="75" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="60" y="90" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="60" y="105" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="60" y="120" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="60" y="135" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="75" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="75" y="15" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="75" y="30" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="75" y="45" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="75" y="60" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="75" y="75" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="75" y="90" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="75" y="105" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="75" y="120" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="75" y="135" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="90" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="90" y="15" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="90" y="30" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="90" y="45" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="90" y="60" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="90" y="75" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="90" y="90" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="90" y="105" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="90" y="120" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="90" y="135" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="105" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="105" y="15" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="105" y="30" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="105" y="45" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="105" y="60" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="105" y="75" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="105" y="90" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="105" y="105" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="105" y="120" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="105" y="135" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="120" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="120" y="15" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="120" y="30" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="120" y="45" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="120" y="60" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="120" y="75" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="120" y="90" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="120" y="105" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="120" y="120" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="120" y="135" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="135" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="135" y="15" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="135" y="30" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="135" y="45" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="135" y="60" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="135" y="75" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="135" y="90" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="135" y="105" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="135" y="120" width="5" height="5" fill="var(--color-secondary-4)"/>
                                    <rect x="135" y="135" width="5" height="5" fill="var(--color-secondary-4)"/>
                                </g>
                            </svg>
                            <img src="{{ static_asset('frontend/img/particle/ellipse-no-fill-large.svg') }}" alt="Ellipse" class="image-2">
                            <img src="{{ static_asset('frontend/img/particle/ellipse-fill-large.svg') }} " alt="Ellipse" class="image-3">
                        </div>
                        <div class="form-title">
                            <h3>{{__('change_password') }}</h3>
                        </div>
                        <form method="POST" action="{{ route('change.password-update') }}" class="form needs-validation" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-12 password-input">
                                    <label for="current_password">{{__('current_password') }} *</label>
                                    <input type="password" class="form-control" name="current_password" id="current_password" placeholder="{{__('current_password') }}" data-lpignore="true" required>
                                    <div class="invalid-feedback">
                                        {{__('please_add_a_password') }}.
                                    </div>
                                    <div class="valid-feedback">
                                        {{__('looks_good') }}!
                                    </div>
                                    <span id="#current_password" class="fa fa-fw fa-eye toggle-password"></span>
                                    @if($errors->has('current_password'))
                                        <div class="nk-block-des text-danger">
                                            <p>{{ $errors->first('current_password') }}</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-12 password-input">
                                    <label for="password">{{__('new_password') }} *</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="{{__('new_password') }}" data-lpignore="true" required>
                                    <div class="invalid-feedback">
                                        {{__('please_add_a_password') }}.
                                    </div>
                                    <div class="valid-feedback">
                                        {{__('looks_good') }}!
                                    </div>
                                    <span id="#password" class="fa fa-fw fa-eye toggle-password"></span>
                                    @if($errors->has('password'))
                                        <div class="nk-block-des text-danger">
                                            <p>{{ $errors->first('password') }}</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-12 password-input">
                                    <label for="password_confirmation">{{__('confirm_password') }}</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Choose Password" data-lpignore="true" required>
                                    <div class="invalid-feedback">
                                        {{__('please_add_a_confirm_password') }}.
                                    </div>
                                    <div class="valid-feedback">
                                        {{__('looks_good') }}!
                                    </div>
                                    <span id="#password_confirmation" class="fa fa-fw fa-eye toggle-password"></span>
                                    @if($errors->has('password_confirmation'))
                                        <div class="nk-block-des text-danger">
                                            <p>{{ $errors->first('password_confirmation') }}</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <div class="col-12">
                                        <button class="template-btn m-b-25" type="submit">{{__('submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== End Change Password Section ======-->
@endsection
