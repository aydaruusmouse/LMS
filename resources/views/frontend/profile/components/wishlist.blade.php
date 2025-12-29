<div class="col-lg-6 col-sm-6">
    <div class="course-item" data-aos="fade-up" data-aos-delay="{{ 200 * $loop->iteration}}">
        <a href="#" class="course-item-thumb">
            <img src="{{ getFileLink('324x199',$course->thumbnail) }}"
                 alt="{{ $course->title }}">
            <span class="course-badge">{{__(@$course->category->title) }}</span>
        </a>
        <a href="javascript:void(0)" class="add_remove_wishlist" data-id="{{ $course->id }}" data-type="course"
           data-route="{{ route('add.remove.wishlist') }}" data-area="wishlist" data-added_class="fal">
            <span class="wishlist-icon"><i class="fas fa-heart cursor-pointer"></i></span></a>
        <div class="course-item-body">
            @if($course->total_rating)
                <ul class="course-item-info justify-content-end">
                    <li class="rating-review">
                        <span class="total-review"><i class="fas fa-star"></i>{{ number_format($course->total_rating,2) }}</span>
                    </li>
                </ul>
            @endif
            <h4 class="title">
                <a href="javascript:void(0)">{{ $course->title }}t</a>
            </h4>
            <ul class="course-item-info">
                <li>
                    <i class="fal fa-file-alt"></i> {{ $course->lessons_count }} {{__('lessons') }}
                </li>
                <li>
                    <i class="fal fa-user-friends"></i> {{ $course->enrolls_count }} {{__('enroll') }}
                </li>
            </ul>
        </div>
        <div class="course-item-footer">
            <div class="course-price"{{ $course->is_free ? __('free') : get_price($course->price, userCurrency()) }} ></div>
        </div>
    </div>
</div>
