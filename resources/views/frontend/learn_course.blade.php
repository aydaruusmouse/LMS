@extends('frontend.layouts.master')
@section('title', __('course'))
@section('content')
    <!--====== Start Course Video Section ======-->
    <section class="course-video-section p-t-50 p-b-100 p-t-sm-30">
        <div class="container container-1278">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="border-bottom-soft-white-lg p-b-md-10 m-b-sm-15 m-b-25 fw-medium fz-22">
                                {{ $course->title }}
                            </h4>
                        </div>
                    </div>

                    @if (@$selected_lesson->lesson_type == 'video')
                        @if($selected_lesson->source == 'mp4' || $selected_lesson->source == 'upload')
                            <div class="video-lesson-player video-wrapper lesson-playlist" id="player">
                                <video onplay="onPlay(this)" ontimeupdate="timeUpdate(this)" onpause="onPause(this)"
                                       onended="onEnded(this)" data-course_id="{{ $course->id }}" data-section_id="{{ $selected_lesson->section_id }}"
                                       data-lesson_id="{{ $selected_lesson->id }}" class="video-lesson-player video_block" data-progress="{{ $lesson_progress ? $lesson_progress->total_spent_time : 0 }}"
                                       playsinline controls
                                       @if ($selected_lesson->images) data-poster="{{ getFileLink('295x248', $selected_lesson->images) }}"
                                       @elseif($course->image)
                                           data-poster="{{ getFileLink('295x248', $course->image) }}" @endif>
                                    <source src="{{ $file }}" type="video/mp4"/>
                                </video>
                            </div>
                        @elseif($selected_lesson->source == 'youtube')
                            <div class="video-lesson-player video-wrapper lesson-playlist video_block"
                                 data-course_id="{{ $course->id }}" data-section_id="{{ $selected_lesson->section_id }}"
                                 data-lesson_id="{{ $selected_lesson->id }}" id="player" data-progress="{{ $lesson_progress ? $lesson_progress->total_spent_time : 0 }}">
                                <iframe
                                    src="https://www.youtube.com/embed/{{ $selected_lesson->source_data }}?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1"
                                    allowfullscreen
                                    allowtransparency
                                    allow="autoplay"
                                    @if ($selected_lesson->images) data-poster="{{ getFileLink('295x248', $selected_lesson->images) }}"
                                    @elseif($course->image)
                                        data-poster="{{ getFileLink('295x248', $course->image) }}" @endif
                                ></iframe>
                            </div>
                        @elseif($selected_lesson->source == 'vimeo')
                            <div class="video-lesson-player video-wrapper lesson-playlist video_block"
                                 data-course_id="{{ $course->id }}" data-section_id="{{ $selected_lesson->section_id }}"
                                 data-lesson_id="{{ $selected_lesson->id }}" id="player" data-progress="{{ $lesson_progress ? $lesson_progress->total_spent_time : 0 }}">
                                <iframe
                                    src="https://player.vimeo.com/video/{{ $selected_lesson->source_data }}?loop=false&amp;byline=false&amp;portrait=false&amp;title=false&amp;speed=true&amp;transparent=0&amp;gesture=media"
                                    allowfullscreen
                                    allowtransparency
                                    allow="autoplay"
                                    @if ($selected_lesson->images) data-poster="{{ getFileLink('295x248', $selected_lesson->images) }}"
                                    @elseif($course->image)
                                        data-poster="{{ getFileLink('295x248', $course->image) }}" @endif
                                ></iframe>
                            </div>
                        @endif
                    @elseif(@$selected_lesson->lesson_type == 'audio')
                        <div class="audio-wrapper audio_block" id="audio_payer" data-progress="{{ $lesson_progress ? $lesson_progress->total_spent_time : 0 }}">
                            <div class="audio-thumb">
                                <img
                                    src="{{ $selected_lesson->images ? getFileLink('295x248', $selected_lesson->images) : getFileLink('295x248', $course->image) }}"
                                    alt="Audio Thumbnail">
                            </div>
                            <div class="audio-content">
                                <h6 class="section_title"></h6>
                                <p class="lesson_title"></p>
                                <audio onplay="onPlay(this)" ontimeupdate="timeUpdate(this)" onpause="onPause(this)"
                                       onended="onEnded(this)" data-course_id="{{ $course->id }}" data-section_id="{{ $selected_lesson->section_id }}"
                                       data-lesson_id="{{ $selected_lesson->id }}" class="audio-player" controls id="player">
                                    <source class="show_audio" src="{{ $file }}" type="audio/mp3">
                                </audio>
                            </div>
                        </div>
                    @elseif(@$selected_lesson->lesson_type == 'doc')
                        @if (str_ends_with($file, 'pdf'))
                            <iframe src="{{ $file }}" height="500" width="100%" frameborder="0"></iframe>
                        @else
                            <a href="{{ $file }}"
                               download="{{ $selected_lesson->title }}-{{ date('Y-m-d') }}.{{ substr($file, -3) }}"></a>
                        @endif
                    @endif

                    <!---- end video section -->
                    <!-- -- audio section -->
                    <!---- end audio section -->
                </div>

                <div class="col-lg-4 m-t-md-45">
                    <div class="sidebar-container">
                        <!-- <h4 class="border-bottom-soft-white-lg p-b-md-10 m-b-sm-15 m-b-25 fw-medium fz-22">Topics Lessons</h4> -->
                        <div class="education-level-tab-content tab-content" id="education-level-tabContent">
                            <div class="tab-pane fade show active" id="ssc-level" role="tabpanel"
                                 aria-labelledby="ssc-level-tab">
                                <!-- Start Education Group Tabs -->
                                <div class="education-group-tabs">
                                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active px-5" id="curriculum-tab"
                                                    data-bs-toggle="tab"
                                                    data-bs-target="#curriculum" type="button" role="tab"
                                                    aria-controls="curriculum"
                                                    aria-selected="true">{{ __('curriculum') }}
                                            </button>
                                        </li>
                                        @if(count($my_resource) > 0)
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link px-5" id="resource-tab" data-bs-toggle="tab"
                                                        data-bs-target="#resource" type="button" role="tab"
                                                        aria-controls="resource"
                                                        aria-selected="false">{{ __('resource') }}
                                                </button>
                                            </li>
                                        @endif

                                    </ul>
                                    <div class="education-group-tab-content tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="curriculum" role="tabpanel"
                                             aria-labelledby="curriculum-tab">
                                            <div class="curriculum-tab curriculum-tab-v2">
                                                <div class="accordion accordion-flush" id="curriculumAccordion">
                                                    @if (count($sections) > 0)
                                                        @foreach ($sections as $key => $section)
                                                            <div class="accordion-item">
                                                                <div class="accordion-header"
                                                                     id="course-curriculum-heading{{ $key }}">
                                                                    <div
                                                                        class="accordion-button {{ isset($selected_lesson) && $selected_lesson->section_id == $section->id ? '' : 'collapsed' }}"
                                                                        role="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#course-curriculum-collapse{{ $key }}"
                                                                        {{ isset($selected_lesson) && $selected_lesson->section_id == $section->id ? 'aria-expanded="true"' : 'aria-expanded="false"' }}
                                                                        aria-controls="course-curriculum-collapse{{ $key }}">
                                                                        {{ $section->title }}
                                                                    </div>
                                                                </div>
                                                                <div id="course-curriculum-collapse{{ $key }}"
                                                                     data-lesson="{{ $selected_lesson->section_id }}"
                                                                     data-section="{{ $section->id }}"
                                                                     class="accordion-collapse {{ isset($selected_lesson) && $selected_lesson->section_id == $section->id ? 'collapse show' : 'collapse' }}"
                                                                     aria-labelledby="course-curriculum-heading{{ $key }}"
                                                                     data-bs-parent="curriculumAccordion">
                                                                    <div class="accordion-body">
                                                                        <div class="course-playlist">
                                                                            <ul class="learning-playlist">
                                                                                @if ($section->lessons->count() > 0)
                                                                                    @foreach ($section->lessons as $k => $lesson)
                                                                                        <li class="change_video">
                                                                                            <a href="{{ route('lesson.details', ['course' => $course->slug, 'slug' => $lesson->slug]) }}">
                                                                                                <div class="icon">
                                                                                                    @if ($lesson->lesson_type == 'video')
                                                                                                        <svg width="11"
                                                                                                             height="14"
                                                                                                             viewBox="0 0 11 14"
                                                                                                             fill="none"
                                                                                                             xmlns="http://www.w3.org/2000/svg">
                                                                                                            <path
                                                                                                                fill-rule="evenodd"
                                                                                                                clip-rule="evenodd"
                                                                                                                d="M1.65082 12.6716L9.6672 7.27008C9.85301 7.14489 9.85301 6.85511 9.6672 6.72992L1.65082 1.32843C1.45213 1.19456 1.19345 1.34732 1.19345 1.59852L1.19345 12.4015C1.19345 12.6527 1.45213 12.8054 1.65082 12.6716ZM10.3032 8.35042C11.2323 7.72444 11.2323 6.27556 10.3032 5.64958L2.28685 0.248098C1.29343 -0.421275 9.38703e-07 0.342513 8.83801e-07 1.59852L4.11588e-07 12.4015C3.56687e-07 13.6575 1.29343 14.4213 2.28685 13.7519L10.3032 8.35042Z"
                                                                                                                fill="var(--color-secondary-4)"/>
                                                                                                        </svg>
                                                                                                    @elseif($lesson->lesson_type == 'audio')
                                                                                                        <svg width="12"
                                                                                                             height="16"
                                                                                                             viewBox="0 0 12 16"
                                                                                                             fill="none"
                                                                                                             xmlns="http://www.w3.org/2000/svg">
                                                                                                            <path
                                                                                                                d="M6.12969 1C5.54621 1 4.98663 1.20114 4.57405 1.55916C4.16147 1.91718 3.92969 2.40277 3.92969 2.90909V8C3.92969 8.50632 4.16147 8.99191 4.57405 9.34993C4.98663 9.70795 5.54621 9.90909 6.12969 9.90909C6.71316 9.90909 7.27274 9.70795 7.68532 9.34993C8.0979 8.99191 8.32969 8.50632 8.32969 8V2.90909C8.32969 2.40277 8.0979 1.91718 7.68532 1.55916C7.27274 1.20114 6.71316 1 6.12969 1Z"
                                                                                                                stroke="#FDCC0D"
                                                                                                                stroke-width="1.2"
                                                                                                                stroke-linecap="round"
                                                                                                                stroke-linejoin="round"/>
                                                                                                            <path
                                                                                                                d="M11.2667 6.72754V8.00027C11.2667 9.18169 10.7258 10.3147 9.76315 11.1501C8.80046 11.9855 7.49478 12.4548 6.13333 12.4548C4.77189 12.4548 3.46621 11.9855 2.50352 11.1501C1.54083 10.3147 1 9.18169 1 8.00027V6.72754"
                                                                                                                stroke="#FDCC0D"
                                                                                                                stroke-width="1.2"
                                                                                                                stroke-linecap="round"
                                                                                                                stroke-linejoin="round"/>
                                                                                                            <path
                                                                                                                d="M6.13281 12.4541V14.9996"
                                                                                                                stroke="#FDCC0D"
                                                                                                                stroke-width="1.2"
                                                                                                                stroke-linecap="round"
                                                                                                                stroke-linejoin="round"/>
                                                                                                            <path
                                                                                                                d="M3.20312 15H9.06979"
                                                                                                                stroke="#FDCC0D"
                                                                                                                stroke-width="1.2"
                                                                                                                stroke-linecap="round"
                                                                                                                stroke-linejoin="round"/>
                                                                                                        </svg>
                                                                                                    @elseif($lesson->lesson_type == 'doc')
                                                                                                        <svg width="13"
                                                                                                             height="14"
                                                                                                             viewBox="0 0 13 14"
                                                                                                             fill="none"
                                                                                                             xmlns="http://www.w3.org/2000/svg">
                                                                                                            <path
                                                                                                                fill-rule="evenodd"
                                                                                                                clip-rule="evenodd"
                                                                                                                d="M9.23848 0C11.4885 0 13 1.51391 13 3.76685V10.2331C13 12.5058 11.535 13.9838 9.26782 13.9979L3.76224 14C1.51219 14 0 12.4861 0 10.2331V3.76685C0 1.49352 1.46496 0.0161728 3.73218 0.00281266L9.23777 0H9.23848ZM9.23848 1.05475L3.73576 1.05756C2.06969 1.0674 1.07349 2.07996 1.07349 3.76685V10.2331C1.07349 11.9313 2.079 12.9453 3.76152 12.9453L9.26425 12.9431C10.9303 12.9333 11.9265 11.9193 11.9265 10.2331V3.76685C11.9265 2.06871 10.9217 1.05475 9.23848 1.05475ZM9.10043 9.47422C9.39671 9.47422 9.63718 9.71049 9.63718 10.0016C9.63718 10.2927 9.39671 10.529 9.10043 10.529H3.93335C3.63707 10.529 3.3966 10.2927 3.3966 10.0016C3.3966 9.71049 3.63707 9.47422 3.93335 9.47422H9.10043ZM9.10043 6.53043C9.39671 6.53043 9.63718 6.76669 9.63718 7.0578C9.63718 7.34891 9.39671 7.58517 9.10043 7.58517H3.93335C3.63707 7.58517 3.3966 7.34891 3.3966 7.0578C3.3966 6.76669 3.63707 6.53043 3.93335 6.53043H9.10043ZM5.90478 3.59345C6.20107 3.59345 6.44153 3.82971 6.44153 4.12082C6.44153 4.41193 6.20107 4.6482 5.90478 4.6482H3.93314C3.63685 4.6482 3.39639 4.41193 3.39639 4.12082C3.39639 3.82971 3.63685 3.59345 3.93314 3.59345H5.90478Z"
                                                                                                                fill="var(--color-secondary-4)"/>
                                                                                                        </svg>
                                                                                                    @endif
                                                                                                </div>
                                                                                                <span
                                                                                                    class="{{ $lesson->slug == request()->route()->parameter('slug') ? 'active_lesson' : '' }}">{{ $lesson->title }}</span>
                                                                                            </a>
                                                                                        </li>
                                                                                    @endforeach
                                                                                @endif
                                                                                @if ($section->quizzes->count() > 0)
                                                                                    @foreach ($section->quizzes as $k => $quiz)
                                                                                        <li>
                                                                                            <a
                                                                                                href="{{ route('my-quiz', $quiz->slug) }}">
                                                                                                <div class="icon">
                                                                                                    <svg width="16"
                                                                                                         height="16"
                                                                                                         viewBox="0 0 16 16"
                                                                                                         fill="none"
                                                                                                         xmlns="http://www.w3.org/2000/svg">
                                                                                                        <path
                                                                                                            d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15Z"
                                                                                                            stroke="#D16D86"
                                                                                                            stroke-width="1.4"
                                                                                                            stroke-linecap="round"
                                                                                                            stroke-linejoin="round"/>
                                                                                                        <path
                                                                                                            d="M5.96094 5.89923C6.12551 5.43139 6.45034 5.0369 6.87791 4.78562C7.30547 4.53434 7.80816 4.44248 8.29696 4.52633C8.78576 4.61017 9.22911 4.86429 9.54849 5.2437C9.86787 5.6231 10.0427 6.10329 10.0419 6.59923C10.0419 7.99923 7.94194 8.69923 7.94194 8.69923"
                                                                                                            stroke="#D16D86"
                                                                                                            stroke-width="1.4"
                                                                                                            stroke-linecap="round"
                                                                                                            stroke-linejoin="round"/>
                                                                                                        <path
                                                                                                            d="M8 11.5H8.007"
                                                                                                            stroke="#D16D86"
                                                                                                            stroke-width="1.4"
                                                                                                            stroke-linecap="round"
                                                                                                            stroke-linejoin="round"/>
                                                                                                    </svg>
                                                                                                </div>
                                                                                                <span>{{ $quiz->title }}</span>
                                                                                            </a>
                                                                                        </li>
                                                                                    @endforeach
                                                                                @endif
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        {{ __('No Lesson Found') . ' !' }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="resource" role="tabpanel"
                                             aria-labelledby="resource-tab">
                                            <div class="curriculum-tab curriculum-tab-v2">
                                                <div class="accordion accordion-flush" id="resourceAccordion">
                                                    @if (count($my_resource) > 0)
                                                        @foreach ($my_resource as $key => $resource)
                                                            <div class="accordion-item">
                                                                <div class="accordion-header"
                                                                     id="resource-curriculum-heading{{ $key }}">
                                                                    <div class="accordion-button" role="button"
                                                                         data-bs-toggle="collapse"
                                                                         data-bs-target="#resource-curriculum-collapse{{ $key }}"
                                                                         aria-expanded="true"
                                                                         aria-controls="resource-curriculum-collapse{{ $key }}">
                                                                        {{ $resource->title }}
                                                                    </div>
                                                                </div>
                                                                <div id="resource-curriculum-collapse{{ $key }}"
                                                                     class="accordion-collapse {{ isset($resource) && $resource->id == $key ? 'collapse show' : 'collapse' }} "
                                                                     aria-labelledby="course-curriculum-headingOne"
                                                                     data-bs-parent="curriculumAccordion">
                                                                    <div class="accordion-body">
                                                                        <div
                                                                            class="bg-white redious-border p-20 rounded-10">
                                                                            <div
                                                                                class="resources-content d-flex align-items-start align-items-sm-center flex-column flex-sm-row gap-20">
                                                                                <div
                                                                                    class="resources-icon redious-border redious-border-5 p-20 mr-1">
                                                                                    <svg width="40" height="40"
                                                                                         viewBox="0 0 40 40" fill="none"
                                                                                         xmlns="http://www.w3.org/2000/svg">
                                                                                        <g id="document 1">
                                                                                            <g id="Group">
                                                                                                <g id="Group_2">
                                                                                                    <path id="Vector"
                                                                                                          d="M13.3359 28.666H12.0026C11.6344 28.666 11.3359 28.9645 11.3359 29.3327C11.3359 29.7008 11.6344 29.9993 12.0026 29.9993H13.3359C13.7041 29.9993 14.0026 29.7008 14.0026 29.3327C14.0026 28.9645 13.7041 28.666 13.3359 28.666Z"
                                                                                                          fill="#556068">
                                                                                                    </path>
                                                                                                </g>
                                                                                            </g>
                                                                                            <g id="Group_3">
                                                                                                <g id="Group_4">
                                                                                                    <path id="Vector_2"
                                                                                                          d="M32.0026 28.666H16.0026C15.6344 28.666 15.3359 28.9645 15.3359 29.3327C15.3359 29.7008 15.6344 29.9993 16.0026 29.9993H32.0026C32.3708 29.9993 32.6693 29.7008 32.6693 29.3327C32.6693 28.9645 32.3708 28.666 32.0026 28.666Z"
                                                                                                          fill="#556068">
                                                                                                    </path>
                                                                                                </g>
                                                                                            </g>
                                                                                            <g id="Group_5">
                                                                                                <g id="Group_6">
                                                                                                    <path id="Vector_3"
                                                                                                          d="M13.3359 24.666H12.0026C11.6344 24.666 11.3359 24.9645 11.3359 25.3327C11.3359 25.7008 11.6344 25.9993 12.0026 25.9993H13.3359C13.7041 25.9993 14.0026 25.7008 14.0026 25.3327C14.0026 24.9645 13.7041 24.666 13.3359 24.666Z"
                                                                                                          fill="#556068">
                                                                                                    </path>
                                                                                                </g>
                                                                                            </g>
                                                                                            <g id="Group_7">
                                                                                                <g id="Group_8">
                                                                                                    <path id="Vector_4"
                                                                                                          d="M32.0026 24.666H16.0026C15.6344 24.666 15.3359 24.9645 15.3359 25.3327C15.3359 25.7008 15.6344 25.9993 16.0026 25.9993H32.0026C32.3708 25.9993 32.6693 25.7008 32.6693 25.3327C32.6693 24.9645 32.3708 24.666 32.0026 24.666Z"
                                                                                                          fill="#556068">
                                                                                                    </path>
                                                                                                </g>
                                                                                            </g>
                                                                                            <g id="Group_9">
                                                                                                <g id="Group_10">
                                                                                                    <path id="Vector_5"
                                                                                                          d="M13.3359 20.666H12.0026C11.6344 20.666 11.3359 20.9645 11.3359 21.3327C11.3359 21.7008 11.6344 21.9993 12.0026 21.9993H13.3359C13.7041 21.9993 14.0026 21.7008 14.0026 21.3327C14.0026 20.9645 13.7041 20.666 13.3359 20.666Z"
                                                                                                          fill="#556068">
                                                                                                    </path>
                                                                                                </g>
                                                                                            </g>
                                                                                            <g id="Group_11">
                                                                                                <g id="Group_12">
                                                                                                    <path id="Vector_6"
                                                                                                          d="M32.0026 20.666H16.0026C15.6344 20.666 15.3359 20.9645 15.3359 21.3327C15.3359 21.7008 15.6344 21.9993 16.0026 21.9993H32.0026C32.3708 21.9993 32.6693 21.7008 32.6693 21.3327C32.6693 20.9645 32.3708 20.666 32.0026 20.666Z"
                                                                                                          fill="#556068">
                                                                                                    </path>
                                                                                                </g>
                                                                                            </g>
                                                                                            <g id="Group_13">
                                                                                                <g id="Group_14">
                                                                                                    <path id="Vector_7"
                                                                                                          d="M13.3359 16.666H12.0026C11.6344 16.666 11.3359 16.9645 11.3359 17.3327C11.3359 17.7008 11.6344 17.9993 12.0026 17.9993H13.3359C13.7041 17.9993 14.0026 17.7008 14.0026 17.3327C14.0026 16.9645 13.7041 16.666 13.3359 16.666Z"
                                                                                                          fill="#556068">
                                                                                                    </path>
                                                                                                </g>
                                                                                            </g>
                                                                                            <g id="Group_15">
                                                                                                <g id="Group_16">
                                                                                                    <path id="Vector_8"
                                                                                                          d="M32.0026 16.666H16.0026C15.6344 16.666 15.3359 16.9645 15.3359 17.3327C15.3359 17.7008 15.6344 17.9993 16.0026 17.9993H32.0026C32.3708 17.9993 32.6693 17.7008 32.6693 17.3327C32.6693 16.9645 32.3708 16.666 32.0026 16.666Z"
                                                                                                          fill="#556068">
                                                                                                    </path>
                                                                                                </g>
                                                                                            </g>
                                                                                            <g id="Group_17">
                                                                                                <g id="Group_18">
                                                                                                    <path id="Vector_9"
                                                                                                          d="M13.3359 12.666H12.0026C11.6344 12.666 11.3359 12.9645 11.3359 13.3327C11.3359 13.7008 11.6344 13.9993 12.0026 13.9993H13.3359C13.7041 13.9993 14.0026 13.7008 14.0026 13.3327C14.0026 12.9645 13.7041 12.666 13.3359 12.666Z"
                                                                                                          fill="#556068">
                                                                                                    </path>
                                                                                                </g>
                                                                                            </g>
                                                                                            <g id="Group_19">
                                                                                                <g id="Group_20">
                                                                                                    <path id="Vector_10"
                                                                                                          d="M32.0026 12.666H16.0026C15.6344 12.666 15.3359 12.9645 15.3359 13.3327C15.3359 13.7008 15.6344 13.9993 16.0026 13.9993H32.0026C32.3708 13.9993 32.6693 13.7008 32.6693 13.3327C32.6693 12.9645 32.3708 12.666 32.0026 12.666Z"
                                                                                                          fill="#556068">
                                                                                                    </path>
                                                                                                </g>
                                                                                            </g>
                                                                                            <g id="Group_21">
                                                                                                <g id="Group_22">
                                                                                                    <path id="Vector_11"
                                                                                                          d="M36.6606 9.958C36.6573 9.89958 36.6459 9.84192 36.6266 9.78667C36.6193 9.76533 36.6139 9.74467 36.6046 9.724C36.5722 9.6515 36.527 9.58533 36.4713 9.52867L27.1379 0.195333C27.0813 0.139583 27.0151 0.0944167 26.9426 0.062C26.9219 0.0526667 26.9013 0.0473333 26.8806 0.04C26.8249 0.0208333 26.7668 0.00916667 26.7079 0.00533333C26.6966 0.00733333 26.6839 0 26.6693 0H8.0026C7.63444 0 7.33594 0.2985 7.33594 0.666667V2.66667H4.0026C3.63444 2.66667 3.33594 2.96517 3.33594 3.33333V39.3333C3.33594 39.7015 3.63444 40 4.0026 40H32.0026C32.3708 40 32.6693 39.7015 32.6693 39.3333V36H36.0026C36.3708 36 36.6693 35.7015 36.6693 35.3333V10C36.6693 9.98533 36.6619 9.97267 36.6606 9.958ZM27.3359 2.276L34.3933 9.33333H27.3359V2.276ZM31.3359 38.6667H4.66927V4H7.33594V35.3333C7.33594 35.7015 7.63444 36 8.0026 36H31.3359V38.6667ZM35.3359 34.6667H8.66927V1.33333H26.0026V10C26.0026 10.3682 26.3011 10.6667 26.6693 10.6667H35.3359V34.6667Z"
                                                                                                          fill="#556068">
                                                                                                    </path>
                                                                                                </g>
                                                                                            </g>
                                                                                            <g id="Group_23">
                                                                                                <g id="Group_24">
                                                                                                    <path id="Vector_12"
                                                                                                          d="M16.0026 6H12.0026C11.6344 6 11.3359 6.2985 11.3359 6.66667V10.6667C11.3359 11.0348 11.6344 11.3333 12.0026 11.3333H16.0026C16.3708 11.3333 16.6693 11.0348 16.6693 10.6667V6.66667C16.6693 6.2985 16.3708 6 16.0026 6ZM15.3359 10H12.6693V7.33333H15.3359V10Z"
                                                                                                          fill="#556068">
                                                                                                    </path>
                                                                                                </g>
                                                                                            </g>
                                                                                        </g>
                                                                                    </svg>
                                                                                </div>&nbsp; &nbsp;

                                                                                <div
                                                                                    class="resources-text-content mt-1">
                                                                                    <p class="ml-3 mt-2 pt-2">
                                                                                        {{ ltrim($resource->source, 'files/') }}
                                                                                    </p>
                                                                                    <a href="{{ route('download.resource', $resource->id) }}"
                                                                                       class="template-btn mt-2"
                                                                                       style="padding:10px 12px;line-height: 1;font-size: 12px; float:right;">
                                                                                        {{ __('download') }} <i
                                                                                            class="fas fa-download"></i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Education Group Tabs -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Course Video Section ======-->
@endsection
@push('js')
    <script>
        let start_time = 0;
        let total_duration = 0;
        let is_playing = false;
        let total_watched_time = 0;

        const videoElement = document.getElementById('player').querySelector('video');

        if(videoElement)
        {
            videoElement.currentTime = $('.video_block').data('progress');
        }
        const audioElement = document.getElementById('audio_payer').querySelector('audio');

        if(audioElement)
        {
            audioElement.currentTime = $('.audio_block').data('progress');
        }

        const onPlay = (target) => {
            is_playing = true;
            start_time = new Date().getTime();
            saveProgress(target);
        }
        const onLoad = (target) => {
            alert('loaded');
        }

        const onPause = (target) => {
            if (is_playing) {
                is_playing = false;
                let current_time = new Date().getTime();
                let elapsed_seconds = (current_time - start_time) / 1000;
                total_watched_time += elapsed_seconds;
            }
            saveProgress(target);
        }

        const onEnded = (target) => {
            if (is_playing) {
                is_playing = false;
                let current_time = new Date().getTime();
                let elapsed_seconds = (current_time - start_time) / 1000;
                total_watched_time += elapsed_seconds;
            }
            saveProgress(target);
        }

        const timeUpdate = (target) => {
            total_duration = target.duration;
        }

        const saveProgress = (target) => {

            var dataset = {
                course_id: $(target).data('course_id'),
                section_id: $(target).data('section_id'),
                lesson_id: $(target).data('lesson_id'),
                total_spent_time: total_watched_time,
                total_duration: total_duration
            }

            $.ajax({
                url: "{{ route('save-progress') }}",
                type: "POST",
                data: dataset,
                success: function (response) {
                },
                error: function (error) {
                    console.log(error.responseText)
                }

            });
        }

        $(document).ready(function () {
            var player = new Plyr('#player');

            player.on('play', function () {
                // saveProgress($('#player'));
                is_playing = true;
                start_time = new Date().getTime();
            });
            player.on('ended', function () {
                if (is_playing) {
                    is_playing = false;
                    let current_time = new Date().getTime();
                    let elapsed_seconds = (current_time - start_time) / 1000;
                    total_watched_time += elapsed_seconds;
                }
                saveProgress($('#player'));
            });
            player.on('pause', function () {
                if (is_playing) {
                    is_playing = false;
                    let current_time = new Date().getTime();
                    let elapsed_seconds = (current_time - start_time) / 1000;
                    total_watched_time += elapsed_seconds;
                }
                saveProgress($('#player'));
            });

            player.on('timeupdate', function (time) {
                total_duration = time.detail.plyr.duration;
            });
            player.on('ready', function (time) {
                time.detail.plyr.currentTime = $('#player').data('progress');
            });
        });
    </script>
@endpush
