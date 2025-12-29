@extends('backend.layouts.master')
@section('title', __('home_page_builder'))
@section('content')
    <form action="{{ route('home.page.builder') }}" method="post" class="form">@csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-9 col-xl-7 col-md-12">
                    <h3 class="section-title">{{ __('home_page_sections') }}</h3>
                    <div class="accordion-item py-3 px-30 d-flex align-items-center justify-content-between">
                        <div class="top-content">
                            <h6>{{__('hero_section')}}</h6>
                            <p>{{__('hero_section_subtitle')}}</p>
                        </div>
                        <a href="{{route('hero.section')}}" class="btn sg-btn-primary">{{__('manage_content')}}</a>
                    </div>
                    <div class="homepage-content" id="homepageContent">
                        <!-- End Manage Content -->
                        @php
                            $i = 0;
                        @endphp
                        @foreach($sections as $key=> $section)
                            @php
                                $i++;
                            @endphp
                            @if($section->section == 'top_courses')
                                <input type="hidden" name="ids[]" value="{{ $section->id }}">
                                <div class="accordion-item" data-type="top_courses" id="top_courses">
                                    <h2 class="accordion-header" id="topCourse">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#top_courses_section_{{$i}}" aria-expanded="true"
                                                aria-controls="topCourseCollapse">
                                            <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                                            <span>{{ __('top_course') }}</span>
                                        </button>
                                        <a href="javascript:void(0)"
                                           data-url="{{ route('delete.home.section',$section->id) }}"
                                           class="delete-icon delete_section"><i class="las la-trash-alt"></i></a>
                                    </h2>
                                    <div id="top_courses_section_{{$i}}" class="accordion-collapse collapse"
                                         aria-labelledby="topCourse"
                                         data-bs-parent="#homepageContent">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-4">
                                                        <label for="courseTitle"
                                                               class="form-label">{{ __('title') }}</label>
                                                        <input type="text" class="form-control rounded-2"
                                                               data-type="title"
                                                               value="{{ arrayCheck('title',$section->contents) ? $section->contents['title'] : '' }}"
                                                               name="builder[top_courses_{{$i}}][title]"
                                                               id="courseTitle" placeholder="{{ __('enter_title') }}">
                                                    </div>
                                                </div>
                                                <!-- End Section Title -->

                                                <div class="col-lg-12">
                                                    <div class="">
                                                        <label for="courseSubtitle"
                                                               class="form-label">{{ __('subtitle') }}</label>
                                                        <textarea name="builder[top_courses_{{$i}}][sub_title]"
                                                                  class="form-control h-80" data-type="sub_title"
                                                                  id="courseSubtitle"
                                                                  placeholder="{{ __('enter_sub_title') }}">{{ arrayCheck('sub_title',$section->contents) ? $section->contents['sub_title'] : '' }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- End Section Subtitle -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($section->section == 'success_story')
                                <input type="hidden" name="ids[]" value="{{ $section->id }}">
                                <div class="accordion-item" data-type="success_story" id="success_story">
                                    <input type="hidden" name="builder[success_story]">
                                    <h2 class="accordion-header" id="successStory">
                                        <button type="button" class="accordion-button bef-iconRMV collapsed">
                                            <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                                            <span>{{ __('success_story') }}</span>
                                        </button>
                                        <a href="javascript:void(0)"
                                           data-url="{{ route('delete.home.section',$section->id) }}"
                                           class="delete-icon delete_section"><i class="las la-trash-alt"></i></a>
                                    </h2>
                                    <div id="success_story_section_{{$i}}" class="accordion-collapse collapse"
                                         aria-labelledby="successStory"
                                         data-bs-parent="#homepageContent">
                                    </div>
                                </div>
                            @endif
                            @if($section->section == 'counter_section')
                                <input type="hidden" name="ids[]" value="{{ $section->id }}">
                                <div class="accordion-item" data-type="counter_section" id="counter_section">
                                    <input type="hidden" name="builder[counter_section]">
                                    <h2 class="accordion-header" id="successStory">
                                        <button class="accordion-button bef-iconRMV collapsed" type="button">
                                            <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                                            <span>{{ __('counter_section') }}</span>
                                        </button>
                                        <a href="javascript:void(0)"
                                           data-url="{{ route('delete.home.section',$section->id) }}"
                                           class="delete-icon delete_section"><i class="las la-trash-alt"></i></a>
                                    </h2>
                                    <div id="counter_section_{{$i}}" class="accordion-collapse collapse"
                                         aria-labelledby="successStory"
                                         data-bs-parent="#homepageContent">
                                    </div>
                                </div>
                            @endif
                            @if($section->section == 'fun_fact')
                                <input type="hidden" name="ids[]" value="{{ $section->id }}">
                                <div class="accordion-item" data-type="funFact" id="fun_fact">
                                    <h2 class="accordion-header" id="funFact">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#funFactCollapse_{{$i}}" aria-expanded="false"
                                                aria-controls="funFactCollapse">
                                            <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                                            <span>{{ __('fun_fact') }}</span>
                                        </button>
                                        <a href="javascript:void(0)"
                                           data-url="{{ route('delete.home.section',$section->id) }}"
                                           class="delete-icon delete_section"><i class="las la-trash-alt"></i></a>
                                    </h2>
                                    <div id="funFactCollapse_{{$i}}" class="accordion-collapse collapse"
                                         aria-labelledby="funFact"
                                         data-bs-parent="#homepageContent">
                                        <div class="accordion-body">

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-4">
                                                        <label for="funFactTitle"
                                                               class="form-label">{{ __('title') }}</label>
                                                        <input type="text" class="form-control rounded-2"
                                                               id="funFactTitle" data-type="title"
                                                               name="builder[fun_fact_{{$i}}][title]"
                                                               placeholder="{{ __('enter_title') }}"
                                                               value="{{ arrayCheck('title',$section->contents) ? $section->contents['title'] : '' }}">
                                                    </div>
                                                </div>
                                                <!-- End Section Title -->

                                                <div class="col-lg-12">
                                                    <div class="mb-4">
                                                        <label for="funFactSubtitle"
                                                               class="form-label">{{ __('subtitle') }}</label>
                                                        <textarea class="form-control h-80"
                                                                  placeholder="{{ __('enter_sub_title') }}"
                                                                  data-type="sub_title"
                                                                  name="builder[fun_fact_{{$i}}][sub_title]"
                                                                  id="funFactSubtitle">{{ arrayCheck('sub_title',$section->contents) ? $section->contents['sub_title'] : '' }}</textarea>
                                                    </div>
                                                </div>

                                                @include('backend.common.media-input',[
                                                    'title' => __('fun_fact_image1'),
                                                    'name'  => "builder[fun_fact_$i][image1]",
                                                    'col'   => 'col-lg-12 mb-4',
                                                    'size'  => '(266x255)',
                                                    'type'  => 'image1',
                                                    'image' => old("builder[fun_fact_$i][image1]"),
                                                    'label' => __('fun_fact_image1'),
                                                    'image_object'  => $section->image_1,
                                                    'media_id'  => $section->media_id_1,
                                                    'edit'      => true,
                                                ])

                                                @include('backend.common.media-input',[
                                                    'title' => __('fun_fact_image2'),
                                                    'name'  => "builder[fun_fact_$i][image2]",
                                                    'col'   => 'col-lg-12 mb-4',
                                                    'size'  => '(296x285)',
                                                    'type'  => 'image2',
                                                    'image' => old("builder[fun_fact_$i][image2]"),
                                                    'label' => __('fun_fact_image2'),
                                                    'image_object'  => $section->image_2,
                                                    'media_id'  => $section->media_id_2,
                                                    'edit'      => true,

                                                ])

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($section->section == 'subject')
                                <input type="hidden" name="ids[]" value="{{ $section->id }}">
                                <div class="accordion-item" data-type="subject" id="subject">
                                    <h2 class="accordion-header" id="subjects">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#subject_section_{{$i}}" aria-expanded="false"
                                                aria-controls="subjectCollapse">
                                            <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                                            <span>{{ __('subject') }}</span>
                                        </button>
                                        <a href="javascript:void(0)"
                                           data-url="{{ route('delete.home.section',$section->id) }}"
                                           class="delete-icon delete_section"><i class="las la-trash-alt"></i></a>
                                    </h2>
                                    <div id="subject_section_{{$i}}" class="accordion-collapse collapse"
                                         aria-labelledby="subjects"
                                         data-bs-parent="#homepageContent">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-4">
                                                        <label for="subjectTitle"
                                                               class="form-label">{{ __('title') }}</label>
                                                        <input type="text" class="form-control rounded-2"
                                                               id="subjectTitle" data-type="title"
                                                               name="builder[subject_{{$i}}][title]"
                                                               placeholder="{{ __('enter_title') }}"
                                                               value="{{ arrayCheck('title',$section->contents) ? $section->contents['title'] : '' }}">
                                                    </div>
                                                </div>
                                                <!-- End Section Title -->

                                                <div class="col-lg-12">
                                                    <div class="mb-4">
                                                        <label for="subjectSubtitle"
                                                               class="form-label">{{ __('subtitle') }}</label>
                                                        <textarea class="form-control h-80"
                                                                  placeholder="{{ __('enter_sub_title') }}"
                                                                  data-type="sub_title"
                                                                  name="builder[subject_{{$i}}][sub_title]"
                                                                  id="subjectSubtitle">{{ arrayCheck('sub_title',$section->contents) ? $section->contents['sub_title'] : '' }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- End Section Subtitle -->

                                                <div class="col-lg-12">
                                                    <div class="multi-select-v2">
                                                        <label class="form-label">{{ __('select_subject') }}</label>
                                                        <select multiple class="form-select rounded-0 mb-3"
                                                                placeholder="{{ __('select_subjects') }}"
                                                                name="builder[subject_{{$i}}][ids][]">
                                                            @foreach($subjects as $subject)
                                                                <option
                                                                    value="{{ $subject->id }}" {{ arrayCheck('ids', $section->contents) && in_array($subject->id,$section->contents['ids']) ? 'selected' : '' }}>{{ $subject->subject_title ? : $subject->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- End Subject -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{--                            @if($section->section == 'service_pricing')--}}
                            {{--                                <div class="accordion-item" data-type="service_pricing" id="service_pricing">--}}
                            {{--                                    <h2 class="accordion-header" id="servicePricing">--}}
                            {{--                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"--}}
                            {{--                                                data-bs-target="#service_pricing_section_{{$i}}" aria-expanded="false"--}}
                            {{--                                                aria-controls="servicePricingCollapse">--}}
                            {{--                                            <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">--}}
                            {{--                                            <span>{{ __('service_pricing') }}</span>--}}
                            {{--                                        </button>--}}
                            {{--                                        <a href="javascript:void(0)" class="delete-icon"><i class="las la-trash-alt"></i></a>--}}
                            {{--                                    </h2>--}}
                            {{--                                    <div id="service_pricing_section_{{$i}}" class="accordion-collapse collapse" aria-labelledby="servicePricing"--}}
                            {{--                                         data-bs-parent="#homepageContent">--}}
                            {{--                                        <div class="accordion-body">--}}
                            {{--                                            <div class="row">--}}
                            {{--                                                <div class="col-lg-12">--}}
                            {{--                                                    <div class="mb-4">--}}
                            {{--                                                        <label for="serviceTitle" class="form-label">{{ __('title') }}</label>--}}
                            {{--                                                        <input type="text" class="form-control rounded-2" id="serviceTitle" data-type="title" name="builder[service_pricing_{{$i}}][title]"--}}
                            {{--                                                               placeholder="{{ __('enter_title') }}" value="{{ arrayCheck('title',$section->contents) ? $section->contents['title'] : '' }}">--}}
                            {{--                                                    </div>--}}
                            {{--                                                </div>--}}
                            {{--                                                <!-- End Section Title -->--}}

                            {{--                                                <div class="col-lg-12">--}}
                            {{--                                                    <div class="">--}}
                            {{--                                                        <label for="serviceSubtitle" class="form-label">{{ __('subtitle') }}</label>--}}
                            {{--                                                        <textarea class="form-control h-80" placeholder="{{ __('enter_sub_title') }}" data-type="sub_title" name="builder[service_pricing_{{$i}}][sub_title]"--}}
                            {{--                                                                  id="serviceSubtitle">{{ arrayCheck('sub_title',$section->contents) ? $section->contents['sub_title'] : '' }}</textarea>--}}
                            {{--                                                    </div>--}}
                            {{--                                                </div>--}}
                            {{--                                                <!-- End Section Subtitle -->--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            @endif--}}
                            @if($section->section == 'instructors')
                                <input type="hidden" name="ids[]" value="{{ $section->id }}">
                                <div class="accordion-item" data-type="instructors" id="instructors">
                                    <h2 class="accordion-header" id="instructor">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#instructors_section_{{$i}}" aria-expanded="false"
                                                aria-controls="instructorCollapse">
                                            <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                                            <span>{{ __('instructor') }}</span>
                                        </button>
                                        <a href="javascript:void(0)"
                                           data-url="{{ route('delete.home.section',$section->id) }}"
                                           class="delete-icon delete_section"><i class="las la-trash-alt"></i></a>
                                    </h2>
                                    <div id="instructors_section_{{$i}}" class="accordion-collapse collapse"
                                         aria-labelledby="instructor"
                                         data-bs-parent="#homepageContent">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-4">
                                                        <label for="instructorTitle"
                                                               class="form-label">{{ __('title') }}</label>
                                                        <input type="text" class="form-control rounded-2"
                                                               data-type="title" id="instructorTitle"
                                                               name="builder[instructors_{{$i}}][title]"
                                                               placeholder="{{ __('enter_title') }}"
                                                               value="{{ arrayCheck('title',$section->contents) ? $section->contents['title'] : '' }}">
                                                    </div>
                                                </div>
                                                <!-- End Section Title -->

                                                <div class="col-lg-12">
                                                    <div class="mb-4">
                                                        <label for="instructorSubtitle"
                                                               class="form-label">{{ __('subtitle') }}</label>
                                                        <textarea name="builder[instructors_{{$i}}][sub_title]"
                                                                  data-type="sub_title" class="form-control h-80"
                                                                  placeholder="{{ __('enter_sub_title') }}"
                                                                  id="instructorSubtitle">{{ arrayCheck('sub_title',$section->contents) ? $section->contents['sub_title'] : '' }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- End Section Subtitle -->

                                                <div class="col-lg-12">
                                                    <label class="form-label">{{ __('select_instructor') }}</label>
                                                    <div class="multi-select-v2">
                                                        <select name="builder[instructors_{{$i}}][ids][]" multiple
                                                                placeholder="{{ __('select_instructor') }}"
                                                                class="form-select form-select-lg mb-3">
                                                            @foreach($instructors as $instructor)
                                                                <option
                                                                    value="{{ $instructor->id }}" {{ arrayCheck('ids', $section->contents) && in_array($instructor->id,$section->contents['ids']) ? 'selected' : '' }}>{{ $instructor->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- End Instructor -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($section->section == 'lesson_with_mentor')
                                <input type="hidden" name="ids[]" value="{{ $section->id }}">
                                <div class="accordion-item" data-type="lesson_with_mentor" id="lesson_with_mentor">
                                    <h2 class="accordion-header" id="mentor">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#lesson_with_mentor_section_{{$i}}"
                                                aria-expanded="false" aria-controls="mentorCollapse">
                                            <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                                            <span>{{ __('lesson_with_mentor') }}</span>
                                        </button>
                                        <a href="javascript:void(0)"
                                           data-url="{{ route('delete.home.section',$section->id) }}"
                                           class="delete-icon delete_section"><i class="las la-trash-alt"></i></a>
                                    </h2>
                                    <div id="lesson_with_mentor_section_{{$i}}" class="accordion-collapse collapse"
                                         aria-labelledby="mentor"
                                         data-bs-parent="#homepageContent">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-4">
                                                        <label for="mentorTitle"
                                                               class="form-label">{{ __('title') }}</label>
                                                        <input type="text" class="form-control rounded-2"
                                                               id="mentorTitle" data-type="title"
                                                               name="builder[lesson_with_mentor_{{$i}}][title]"
                                                               placeholder="{{ __('enter_title') }}"
                                                               value="{{ arrayCheck('title',$section->contents) ? $section->contents['title'] : '' }}">
                                                    </div>
                                                </div>
                                                <!-- End Section Title -->

                                                <div class="col-lg-12">
                                                    <div class="mb-4">
                                                        <label for="mentorSubtitle"
                                                               class="form-label">{{ __('subtitle') }}</label>
                                                        <textarea class="form-control h-80"
                                                                  placeholder="{{ __('enter_sub_title') }}"
                                                                  data-type="sub_title"
                                                                  name="builder[lesson_with_mentor_{{$i}}][sub_title]"
                                                                  id="mentorSubtitle">{{ arrayCheck('sub_title',$section->contents) ? $section->contents['sub_title'] : '' }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <label class="form-label">{{ __('select_lessons') }}</label>
                                                    <div class="multi-select-v2">
                                                        <select name="builder[lesson_with_mentor_{{$i}}][ids][]"
                                                                multiple placeholder="{{ __('select_lessons') }}"
                                                                class="form-select form-select-lg mb-3">
                                                            @foreach($lessons as $lesson)
                                                                <option
                                                                    value="{{ $lesson->id }}" {{ arrayCheck('ids', $section->contents) && in_array($lesson->id,$section->contents['ids']) ? 'selected' : '' }}>{{ $lesson->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- End Mentor -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($section->section == 'single_course')
                                <input type="hidden" name="ids[]" value="{{ $section->id }}">
                                <div class="accordion-item" data-type="single_course" id="single_course">
                                    <h2 class="accordion-header" id="singleCourse">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#single_course_section_{{$i}}" aria-expanded="false"
                                                aria-controls="singleCourseCollapse">
                                            <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                                            <span>{{ __('single_course') }}</span>
                                        </button>
                                        <a href="javascript:void(0)"
                                           data-url="{{ route('delete.home.section',$section->id) }}"
                                           class="delete-icon delete_section"><i class="las la-trash-alt"></i></a>
                                    </h2>
                                    <div id="single_course_section_{{$i}}" class="accordion-collapse collapse"
                                         aria-labelledby="singleCourse"
                                         data-bs-parent="#homepageContent">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-4">
                                                        <label for="singleCourseTitle"
                                                               class="form-label">{{ __('title') }}</label>
                                                        <input type="text" class="form-control rounded-2"
                                                               id="singleCourseTitle" data-type="title"
                                                               name="builder[single_course_{{$i}}][title]"
                                                               placeholder="{{ __('enter_title') }}"
                                                               value="{{ arrayCheck('title',$section->contents) ? $section->contents['title'] : '' }}">
                                                    </div>
                                                </div>
                                                <!-- End Section Title -->

                                                <div class="col-lg-12">
                                                    <div class="mb-4">
                                                        <label for="singleCourseSubtitle"
                                                               class="form-label">{{ __('subtitle') }}</label>
                                                        <textarea class="form-control h-80"
                                                                  placeholder="{{ __('enter_sub_title') }}"
                                                                  data-type="sub_title"
                                                                  name="builder[single_course_{{$i}}][sub_title]"
                                                                  id="singleCourseSubtitle">{{ arrayCheck('sub_title',$section->contents) ? $section->contents['sub_title'] : '' }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- End Section Subtitle -->

                                                <div class="col-lg-12">
                                                    <label class="form-label">{{ __('select_course') }}</label>
                                                    <div class="multi-select-v2">
                                                        <select name="builder[single_course_{{$i}}][ids][]" multiple
                                                                placeholder="{{ __('select_course') }}"
                                                                class="form-select form-select-lg mb-3">
                                                            @foreach($courses as $course)
                                                                <option
                                                                    value="{{ $course->id }}" {{ arrayCheck('ids', $section->contents) && in_array($course->id,$section->contents['ids']) ? 'selected' : '' }}>{{ $course->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- End Single Course -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($section->section == 'video_slider')
                                <input type="hidden" name="ids[]" value="{{ $section->id }}">
                                <div class="accordion-item" data-type="video_slider" id="video_slider">
                                    <h2 class="accordion-header" id="videoSlider">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#video_slider_section_{{$i}}" aria-expanded="false"
                                                aria-controls="videoSliderCollapse">
                                            <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                                            <span>{{ __('video_slider') }}</span>
                                        </button>
                                        <a href="javascript:void(0)"
                                           data-url="{{ route('delete.home.section',$section->id) }}"
                                           class="delete-icon delete_section"><i class="las la-trash-alt"></i></a>
                                    </h2>
                                    <div id="video_slider_section_{{$i}}" class="accordion-collapse collapse"
                                         aria-labelledby="videoSlider"
                                         data-bs-parent="#homepageContent">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-4">
                                                        <label for="videoSliderTitle"
                                                               class="form-label">{{ __('title') }}</label>
                                                        <input type="text" class="form-control rounded-2"
                                                               id="videoSliderTitle" data-type="title"
                                                               name="builder[video_slider_{{$i}}][title]"
                                                               placeholder="{{ __('enter_title') }}"
                                                               value="{{ arrayCheck('title',$section->contents) ? $section->contents['title'] : '' }}">
                                                    </div>
                                                </div>
                                                <!-- End Section Title -->

                                                <div class="col-lg-12">
                                                    <div class="mb-4">
                                                        <label for="videoSliderSubtitle"
                                                               class="form-label">{{ __('subtitle') }}</label>
                                                        <textarea class="form-control h-80"
                                                                  placeholder="{{ __('enter_sub_title') }}"
                                                                  data-type="sub_title"
                                                                  name="builder[video_slider_{{$i}}][sub_title]"
                                                                  id="videoSliderSubtitle">{{ arrayCheck('sub_title',$section->contents) ? $section->contents['sub_title'] : '' }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- End Section Subtitle -->

                                                <div class="col-12">
                                                    <div class="text-end">
                                                        <a href="javascript:void(0)"
                                                           class="btn sg-btn-primary clone_video_div"><i
                                                                class="las la-plus"></i></a>
                                                    </div>
                                                    @if(arrayCheck('links',$section->contents) && count($section->contents['links']) > 0)
                                                        @foreach($section->contents['links'] as $k => $link)
                                                            @php
                                                                $media = \App\Models\MediaLibrary::find(getArrayValue('media_id', $link));
                                                            @endphp
                                                            <div class="row video_div mb-4 custom-image">
                                                                <div class="col-lg-2 mt-5 image_col">
                                                                    <div class="selected-files d-flex flex-wrap gap-20">
                                                                        @if($media)
                                                                            <div class="selected-files-item">
                                                                                @if (arrayCheck('image_80x80',$media->image_variants) && is_file_exists($media->image_variants['image_80x80'], $media->image_variants['storage']))
                                                                                    <img
                                                                                        src="{{ getFileLink('80x80',$media->image_variants) }}"
                                                                                        alt="{{ $media->name }}"
                                                                                        class="selected-img">
                                                                                @else
                                                                                    <img
                                                                                        src="{{ static_asset('images/default/default-image-80x80.png') }}"
                                                                                        data-default="{{ static_asset('images/default/default-image-80x80.png') }}"
                                                                                        alt="category-banner"
                                                                                        class="selected-img">
                                                                                @endif
                                                                                <div class="remove-icon"
                                                                                     data-id="{{ $media->id }}">
                                                                                    <i class='las la-times'></i>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                        <div
                                                                            class="selected-files-item {{ $media && arrayCheck('image_80x80',$media->image_variants) && is_file_exists($media->image_variants['image_80x80'], $media->image_variants['storage']) ? 'd-none' : '' }}">
                                                                            <img class="selected-img"
                                                                                 src="{{ static_asset('images/default/default-image-80x80.png') }}"
                                                                                 alt="Headphone">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <div class="mb-2 gallery-modal" data-for="image"
                                                                         data-selection="single">
                                                                        <label for="apkThumb"
                                                                               class="form-label mb-1">{{ __('thumbnail') }} ({{ __('1030x520') }})</label>
                                                                        <label for="apkThumb" class="file-upload-text">
                                                                            <p>
                                                                                <span class="file_selected">
                                                                                    {{ $media && $media->image_variants && arrayCheck('image_80x80',$media->image_variants) && is_file_exists($media->image_variants['image_80x80'], $media->image_variants['storage']) ? 1 : '0' }}
                                                                                </span>{{ __('files_selected') }}
                                                                            </p>
                                                                            <span
                                                                                class="file-btn">{{ __('choose_file') }}</span>
                                                                        </label>
                                                                        <input class="d-none" type="hidden"
                                                                               name="builder[video_slider_{{$i}}][links][{{ $k }}][media_id]"
                                                                               value="{{ getArrayValue('media_id', $link) }}">
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-4">
                                                                            <div class="multi-select-v2 mb-30">
                                                                                <label
                                                                                    class="form-label mb-1">{{ __('video_source') }}</label>
                                                                                <select
                                                                                    name="builder[video_slider_{{$i}}][links][{{ $k }}][video_source]"
                                                                                    data-is_array="1"
                                                                                    data-type="[links][0][video_source]"
                                                                                    class="form-select">
                                                                                    <option
                                                                                        value="youtube" {{ $link['video_source'] == 'youtube' ? 'selected' : '' }}>{{ __('youtube') }}</option>
                                                                                    <option
                                                                                        value="vimeo" {{ $link['video_source'] == 'vimeo' ? 'selected' : '' }}>{{ __('vimeo') }}</option>
                                                                                    <option
                                                                                        value="mp4" {{ $link['video_source'] == 'mp4' ? 'selected' : '' }}>{{ __('mp4') }}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-8">
                                                                            <div class="video-upload-link mb-30">
                                                                                <label
                                                                                    class="form-label mb-1">{{ __('video') }}</label>
                                                                                <input type="url" data-is_array="1"
                                                                                       value="{{ $link['video'] }}"
                                                                                       data-type="[links][0][video]"
                                                                                       name="builder[video_slider_{{$i}}][links][{{ $k }}][video]"
                                                                                       class="form-control rounded-2"
                                                                                       placeholder="https://">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2 mt-5">
                                                                    <a href="javascript:void(0)"
                                                                       class="btn btn-danger text-white btn-sm mt-30 delete_video_div"><i
                                                                            class="las la-minus"></i></a>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="row video_div mb-4 custom-image">
                                                            <div class="col-lg-2 mt-5 image_col">
                                                                <div class="selected-files d-flex flex-wrap gap-20">
                                                                    <div class="selected-files-item">
                                                                        <img class="selected-img"
                                                                             src="{{ static_asset('images/default/default-image-80x80.png') }}"
                                                                             alt="Headphone">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <div class="mb-2 gallery-modal" data-for="image"
                                                                     data-selection="single">
                                                                    <label for="apkThumb"
                                                                           class="form-label mb-1">{{ __('thumbnail') }} ({{ __('1030x520') }})</label>
                                                                    <label class="file-upload-text">
                                                                        <p><span class="file_selected">0 </span>{{ __('files_selected') }}</p>
                                                                        <span class="file-btn">{{ __('choose_file') }}</span>
                                                                    </label>
                                                                    <input class="d-none" type="hidden"
                                                                           name="builder[video_slider_{{$i}}][links][0][media_id]"
                                                                           value="">
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <div class="multi-select-v2 mb-30">
                                                                            <label
                                                                                class="form-label mb-1">{{ __('video_source') }}</label>
                                                                            <select
                                                                                name="builder[video_slider_{{$i}}][links][{{ $k }}][video_source]"
                                                                                data-is_array="1"
                                                                                data-type="[links][0][video_source]"
                                                                                class="form-select">
                                                                                <option
                                                                                    value="youtube" {{ $link['video_source'] == 'youtube' ? 'selected' : '' }}>{{ __('youtube') }}</option>
                                                                                <option
                                                                                    value="vimeo" {{ $link['video_source'] == 'vimeo' ? 'selected' : '' }}>{{ __('vimeo') }}</option>
                                                                                <option
                                                                                    value="mp4" {{ $link['video_source'] == 'mp4' ? 'selected' : '' }}>{{ __('mp4') }}</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <div class="video-upload-link mb-30">
                                                                            <label
                                                                                class="form-label mb-1">{{ __('video') }}</label>
                                                                            <input type="url" data-is_array="1"
                                                                                   value="{{ $link['video'] }}"
                                                                                   data-type="[links][0][video]"
                                                                                   name="builder[video_slider_{{$i}}][links][{{ $k }}][video]"
                                                                                   class="form-control rounded-2"
                                                                                   placeholder="https://">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 mt-5">
                                                                <a href="javascript:void(0)"
                                                                   class="btn btn-danger text-white btn-sm mt-30 delete_video_div"><i
                                                                        class="las la-minus"></i></a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- End Video URL -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($section->section == 'featured_course')
                                <input type="hidden" name="ids[]" value="{{ $section->id }}">
                                <div class="accordion-item" data-type="featured_course" id="featured_course">
                                    <h2 class="accordion-header" id="featuredCourse">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#featured_course_section_{{$i}}" aria-expanded="false"
                                                aria-controls="featuredCourseCollapse">
                                            <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                                            <span>{{ __('featured_course') }}</span>
                                        </button>
                                        <a href="javascript:void(0)"
                                           data-url="{{ route('delete.home.section',$section->id) }}"
                                           class="delete-icon delete_section"><i class="las la-trash-alt"></i></a>
                                    </h2>
                                    <div id="featured_course_section_{{$i}}" class="accordion-collapse collapse"
                                         aria-labelledby="featuredCourse"
                                         data-bs-parent="#homepageContent">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-4">
                                                        <label for="featuredCourseTitle"
                                                               class="form-label">{{ __('title') }}</label>
                                                        <input type="text" class="form-control rounded-2"
                                                               id="featuredCourseTitle" data-type="title"
                                                               name="builder[featured_course_{{$i}}][title]"
                                                               placeholder="{{ __('enter_title') }}"
                                                               value="{{ arrayCheck('title',$section->contents) ? $section->contents['title'] : '' }}">
                                                    </div>
                                                </div>
                                                <!-- End Section Title -->

                                                <div class="col-lg-12">
                                                    <div class="mb-4">
                                                        <label for="featuredCourseSubtitle"
                                                               class="form-label">{{ __('subtitle') }}</label>
                                                        <textarea class="form-control h-80"
                                                                  placeholder="{{ __('enter_sub_title') }}"
                                                                  data-type="sub_title"
                                                                  name="builder[featured_course_{{$i}}][sub_title]"
                                                                  id="featuredCourseSubtitle">{{ arrayCheck('sub_title',$section->contents) ? $section->contents['sub_title'] : '' }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- End Section Subtitle -->

                                                <div class="col-lg-12">
                                                    <label class="form-label">{{ __('select_course') }}</label>
                                                    <div class="multi-select-v2">
                                                        <select name="builder[featured_course_{{$i}}][ids][]"
                                                                data-is_featured="1"
                                                                placeholder="{{ __('select_course') }}"
                                                                class="form-select form-select-lg mb-3" multiple>
                                                            @foreach($featured_courses as $featured_course)
                                                                <option
                                                                    value="{{ $featured_course->id }}" {{ arrayCheck('ids', $section->contents) && in_array($featured_course->id,$section->contents['ids']) ? 'selected' : '' }}>{{ $featured_course->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- End Single Course -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($section->section == 'blog_news')
                                <input type="hidden" name="ids[]" value="{{ $section->id }}">
                                <div class="accordion-item" data-type="blog_news" id="blog_news">
                                    <h2 class="accordion-header" id="blogNews">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#blog_news_section_{{$i}}" aria-expanded="false"
                                                aria-controls="blogNewsCollapse">
                                            <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                                            <span>{{ __('blog_news') }}</span>
                                        </button>
                                        <a href="javascript:void(0)"
                                           data-url="{{ route('delete.home.section',$section->id) }}"
                                           class="delete-icon delete_section"><i class="las la-trash-alt"></i></a>
                                    </h2>
                                    <div id="blog_news_section_{{$i}}" class="accordion-collapse collapse"
                                         aria-labelledby="blogNews"
                                         data-bs-parent="#homepageContent">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-4">
                                                        <label for="blogNewsTitle"
                                                               class="form-label">{{ __('title') }}</label>
                                                        <input type="text" class="form-control rounded-2"
                                                               id="blogNewsTitle" data-type="title"
                                                               name="builder[blog_news_{{$i}}][title]"
                                                               placeholder="{{ __('enter_title') }}"
                                                               value="{{ arrayCheck('title',$section->contents) ? $section->contents['title'] : '' }}">
                                                    </div>
                                                </div>
                                                <!-- End Section Title -->

                                                <div class="col-lg-12">
                                                    <div class="">
                                                        <label for="blogNewsSubtitle"
                                                               class="form-label">{{ __('subtitle') }}</label>
                                                        <textarea class="form-control h-80"
                                                                  placeholder="{{ __('enter_sub_title') }}"
                                                                  data-type="sub_title"
                                                                  name="builder[blog_news_{{$i}}][sub_title]"
                                                                  id="blogNewsSubtitle">{{ arrayCheck('sub_title',$section->contents) ? $section->contents['sub_title'] : '' }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- End Section Subtitle -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($section->section == 'testimonial')
                                <input type="hidden" name="ids[]" value="{{ $section->id }}">
                                <div class="accordion-item" data-type="testimonial" id="testimonial">
                                    <h2 class="accordion-header" id="testimonial">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#testimonial_section_{{$i}}" aria-expanded="false"
                                                aria-controls="testimonialCollapse">
                                            <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                                            <span>{{ __('testimonial') }}</span>
                                        </button>
                                        <a href="javascript:void(0)"
                                           data-url="{{ route('delete.home.section',$section->id) }}"
                                           class="delete-icon delete_section"><i class="las la-trash-alt"></i></a>
                                    </h2>
                                    <div id="testimonial_section_{{$i}}" class="accordion-collapse collapse"
                                         aria-labelledby="testimonial"
                                         data-bs-parent="#homepageContent">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-4">
                                                        <label for="testimonialTitle"
                                                               class="form-label">{{ __('title') }}</label>
                                                        <input type="text" class="form-control rounded-2"
                                                               id="testimonialTitle" data-type="title"
                                                               name="builder[testimonial_{{$i}}][title]"
                                                               placeholder="{{ __('enter_title') }}"
                                                               value="{{ arrayCheck('title',$section->contents) ? $section->contents['title'] : '' }}">
                                                    </div>
                                                </div>
                                                <!-- End Section Title -->

                                                <div class="col-lg-12">
                                                    <div class="mb-4">
                                                        <label for="testimonialSubtitle"
                                                               class="form-label">{{ __('subtitle') }}</label>
                                                        <textarea class="form-control h-80"
                                                                  placeholder="{{ __('enter_sub_title') }}"
                                                                  data-type="sub_title"
                                                                  name="builder[testimonial_{{$i}}][sub_title]"
                                                                  id="testimonialSubtitle">{{ arrayCheck('sub_title',$section->contents) ? $section->contents['sub_title'] : '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($section->section == 'become_instructor')
                                <input type="hidden" name="ids[]" value="{{ $section->id }}">
                                <div class="accordion-item" data-type="become_instructor" id="become_instructor">
                                    <h2 class="accordion-header" id="becomeInstructor">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#become_instructor_section_{{$i}}" aria-expanded="false"
                                                aria-controls="becomeInstructorCollapse">
                                            <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                                            <span>{{ __('become_instructor') }}</span>
                                        </button>
                                        <a href="javascript:void(0)"
                                           data-url="{{ route('delete.home.section',$section->id) }}"
                                           class="delete-icon delete_section"><i class="las la-trash-alt"></i></a>
                                    </h2>
                                    <div id="become_instructor_section_{{$i}}" class="accordion-collapse collapse"
                                         aria-labelledby="becomeInstructor" data-bs-parent="#homepageContent">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-4">
                                                        <label for="becomeInstructorTitle"
                                                               class="form-label">{{ __('title') }}</label>
                                                        <input type="text" class="form-control rounded-2"
                                                               id="becomeInstructorTitle" data-type="title"
                                                               name="builder[become_instructor_{{$i}}][title]"
                                                               placeholder="{{ __('enter_title') }}"
                                                               value="{{ arrayCheck('title',$section->contents) ? $section->contents['title'] : '' }}">
                                                    </div>
                                                </div>
                                                <!-- End Section Title -->

                                                <div class="col-lg-12">
                                                    <div class="">
                                                        <label for="becomeInstructorSubtitle"
                                                               class="form-label">{{ __('subtitle') }}</label>
                                                        <textarea class="form-control h-80"
                                                                  placeholder="{{ __('enter_sub_title') }}"
                                                                  data-type="sub_title"
                                                                  name="builder[become_instructor_{{$i}}][sub_title]"
                                                                  id="becomeInstructorSubtitle">{{ arrayCheck('sub_title',$section->contents) ? $section->contents['sub_title'] : '' }}</textarea>
                                                    </div>
                                                </div>

                                                @include('backend.common.media-input',[
                                                    'title' => __('image'),
                                                    'name'  => "builder[become_instructor_$i][image1]",
                                                    'col'   => 'col-lg-12 mb-4',
                                                    'size'  => '(615x623)',
                                                    'type'  => 'image1',
                                                    'image' => old("builder[become_instructor_$i][image1]"),
                                                    'label' => __('image'),
                                                    'image_object'  => $section->image_1,
                                                    'media_id'  => $section->media_id_1,
                                                    'edit'      => true,
                                                ])
                                                <!-- End Section Subtitle -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($section->section == 'partner_logo')
                                <input type="hidden" name="ids[]" value="{{ $section->id }}">
                                <div class="accordion-item" data-type="partner_logo" id="partner_logo">
                                    <h2 class="accordion-header" id="partnerLogo">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#partner_logo_section_{{$i}}" aria-expanded="false"
                                                aria-controls="partnerLogoCollapse">
                                            <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                                            <span>{{ __('partner_logo') }}</span>
                                        </button>
                                        <a href="javascript:void(0)"
                                           data-url="{{ route('delete.home.section',$section->id) }}"
                                           class="delete-icon delete_section"><i class="las la-trash-alt"></i></a>
                                    </h2>
                                    <div id="partner_logo_section_{{$i}}" class="accordion-collapse collapse"
                                         aria-labelledby="partnerLogo"
                                         data-bs-parent="#homepageContent">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-4">
                                                        <label for="partnerLogoTitle"
                                                               class="form-label">{{ __('title') }}</label>
                                                        <input type="text" class="form-control rounded-2"
                                                               id="partnerLogoTitle" data-type="title"
                                                               name="builder[partner_logo_{{$i}}][title]"
                                                               placeholder="{{ __('enter_title') }}"
                                                               value="{{ arrayCheck('title',$section->contents) ? $section->contents['title'] : '' }}">
                                                    </div>
                                                </div>
                                                <!-- End Section Title -->

                                                <div class="col-lg-12">
                                                    <div class="">
                                                        <label for="partnerLogoSubtitle"
                                                               class="form-label">{{ __('subtitle') }}</label>
                                                        <textarea class="form-control h-80"
                                                                  placeholder="{{ __('enter_sub_title') }}"
                                                                  data-type="sub_title"
                                                                  name="builder[partner_logo_{{$i}}][sub_title]"
                                                                  id="partnerLogoSubtitle">{{ arrayCheck('sub_title',$section->contents) ? $section->contents['title'] : '' }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- End Section Subtitle -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-5 col-md-12">
                    <div class="fixedSide">
                        <h3 class="section-title">{{ __('add_module') }}</h3>
                        <div class="bg-white redious-border p-20 px-xl-3 py-xl-20 simplebar">
                            <div class="builder-content" id="builderContent">
                                <div class="builder" data-target_id="top_courses" data-name="top_courses"
                                     data-var_type="">
                                    <div class="icon">
                                        <img src="{{ static_asset('admin/img/icons/home-icon/book-opened.svg')}}"
                                             alt="Book Opened">
                                    </div>
                                    <h6 class="title">{{ __('top_course') }}</h6>
                                </div>
                                <!-- End Builder -->

                                <div class="builder" data-target_id="fun_fact" data-name="fun_fact"
                                     data-var_type="array">
                                    <div class="icon">
                                        <img src="{{ static_asset('admin/img/icons/home-icon/happy-face.svg')}}"
                                             alt="Happy Face">
                                    </div>
                                    <h6 class="title">{{ __('fun_fact') }}</h6>
                                </div>
                                <!-- End Builder -->

                                <div class="builder" data-target_id="subject" data-name="subject" data-var_type="array">
                                    <div class="icon">
                                        <img src="{{ static_asset('admin/img/icons/home-icon/notebook.svg')}}"
                                             alt="Notebook">
                                    </div>
                                    <h6 class="title">{{ __('subject') }}</h6>
                                </div>
                                <!-- End Builder -->

                                {{--                                <div class="builder" data-target_id="service_pricing" data-name="service_pricing" data-var_type="array">--}}
                                {{--                                    <div class="icon">--}}
                                {{--                                        <img src="{{ static_asset('admin/img/icons/home-icon/dolar.svg')}}" alt="Dollar">--}}
                                {{--                                    </div>--}}
                                {{--                                    <h6 class="title">{{ __('pricing') }}</h6>--}}
                                {{--                                </div>--}}
                                <!-- End Builder -->

                                <div class="builder" data-target_id="success_story" data-name="success_story"
                                     data-type="array">
                                    <div class="icon">
                                        <img src="{{ static_asset('admin/img/icons/home-icon/cup.svg')}}" alt="cup">
                                    </div>
                                    <h6 class="title">{{ __('success_story') }}</h6>
                                </div>

                                <div class="builder" data-target_id="counter_section" data-name="counter_section"
                                     data-var_type="array">
                                    <div class="icon">
                                        <img src="{{ static_asset('admin/img/icons/home-icon/cup.svg')}}" alt="cup">
                                    </div>
                                    <h6 class="title">{{ __('counter_section') }}</h6>
                                </div>
                                <!-- End Builder -->

                                <div class="builder" data-target_id="instructors" data-name="instructors"
                                     data-var_type="array">
                                    <div class="icon">
                                        <img src="{{ static_asset('admin/img/icons/home-icon/person.svg')}}"
                                             alt="person">
                                    </div>
                                    <h6 class="title">{{ __('instructor') }}</h6>
                                </div>
                                <!-- End Builder -->

                                <div class="builder" data-target_id="lesson_with_mentor" data-name="lesson_with_mentor"
                                     data-var_type="array">
                                    <div class="icon">
                                        <img src="{{ static_asset('admin/img/icons/home-icon/news.svg')}}" alt="news">
                                    </div>
                                    <h6 class="title">{{ __('lesson_with_mentor') }}</h6>
                                </div>
                                <!-- End Builder -->

                                <div class="builder" data-target_id="single_course" data-name="single_course"
                                     data-var_type="array">
                                    <div class="icon">
                                        <img src="{{ static_asset('admin/img/icons/home-icon/notebook.svg')}}"
                                             alt="notebook">
                                    </div>
                                    <h6 class="title">{{ __('single_course') }}</h6>
                                </div>
                                <!-- End Builder -->

                                <div class="builder" data-target_id="video_slider" data-name="video_slider"
                                     data-var_type="array">
                                    <div class="icon">
                                        <img src="{{ static_asset('admin/img/icons/home-icon/online-video.svg')}}"
                                             alt="online-video">
                                    </div>
                                    <h6 class="title">{{ __('video_slider') }}</h6>
                                </div>
                                <!-- End Builder -->

                                <div class="builder" data-target_id="featured_course" data-name="featured_course"
                                     data-var_type="array">
                                    <div class="icon">
                                        <img src="{{ static_asset('admin/img/icons/home-icon/book-opened.svg')}}"
                                             alt="book-opened">
                                    </div>
                                    <h6 class="title">{{ __('featured_course') }}</h6>
                                </div>
                                <!-- End Builder -->

                                <div class="builder" data-target_id="blog_news" data-name="blog_news"
                                     data-var_type="array">
                                    <div class="icon">
                                        <img src="{{ static_asset('admin/img/icons/home-icon/dashboard.svg')}}"
                                             alt="dashboard">
                                    </div>
                                    <h6 class="title">{{ __('blog_news') }}</h6>
                                </div>
                                <!-- End Builder -->

                                <div class="builder" data-target_id="testimonial" data-name="testimonial"
                                     data-var_type="array">
                                    <div class="icon">
                                        <img src="{{ static_asset('admin/img/icons/home-icon/rate.svg')}}" alt="rate">
                                    </div>
                                    <h6 class="title">{{ __('testimonial') }}</h6>
                                </div>
                                <!-- End Builder -->
                                <div class="builder" data-target_id="become_instructor" data-name="become_instructor"
                                     data-var_type="array">
                                    <div class="icon">
                                        <img src="{{ static_asset('admin/img/icons/home-icon/person.svg')}}"
                                             alt="person">
                                    </div>
                                    <h6 class="title">{{ __('become_instructor') }}</h6>
                                </div>

                                <div class="builder" data-target_id="partner_logo" data-name="partner_logo"
                                     data-var_type="array">
                                    <div class="icon">
                                        <img src="{{ static_asset('admin/img/icons/home-icon/star.svg')}}" alt="star">
                                    </div>
                                    <h6 class="title">{{ __('partner_logo') }}</h6>
                                </div>
                                <!-- End Builder -->
                                {{--
                                                            <div class="builder" data-target_id="become_instructor" data-name="become_instructor"
                                                                 data-type="array">
                                                                <div class="icon">
                                                                    <img src="{{ static_asset('admin/img/icons/home-icon/layers.svg')}}" alt="layers">
                                                                </div>
                                                                <h6 class="title">{{ __('subscription') }}</h6>
                                                            </div>
                                                            <!-- End Builder -->--}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="homepageFixBTN bg-white py-20 px-4">
                <button type="submit" class="btn sg-btn-primary">{{ __('update') }}</button>
                @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
            </div>
        </div>
    </form>
    <div class="modal">
        <div class="accordion" id="homepageContent">
            <div class="accordion-item" data-type="top_courses" id="top_courses">
                <h2 class="accordion-header" id="topCourse">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#topCourseCollapse" aria-expanded="true" aria-controls="topCourseCollapse">
                        <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                        <span>{{ __('top_course') }}</span>
                    </button>
                    <a href="javascript:void(0)" class="delete-icon"><i class="las la-trash-alt"></i></a>
                </h2>
                <div id="topCourseCollapse" class="accordion-collapse collapse show" aria-labelledby="topCourse"
                     data-bs-parent="#homepageContent">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="courseTitle" class="form-label">{{ __('title') }}</label>
                                    <input type="text" class="form-control rounded-2" data-type="title"
                                           name="builder[top_courses]" id="courseTitle"
                                           placeholder="{{ __('enter_title') }}">
                                </div>
                            </div>
                            <!-- End Section Title -->

                            <div class="col-lg-12">
                                <div class="">
                                    <label for="courseSubtitle" class="form-label">{{ __('subtitle') }}</label>
                                    <textarea name="builder[top_courses]" class="form-control h-80"
                                              data-type="sub_title" id="courseSubtitle"
                                              placeholder="{{ __('enter_sub_title') }}"></textarea>
                                </div>
                            </div>
                            <!-- End Section Subtitle -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Top Course -->

            <div class="accordion-item" data-type="success_story" id="success_story">
                <input type="hidden" name="builder[success_story]">
                <h2 class="accordion-header" id="successStory">
                    <button type="button" class="accordion-button bef-iconRMV collapsed">
                        <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                        <span>{{ __('success_story') }}</span>
                    </button>
                    <a href="javascript:void(0)" class="delete-icon"><i class="las la-trash-alt"></i></a>
                </h2>
                <div id="successStoryCollapse" class="accordion-collapse collapse" aria-labelledby="successStory"
                     data-bs-parent="#homepageContent">
                </div>
            </div>

            <div class="accordion-item" data-type="counter_section" id="counter_section">
                <input type="hidden" name="builder[counter_section]">
                <h2 class="accordion-header" id="successStory">
                    <button class="accordion-button bef-iconRMV collapsed" type="button">
                        <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                        <span>{{ __('counter_section') }}</span>
                    </button>
                    <a href="javascript:void(0)" class="delete-icon"><i class="las la-trash-alt"></i></a>
                </h2>
                <div id="successStoryCollapse" class="accordion-collapse collapse" aria-labelledby="successStory"
                     data-bs-parent="#homepageContent">
                </div>
            </div>
            <!-- End Counter section -->

            <div class="accordion-item" data-type="funFact" id="fun_fact">
                <h2 class="accordion-header" id="funFact">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#funFactCollapse" aria-expanded="false" aria-controls="funFactCollapse">
                        <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                        <span>{{ __('fun_fact') }}</span>
                    </button>
                    <a href="javascript:void(0)" class="delete-icon"><i class="las la-trash-alt"></i></a>
                </h2>
                <div id="funFactCollapse" class="accordion-collapse collapse" aria-labelledby="funFact"
                     data-bs-parent="#homepageContent">
                    <div class="accordion-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="funFactTitle" class="form-label">{{ __('title') }}</label>
                                    <input type="text" class="form-control rounded-2" id="funFactTitle"
                                           data-type="title" name="builder[fun_fact]"
                                           placeholder="{{ __('enter_title') }}">
                                </div>
                            </div>
                            <!-- End Section Title -->

                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="funFactSubtitle" class="form-label">{{ __('subtitle') }}</label>
                                    <textarea class="form-control h-80" placeholder="{{ __('enter_sub_title') }}"
                                              data-type="sub_title" name="builder[fun_fact]"
                                              id="funFactSubtitle"></textarea>
                                </div>
                            </div>

                            @include('backend.common.media-input',[
                                'title' => __('fun_fact_image1'),
                                'name'  => 'fun_fact_image1',
                                'col'   => 'col-lg-12 mb-4',
                                'size'  => '(266x255)',
                                'type'  => 'image1',
                                'image' => old('fun_fact_image1'),
                                'label' => __('fun_fact_image1'),
                            ])

                            @include('backend.common.media-input',[
                                'title' => __('fun_fact_image2'),
                                'name'  => 'fun_fact_image2',
                                'col'   => 'col-lg-12 mb-4',
                                'size'  => '(296x285)',
                                'type'  => 'image2',
                                'image' => old('fun_fact_image2'),
                                'label' => __('fun_fact_image2'),
                            ])

                        </div>
                    </div>
                </div>
            </div>
            <!-- End Fun Fact -->

            <div class="accordion-item" data-type="subject" id="subject">
                <h2 class="accordion-header" id="subjects">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#subjectCollapse" aria-expanded="false" aria-controls="subjectCollapse">
                        <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                        <span>{{ __('subject') }}</span>
                    </button>
                    <a href="javascript:void(0)" class="delete-icon"><i class="las la-trash-alt"></i></a>
                </h2>
                <div id="subjectCollapse" class="accordion-collapse collapse" aria-labelledby="subjects"
                     data-bs-parent="#homepageContent">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="subjectTitle" class="form-label">{{ __('title') }}</label>
                                    <input type="text" class="form-control rounded-2" id="subjectTitle"
                                           data-type="title" name="builder[subject]"
                                           placeholder="{{ __('enter_title') }}">
                                </div>
                            </div>
                            <!-- End Section Title -->

                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="subjectSubtitle" class="form-label">{{ __('subtitle') }}</label>
                                    <textarea class="form-control h-80" placeholder="{{ __('enter_sub_title') }}"
                                              data-type="sub_title" name="builder[subject]"
                                              id="subjectSubtitle"></textarea>
                                </div>
                            </div>
                            <!-- End Section Subtitle -->

                            <div class="col-lg-12">
                                <div class="multi-select-v2">
                                    <label class="form-label">{{ __('select_subject') }}</label>
                                    <select multiple class="form-select rounded-0 mb-3"
                                            placeholder="{{ __('select_subjects') }}" name="builder[subject]">
                                    </select>
                                </div>
                            </div>
                            <!-- End Subject -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Subject -->

            <div class="accordion-item" data-type="service_pricing" id="service_pricing">
                <h2 class="accordion-header" id="servicePricing">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#servicePricingCollapse" aria-expanded="false"
                            aria-controls="servicePricingCollapse">
                        <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                        <span>{{ __('service_pricing') }}</span>
                    </button>
                    <a href="javascript:void(0)" class="delete-icon"><i class="las la-trash-alt"></i></a>
                </h2>
                <div id="servicePricingCollapse" class="accordion-collapse collapse" aria-labelledby="servicePricing"
                     data-bs-parent="#homepageContent">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="serviceTitle" class="form-label">{{ __('title') }}</label>
                                    <input type="text" class="form-control rounded-2" id="serviceTitle"
                                           data-type="title" name="builder[service_pricing]"
                                           placeholder="{{ __('enter_title') }}">
                                </div>
                            </div>
                            <!-- End Section Title -->

                            <div class="col-lg-12">
                                <div class="">
                                    <label for="serviceSubtitle" class="form-label">{{ __('subtitle') }}</label>
                                    <textarea class="form-control h-80" placeholder="{{ __('enter_sub_title') }}"
                                              data-type="sub_title" name="builder[service_pricing]"
                                              id="serviceSubtitle"></textarea>
                                </div>
                            </div>
                            <!-- End Section Subtitle -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Service Pricing -->

            <div class="accordion-item" data-type="instructors" id="instructors">
                <h2 class="accordion-header" id="instructor">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#instructorCollapse" aria-expanded="false"
                            aria-controls="instructorCollapse">
                        <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                        <span>{{ __('instructor') }}</span>
                    </button>
                    <a href="javascript:void(0)" class="delete-icon"><i class="las la-trash-alt"></i></a>
                </h2>
                <div id="instructorCollapse" class="accordion-collapse collapse" aria-labelledby="instructor"
                     data-bs-parent="#homepageContent">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="instructorTitle" class="form-label">{{ __('title') }}</label>
                                    <input type="text" class="form-control rounded-2" data-type="title"
                                           id="instructorTitle" name="builder[instructors]"
                                           placeholder="{{ __('enter_title') }}">
                                </div>
                            </div>
                            <!-- End Section Title -->

                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="instructorSubtitle" class="form-label">{{ __('subtitle') }}</label>
                                    <textarea name="builder[instructors]" data-type="sub_title"
                                              class="form-control h-80" placeholder="{{ __('enter_sub_title') }}"
                                              id="instructorSubtitle"></textarea>
                                </div>
                            </div>
                            <!-- End Section Subtitle -->

                            <div class="col-lg-12">
                                <label class="form-label">{{ __('select_instructor') }}</label>
                                <div class="multi-select-v2">
                                    <select name="builder[instructors]" multiple
                                            placeholder="{{ __('select_instructor') }}"
                                            class="form-select form-select-lg mb-3"></select>
                                </div>
                            </div>
                            <!-- End Instructor -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Instructor -->

            <div class="accordion-item" data-type="lesson_with_mentor" id="lesson_with_mentor">
                <h2 class="accordion-header" id="mentor">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#mentorCollapse" aria-expanded="false" aria-controls="mentorCollapse">
                        <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                        <span>{{ __('lesson_with_mentor') }}</span>
                    </button>
                    <a href="javascript:void(0)" class="delete-icon"><i class="las la-trash-alt"></i></a>
                </h2>
                <div id="mentorCollapse" class="accordion-collapse collapse" aria-labelledby="mentor"
                     data-bs-parent="#homepageContent">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="mentorTitle" class="form-label">{{ __('title') }}</label>
                                    <input type="text" class="form-control rounded-2" id="mentorTitle" data-type="title"
                                           name="builder[lesson_with_mentor]"
                                           placeholder="{{ __('enter_title') }}">
                                </div>
                            </div>
                            <!-- End Section Title -->

                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="mentorSubtitle" class="form-label">{{ __('subtitle') }}</label>
                                    <textarea class="form-control h-80" placeholder="{{ __('enter_sub_title') }}"
                                              data-type="sub_title" name="builder[lesson_with_mentor]"
                                              id="mentorSubtitle"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <label class="form-label">{{ __('select_lessons') }}</label>
                                <div class="multi-select-v2">
                                    <select name="builder[lesson_with_mentor]" multiple
                                            placeholder="{{ __('select_lessons') }}"
                                            class="form-select form-select-lg mb-3"></select>
                                </div>
                            </div>
                            <!-- End Mentor -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Lesson With Mentor -->

            <div class="accordion-item" data-type="single_course" id="single_course">
                <h2 class="accordion-header" id="singleCourse">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#singleCourseCollapse" aria-expanded="false"
                            aria-controls="singleCourseCollapse">
                        <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                        <span>{{ __('single_course') }}</span>
                    </button>
                    <a href="javascript:void(0)" class="delete-icon"><i class="las la-trash-alt"></i></a>
                </h2>
                <div id="singleCourseCollapse" class="accordion-collapse collapse" aria-labelledby="singleCourse"
                     data-bs-parent="#homepageContent">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="singleCourseTitle" class="form-label">{{ __('title') }}</label>
                                    <input type="text" class="form-control rounded-2" id="singleCourseTitle"
                                           data-type="title" name="builder[single_course]"
                                           placeholder="{{ __('enter_title') }}">
                                </div>
                            </div>
                            <!-- End Section Title -->

                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="singleCourseSubtitle" class="form-label">{{ __('subtitle') }}</label>
                                    <textarea class="form-control h-80" placeholder="{{ __('enter_sub_title') }}"
                                              data-type="sub_title" name="builder[single_course]"
                                              id="singleCourseSubtitle"></textarea>
                                </div>
                            </div>
                            <!-- End Section Subtitle -->

                            <div class="col-lg-12">
                                <label class="form-label">{{ __('select_course') }}</label>
                                <div class="multi-select-v2">
                                    <select name="builder[single_course]" multiple
                                            placeholder="{{ __('select_course') }}"
                                            class="form-select form-select-lg mb-3"></select>
                                </div>
                            </div>
                            <!-- End Single Course -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Single Course -->

            <div class="accordion-item" data-type="video_slider" id="video_slider">
                <h2 class="accordion-header" id="videoSlider">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#videoSliderCollapse" aria-expanded="false"
                            aria-controls="videoSliderCollapse">
                        <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                        <span>{{ __('video_slider') }}</span>
                    </button>
                    <a href="javascript:void(0)" class="delete-icon"><i class="las la-trash-alt"></i></a>
                </h2>
                <div id="videoSliderCollapse" class="accordion-collapse collapse" aria-labelledby="videoSlider"
                     data-bs-parent="#homepageContent">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="videoSliderTitle" class="form-label">{{ __('title') }}</label>
                                    <input type="text" class="form-control rounded-2" id="videoSliderTitle"
                                           data-type="title" name="builder[video_slider]"
                                           placeholder="{{ __('enter_title') }}">
                                </div>
                            </div>
                            <!-- End Section Title -->

                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="videoSliderSubtitle" class="form-label">{{ __('subtitle') }}</label>
                                    <textarea class="form-control h-80" placeholder="{{ __('enter_sub_title') }}"
                                              data-type="sub_title" name="builder[video_slider]"
                                              id="videoSliderSubtitle"></textarea>
                                </div>
                            </div>
                            <!-- End Section Subtitle -->

                            <div class="col-12">
                                <div class="text-end">
                                    <a href="javascript:void(0)" class="btn sg-btn-primary clone_video_div"><i
                                            class="las la-plus"></i></a>
                                </div>
                                <div class="row video_div mb-4 custom-image">
                                    <div class="col-lg-2 mt-5 image_col">
                                        <div class="selected-files d-flex flex-wrap gap-20">
                                            <div class="selected-files-item">
                                                <img class="selected-img"
                                                     src="{{ static_asset('images/default/default-image-80x80.png') }}"
                                                     alt="Headphone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="mb-2 gallery-modal" data-for="image" data-selection="single">
                                            <label for="apkThumb"
                                                   class="form-label mb-1">{{ __('thumbnail') }} ({{ __('1030x520') }})</label>
                                            <label for="apkThumb" class="file-upload-text">
                                                <p><span class="file_selected">0 </span>{{ __('files_selected') }}</p>
                                                <span class="file-btn">{{ __('choose_file') }}</span>
                                            </label>
                                            <input class="d-none" type="hidden" name="builder[video_slider]"
                                                   data-is_array="1"
                                                   data-type="[links][0][media_id]" value="">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="multi-select-v2 mb-30">
                                                    <label class="form-label mb-1">{{ __('video_source') }}</label>
                                                    <select
                                                        name="builder[video_slider]"
                                                        data-is_array="1"
                                                        data-type="[links][0][video_source]"
                                                        class="form-select">
                                                        <option value="youtube">{{ __('youtube') }}</option>
                                                        <option value="vimeo">{{ __('vimeo') }}</option>
                                                        <option value="mp4">{{ __('mp4') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="video-upload-link mb-30">
                                                    <label
                                                        class="form-label mb-1">{{ __('video') }}</label>
                                                    <input type="url" data-is_array="1"
                                                           data-type="[links][0][video]"
                                                           name="builder[video_slider]"
                                                           class="form-control rounded-2"
                                                           placeholder="https://">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 mt-5">
                                        <a href="javascript:void(0)"
                                           class="btn btn-danger text-white btn-sm mt-30 delete_video_div"><i
                                                class="las la-minus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Video Slider -->

            <div class="accordion-item" data-type="featured_course" id="featured_course">
                <h2 class="accordion-header" id="featuredCourse">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#featuredCourseCollapse" aria-expanded="false"
                            aria-controls="featuredCourseCollapse">
                        <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                        <span>{{ __('featured_course') }}</span>
                    </button>
                    <a href="javascript:void(0)" class="delete-icon"><i class="las la-trash-alt"></i></a>
                </h2>
                <div id="featuredCourseCollapse" class="accordion-collapse collapse" aria-labelledby="featuredCourse"
                     data-bs-parent="#homepageContent">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="featuredCourseTitle" class="form-label">{{ __('title') }}</label>
                                    <input type="text" class="form-control rounded-2" id="featuredCourseTitle"
                                           data-type="title" name="builder[featured_course]"
                                           placeholder="{{ __('enter_title') }}">
                                </div>
                            </div>
                            <!-- End Section Title -->

                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="featuredCourseSubtitle" class="form-label">{{ __('subtitle') }}</label>
                                    <textarea class="form-control h-80" placeholder="{{ __('enter_sub_title') }}"
                                              data-type="sub_title" name="builder[featured_course]"
                                              id="featuredCourseSubtitle"></textarea>
                                </div>
                            </div>
                            <!-- End Section Subtitle -->

                            <div class="col-lg-12">
                                <label class="form-label">{{ __('select_course') }}</label>
                                <div class="multi-select-v2">
                                    <select name="builder[featured_course]" data-is_featured="1"
                                            placeholder="{{ __('select_course') }}"
                                            class="form-select form-select-lg mb-3" multiple></select>
                                </div>
                            </div>
                            <!-- End Single Course -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Featured Course -->

            <div class="accordion-item" data-type="blog_news" id="blog_news">
                <h2 class="accordion-header" id="blogNews">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#blogNewsCollapse" aria-expanded="false" aria-controls="blogNewsCollapse">
                        <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                        <span>{{ __('blog_news') }}</span>
                    </button>
                    <a href="javascript:void(0)" class="delete-icon"><i class="las la-trash-alt"></i></a>
                </h2>
                <div id="blogNewsCollapse" class="accordion-collapse collapse" aria-labelledby="blogNews"
                     data-bs-parent="#homepageContent">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="blogNewsTitle" class="form-label">{{ __('title') }}</label>
                                    <input type="text" class="form-control rounded-2" id="blogNewsTitle"
                                           data-type="title" name="builder[blog_news]"
                                           placeholder="{{ __('enter_title') }}">
                                </div>
                            </div>
                            <!-- End Section Title -->

                            <div class="col-lg-12">
                                <div class="">
                                    <label for="blogNewsSubtitle" class="form-label">{{ __('subtitle') }}</label>
                                    <textarea class="form-control h-80" placeholder="{{ __('enter_sub_title') }}"
                                              data-type="sub_title" name="builder[blog_news]"
                                              id="blogNewsSubtitle"></textarea>
                                </div>
                            </div>
                            <!-- End Section Subtitle -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Blog News -->

            <div class="accordion-item" data-type="testimonial" id="testimonial">
                <h2 class="accordion-header" id="testimonial">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#testimonialCollapse" aria-expanded="false"
                            aria-controls="testimonialCollapse">
                        <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                        <span>{{ __('testimonial') }}</span>
                    </button>
                    <a href="javascript:void(0)" class="delete-icon"><i class="las la-trash-alt"></i></a>
                </h2>
                <div id="testimonialCollapse" class="accordion-collapse collapse" aria-labelledby="testimonial"
                     data-bs-parent="#homepageContent">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="testimonialTitle" class="form-label">{{ __('title') }}</label>
                                    <input type="text" class="form-control rounded-2" id="testimonialTitle"
                                           data-type="title" name="builder[testimonial]"
                                           placeholder="{{ __('enter_title') }}">
                                </div>
                            </div>
                            <!-- End Section Title -->

                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="testimonialSubtitle" class="form-label">{{ __('subtitle') }}</label>
                                    <textarea class="form-control h-80" placeholder="{{ __('enter_sub_title') }}"
                                              data-type="sub_title" name="builder[testimonial]"
                                              id="testimonialSubtitle"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Testimonial -->

            <div class="accordion-item" data-type="become_instructor" id="become_instructor">
                <h2 class="accordion-header" id="becomeInstructor">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#becomeInstructorCollapse" aria-expanded="false"
                            aria-controls="becomeInstructorCollapse">
                        <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                        <span>{{ __('become_instructor') }}</span>
                    </button>
                    <a href="javascript:void(0)" class="delete-icon"><i class="las la-trash-alt"></i></a>
                </h2>
                <div id="becomeInstructorCollapse" class="accordion-collapse collapse"
                     aria-labelledby="becomeInstructor" data-bs-parent="#homepageContent">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="becomeInstructorTitle" class="form-label">{{ __('title') }}</label>
                                    <input type="text" class="form-control rounded-2" id="becomeInstructorTitle"
                                           data-type="title" name="builder[become_instructor]"
                                           placeholder="{{ __('enter_title') }}">
                                </div>
                            </div>
                            <!-- End Section Title -->

                            <div class="col-lg-12">
                                <div class="">
                                    <label for="becomeInstructorSubtitle"
                                           class="form-label">{{ __('subtitle') }}</label>
                                    <textarea class="form-control h-80" placeholder="{{ __('enter_sub_title') }}"
                                              data-type="sub_title" name="builder[become_instructor]"
                                              id="becomeInstructorSubtitle"></textarea>
                                </div>
                            </div>

                            @include('backend.common.media-input',[
                                'title' => __('become_instructor_image'),
                                'name'  => 'become_instructor_image',
                                'col'   => 'col-lg-12 mt-4',
                                'size'  => '(615x623)',
                                'image' => old('become_instructor_image'),
                                'label' => __('image'),
                            ])
                            <!-- End Section Subtitle -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Become an instructor -->

            <div class="accordion-item" data-type="partner_logo" id="partner_logo">
                <h2 class="accordion-header" id="partnerLogo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#partnerLogoCollapse" aria-expanded="false"
                            aria-controls="partnerLogoCollapse">
                        <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                        <span>{{ __('partner_logo') }}</span>
                    </button>
                    <a href="javascript:void(0)" class="delete-icon"><i class="las la-trash-alt"></i></a>
                </h2>
                <div id="partnerLogoCollapse" class="accordion-collapse collapse" aria-labelledby="partnerLogo"
                     data-bs-parent="#homepageContent">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="partnerLogoTitle" class="form-label">{{ __('title') }}</label>
                                    <input type="text" class="form-control rounded-2" id="partnerLogoTitle"
                                           data-type="title" name="builder[partner_logo]"
                                           placeholder="{{ __('enter_title') }}">
                                </div>
                            </div>
                            <!-- End Section Title -->

                            <div class="col-lg-12">
                                <div class="">
                                    <label for="partnerLogoSubtitle" class="form-label">{{ __('subtitle') }}</label>
                                    <textarea class="form-control h-80" placeholder="{{ __('enter_sub_title') }}"
                                              data-type="sub_title" name="builder[partner_logo]"
                                              id="partnerLogoSubtitle"></textarea>
                                </div>
                            </div>
                            <!-- End Section Subtitle -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Partner Logo -->
        </div>
    </div>
    @include('backend.common.gallery-modal')
@endsection
@push('js')
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
    <script>
        section = {{ count($sections) }};
    </script>
@endpush
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@push('js_asset')
    <script src="{{ static_asset('admin/js/sortable.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
@endpush
@push('js')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.delete_video_div', function () {
                $(this).closest(".row").remove();
            });
            $(document).on('click', '.clone_video_div', function () {
                let selector = $(this).closest('.col-12');
                let clone_div = $('#videoSliderCollapse .video_div').clone();
                clone_div.appendTo(selector);
                let count = selector.find('.video_div').length;
                count--;
                let first_input_name = selector.find('.video_div').first().find('input').attr('name');
                let next_name = first_input_name.replace('[links][0]', '[links][' + count + ']');
                let first_url_name = selector.find('.video_div').first().find('input[type="url"]').attr('name');
                let next_url_name = first_url_name.replace('[links][0]', '[links][' + count + ']');
                let first_select_name = selector.find('.video_div').first().find('select').attr('name');
                let next_select_name = first_select_name.replace('[links][0]', '[links][' + count + ']');

                selector.find('.video_div').last().find('select').attr('name', next_select_name).select2({
                    minimumResultsForSearch: Infinity,
                    placeholder: $(this).attr("placeholder"),
                });
                selector.find('.video_div').last().find('input').attr('name', next_name);
                selector.find('.video_div').last().find('input[type="url"]').attr('name', next_url_name);
            });
        })
    </script>
@endpush
