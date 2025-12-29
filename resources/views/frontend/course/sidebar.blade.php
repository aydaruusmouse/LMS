<div class="course-sidebar border-radius-3 m-t-md-30">
    <div class="widget widget-checklist">
        <ul class="category-list-group">
            <li class="dropdown-title">{{__('all_categories')}}
                <span>({{ $total_courses }})</span></li>
            @foreach($filter_categories as $category)
                @php
                    $total_this_category_course = $category->active_courses_count + $category->subCategories->sum('active_courses_count');
                @endphp
                @if(count($category->subCategories) > 0)
                    <li>
                        <a href="{{ route('category.courses',$category->slug) }}" data-id="{{ $category->id }}" class="{{ request()->route()->parameter('slug') == $category->slug ? 'active_lesson sub-menu-opened' : '' }} parent_category">{{ $category->lang_title }}
                            @if($total_this_category_course > 0)
                                <span>({{ $total_this_category_course }})</span>
                            @endif
                        </a>
                        @if(count($category->subCategories) > 0)
                            <ul class="sub-menu">
                                @foreach($category->subCategories as $subCategory)
                                    <li>
                                        <label>
                                            <input type="checkbox" class="category_checkbox"
                                                   value="{{ $subCategory->id }}" {{ in_array($subCategory->id,$category_ids) ? 'checked' : '' }}>
                                            <span>{{ $subCategory->lang_title }}</span>
                                        </label>
                                        @if($subCategory->active_courses_count > 0)
                                            <span>({{ $subCategory->active_courses_count }})</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @else
                    <li>
                        <label>
                            <input type="checkbox" class="category_checkbox"
                                   value="{{ $category->id }}" {{ in_array($category->id,$category_ids) ? 'checked' : '' }}>
                            <span>{{ $category->lang_title }}</span>
                        </label>
                        <span>({{ $total_this_category_course }})</span>
                    </li>
                @endif
            @endforeach
            @if($filter_categories->nextPageUrl())
                <li class="show-more" data-page="{{ $filter_categories->currentPage() }}"
                    data-url="{{ route('load.category') }}">
                    <a href="javascript:void(0)">Show more</a>
                    @include('components.frontend_loading_btn', ['class' => 'btn'])
                </li>
            @endif
        </ul>
    </div>
    <div class="widget widget-checklist">
        <ul class="widget-list-group subject_section_wrap">
            <li class="dropdown-title">{{__('subject')}}</li>
            @foreach($subjects as $subject)
                <li>
                    <label>
                        <input type="checkbox" class="subject_checkbox" name="subject_checkbox"
                               value="{{$subject->id}}" {{ in_array($subject->id,$subject_ids) ? 'checked' : '' }}>
                        <span>{{$subject->title}}</span>
                    </label>
                </li>
            @endforeach
            @if($subjects->nextPageUrl())
                <li class="subject-more" data-page="{{ $subjects->currentPage() }}"
                    data-url="{{ route('load.subject') }}">
                    <a href="javascript:void(0)">{{__('show_more')}}</a>
                    @include('components.frontend_loading_btn', ['class' => 'btn'])
                </li>
            @endif
        </ul>
    </div>

    <div class="widget widget-checklist">
        <ul class="widget-list-group">
            <li class="dropdown-title">{{__('price')}}</li>
            <!--            <li>
                <label>
                    <input type="checkbox" class="price_checkbox" name="price_checkbox" value="all"  {{ in_array('all',$price) ? 'checked' : '' }}>
                    <span>All</span>
                </label>
            </li>-->
            <li>
                <label>
                    <input type="checkbox" class="price_checkbox" name="price_checkbox"
                           value="paid" {{ in_array('paid',$price) ? 'checked' : '' }}>
                    <span>{{__('paid')}}</span>
                </label>
            </li>
            <li>
                <label>
                    <input type="checkbox" class="price_checkbox" name="price_checkbox"
                           value="free" {{ in_array('free',$price) ? 'checked' : '' }}>
                    <span>{{__('free')}}</span>
                </label>
            </li>
        </ul>
    </div>
    <div class="widget widget-checklist">
        <ul class="widget-list-group">
            <li class="dropdown-title">{{__('level')}}</li>
            <!--            <li>
                <label>
                    <input type="checkbox" class="level_checkbox" value="all"  {{ in_array('all',$level_ids) ? 'checked' : '' }}>
                    <span>All</span>
                </label>
            </li>-->
            @foreach($levels as $level)
                <li>
                    <label>
                        <input type="checkbox" class="level_checkbox"
                               value="{{ $level->id }}" {{ in_array($level->id,$level_ids) ? 'checked' : '' }}>
                        <span>{{ $level->lang_title }}</span>
                    </label>
                </li>
            @endforeach
            @if($levels->nextPageUrl())
                <li class="show-more" data-page="{{ $levels->currentPage() }}" data-url="{{ route('load.levels') }}">
                    <a href="javascript:void(0)">Show more</a>
                    @include('components.frontend_loading_btn', ['class' => 'btn'])
                </li>
            @endif
        </ul>
    </div>
    <div class="widget rating-widget">
        <div class="rating-group">
            <h4 class="dropdown-title">{{__('ratings') }}</h4>
            <label>
                <input type="checkbox" class="rating_checkbox" name="rating_checkbox"
                       value="1" {{ in_array(1,$rating) ? 'checked' : '' }}>
                <span>
                    <img src="{{ static_asset('frontend/img/rating/rating-1.jpg') }} " alt="rating one">
                </span>
            </label>
            <label>
                <input class="form-check-input rating_checkbox" type="checkbox" name="rating_checkbox"
                       value="2" {{ in_array(2,$rating) ? 'checked' : '' }}>
                <span>
                    <img src="{{ static_asset('frontend/img/rating/rating-2.jpg') }} " alt="rating two">
                </span>
            </label>
            <label>
                <input class="form-check-input rating_checkbox" type="checkbox" name="rating_checkbox"
                       value="3" {{ in_array(3,$rating) ? 'checked' : '' }}>
                <span>
                    <img src="{{ static_asset('frontend/img/rating/rating-3.jpg') }} " alt="rating three">
                </span>
            </label>
            <label>
                <input class="form-check-input rating_checkbox" type="checkbox" name="rating_checkbox"
                       value="4" {{ in_array(4,$rating) ? 'checked' : '' }}>
                <span>
                    <img src="{{ static_asset('frontend/img/rating/rating-4.jpg') }} " alt="rating four">
                </span>
            </label>
            <label>
                <input class="form-check-input rating_checkbox" type="checkbox" name="rating_checkbox"
                       value="5" {{ in_array(5,$rating) ? 'checked' : '' }}>
                <span>
                    <img src="{{ static_asset('frontend/img/rating/rating-5.jpg') }} " alt="rating five">
                </span>
            </label>
        </div>
    </div>
        <div class="text-center">
            <a href="{{ route('courses') }}" class="template-btn pt-2 pb-2">{{ __('reset') }}</a>
        </div>
</div>
