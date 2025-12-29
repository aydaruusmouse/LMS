@if(isset($course) )
<div class="col-xl-3 col-lg-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ 200 * $loop->iteration}}">
    <a href="{{ route('course.details', $course->slug) }}" class="course-lesson-item">
        <img src="{{ getFileLink('402x248', $course->image) }}" alt="Lesson thumbnail">
        <div class="course-lesson-item-content">
            <h5>{{ $course->title }}</h5>
            <p>{{ $course->category->lang_title }}</p>
        </div>
    </a>
</div>
@else
    @include('frontend.not_found',$data=['title'=> 'single course'])
@endif
