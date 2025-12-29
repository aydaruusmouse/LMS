<section class="course-lesson-section p-t-80 p-b-80 p-t-sm-40 p-b-sm-50">
    <div class="container container-1278">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="common-heading text-center m-b-30">
                    <h3>{{ $section->contents['title'] }}</h3>
                    @if(isset($section->contents['sub_title']))
                        <p>{{ $section->contents['sub_title'] }}</p>
                    @else
                        <p>{{__('Latest news and amazing features in our websiteconsectetur adipiscing elit. Odio orci')}}</p>
                    @endif
                </div>
            </div>
        </div>
        @php(
    $courses = 'courses_'.$key
)


<div class="row course-lesson-v2 course-lesson-slider-v2 slider-primary"
             dir="{{ systemLanguage() ? systemLanguage()->text_direction : 'ltr' }}">
            @if(isset($$courses))
                @foreach($$courses as $key => $course)
                    @include('frontend.course.single_course_component')
                @endforeach
            @else
                @include('frontend.not_found',$data=['title'=> 'courses'])
            @endif
        </div>
    </div>
</section>
