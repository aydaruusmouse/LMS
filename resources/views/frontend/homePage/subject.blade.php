<section class="course-subject-section p-t-80 p-b-50 p-t-sm-40 p-b-sm-50">
    <div class="container container-1278">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="common-heading text-center m-b-40">
                    <h3>{{__($section->contents['title']) }}</h3>
                    <p>{{__($section->contents['sub_title']) }}</p>
                </div>
            </div>
        </div>
        @php(
    $subjects = 'subjects_'.$key
)
        <div class="row gx-3 gx-sm-4 course-subject-items" data-aos="fade-up">

            @if (isset($$subjects))

                        @foreach($$subjects as $subject)
                            <div class="col-xl-3 col-lg-4 col-sm-6">
                                <form action="{{route('courses')}}" id="course_by_subject">
                                    <input type="hidden" name="subject_title" value="{{$subject->title}}">
                                    <a href="javascript:void(0)" class="course-subject-item subject_courses"
                                    onclick="submitForm('course_by_subject')">
                                        <img src="{{ getFileLink('40x40', $subject->image) }} "
                                            alt="{{ $subject->lang_title }}">
                                        <span>{{ $subject->lang_title }}</span>
                                    </a>
                                </form>
                            </div>
                        @endforeach
           @else
                 @include('frontend.not_found',$data=['title'=> 'subject'])
            @endif

        </div>
    </div>
</section>
