<section class="achievement-section overflow-hidden color-bg-off-white p-t-80 p-b-80 p-t-sm-40 p-b-sm-50">
    <div class="container container-1278">
        <div class="row justify-content-center d-block d-lg-none">
            <div class="col-lg-6">
                <div class="common-heading text-center m-b-40">
                    <h3>{{__($section->contents['title']) }}</h3>
                    <p>{{__($section->contents['sub_title']) }}</p>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-sm-6 col-xs-6">
                <div class="achievement-content-block">
                    <div class="common-heading d-none d-lg-block m-b-50">
                        <h3>{{__($section->contents['title']) }}</h3>
                        <p>{{__($section->contents['sub_title']) }}</p>
                    </div>
                    <div class="row gx-3 counter-items-v3">
                        <div class="col-6">
                            <div class="counter-item m-b-45 m-b-sm-30" data-aos="fade-up" data-aos-delay="200">
                                <div class="icon">
                                    <img src="{{ static_asset('frontend/img/icons/user-2.svg') }}" alt="user">
                                </div>
                                <div class="content">
                                    <div class="counter-wrap">
                                        <span class="counter">{{ $total_instructors  }}</span>
                                        <span class="suffix">+</span>
                                    </div>
                                    <p class="title">{{__('teacher') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="counter-item m-b-45 m-b-sm-30" data-aos="fade-up" data-aos-delay="400">
                                <div class="icon">
                                    <img src="{{ static_asset('frontend/img/icons/live-streaming.svg') }}" alt="live streaming">
                                </div>
                                <div class="content">
                                    <div class="counter-wrap">
                                        <span class="counter">{{ $total_videos }}</span>
                                        <span class="suffix">+</span>
                                    </div>
                                    <p class="title">{{__('video') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="counter-item m-b-45 m-b-sm-0" data-aos="fade-up" data-aos-delay="600">
                                <div class="icon">
                                    <img src="{{ static_asset('frontend/img/icons/user-3.svg') }}" alt="user">
                                </div>
                                <div class="content">
                                    <div class="counter-wrap">
                                        <span class="counter">{{ $total_students }}</span>
                                        <span class="suffix">+</span>
                                    </div>
                                    <p class="title">{{__('student') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="counter-item m-b-45 m-b-sm-0" data-aos="fade-up" data-aos-delay="800">
                                <div class="icon">
                                    <img src="{{ static_asset('frontend/img/icons/rocket.svg') }}" alt="rocket">
                                </div>
                                <div class="content">
                                    <div class="counter-wrap">
                                        <span class="counter">4576543</span>
                                        <span class="suffix">+</span>
                                    </div>
                                    <p class="title">{{__('apps_user')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xs-6">
                <div class="masonry-images">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block">
                            <div class="left-content" data-aos="fade-up" data-aos-delay="200">
                                <img src="{{ getFileLink('266x250', $section->image_1) }}" class="main-image" alt="Benefit Image">
                                <div class="element-wrapper">
                                    <span class="element"></span>
                                    <img src="{{ static_asset('frontend/img/particle/dot-pattern.svg') }}" class="animate-float-bob-y" alt="Dot Pattern">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 align-self-end">
                            <div class="right-content" data-aos="fade-up" data-aos-delay="400">
                                <div class="element-wrapper">
                                    <span class="element"></span>
                                    <span class="element-two d-block d-lg-none"></span>
                                    <img src="{{ static_asset('frontend/img/particle/dot-pattern.svg') }} " class="animate-float-bob-x" alt="Dot Pattern">
                                </div>
                                <img src="{{ getFileLink('296x285', $section->image_2) }}" class="main-image" alt="Benefit Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

