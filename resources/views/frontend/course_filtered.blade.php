<div class="row course-items-v3 list-view">
    @if($courses->count() > 0)
    @foreach($courses as $course)
    <div class="col-md-12 col-sm-6">
        <div class="course-item">
            <a href="#" target="_blank" class="course-item-thumb">
                <img src="{{ getFileLink('80x80', $course->meta_image) }} " alt="{{ $course->title }}">
            </a>
            <div class="course-item-body p-0">
                <div class="course-item-body-inner">
                    <div class="course-item-header course-item-info justify-content-end">
                        <ul class="course-category">
                            <li>
                                <a href="#">{{__($course->category->getTranslation('title')) }}</a>
                            </li>
                        </ul>
                        <div class="rating-review">
                            <span class="total-review"><i class="fas fa-star"></i> {{ number_format($course->reviews_avg_rating,2) }}</span>
                        </div>
                    </div>
                    <h4 class="title">
                        <a href="#" target="_blank">{{__($course->title) }}s</a>
                    </h4>
                    <ul class="course-item-info">
                        <li><i class="fal fa-file-alt"></i> {{ $course->lessons->count() }} {{__('lessons') }}</li>
                        <li><i class="fal fa-user-friends"></i> {{ $course->enrolls->count() }} {{__('enroll') }}</li>
                    </ul>
                </div>
                <div class="course-item-footer">
                    <div class="course-price">{{ $course->price }}<small>{{ $course->price }}</small></div>
                    <div class="course-lesson">
                        <a href="{{ route('course.details', $course->slug) }}" class="template-btn">{{__('details') }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
            @include('frontend.not_found',$data=['title'=> 'courses'])
    @endif
</div>


