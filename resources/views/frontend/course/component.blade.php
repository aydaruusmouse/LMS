@if(isset($style) && $style == 'list')
    <div class="col-md-12 col-sm-6">
        <div class="course-item" data-aos="fade-up" data-aos-delay="{{ $key+=100 }}">
            <a href="{{ route('course.details', $course->slug) }}" target="_blank" class="course-item-thumb">
                <img src="{{ getFileLink('295x248', $course->image) }}" alt="{{ $course->title }}">
            </a>
            <div class="course-item-body">
                <div class="course-item-header">
                    <ul class="course-category">
                        <li>
                            <a href="javascript:void(0)">{{ $course->category->lang_title }}</a>
                        </li>
                    </ul>
                    @if($course->course_type)
                        <ul class="course-category">
                            <li>
                                <a href="javascript:void(0)">{{ $course->course_type }}</a>
                            </li>
                        </ul>
                    @endif
                    @if($course->total_rating)
                        <div class="rating-review">
                            <span class="total-review"><i class="fas fa-star"></i>{{ number_format($course->total_rating,2) }}</span>
                        </div>
                    @endif
                </div>
                <h4 class="title">
                    <a href="{{ route('course.details', $course->slug) }}">{{ $course->title }}</a>
                </h4>
                <ul class="course-item-info {{ !$course->total_lesso && $course->total_enrolled == 0 ? 'mb-20' : '' }}">
                    @if($course->total_lesson)
                        <li><i class="fal fa-file-alt"></i> {{ $course->total_lesson }} {{__('lessons') }}</li>
                    @endif
                    @if($course->total_enrolled > 0)
                        <li><i class="fal fa-user-friends"></i> {{ $course->total_enrolled }} {{__('enroll') }}</li>
                    @endif
                </ul>
                <div class="course-item-footer">
                    @if($course->is_free == 1 || $course->price == 0)
                        <div class="course-price">{{ __('free') }}</div>
                    @elseif($course->is_discount)
                        <div class="course-price">
                            {{ get_price($course->discount_amount, userCurrency()) }}
                            <small>{{ get_price($course->price, userCurrency()) }}</small>
                        </div>
                    @else
                        <div class="course-price">
                            {{ get_price($course->price, userCurrency()) }}
                        </div>
                    @endif
                    <div class="course-lesson">
                        <a href="{{ route('course.details', $course->slug) }}"
                           class="template-btn">{{__('details') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="{{ $col }} col-sm-6" data-aos="fade-up" data-aos-delay="{{ 200 * $key +1}}">
        <div class="course-item">
            <a href="{{ route('course.details', $course->slug) }}"
               class="course-item-thumb">
                <img src="{{ getFileLink('402x248', $course->image) }}"
                     alt="Course Thumbnail">
                {{-- <span class="course-badge">{{ $course->category->lang_title }}</span> --}}
            </a>
            <div class="course-item-body p-0">
                <div class="course-item-body-inner">
                    <div class="course-item-header course-item-info justify-content-end">
                        <ul class="course-category">
                            <li>
                                <a href="#">{{ $course->category->lang_title }}</a>
                            </li>
                        </ul>
                        @if($course->total_rating)
                            <ul class="course-item-info justify-content-end">
                                <li class="rating-review">
                                    <span class="total-review"><i class="fas fa-star"></i>{{ number_format($course->total_rating,2) }}</span>
                                </li>
                            </ul>
                        @endif
                    </div>
                    <h4 class="title">
                        <a href="{{ route('course.details', $course->slug) }}">{{ $course->title }}</a>
                    </h4>
                    <ul class="course-item-info {{ !$course->total_lesso && $course->total_enrolled == 0 ? 'mb-20' : '' }}">
                        @if($course->total_lesson)
                            <li>
                                <i class="fal fa-file-alt"></i> {{ $course->total_lesson }} {{__('lessons') }}
                            </li>
                        @endif
                        @if($course->total_enrolled > 0)
                            <li>
                                <i class="fal fa-user-friends"></i> {{ $course->total_enrolled }} {{__('enroll') }}
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="course-item-footer">
                    @if($course->is_free == 1 || $course->price == 0)
                        <div class="course-price">{{ __('free') }}</div>
                    @elseif($course->is_discount)
                        <div class="course-price">
                            {{ get_price($course->discount_amount, userCurrency()) }}
                            <small>{{ get_price($course->price, userCurrency()) }}</small>
                        </div>
                    @else
                        <div class="course-price">
                            {{ get_price($course->price, userCurrency()) }}
                        </div>
                    @endif
                    <ul>
                        <li>
                            <a href="{{ route('course.details', $course->slug) }}"
                               class="template-btn">{{__('details') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif

