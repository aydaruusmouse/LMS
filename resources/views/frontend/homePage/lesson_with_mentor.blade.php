@php
    $lessons = 'lessons_'.$key;
    $lessons = $$lessons;
@endphp
    <section class="lesson-with-mentor-section p-t-80 p-b-120 p-t-sm-40 p-b-sm-50">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="common-heading text-center m-b-50">
                        <h3>{{__($section->contents['title']) }}</h3>
                        <p>{{__($section->contents['sub_title']) }}</p>
                    </div>
                </div>
            </div>
            <div class="row lesson-playlist" data-aos="fade-up">
                <div class="col-xl-7 col-lg-6">
                    <div class="tab-content lesson-playlist-content">
                        <div class="element-wrapper">
                            <img src="{{ static_asset('frontend/img/particle/dot-pattern.svg') }}" alt="Dot Pattern">
                            <span class="element"></span>
                        </div>

                        @foreach($lessons as $lesson_key=> $lesson)
                            <div class="tab-pane {{ $lesson_key == 0 ? 'active' : '' }}" id="video-{{ $lesson->id }}" role="tabpanel"
                                 aria-labelledby="video-{{ $lesson->id }}-tab">
                                @if($lesson->source == 'mp4' || $lesson->source == 'upload')
                                    <video class="video-lesson-player" id="player" playsinline controls
                                           @if($lesson->image)
                                               data-poster="{{ getFileLink('417x384', $lesson->image) }}">
                                        @endif
                                        <source
                                            src="{{ $lesson->source == 'upload' ? get_media(getArrayValue('image',$lesson->source_data),getArrayValue('storage',$lesson->source_data)) : $lesson->source_data }}"
                                            type="video/mp4"/>
                                    </video>
                                @else
                                    <div class="video-lesson-player"
                                         @if($lesson->images)
                                             data-poster="{{ getFileLink('721x450', $lesson->images) }}">
                                        @endif
                                        data-plyr-provider="{{ $lesson->source }}"
                                        data-plyr-embed-id="{{ $lesson->source_data }}"
                                        ></div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6">
                    <ul class="lesson-playlist-items nav flex-column nav-tabs" id="myTab" role="tablist">
                        @if(count($lessons)>0)
                            @foreach($lessons as $lesson_key=> $lesson)
                                <li class="lesson-playlist-item" role="presentation">
                                    <a href="#" class="nav-link {{ $lesson_key == 0 ? 'active' : '' }}" id="video-{{ $lesson->id }}-tab"
                                       data-bs-toggle="tab" data-bs-target="#video-{{ $lesson->id }}" role="tab"
                                       aria-controls="video-{{ $lesson->id }}" aria-selected="true">
                                        <div class="lesson-thumbnail">
                                            <img src="{{ getFileLink('190x230', $lesson->image) }}"
                                                 alt="{{ $lesson->title }}">
                                            <div class="play-icon"><i class="fa fa-play"></i></div>
                                        </div>
                                        <div class="lesson-content">
                                            <h5>{{ $lesson->title }}</h5>
                                            <p>{{ $lesson->duration }}</p>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        @else
                            @include('frontend.not_found',$data=['title'=> 'lesson'])
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>


