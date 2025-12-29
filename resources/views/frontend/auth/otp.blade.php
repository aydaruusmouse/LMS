@extends('frontend.layouts.master')
@section('title', __('otp'))
@section('content')
  <!--====== Start OTP Section ======-->
  <section class="otp-section p-t-130 p-b-200 p-b-md-100 p-b-sm-50 p-t-md-90 p-t-sm-40">
    <div class="container container-1278">
        <div class="form-internal">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-5 col-lg-8 col-md-10">
                    <div class="user-form-container max-content m-t-40 m-t-sm-0">
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
                        <div class="form-title text-align-center m-b-40">
                            <h3 class="m-0 text-uppercase">{{__('confirm_your_mail') }}</h3>
                            <p>{{__('forget_password_hints') }} {{ $email }}</p>
                        </div>
                        <form action="{{ route('confirm.password.otp-submit') }}" method="get" class="form otp-form needs-validation" novalidate>
                            @csrf
                            <div class="row text-center justify-content-center gx-3" dir="ltr">
                                <div class="col">
                                    <input type="number" required value="{{ $otp_array[0] }}" name="first">
                                    @if($errors->has('first'))
                                        <div class="nk-block-des text-danger">
                                            <p>{{ $errors->first('first') }}</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="col">
                                    <input type="number" required value="{{ $otp_array[1] }}" name="second">
                                    @if($errors->has('second'))
                                        <div class="nk-block-des text-danger">
                                            <p>{{ $errors->first('second') }}</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="col">
                                    <input type="number" required value="{{ $otp_array[2] }}" name="third">
                                    @if($errors->has('third'))
                                        <div class="nk-block-des text-danger">
                                            <p>{{ $errors->first('third') }}</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="col">
                                    <input type="number" required value="{{ $otp_array[3] }}" name="fourth">
                                    @if($errors->has('fourth'))
                                        <div class="nk-block-des text-danger">
                                            <p>{{ $errors->first('fourth') }}</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <button class="template-btn m-t-sm-30 m-t-55 m-b-30" type="submit">{{__('verify') }}</button>
                                    @if($errors->has('email'))
                                        <div class="nk-block-des text-danger">
                                            <p>{{ $errors->first('email') }}</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <div class="forgot-pass-btn m-b-20">
                                        {{__('do_not_received_the_otp_code') }}? <a href="#">{{__('resend_otp') }}.</a>
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
<!--====== End OTP Section ======-->
@endsection

