<!--====== Start Success Story Section ======-->
<section class="success-story-section p-t-80 p-b-120 p-b-md-80 p-t-sm-50 p-b-sm-50">
    <div class="container container-1278">
        <div class="success-story-v2" data-aos="fade-up">
            <div class="row align-items-center">
                <div class="col-xl-5 col-md-6">
                    <div class="success-story-author-preview" data-direction="{{ systemLanguage() ? systemLanguage()->text_direction : 'ltr' }}" dir="{{ systemLanguage() ? systemLanguage()->text_direction : 'ltr' }}">
                        @foreach($success_stories as $success)
                        <div class="slick-slide">
                            <img src="{{ getFileLink('473x337', $success->image) }} " alt="Success story preview">
                       </div>
                       @endforeach
                    </div>
                 </div>
                <div class="col-xl-7 col-md-6">
                    <div class="success-story-content-wrapper" dir="{{ systemLanguage() ? systemLanguage()->text_direction : 'ltr' }}">
                        <h3 class="title">{{__('success_story') }}</h3>
                        <div class="success-story-content" data-direction="{{ systemLanguage() ? systemLanguage()->text_direction : 'ltr' }}">
                            @if(count($success_stories)>0)
                            @foreach($success_stories as $success)
                            <div class="single-success-story">
                                <p>{{ $success->lang_description }}</p>
                                <h5>{{ $success->lang_title }} </h5>
                            </div>
                            @endforeach
                            @else
                                @include('frontend.not_found',$data=['title'=> 'success stories'])
                            @endif
                        </div>
                        <div class="success-story-author slider-primary" data-direction="{{ systemLanguage() ? systemLanguage()->text_direction : 'ltr' }}">
                            @foreach($success_stories as $success)
                            <div class="slick-slide">
                                <img src="{{ getFileLink('163x116', $success->image) }}" alt="Success story author">
                            </div>
                            @endforeach
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</section>
<!--====== End Success Story Section ======-->
