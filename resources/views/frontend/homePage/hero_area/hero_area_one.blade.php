@php
    $lang = App::getLocale();
@endphp


<section class="hero-area hero-area-v5 p-t-120 p-b-60 p-b-md-40">
    <div class="container container-1278">
        <div class="row justify-content-center align-items-center">
            <div class="col-xl-6 col-lg-6 col-md-10">
                <div class="hero-content text-align-center text-align-lg-start p-b-md-40" data-aos="fade-up"
                     data-aos-delay="200">
                    <span class="hero-subtitle"> {!! setting('hero_subtitle',$lang) !!}</span>
                    <h1 class="hero-title">{!! setting('hero_title',$lang) !!}</h1>
                    <p>{!! setting('hero_description',$lang) !!}</p>
                    <ul class="hero-btns d-flex justify-content-center justify-content-lg-start align-items-center">
                        @if (setting('hero_main_action_btn_enable') != 0 )
                            <li>
                                <a href="{{url(setting('hero_main_action_btn_url'))}}" class="template-btn">
                                    {{setting('hero_main_action_btn_label', $lang)}} <i
                                        class="fas fa-long-arrow-right"></i>
                                </a>
                            </li>
                        @endif
                        @if (!Auth::check())
                        @if (setting('hero_secondary_action_btn_enable') != 0 && setting('hero_secondary_action_btn_url') != null)
                                <li>
                                    <a href="{{url(setting('hero_secondary_action_btn_url'))}}"
                                       class="template-btn text-uppercase bordered-btn-secondary">
                                        {{setting('hero_secondary_action_btn_label', $lang)}}
                                    </a>
                                </li>
                            @endif
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-9">
                <div class="hero-masonry-image" data-aos="fade-up" data-aos-delay="400">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex gap-3 justify-content-end align-items-end">
                                <img
                                    src="{{ setting('header1_hero_image1') && @is_file_exists(setting('header1_hero_image1')['image_240x240']) ? get_media(setting('header1_hero_image1')['image_240x240']) : get_media('images/default/hero/header-01.png') }}"
                                    alt="Hero Image" class="image-one">
                                <img
                                    src="{{ setting('header1_hero_image2') && @is_file_exists(setting('header1_hero_image2')['image_196x196']) ? get_media(setting('header1_hero_image2')['image_196x196']) : get_media('images/default/hero/header-02.png')}}"
                                    alt="Hero Image" class="image-two m-r-15">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex gap-3 justify-content-end align-items-start">
                                <img
                                    src="{{ setting('header1_hero_image3') && @is_file_exists(setting('header1_hero_image3')['image_284x284']) ? get_media(setting('header1_hero_image3')['image_284x284']) : get_media('images/default/hero/header-03.png')}}"
                                    alt="Hero Image" class="image-three">
                                <img
                                    src="{{ setting('header1_hero_image4') && @is_file_exists(setting('header1_hero_image4')['image_212x212']) ? get_media(setting('header1_hero_image4')['image_212x212']) : get_media('images/default/hero/header-04.png')}}"
                                    alt="Hero Image" class="image-four">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
