<!--====== Start Footer Area ======-->
<footer class="footer-area footer-area-v2 footer-offset">
    <div class="footer-widget">
        <div class="container container-1278">
            <div class="footer-top">
                <div class="row justify-content-between">
                    <div class="col-md-4">
                        <div class="widget">
                            <!-- <h5 class="widget-title">Connect with us!</h5> -->
                            <a href="{{ url('/') }}" class="brand-logo main-logo m-r-25">
                                @php
                                    $src = setting('light_logo') && @is_file_exists(setting('light_logo')['original_image']) ? get_media(setting('light_logo')['original_image']) : get_media('images/default/logo/logo-green-white.png');
                                @endphp
                                <img style="max-width: 140px"
                                     src="{{ $src }}"
                                     alt="logo">
                            </a>
                            <p class="py-2">{{ setting('footer_logo_description') }}</p>

                            @if (setting('show_social_links') != 0)
                                <ul class="social-profile m-t-75">
                                    @if (setting('facebook_link') != '')
                                        <li><a class="rounded-circle" href="{{ setting('facebook_link') }}"><i
                                                    class="fab fa-facebook-f"></i></a></li>
                                    @endif
                                    @if (setting('twitter_link') != '')
                                        <li><a class="rounded-circle" href="{{ setting('twitter_link') }}"><i
                                                    class="fab fa-twitter"></i></a>
                                        </li>
                                    @endif
                                    @if (setting('linkedin_link') != '')
                                        <li><a class="rounded-circle" href="{{ setting('linkedin_link') }}"><i
                                                    class="fab fa-linkedin-in"></i></a></li>
                                    @endif
                                    @if (setting('instagram_link') != '')
                                        <li><a class="rounded-circle" href="{{ setting('instagram_link') }}"><i
                                                    class="fab fa-instagram"></i></a></li>
                                    @endif
                                    @if (setting('youtube_link') != '')
                                        <li><a class="rounded-circle" href="{{ setting('youtube_link') }}"><i
                                                    class="fab fa-youtube"></i></a>
                                        </li>
                                    @endif
                                </ul>
                            @endif

                        </div>
                    </div>

                    @if(setting('show_newsletter'))
                        <div class="col-md-5">
                            <div class="widget newsletter-widget">
                                <h5 class="widget-title">{{ setting('newsletter_title', app()->getLocale()) }}</h5>
                                <form action="{{ route('subscribe') }}" method="POST"
                                      class="footer-subscription form needs-validation ajax_form" novalidate>
                                    <input class="subscription-mail" type="email" name="email"
                                           placeholder="{{ __('your_email') }}" required>
                                    @csrf
                                    <div class="invalid-feedback">
                                        {{ __('Please add your email.') }}
                                    </div>
                                    <div class="valid-feedback">
                                        {{ __('Looks good!') }}
                                    </div>
                                    <button type="submit"> {{ __('subscribe') }}
                                    </button>
                                    @include('components.frontend_loading_btn', [
                                        'class' => 'btn sg-btn-primary',
                                    ])
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">

                @if (setting('show_useful_link') && is_array(setting('footer_useful_link_menu')) && count(setting('footer_useful_link_menu')) > 0)
                    <div class="col-md-3 offset-md-1 col-6 order-2 order-md-1">
                        <div class="widget nav-widget">
                            <h5 class="widget-title">{{ setting('useful_link_title', app()->getLocale()) }}</h5>
                            <ul>
                                @foreach (setting('footer_useful_link_menu') as $usefulLink)
                                    <li><a href="{{ $usefulLink['url'] }}">{{ $usefulLink['label'] }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif


                @if (setting('show_resource_link') && is_array(setting('footer_resource_link_menu')) && count(setting('footer_resource_link_menu')) > 0)
                    <div class="col-md-3 col-6 order-3 order-md-2">
                        <div class="widget nav-widget">
                            <h5 class="widget-title">{{ setting('resource_link_title', app()->getLocale()) }}</h5>
                            @php
                                $resource_link_menu = headerFooterMenu('footer_resource_link_menu', app()->getLocale()) ? : headerFooterMenu('footer_resource_link_menu');
                            @endphp
                            <ul>
                                @foreach ($resource_link_menu as $resourceLink)
                                    <li><a href="{{ $resourceLink['url'] }}">{{ $resourceLink['label'] }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif


                @if (setting('show_quick_link') && is_array(setting('footer_quick_link_menu')) && count(setting('footer_quick_link_menu')) > 0)
                    <div class="col-md-2 col-6 order-4 order-md-3">
                        <div class="widget nav-widget">
                            <h5 class="widget-title">{{ setting('quick_link_title', app()->getLocale()) }}</h5>
                            @php
                                $quick_link_menu = headerFooterMenu('footer_quick_link_menu', app()->getLocale()) ? : headerFooterMenu('footer_quick_link_menu');
                            @endphp
                            <ul>
                                @foreach ($quick_link_menu as $quickLink)
                                    <li><a href="{{ $quickLink['url'] }}">{{ $quickLink['label'] }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif


                @if (setting('show_apps_link') != 0)
                    <div class="col-md-3">
                        <div class="widget download-app-widget">
                            <h5 class="widget-title">{{ setting('apps_link_title', app()->getLocale()) }}</h5>
                            <p>{{ setting('apps_link_description', app()->getLocale()) }}</p>
                            <div class="row gx-3 m-t-15">
                                @if (setting('play_store_link') != '')
                                    <div class="col-xl-6 col-md-12 col-auto">
                                        <a href="{{ setting('play_store_link') }}">
                                            <img src="{{ static_asset('frontend/img/store/google-play.png') }}"
                                                 alt="Google Play">
                                        </a>
                                    </div>
                                @endif

                                @if (setting('app_store_link') != '')
                                    <div class="col-xl-6 col-md-12 col-auto">
                                        <a href="{{ setting('app_store_link') }}">
                                            <img src="{{ static_asset('frontend/img/store/app-store.png') }}"
                                                 alt="App Store">
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                @if(setting('show_payment_method_banner') == 1)
                    <div class="col-12 order-5">
                        <div class="payment-logos text-align-md-end text-center">
                            <img
                                src="{{ setting('payment_method_banner') && @is_file_exists(setting('payment_method_banner')['original_image']) ? get_media(setting('payment_method_banner')['original_image']) : get_media('frontend/img/payment-methods/footer-payment.png') }}"
                                alt="Payment Logos">
                        </div>
                    </div>
                @endif
            </div>
        </div>


        @if (setting('show_copyright') != 0)
            <div class="footer-bottom m-t-40">
                <div class="container container-1278">
                    <div class="row justify-content-center align-items-center flex-column">
                        <div class="col-lg-auto col-md-5">
                            <div class="copyright-text d-flex align-items-end justify-content-center mt-4">
                                {{-- <img src="{{ setting('copyright_logo') && @is_file_exists(setting('copyright_logo')['original_image']) ? get_media(setting('copyright_logo')['original_image']) : get_media('frontend/img/logo.png') }}" alt="Footer Logo" class="m-r-25"> --}}
                                <span>{{ setting('copyright_title', app()->getLocale()) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</footer>
<!--====== End Footer Area ======-->

<!--====== Start Scroll To Top ======-->
<a href="#" class="back-to-top" id="fixed-scroll-top">
    <i class="far fa-angle-up"></i>
</a>


@php $lang =  app()->getLocale() @endphp
@if (((request()->routeIs('home') && setting('popup_show_in') == 'home_page') || setting('popup_show_in') == 'all_page') && setting('site_popup_status') == 1)
    <!--====== Window Load Subscription Modal ======-->
    @if (!session()->get('dont_show'))
        <div class="modal window-load-modal fade" id="windowLoadModal" tabindex="-1"
             aria-labelledby="windowLoadModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row align-items-xl-center justify-content-center">
                            <div class="col-lg-6">
                                <div class="modal-thumbnail m-b-md-20">

                                    <img class="selected-img"
                                         src="{{ getFileLink('500x500', setting('popup_image')) }}" alt="pop-up">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="modal-content-inner">
                                    <h4>{{ setting('popup_title', $lang) }}</h4>
                                    <p>{{ setting('popup_description', $lang) }}</p>
                                    <form action="{{ route('subscribe') }}" class="footer-subscription ajax_form"
                                          method="POST">@csrf
                                        <input class="subscription-mail" type="email" name="email"
                                               placeholder="{{ __('email') }}">
                                        <div class="nk-block-des">
                                            <p class="email_error error text-danger"></p>
                                        </div>
                                        <button name="submit" type="submit" class="template-btn">
                                            {{ __('subscribe') }}
                                        </button>
                                        @include('components.frontend_loading_btn', [
                                            'class' => 'template-btn',
                                        ])

                                        <div class="social-links">
                                            <ul>
                                                @if (setting('facebook_link'))
                                                    <li><a href="{{ setting('facebook_link') }}"><i
                                                                class="fab fa-facebook-f"></i></a></li>
                                                @endif
                                                @if (setting('twitter_link'))
                                                    <li><a href="{{ setting('twitter_link') }}"><i
                                                                class="fab fa-twitter"></i></a></li>
                                                @endif
                                                @if (setting('linkedin_link'))
                                                    <li><a href="{{ setting('linkedin_link') }}"><i
                                                                class="fab fa-linkedin-in"></i></a></li>
                                                @endif
                                                @if (setting('instagram_link'))
                                                    <li><a href="{{ setting('instagram_link') }}"><i
                                                                class="fab fa-instagram"></i></a></li>
                                                @endif
                                                @if (setting('youtube_link'))
                                                @endif
                                                <li>
                                                    <a href="{{ setting('youtube_link') }}">{{ session()->get('dont_show') }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dont-show-popup">
                                            <div class="remember-password m-b-15">
                                                <input type="checkbox" id="tnc" value="1" name="dont_show_this">
                                                <label for="tnc">{{ __('dont_show_this_again') }} </label>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
<input type="hidden" class="cookie_status" value="{{ setting('cookies_status') }}">
<!--======= Cookie Alert Popup =======-->
<div class="cookiealert-popup">
    <div class="container container-1278">
        <div class="row">
            <div class="col-12">
                <div class="cookiealert-content text-center">
                    <h4>{{ setting('cookies_agreement_title', userLanguage()) }}</h4>
                    <div>
                        {!! setting('cookies_agreement', userLanguage()) !!}
                    </div>
                    <div class="confirmation-btns d-flex justify-content-center">
                        <button type="button"
                                class="dont-accept-cookies template-btn">{{ __('don’t_accept') }}</button>
                        <button type="button" class="accept-cookies template-btn">{{ __('accept') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
