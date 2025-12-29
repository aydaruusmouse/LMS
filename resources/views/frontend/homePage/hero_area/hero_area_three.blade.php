@php
    $lang = App::getLocale();
@endphp
<!--====== Start Hero Area ======-->
<section class="hero-area hero-dark p-t-130">
    <div class="container container-1278">
        <div class="row justify-content-center justify-content-lg-start text-align-center text-align-lg-start align-items-center">
            <div class="col-xl-6 col-lg-6 col-md-10">
                <div class="hero-content p-t-60 p-t-md-0 p-b-md-80 p-b-160" data-aos="fade-up" data-aos-delay="200">
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
            <img src="{{ setting('header3_hero_image') && @is_file_exists(setting('header3_hero_image')['image_596x560']) ? get_media(setting('header3_hero_image')['image_596x560']) : get_media('images/default/hero/header-06.png')}}" alt="image">
        </div>
    </div>
</section>
<!--====== End Hero Area ======-->
