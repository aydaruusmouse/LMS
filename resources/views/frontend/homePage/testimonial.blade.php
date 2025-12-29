
<section class="student-feedback-section p-t-80 p-b-80 p-t-sm-40 p-b-sm-50">
    <div class="container container-1278">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="common-heading text-center m-b-50 m-b-sm-30">
                    <h3>{{ $section->contents['title'] }}</h3>
                    <p>{{ $section->contents['sub_title'] }}</p>
                </div>
            </div>
        </div>
        <div class="testimonial-items-v2 testimonial-slider slider-primary" data-aos="fade-up" dir="{{ systemLanguage() ? systemLanguage()->text_direction : 'ltr' }}">
            @if(count($testimonials))
            @foreach($testimonials as $testimonial)
            <div class="testimonial-item">
                <div class="row align-items-center">
                    <div class="col-xl-5 col-md-3">
                        <div class="author-thumb">
                            <img src="{{  getFileLink('282x282', $testimonial->image) }} " alt="{{   $testimonial->testimonial_name ? : $testimonial->name }}">
                        </div>
                    </div>
                    <div class="col-xl-7 col-md-9">
                        <div class="testimonial-item-body">
                            {{-- <img src="{{ static_asset('frontend/img/icons/quote.svg') }} " class="quote" alt="Quote"> --}}
                            <svg class="quote" width="96" viewBox="0 0 96 68" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.9199 44.4184C15.808 49.7515 12.4801 55.0205 8.03203 60.0967C6.62403 61.7031 6.43203 64.0162 7.584 65.8153C8.4801 67.229 9.95197 68 11.552 68C12 68 12.4481 67.968 12.8961 67.8072C22.3039 65.0443 44.2881 55.2454 44.8961 23.8244C45.1199 11.7124 36.2881 1.30309 24.8 0.114367C18.432 -0.528219 12.0961 1.55995 7.392 5.80084C2.6881 10.0739 0 16.1782 0 22.5394C0 33.1415 7.4881 42.4265 17.9199 44.4184Z" fill="var(--color-secondary-4)" fill-opacity="0.4"/>
                                <path d="M75.8721 0.114367C69.5359 -0.528219 63.2 1.55995 58.4961 5.80084C53.792 10.0739 51.1039 16.1782 51.1039 22.5394C51.1039 33.1415 58.592 42.4264 69.024 44.4184C66.9119 49.7515 63.584 55.0205 59.1359 60.0967C57.7279 61.7031 57.5359 64.0162 58.6881 65.8153C59.584 67.2289 61.0561 68 62.6561 68C63.1039 68 63.552 67.968 64 67.8072C73.408 65.0442 95.392 55.2454 96 23.8244V23.3748C96 11.4553 87.2641 1.30309 75.8721 0.114367Z" fill="var(--color-secondary-4)" fill-opacity="0.4"/>
                            </svg>
                            <p>{{ $testimonial->lang_description }}</p>
                            <div class="author-info">
                                <h6>{{ $testimonial->lang_name }} </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
                @include('frontend.not_found',$data=['title'=> 'testimonial'])
            @endif
        </div>
    </div>
</section>
