<div class="col-lg-6 col-sm-6" data-aos="fade-up" data-aos-delay="{{ 200 * $loop->iteration}}">
    <div class="course-item course-progress">
        <a href="#" class="course-item-thumb">
            <img src="{{getFileLink('324x199', $course->image) }}" alt="{{__(@$course->category->title) }}">
        </a>
        <div class="course-item-body">
            <h4 class="title">
                <a href="{{ route('course.details',$course->slug) }}">{{__(@$course->title) }}</a>
            </h4>
        </div>
        <div class="course-item-footer">
            <div class="line-progress">
                <span>{{$course->enrolls[0]->complete_count}}%</span>
                <div data-progress="{{$course->enrolls[0]->complete_count}}" class="animate-progress" style="--animate-progress:{{$course->enrolls[0]->complete_count}}%;"></div>
            </div>
            @if($course->enrolls[0]->complete_count < setting('course_view_percent'))
                <a href="{{ route('my-course',$course->slug) }}" class="template-btn">{{__('continue') }}</a>
            @else
                <a href="{{ route('course.certificate-show',$course->id) }}" class="template-btn">{{__('certificate') }}</a>
            @endif
        </div>
    </div>
</div>
