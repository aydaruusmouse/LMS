<div class="tab-pane fade show active" id="1" role="tabpanel" aria-labelledby="all-courses-tab">
    <div class="row course-items-v3">
        @if (count($courses) > 0)
            @foreach ($courses as $course)
                <div class="col-lg-4 col-sm-6">
                    <div class="course-item">
                        <a href="{{ route('course.details', $course->slug) }}" class="course-item-thumb">
                            <img src="{{ getFileLink('40x40', $course->meta_image) }} " alt="Course Thumbnail">
                            <span class="course-badge">{{ __($course->slug) }}</span>
                        </a>
                        <div class="course-item-body">
                            <ul class="course-item-info justify-content-end">
                                <li class="rating-review">
                                    <span class="total-review"><i
                                            class="fas fa-star"></i>{{ number_format($course->reviews_avg_rating, 2) }}
                                    </span>
                                </li>
                            </ul>
                            <h4 class="title">
                                <a href="{{ route('course.details', $course->slug) }}">{{ __($course->title) }}</a>
                            </h4>
                            <ul class="course-item-info">
                                <li><i class="fal fa-file-alt"></i> {{ $course->lessons->count() }} {{ __('lessons') }}
                                </li>
                                <li><i class="fal fa-user-friends"></i> {{ $course->enrolls->count() }}
                                    {{ __('enroll') }} </li>
                            </ul>
                        </div>
                        <div class="course-item-footer">
                            <div class="course-price">{{ $course->price }}</div>
                            <ul>
                                <li>
                                    <a href="{{ route('course.details', $course->slug) }}"
                                        class="template-btn">{{ __('details') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            @include('frontend.not_found', $data = ['title' => 'course'])
        @endif
    </div>
</div>
