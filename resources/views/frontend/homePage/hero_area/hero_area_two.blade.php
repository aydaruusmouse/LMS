@php
    $lang = App::getLocale();
@endphp
 <!--====== Start Hero Area ======-->
 <section class="hero-area hero-area-v2 p-t-10 p-b-60 p-b-sm-40">
    <div class="container container-1278">
        <div class="row align-items-center justify-content-center justify-content-lg-start text-align-center text-align-lg-start">
            <div class="col-xl-6 col-lg-6 col-md-10">
                <div class="hero-content p-t-115 p-b-160 p-t-md-30 p-b-md-40" data-aos="fade-up" data-aos-delay="200">
                    <span class="hero-subtitle">{!! setting('hero_subtitle',$lang) !!}</span>
                    <h1 class="hero-title">{!! setting('hero_title',$lang) !!}</h1>
                    <p>{!! setting('hero_description',$lang) !!}</p>
                    @if (setting('hero_main_action_btn_enable') != 0 )
                        <a href="{{url(setting('hero_main_action_btn_url'))}}" class="template-btn">{{setting('hero_main_action_btn_label', $lang)}} <i class="fas fa-long-arrow-right"></i></a>
                    @endif
                </div>
            </div>
        </div>
        <div class="hero-image" data-aos="fade-up" data-aos-delay="400">
            <div class="circle-element">
                <span class="element element-3x animate-zoom-fade"></span>
                <span class="element element-5x animate-zoom-fade"></span>
                <span class="element element-2x animate-zoom-fade"></span>
                <span class="element element-1x animate-zoom-fade"></span>
                <span class="element element-4x animate-zoom-fade"></span>
                <div class="rating-box animate-float-bob-y">
                    <h5>4.9/5</h5>
                    <div class="rating-review">
                        <ul class="all-rating star-4">
                            <li>
                                <div class="main-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="blank-rating">
                                    <i class="fas fa-star-half-alt"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <p>{{setting('hero_rating_overview',$lang)}}</p>
                </div>
                <ul class="user-images animate-float-bob-x">
                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="{{setting('header2_hero_title1',$lang)}}"><a href="#"><img src="{{ setting('header2_hero_image1') && @is_file_exists(setting('header2_hero_image1')['image_80x80']) ? get_media(setting('header2_hero_image1')['image_80x80']) : get_media('frontend/img/hero/header-07.png') }}" alt="user one"></a></li>
                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="{{setting('header2_hero_title2',$lang)}}"><a href="#"><img src="{{ setting('header2_hero_image2') && @is_file_exists(setting('header2_hero_image2')['image_80x80']) ? get_media(setting('header2_hero_image2')['image_80x80']) : get_media('frontend/img/hero/header-07.png')}}" alt="user two"></a></li>
                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="{{setting('header2_hero_title3',$lang)}}"><a href="#"><img src="{{ setting('header2_hero_image3') && @is_file_exists(setting('header2_hero_image3')['image_80x80']) ? get_media(setting('header2_hero_image3')['image_80x80']) : get_media('frontend/img/hero/header-07.png')}}" alt="user three"></a></li>
                    <li class="note">14k+ <span>{{__('Students')}}</span></li>
                </ul>
            </div>
            <img src="{{ setting('header2_hero_image4') && @is_file_exists(setting('header2_hero_image4')['image_418x558']) ? get_media(setting('header2_hero_image4')['image_418x558']) : get_media('images/default/hero/header-05.png')}}" alt="image" data-aos="fade-up" data-aos-delay="200">
        </div>
    </div>
</section>
<!--====== End Hero Area ======-->
