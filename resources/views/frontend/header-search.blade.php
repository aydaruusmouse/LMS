@if(count($courses) > 0)
    <h6 class="title">{{ __('courses') }}</h6>
    <div class="item-group">
        @foreach ($courses as $course)
            <div class="item">
                <div class="thumb">
                    <a href="{{ route('course.details', $course->slug) }}">
                        <img src="{{ getFileLink('40x40', $course->image) }}" alt="{{ $course->title }}">
                    </a>
                </div>
                <div class="content">
                    <h6><a href="{{ route('course.details', $course->slug) }}">{{ $course->title }}</a></h6>
                </div>
            </div>
        @endforeach
    </div>
@endif

@if (count($categories) > 0)
    <h6 class="title">{{ __('categories') }}</h6>
    <ul class="list-group">
        @foreach ($categories as $category)
            <li><a href="{{ route('courses', ['category' => $category->id]) }}">{{ $category->lang_title }}</a></li>
        @endforeach
    </ul>
@endif
@if(count($instructors) > 0)
    <h6 class="title">{{ __('instructors') }}</h6>
    <div class="item-group">
        @foreach ($instructors as $instructor)
            <div class="item">
                <div class="thumb">
                    <a href="{{ route('instructor.details', $instructor->instructor->slug) }}">
                        <img src="{{ getFileLink('40x40', $instructor->image) }}" alt="{{ $instructor->name }}">
                    </a>
                </div>
                <div class="content">
                    <h6><a href="{{ route('instructor.details', $instructor->instructor->slug) }}">{{ $instructor->name }}</a></h6>
                </div>
            </div>
        @endforeach
    </div>
@endif
@if (count($organizations) > 0)
    <h6 class="title">{{ __('organizations') }}</h6>
    <ul class="list-group">
        @foreach ($organizations as $organization)
            <li><a href="{{ route('organization.details', $organization->slug) }}">{{ $organization->org_name }}</a></li>
        @endforeach
    </ul>
@endif
@if (count($subjects) > 0)
    <h6 class="title">{{ __('subjects') }}</h6>
    <ul class="list-group">
        @foreach ($subjects as $subject)
            <li><a href="{{ route('courses', ['subject' => $subject->id]) }}">{{ $subject->lang_title }}</a></li>
        @endforeach
    </ul>
@endif
@if (count($tags) > 0)
    <h6 class="title">{{ __('tags') }}</h6>
    <ul class="list-group">
        @foreach ($tags as $tag)
            <li><a href="{{ route('courses', ['tag' => $tag->id]) }}">{{ $tag->lang_title }}</a></li>
        @endforeach
    </ul>
@endif
@if (count($levels) > 0)
    <h6 class="title">{{ __('tags') }}</h6>
    <ul class="list-group">
        @foreach ($levels as $level)
            <li><a href="{{ route('courses', ['level' => $level->id]) }}">{{ $level->lang_title }}</a></li>
        @endforeach
    </ul>
@endif

@if(count($courses) == 0 && count($categories) == 0 && count($instructors) == 0 && count($organizations) == 0 && count($subjects) == 0 && count($tags) == 0 && count($levels) == 0)
    <div class="item-group">
        <div class="item">
            <div class="content text-center">
                <h6>{{ __('no_result_found') }}</h6>
            </div>
        </div>
    </div>
@endif
