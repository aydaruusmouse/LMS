<section class="recent-videos-section bg-cover p-t-80 p-b-80 p-t-sm-40 p-b-sm-50"
         style="background-image: url({{ static_asset('frontend/img/section/recent-video-section-bg.jpg') }});">
    <div class="container container-1278">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="common-heading color-white text-center m-b-40 m-b-sm-30">
                    <h3>{{ $section->contents['title'] }}</h3>
                    <p>{{ $section->contents['sub_title'] }}</p>
                </div>
            </div>
        </div>
        <div class="row recent-videos recent-video-slider slider-primary justify-content-center" data-aos="fade-up"
             dir="{{ systemLanguage() ? systemLanguage()->text_direction : 'ltr' }}">
            @foreach(getArrayValue('links',$section->contents,[]) as $link)
                <div class="col-lg-10">
                    @include('frontend.components.video',['source' => $link['video_source'], 'video' => $link['video'], 'class' => 'recent-video-player', 'image' => getArrayValue('image', $link) , 'size' => '1030x520'])
                </div>
            @endforeach
        </div>
    </div>
</section>
