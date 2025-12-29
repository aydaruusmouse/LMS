@extends('frontend.layouts.master')
@section('title', __('sign_up'))
@section('content')
    <!--====== Start Sign Up Section ======-->
    <section class="sign-up-section p-t-130 p-b-200 p-b-md-100 p-t-md-90 p-b-sm-50 p-t-sm-40">
        <div class="container container-1278">
            <div class="form-internal">
                <div class="row justify-content-center align-items-center">
                    <div class="col-xl-6 col-lg-8 col-md-10">
                        <div class="user-form-container m-t-40 m-t-sm-0">
                            <div class="form-shape">
                                <svg width="140" class="image-1" height="140" viewBox="0 0 140 140" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.5">
                                        <rect width="5" height="5" class="svg-primary"/>
                                        <rect y="15" width="5" height="5" class="svg-primary"/>
                                        <rect y="30" width="5" height="5" class="svg-primary"/>
                                        <rect y="45" width="5" height="5" class="svg-primary"/>
                                        <rect y="60" width="5" height="5" class="svg-primary"/>
                                        <rect y="75" width="5" height="5" class="svg-primary"/>
                                        <rect y="90" width="5" height="5" class="svg-primary"/>
                                        <rect y="105" width="5" height="5" class="svg-primary"/>
                                        <rect y="120" width="5" height="5" class="svg-primary"/>
                                        <rect y="135" width="5" height="5" class="svg-primary"/>
                                        <rect x="15" width="5" height="5" class="svg-primary"/>
                                        <rect x="15" y="15" width="5" height="5" class="svg-primary"/>
                                        <rect x="15" y="30" width="5" height="5" class="svg-primary"/>
                                        <rect x="15" y="45" width="5" height="5" class="svg-primary"/>
                                        <rect x="15" y="60" width="5" height="5" class="svg-primary"/>
                                        <rect x="15" y="75" width="5" height="5" class="svg-primary"/>
                                        <rect x="15" y="90" width="5" height="5" class="svg-primary"/>
                                        <rect x="15" y="105" width="5" height="5" class="svg-primary"/>
                                        <rect x="15" y="120" width="5" height="5" class="svg-primary"/>
                                        <rect x="15" y="135" width="5" height="5" class="svg-primary"/>
                                        <rect x="30" width="5" height="5" class="svg-primary"/>
                                        <rect x="30" y="15" width="5" height="5" class="svg-primary"/>
                                        <rect x="30" y="30" width="5" height="5" class="svg-primary"/>
                                        <rect x="30" y="45" width="5" height="5" class="svg-primary"/>
                                        <rect x="30" y="60" width="5" height="5" class="svg-primary"/>
                                        <rect x="30" y="75" width="5" height="5" class="svg-primary"/>
                                        <rect x="30" y="90" width="5" height="5" class="svg-primary"/>
                                        <rect x="30" y="105" width="5" height="5" class="svg-primary"/>
                                        <rect x="30" y="120" width="5" height="5" class="svg-primary"/>
                                        <rect x="30" y="135" width="5" height="5" class="svg-primary"/>
                                        <rect x="45" width="5" height="5" class="svg-primary"/>
                                        <rect x="45" y="15" width="5" height="5" class="svg-primary"/>
                                        <rect x="45" y="30" width="5" height="5" class="svg-primary"/>
                                        <rect x="45" y="45" width="5" height="5" class="svg-primary"/>
                                        <rect x="45" y="60" width="5" height="5" class="svg-primary"/>
                                        <rect x="45" y="75" width="5" height="5" class="svg-primary"/>
                                        <rect x="45" y="90" width="5" height="5" class="svg-primary"/>
                                        <rect x="45" y="105" width="5" height="5" class="svg-primary"/>
                                        <rect x="45" y="120" width="5" height="5" class="svg-primary"/>
                                        <rect x="45" y="135" width="5" height="5" class="svg-primary"/>
                                        <rect x="60" width="5" height="5" class="svg-primary"/>
                                        <rect x="60" y="15" width="5" height="5" class="svg-primary"/>
                                        <rect x="60" y="30" width="5" height="5" class="svg-primary"/>
                                        <rect x="60" y="45" width="5" height="5" class="svg-primary"/>
                                        <rect x="60" y="60" width="5" height="5" class="svg-primary"/>
                                        <rect x="60" y="75" width="5" height="5" class="svg-primary"/>
                                        <rect x="60" y="90" width="5" height="5" class="svg-primary"/>
                                        <rect x="60" y="105" width="5" height="5" class="svg-primary"/>
                                        <rect x="60" y="120" width="5" height="5" class="svg-primary"/>
                                        <rect x="60" y="135" width="5" height="5" class="svg-primary"/>
                                        <rect x="75" width="5" height="5" class="svg-primary"/>
                                        <rect x="75" y="15" width="5" height="5" class="svg-primary"/>
                                        <rect x="75" y="30" width="5" height="5" class="svg-primary"/>
                                        <rect x="75" y="45" width="5" height="5" class="svg-primary"/>
                                        <rect x="75" y="60" width="5" height="5" class="svg-primary"/>
                                        <rect x="75" y="75" width="5" height="5" class="svg-primary"/>
                                        <rect x="75" y="90" width="5" height="5" class="svg-primary"/>
                                        <rect x="75" y="105" width="5" height="5" class="svg-primary"/>
                                        <rect x="75" y="120" width="5" height="5" class="svg-primary"/>
                                        <rect x="75" y="135" width="5" height="5" class="svg-primary"/>
                                        <rect x="90" width="5" height="5" class="svg-primary"/>
                                        <rect x="90" y="15" width="5" height="5" class="svg-primary"/>
                                        <rect x="90" y="30" width="5" height="5" class="svg-primary"/>
                                        <rect x="90" y="45" width="5" height="5" class="svg-primary"/>
                                        <rect x="90" y="60" width="5" height="5" class="svg-primary"/>
                                        <rect x="90" y="75" width="5" height="5" class="svg-primary"/>
                                        <rect x="90" y="90" width="5" height="5" class="svg-primary"/>
                                        <rect x="90" y="105" width="5" height="5" class="svg-primary"/>
                                        <rect x="90" y="120" width="5" height="5" class="svg-primary"/>
                                        <rect x="90" y="135" width="5" height="5" class="svg-primary"/>
                                        <rect x="105" width="5" height="5" class="svg-primary"/>
                                        <rect x="105" y="15" width="5" height="5" class="svg-primary"/>
                                        <rect x="105" y="30" width="5" height="5" class="svg-primary"/>
                                        <rect x="105" y="45" width="5" height="5" class="svg-primary"/>
                                        <rect x="105" y="60" width="5" height="5" class="svg-primary"/>
                                        <rect x="105" y="75" width="5" height="5" class="svg-primary"/>
                                        <rect x="105" y="90" width="5" height="5" class="svg-primary"/>
                                        <rect x="105" y="105" width="5" height="5" class="svg-primary"/>
                                        <rect x="105" y="120" width="5" height="5" class="svg-primary"/>
                                        <rect x="105" y="135" width="5" height="5" class="svg-primary"/>
                                        <rect x="120" width="5" height="5" class="svg-primary"/>
                                        <rect x="120" y="15" width="5" height="5" class="svg-primary"/>
                                        <rect x="120" y="30" width="5" height="5" class="svg-primary"/>
                                        <rect x="120" y="45" width="5" height="5" class="svg-primary"/>
                                        <rect x="120" y="60" width="5" height="5" class="svg-primary"/>
                                        <rect x="120" y="75" width="5" height="5" class="svg-primary"/>
                                        <rect x="120" y="90" width="5" height="5" class="svg-primary"/>
                                        <rect x="120" y="105" width="5" height="5" class="svg-primary"/>
                                        <rect x="120" y="120" width="5" height="5" class="svg-primary"/>
                                        <rect x="120" y="135" width="5" height="5" class="svg-primary"/>
                                        <rect x="135" width="5" height="5" class="svg-primary"/>
                                        <rect x="135" y="15" width="5" height="5" class="svg-primary"/>
                                        <rect x="135" y="30" width="5" height="5" class="svg-primary"/>
                                        <rect x="135" y="45" width="5" height="5" class="svg-primary"/>
                                        <rect x="135" y="60" width="5" height="5" class="svg-primary"/>
                                        <rect x="135" y="75" width="5" height="5" class="svg-primary"/>
                                        <rect x="135" y="90" width="5" height="5" class="svg-primary"/>
                                        <rect x="135" y="105" width="5" height="5" class="svg-primary"/>
                                        <rect x="135" y="120" width="5" height="5" class="svg-primary"/>
                                        <rect x="135" y="135" width="5" height="5" class="svg-primary"/>
                                    </g>
                                </svg>
                                <img src="{{ static_asset('frontend/img/particle/ellipse-no-fill-large.svg') }}"
                                     alt="Ellipse" class="image-2">
                                <img src="{{ static_asset('frontend/img/particle/ellipse-fill-large.svg') }} "
                                     alt="Ellipse" class="image-3">
                            </div>
                            <div class="form-title">
                                <h3>{{__('create_your_account') }}</h3>
                            </div>
                            <form method="POST" action="{{ route('signup.store') }}" class="form sing_up_form">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <label for="firstName">{{__('first_name') }} *</label>
                                        <input type="text" class="form-control" name="first_name" id="firstName"
                                               placeholder="{{__('first_name') }}" value="{{ old('first_name') }}">
                                        <div class="nk-block-des text-danger">
                                            <p>{{ $errors->first('first_name') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label for="lastName">{{__('last_name') }}</label>
                                        <input type="text" class="form-control" name="last_name" id="lastName"
                                               placeholder="{{__('last_name') }}" value="{{ old('last_name') }}">
                                        <div class="nk-block-des text-danger">
                                            <p>{{ $errors->first('last_name') }}</p>
                                        </div>
                                    </div>
                                    @if(Request::Route()->getName() != 'student.sign_up')
                                        <div class="col-12 mb-4">
                                            <label for="organiName">{{__('organisation_name') }} *</label>
                                            <input type="text" class="form-control" name="organization_id"
                                                   id="organiName">
                                            <div class="nk-block-des text-danger">
                                                <p>{{ $errors->first('org_name') }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-12 mb-4">
                                        <label for="email">{{__('email') }} *</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                               placeholder="{{__('email') }}" value="{{ old('email') }}">
                                        <div class="nk-block-des text-danger">
                                            <p>{{ $errors->first('email') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        @include('backend.common.tel-input',[
                                                'name' => 'phone',
                                                'value' => old('phone'),
                                                'label' => __('phone_number'),
                                                'id' => 'phoneNumber',
                                                'country_id_field' => 'phone_country_id',
                                                'country_id' => old('phone_country_id') ? : (setting('default_country') ? : 19)
                                    ])
                                    </div>
                                    <div class="col-12 password-input mb-4">
                                        <label for="password">{{__('password') }} *</label>
                                        <input type="password" class="form-control" name="password" id="password"
                                               placeholder="Choose Password" data-lpignore="true">
                                        <span id="#password" class="fa fa-fw fa-eye toggle-password"></span>
                                        <div class="nk-block-des text-danger">
                                            <p>{{ $errors->first('password') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 password-input mb-4">
                                        <label for="password_confirmation">{{__('confirm_password') }}</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                               id="password_confirmation" placeholder="Choose Password"
                                               data-lpignore="true">
                                        <span id="#password_confirmation"
                                              class="fa fa-fw fa-eye toggle-password"></span>
                                        <div class="nk-block-des text-danger">
                                            <p>{{ $errors->first('password') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="remember-password m-b-20">
                                            <input type="checkbox" id="stayLoggedIn" name="terms_condition" value="1"
                                                   checked="{{ old('terms_condition') == 1 }}">
                                            <label
                                                for="stayLoggedIn"> {{__('by_clicking_create_account_you_agree_to_the')  }}
                                                <a href="{{ $terms_condition }}">{{__('terms_of_service') }}</a> {{__('and') }} <a
                                                    href="{{ $privacy_url }}"> {{__('privacy_policy') }}.</a></label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="template-btn m-b-25"
                                                type="submit">{{__('create_account') }}</button>
                                    </div>
                                    <div class="col-12">
                                        <div class="forgot-pass-btn m-b-20">
                                            {{__('already_have_an_account') }} ? <a
                                                href="{{ route('login') }}">{{__('login_here') }}</a>
                                        </div>
                                    </div>
                                    @if(setting('is_google_login_activated') == 1 || setting('is_facebook_login_activated') == 1 || setting('is_twitter_login_activated') == 1)
                                        <div class="col-12">
                                            <div class="form-divider m-b-15">
                                                <span>{{__('or') }}</span>
                                            </div>
                                        </div>
                                        <div id="firebaseui-auth-container">

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
    <!--====== End Sign Up Section ======-->
@endsection
@if((setting('api_key') && setting('api_key') && setting('project_id') && setting('storage_bucket') && setting('messaging_sender_id') && setting('app_id') && setting('measurement_id') ||
   (setting('is_google_login_activated') == 1 || setting('is_facebook_login_activated') == 1 || setting('is_twitter_login_activated') == 1)))
    @push('css')
        <link type="text/css" rel="stylesheet" href="{{ static_asset('frontend/css/firebase-ui-auth.css') }}"/>
    @endpush
    @push('js')
        <script src="{{ static_asset('admin/js/countries.js') }}"></script>
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
                                picture: response.picture.data.url,
                                phone: authResult.user.phoneNumber,
                                _token: '{{ csrf_token() }}',
                            };
                        } else if (authResult.additionalUserInfo.providerId == 'google.com') {
                            var data = {
                                uid: authResult.user.uid,
                                name: response.name,
                                email: response.email,
                                picture: response.picture,
                                phone: authResult.user.phoneNumber,
                                _token: '{{ csrf_token() }}',
                            };
                        } else {
                            var data = {
                                uid: authResult.user.uid,
                                name: authResult.user.displayName,
                                email: authResult.user.email,
                                picture: authResult.user.photoURL,
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
    <script src="{{ static_asset('admin/js/countries.js') }}"></script>
    @if(setting('is_recaptcha_activated') && setting('recaptcha_Site_key') && setting('recaptcha_secret'))
        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async
                defer></script>
    @endif
    <script>
        @if(setting('is_recaptcha_activated') && setting('recaptcha_Site_key') && setting('recaptcha_secret'))
        var onloadCallback = function () {
            grecaptcha.render('html_element', {
                'sitekey': '{{ setting('recaptcha_Site_key') }}',
                'size': 'md'
            });
        };
        var imNotARobot = function () {
            $('.recaptcha').val(1);
        };
        @endif
        $(document).ready(function (){
            /*let selector = $('.simplebar');
            if (!selector.hasClass('dropdown-menu'))
            {
                selector.addClass('dropdown-menu');
            }*/
        });
    </script>
@endpush
