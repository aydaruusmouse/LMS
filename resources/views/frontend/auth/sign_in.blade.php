@extends('frontend.layouts.master')
@section('title', __('sign_in'))

@section('title', __('sign_in'))
@section('content')
    <!--====== Start Sign In Section ======-->
    <section class="sign-in-section p-t-130 p-b-75 p-t-md-90 p-b-sm-40 p-t-sm-40">
        <div class="container container-1278">
            <div class="form-internal">
                <div class="row justify-content-center align-items-center">
                    <div class="col-xl-5 col-lg-8 col-md-8">
                        <div class="user-form-container m-t-40 m-t-sm-0">
                            <div class="form-shape">
                                <svg width="140" height="140" class="image-1" viewBox="0 0 140 140" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
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
                                <img src="{{ static_asset('frontend/img/particle/ellipse-no-fill-large.svg') }}"
                                     alt="Ellipse" class="image-2">
                                <img src="{{ static_asset('frontend/img/particle/ellipse-fill-large.svg') }} "
                                     alt="Ellipse" class="image-3">
                            </div>
                            <div class="form-title">
                                <h3>{{__('log_in_to_your_account') }}</h3>
                            </div>
                            <form method="POST" action="{{ route('login') }}" class="form ajax_form">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <label for="email">{{__('email') }}*</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                               placeholder="{{ __('email') }}"
                                               value="">
                                        <div class="nk-block-des text-danger mb-4">
                                            <p class="email_error error">{{ $errors->first('email') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 password-input">
                                        <label for="password">{{__('password') }}</label>
                                        <input type="password" class="form-control" name="password" id="password"
                                               placeholder="{{ __('enter_password') }}" data-lpignore="true"
                                               value="">
                                        <span id="#password" class="fa fa-fw fa-eye toggle-password"></span>
                                        <div class="nk-block-des text-danger mb-4">
                                            <p class="password_error error">{{ $errors->first('password') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="remember-password m-b-15">
                                            <input type="checkbox" id="stayLoggedIn" checked="" name="remember">
                                            <label for="stayLoggedIn">{{__('stay_logged_in')}}</label>
                                        </div>
                                    </div>
                                    @if(setting('is_recaptcha_activated') && setting('recaptcha_Site_key') && setting('recaptcha_secret'))
                                        <input type="hidden" class="recaptcha" name="recaptcha" value="0">
                                        <div class="mb-30">
                                            <div id="html_element" data-callback="imNotARobot" class="g-recaptcha"
                                                 data-sitekey="{{ setting('recaptcha_Site_key') }}"></div>
                                        </div>
                                        <div class="nk-block-des text-danger">
                                            <p class="recaptcha_error error">{{ $errors->first('recaptcha') }}</p>
                                        </div>
                                    @endif
                                    <div class="col-12">
                                        <button class="template-btn m-b-25" type="submit">{{__('login') }}</button>
                                        @include('components.frontend_loading_btn',['class' => 'template-btn m-b-25'])
                                    </div>
                                    <div class="col-12">
                                        <div class="forgot-pass-btn m-b-20">
                                            {{__('forgot_password') }} <a
                                                href="{{ route('password.forgot') }}">{{__('password') }}?</a>
                                        </div>
                                        <div class="forgot-pass-btn m-b-20">
                                            {{__('new_user') }}? <a
                                                href="{{ route('student.sign_up') }}">{{__('create_an_account') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row gx-3">
                                    @if(setting('is_google_login_activated') == 1 || setting('is_facebook_login_activated') == 1 || setting('is_twitter_login_activated') == 1)
                                        <div class="col-12">
                                            <div id="firebaseui-auth-container">

                                            </div>
                                        </div>

                                    @endif
                                    @if(config('app.demo_mode'))
                                        <div class="login-as">
                                            <h6>{{ __('login_as') }}</h6>
                                            <ul class="login-BTN ">
                                                <li>
                                                    <a href="javascript:void(0)" class="input_filler template-btn bordered-btn-secondary" data-type="admin">{{ __('admin') }}</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" class="input_filler template-btn bordered-btn-secondary" data-type="instructor">{{ __('instructor') }}</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" class="input_filler template-btn bordered-btn-secondary" data-type="organization">{{ __('organization') }}</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" class="input_filler template-btn bordered-btn-secondary" data-type="student">{{ __('student') }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Sign In Section ======-->
@endsection

@if((setting('api_key') && setting('api_key') && setting('project_id') && setting('storage_bucket') && setting('messaging_sender_id') && setting('app_id') && setting('measurement_id') ||
   (setting('is_google_login_activated') == 1 || setting('is_facebook_login_activated') == 1 || setting('is_twitter_login_activated') == 1)))
    @push('css')
        <link type="text/css" rel="stylesheet" href="{{ static_asset('frontend/css/firebase-ui-auth.css') }}"/>
    @endpush
    @push('js')
        <script src="{{ static_asset('frontend/js/firebase-app.js') }}"></script>
        <script src="{{ static_asset('frontend/js/firebase-auth.js') }}"></script>
        <script src="{{ static_asset('frontend/js/firebase-ui-auth.js') }}"></script>
    @endpush
    @push('js')
        <script>
            const firebaseConfig = {
                apiKey: "{{ setting('api_key') }}",
                authDomain: "{{ setting('auth_domain') }}",
                projectId: "{{ setting('project_id') }}",
                storageBucket: "{{ setting('storage_bucket') }}",
                messagingSenderId: "{{ setting('messaging_sender_id') }}",
                appId: "{{ setting('app_id') }}",
                measurementId: "{{ setting('measurement_id') }}"
            };

            // Initialize Firebase
            firebase.initializeApp(firebaseConfig);

            var ui = new firebaseui.auth.AuthUI(firebase.auth());
            var uiConfig = {
                callbacks: {
                    signInSuccessWithAuthResult: function (authResult, redirectUrl) {
                        let response = authResult.additionalUserInfo.profile;
                        if (authResult.additionalUserInfo.providerId == 'facebook.com') {
                            var data = {
                                uid: authResult.user.uid,
                                name: response.name,
                                birthday: response.birthday,
                                gender: response.gender,
                                email: response.email,
                                image: response.picture.data.url,
                                phone: authResult.user.phoneNumber,
                                _token: '{{ csrf_token() }}',
                            };
                        } else if (authResult.additionalUserInfo.providerId == 'google.com') {
                            var data = {
                                uid: authResult.user.uid,
                                name: response.name,
                                email: response.email,
                                image: response.picture,
                                phone: authResult.user.phoneNumber,
                                _token: '{{ csrf_token() }}',
                            };
                        } else {
                            var data = {
                                uid: authResult.user.uid,
                                name: authResult.user.displayName,
                                email: authResult.user.email,
                                image: authResult.user.photoURL,
                                phone: authResult.user.phoneNumber,
                                _token: '{{ csrf_token() }}',
                            };
                        }

                        $.ajax({
                            url: "{{ route('social.login') }}",
                            type: 'POST',
                            data: data,
                            success: function (response) {
                                window.location.href = response.route;
                                toastr.success(response.success);
                            }
                        });
                        return true;
                    }
                },
                signInFlow: 'popup',
                signInSuccessUrl: '#',
                signInOptions: [
                        @if(setting('is_google_login_activated') == 1)
                    {
                        provider: firebase.auth.GoogleAuthProvider.PROVIDER_ID,
                        scopes: [
                            'https://www.googleapis.com/auth/contacts.readonly',
                            'https://www.googleapis.com/auth/user.birthday.read',
                            'https://www.googleapis.com/auth/user.gender.read',
                            'https://www.googleapis.com/auth/user.phonenumbers.read'
                        ],
                    },
                        @endif
                        @if(setting('is_facebook_login_activated') == 1)
                    {
                        provider: firebase.auth.FacebookAuthProvider.PROVIDER_ID,
                        scopes: [
                            'public_profile',
                            'email',
                            'user_likes',
                            'user_friends'
                        ],
                    },
                        @endif
                        @if(setting('is_twitter_login_activated') == 1)
                    {
                        provider: firebase.auth.TwitterAuthProvider.PROVIDER_ID,
                    }
                    @endif
                ]
            };
            ui.start('#firebaseui-auth-container', uiConfig);
        </script>
    @endpush
@endif

@push('js')
    @if(setting('is_recaptcha_activated') && setting('recaptcha_Site_key') && setting('recaptcha_secret'))
        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async
                defer></script>
    @endif
    @if(setting('is_recaptcha_activated') && setting('recaptcha_Site_key') && setting('recaptcha_secret'))
        <script>
            var onloadCallback = function () {
                grecaptcha.render('html_element', {
                    'sitekey': '{{ setting('recaptcha_Site_key') }}',
                    'size': 'md'
                });
            };
            var imNotARobot = function () {
                $('.recaptcha').val(1);
            };
        </script>
    @endif
    <script>
        $(document).ready(function () {
            $(document).on('click','.login-as a', function () {
                var type = $(this).data('type');
                if (type == 'admin') {
                    $('#email').val('admin@spagreen.net');
                    $('#password').val('123456');

                } else if (type == 'instructor') {
                    $('#email').val('instructor@spagreen.net');
                    $('#password').val('123456');
                }
                else if (type == 'student') {
                    $('#email').val('student@spagreen.net');
                    $('#password').val('123456');
                }
                else if (type == 'staff') {
                    $('#email').val('staff@spagreen.net');
                    $('#password').val('123456');
                }
                else if (type == 'organization') {
                    $('#email').val('org_staff@spagreen.net');
                    $('#password').val('123456');
                }
                $('.login-as').addClass('d-none');
                $('.user-form-container .ajax_form').submit();

            });
        });
    </script>
@endpush
