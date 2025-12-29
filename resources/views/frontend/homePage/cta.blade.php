<!--====== Start CTA Section ======-->
@if(setting('site_cta_status') == 1 && (setting('cta_show_in') == 'all_page' || (setting('cta_show_in') == 'home_page' && (request()->routeIs('home') || request()->routeIs('home2') || request()->routeIs('home3'))))))
    <section class="cta-section m-t-sm-0 m-t-lg-120 m-t-145">
        <div class="container container-1278">
            <div class="cta-wrapper" data-aos="fade-up">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="cta-image d-none d-md-block text-center">
                            @if ( setting('cta_image'))
                                <img src="{{ getFileLink('391x541', setting('cta_image')) }}" alt="CTA image">
                            @else
                                <img src="{{ getFileLink('320x320', setting('cta_image')) }}" alt="CTA image">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-11 col-md-6">
                        <div class="cta-text-block p-r-md-0 p-r-lg-80 p-r-110">
                            <div class="common-heading minh-255">
                                <h3 class="m-b-10">{{ setting('cta_title') }}</h3>
                                <p class="m-b-25">{{ setting('cta_description') }}</p>
                                @if(!Auth::check())
                                    <a href="{{  route('student.sign_up') }}" class="template-btn template-btn-white">
                                        {{ __('signup_now') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@else
    <section class="cta-section m-t-sm-0 m-t-lg-120 m-t-145">
    </section>
@endif
<!--====== End CTA Section ======-->

