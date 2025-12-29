@extends('backend.layouts.master')
@section('title', __('edit_course'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="section-title">{{ __('edit_course') }}</h3>
                @php
                    $step_1_error = false;
                    $step_2_error = false;
                    $step_3_error = false;
                    $step_6_error = false;
                    $step_1_errors = ['title', 'category_id', 'subject_id', 'organization_id', 'language_id', 'level_id', 'instructor_ids', 'duration', 'capacity', 'start_date'];
                    $step_3_errors = ['price', 'discount_type', 'discount', 'discount_period', 'renew_after'];
                    $step_6_errors = ['LiveClassmeetingMethod', 'liveClassDescription', 'LiveClassmeetingLink', 'LiveClassmeetingPassword', 'LiveClassMeetingID'];

                    foreach ($step_1_errors as $step1) {
                        if ($errors->has($step1)) {
                            $step_1_error = true;
                            $request_tab = 'basic';
                            break;
                        }
                    }

                    if ($errors->has('video')) {
                        $step_2_error = true;
                    }

                    foreach ($step_3_errors as $step3) {
                        if ($errors->has($step3)) {
                            $step_3_error = true;
                            if(!$step_1_error)
                                $request_tab = 'pricing';
                            break;
                        }
                    }
                    foreach ($step_6_errors as $step6) {
                        if ($errors->has($step6)) {
                            $step_6_error = true;
                            if(!$step_1_error && !$step_3_error)
                                $request_tab = 'LiveClass';
                            break;
                        }
                    }
                @endphp
                <div class="default-tab-list bg-white redious-border p-20 p-sm-30">
                    <ul class="nav justify-content-center pb-40 mb-0" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link tab_change {{ $request_tab == 'basic' ? 'active ' : '' }}{{ $step_1_error ? 'text-danger' : '' }}"
                               data-tab="basic" id="basicInformation" data-bs-toggle="pill"
                               data-bs-target="#basicCourseInformation" role="tab"
                               aria-controls="basicCourseInformation" aria-selected="true">
                                <span
                                    class="default-tab-count {{ $step_1_error ? 'bg-danger text-white' : '' }}">1</span>{{ __('basic_information') }}
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link tab_change {{ $request_tab == 'mediaImages' ? 'active' : '' }}"
                               data-tab="mediaImages" id="mediaImages" data-bs-toggle="pill"
                               data-bs-target="#courseMediaImages" role="tab" aria-controls="courseMediaImages"
                               aria-selected="false">
                                <span
                                    class="default-tab-count {{ $step_2_error  ? 'bg-danger text-white' : '' }}">2</span>{{ __('media_images') }}
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link tab_change {{ $request_tab == 'pricing' ? 'active ' : '' }} {{ $step_3_error ? 'text-danger' : '' }}"
                               data-tab="pricing" id="pricing" data-bs-toggle="pill" data-bs-target="#coursePricing"
                               role="tab" aria-controls="coursePricing" aria-selected="false">
                                <span
                                    class="default-tab-count {{ $step_3_error  ? 'bg-danger text-white' : '' }}">3</span>{{ __('pricing') }}
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link tab_change {{ $request_tab == 'seo' ? 'active' : '' }} {{ $step_1_error || $step_2_error || $step_3_error }}"
                               data-tab="seo" id="seo" data-bs-toggle="pill" data-bs-target="#courseSEO"
                               role="tab" aria-controls="courseSEO" aria-selected="false">
                                <span class="default-tab-count">4</span>{{ __('seo') }}</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link tab_change {{ $step_1_error || $step_2_error || $step_3_error }} {{ $request_tab == 'curriculum' ? 'active' : '' }}"
                               data-tab="curriculum" id="curriculum" data-bs-toggle="pill"
                               data-bs-target="#courseCurriculum" role="tab" aria-controls="courseCurriculum"
                               aria-selected="false"><span class="default-tab-count ">5</span> {{ __('curriculum') }}
                            </a>
                        </li>
                        <li class="nav-item {{ $course->course_type == 'live_class' ? '' : 'd-none' }}"
                            id="notLiveClass"
                            role="presentation">
                            <a class="nav-link tab_change {{ $step_6_error ? 'text-danger ' : '' }} {{ $request_tab == 'LiveClass' ? 'active' : '' }}"
                               data-tab="live_class" id="live_class" data-bs-toggle="pill"
                               data-bs-target="#courseLiveClass" role="tab" aria-controls="courseLiveClass"
                               aria-selected="false"><span class="default-tab-count {{ $step_6_error ? 'bg-danger text-white' : '' }}">6</span> {{ __('Live Class') }}
                            </a>
                        </li>


                        <li class="nav-item" role="presentation">
                            <a class="nav-link tab_change {{ $step_1_error || $step_2_error || $step_3_error }} {{ $request_tab == 'assignment' ? 'active' : '' }}"
                               data-tab="assignment" id="assignment" data-bs-toggle="pill"
                               data-bs-target="#courseAssignment" role="tab" aria-controls="courseAssignment"
                               aria-selected="false">
                                <span class="default-tab-count courseAssignmentIndex">
                                    @if ($course->course_type == 'live_class')
                                        {{ 7 }}
                                    @else
                                        {{ 6 }}
                                    @endif
                                </span>
                                {{-- <span class="default-tab-count num_live">6 </span> --}}

                                {{ __('assignment') }}
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link tab_change {{ $step_1_error || $step_2_error || $step_3_error }} {{ $request_tab == 'resource' ? 'active' : '' }}"
                               data-tab="resource" id="resource" data-bs-toggle="pill" data-bs-target="#courseResource"
                               role="tab" aria-controls="courseResource" aria-selected="false">
                                {{-- <span class="default-tab-count order">8 </span>
                                <span class="default-tab-count num_live">6</span> --}}
                                <span class="default-tab-count courseresourceIndex">
                                    @if ($course->course_type == 'live_class')
                                        {{ 8 }}
                                    @else
                                        {{ 7 }}
                                    @endif
                                </span>
                                {{ __('resource') }}
                            </a>
                        </li>
                        <li class="nav-item " role="presentation">
                            <a class="nav-link tab_change {{ $step_1_error || $step_2_error || $step_3_error }} {{ $request_tab == 'faq' ? 'active' : '' }}"
                               data-tab="faq" id="faq" data-bs-toggle="pill" data-bs-target="#courseFAQ"
                               role="tab" aria-controls="courseFAQ" aria-selected="false">
                                <span class="default-tab-count coursefaqIndex">
                                    @if ($course->course_type == 'live_class')
                                        {{ 9 }}
                                    @else
                                        {{ 8 }}
                                    @endif
                                </span>
                                {{-- <span class="default-tab-count num_live">8</span> --}}
                                {{ __('faq') }}
                            </a>
                        </li>
                    </ul>
                    <!-- End Edit Course tab menu -->

                    <form action="{{ route('courses.update', $course->id) }}" method="POST"
                          enctype="multipart/form-data">@csrf
                        @method('PUT')
                        <div class="tab-content" id="mgCourse-tabContent">
                            <div
                                class="tab-pane fade {{ $request_tab == 'basic' ? 'show active' : '' }} {{ $step_1_error ? 'show active' : '' }}"
                                id="basicCourseInformation" role="tabpanel" aria-labelledby="basicInformation"
                                tabindex="0">
                                <div class="row gx-20">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <label for="courseTitle" class="form-label">{{ __('course_title') }}</label>
                                            <input type="text" value="{{ old('title', $course->title) }}"
                                                   class="form-control rounded-2 ai_content_name" id="courseTitle"
                                                   name="title" placeholder="{{ __('enter_course_title') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('title') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Course Title -->

                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="select_category"
                                                       class="form-label">{{ __('select_category') }}</label>
                                                <select id="select_category" name="category_id"
                                                        data-route="{{ route('ajax.categories') }}"
                                                        placeholder="{{ __('select_category') }}"
                                                        class="form-select-lg rounded-0 mb-3"
                                                        aria-label=".form-select-lg example">
                                                    @if ($category)
                                                        <option value="{{ $category->id }}" selected>
                                                            {{ $category->title }}</option>
                                                    @endif
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('category_id') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Course Category -->

                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="courseType"
                                                       class="form-label">{{ __('course_type') }}</label>
                                                <select id="courseType" name="course_type"
                                                        class="form-select form-select-lg mb-3 without_search selectcourse"
                                                        aria-label=".form-select-lg">

                                                    <option value="course"
                                                        {{ old('course_type', $course->course_type) == 'course' ? 'selected' : '' }}>
                                                        {{ __('course') }}</option>
                                                    <option value="live_class"
                                                        {{ old('course_type', $course->course_type) == 'live_class' ? 'selected' : '' }}>
                                                        {{ __('live_class') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Course Type -->

                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="language_id" class="form-label">{{ __('language') }}</label>
                                                <select id="language_id"
                                                        class="form-select form-select-lg mb-3 with_search"
                                                        name="language_id">
                                                    <option value="">{{ __('select_language') }}</option>
                                                    @foreach ($languages as $language)
                                                        <option value="{{ $language->id }}"
                                                            {{ old('language_id', $course->language_id) == $language->id ? 'selected' : '' }}>
                                                            {{ $language->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('language_id') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Language -->

                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="select_subject"
                                                       class="form-label">{{ __('select_subject') }}</label>
                                                <select id="select_subject" name="subject_id"
                                                        placeholder="{{ __('select_subject') }}"
                                                        data-route="{{ route('ajax.subjects') }}"
                                                        class="form-select-lg rounded-0 mb-3"
                                                        aria-label=".form-select-lg example">
                                                    @if ($subject)
                                                        <option value="{{ $subject->id }}"
                                                                @if ($subject->id == $course->subject_id) selected @endif>
                                                            {{ $subject->title }}</option>
                                                    @endif
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('subject_id') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Subject -->

                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="courseLevel"
                                                       class="form-label">{{ __('course_level') }}</label>
                                                <select id="courseLevel"
                                                        class="form-select form-select-lg mb-3 with_search"
                                                        name="level_id"
                                                        aria-label=".form-select-lg">
                                                    <option value="">{{ __('select_level') }}</option>
                                                    @foreach ($levels as $level)
                                                        <option value="{{ $level->id }}"
                                                            {{ old('level_id', $course->level_id) == $level->id ? 'selected' : '' }}>
                                                            {{ $level->title }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('level_id') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Level -->

                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="ins_by_org"
                                                       class="form-label">{{ __('select_organization') }}</label>
                                                <select id="ins_by_org" name="organization_id"
                                                        data-route="{{ route('ajax.organizations') }}"
                                                        class="form-select-lg rounded-0 mb-3 with_search"
                                                        aria-label=".form-select-lg example"
                                                        data-url="{{ route('ajax.instructors') }}">
                                                    <option value="">{{ __('select_organization') }}</option>
                                                    @if ($organization)
                                                        <option value="{{ $organization->id }}" selected>
                                                            {{ $organization->org_name }}</option>
                                                    @endif
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('organization_id') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Organisation -->

                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="instructor_ids"
                                                       class="form-label">{{ __('instructor') }}</label>
                                                <select id="instructor_ids" name="instructor_ids[]" multiple
                                                        class="form-select form-select-lg mb-3 without_search"
                                                        aria-label=".form-select-lg">
                                                    @foreach ($instructors as $instructor)
                                                        <option value="{{ $instructor->id }}"
                                                            {{ old('instructor_ids', $course->instructor_ids) && in_array($instructor->id, old('instructor_ids', $course->instructor_ids)) ? 'selected' : '' }}>
                                                            {{ $instructor->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('instructor_ids') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Instructor -->

                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <label for="courseDuration"
                                                   class="form-label">{{ __('course_duration') }}</label>
                                            <input type="text" class="form-control rounded-2" id="courseDuration"
                                                   name="duration" placeholder="{{ __('72_hours') }}"
                                                   value="{{ old('duration', $course->duration) }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('duration') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Course Duration -->

                                    <div class="col-lg-6 col-md-6">
                                        <div class="multi-select-v2 mb-4">
                                            <label for="tag" class="form-label">{{ __('course_tag') }}</label>
                                            <select id="tag" multiple
                                                    class="form-select form-select-lg mb-3 with_search" name="tags[]"
                                                    aria-label=".form-select-lg" placeholder="{{ __('select_tags') }}">
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->id }}"
                                                        {{ old('tags', $course->tags) && in_array($tag->id, old('tags', $course->tags)) ? 'selected' : '' }}>
                                                        {{ $tag->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- End Course Tag -->

                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <div class="d-flex justify-content-between">
                                                <label for="shortDescription"
                                                       class="form-label">{{ __('short_description') }}</label>
                                                @include('backend.common.ai_btn', [
                                                    'name' => 'ai_short_description',
                                                    'length' => '200',
                                                    'topic' => 'ai_content_name',
                                                    'use_case' => 'short description for course',
                                                ])
                                            </div>
                                            <textarea class="form-control" name="short_description"
                                                      id="shortDescription"
                                                      placeholder="{{ __('enter_short_description') }}">{{ old('short_description', $course->short_description) }}</textarea>
                                        </div>
                                    </div>
                                    <!-- End Short Description -->

                                    <div class="col-lg-12">
                                        <div class="editor-wrapper">
                                            <div class="d-flex justify-content-between">
                                                <label class="form-label mb-1">{{ __('description') }}</label>
                                                @include('backend.common.ai_btn', [
                                                    'name' => 'ai_description',
                                                    'length' => '259',
                                                    'topic' => 'ai_content_name',
                                                    'use_case' => 'long description  for course',
                                                    'long_description' => 1,
                                                ])
                                            </div>
                                            <textarea id="product-update-editor"
                                                      name="description">{!! old('description', $course->description) !!}</textarea>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="custom-checkbox mt-12 col-6">
                                                <label>
                                                    <input type="checkbox" value="1" name="is_private"
                                                        {{ old('is_private', $course->is_private) == 1 ? 'checked' : '' }}>
                                                    <span>{{ __('private_course') }}</span>
                                                </label>
                                            </div>
                                            <div class="col-6 d-flex align-items-center">
                                                <label class="col-6 text-end px-4" for="course_status">Change
                                                    Status</label>
                                                <div class="col-6">
                                                    <select name="status" id="course_status"
                                                            class="form-control form-select form-select-lg mb-3 without_search">
                                                        <option
                                                            {{ $course->status == 'draft' ? 'selected' : '' }}
                                                            value="draft">Draft
                                                        </option>
                                                        <option
                                                            {{ $course->status == 'in_review' ? 'selected' : '' }}
                                                            value="in_review">In
                                                            Review
                                                        </option>
                                                        <option
                                                            {{ $course->status == 'rejected' ? 'selected' : '' }}
                                                            value="rejected">Rejected
                                                        </option>
                                                        <option
                                                            {{ $course->status == 'approved' ? 'selected' : '' }}
                                                            value="approved">Approved
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Description -->

                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-end align-items-center mt-30">
                                            <a href="#" type="button" class="btn sg-btn-primary btn_action"
                                               data-bs-toggle="tab"
                                               data-bs-target="#mediaImages">{{ __('next') }}</a>
                                        </div>
                                    </div>
                                    <!-- End Next Page BTN -->
                                </div>
                            </div>
                            <!-- End Basic Course Information -->

                            <div
                                class="tab-pane fade {{ $request_tab == 'mediaImages' ? 'show active' : '' }} {{ $step_1_error || $step_2_error }}"
                                id="courseMediaImages" role="tabpanel" aria-labelledby="mediaImages" tabindex="0">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="video_source"
                                                       class="form-label">{{ __('video_source') }}</label>
                                                <select id="video_source"
                                                        class="form-select form-select-lg mb-3 without_search"
                                                        name="video_source">
                                                    <option value="">{{ __('select_video_source') }}</option>
                                                    <option value="upload"
                                                        {{ old('video_source', $course->video_source) == 'upload' ? 'selected' : '' }}>
                                                        {{ __('upload') }}</option>

                                                    <option value="youtube"
                                                        {{ old('video_source', $course->video_source) == 'youtube' ? 'selected' : '' }}>
                                                        {{ __('youtube') }}</option>

                                                    <option value="vimeo"
                                                        {{ old('video_source', $course->video_source) == 'vimeo' ? 'selected' : '' }}>
                                                        {{ __('vimeo') }}</option>
                                                    <option value="mp4"
                                                        {{ old('video_source', $course->video_source) == 'mp4' ? 'selected' : '' }}>
                                                        {{ __('mp4') }}</option>
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('video_source') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Video Source -->
                                    <div
                                        class="col-lg-6 col-md-6 upload_div {{ old('video_source', $course->video_source) == 'upload' ? '' : 'd-none' }}">
                                        <div class="mb-3">
                                            <label for="thumbnailFile"
                                                   class="form-label">{{ __('upload_video') }}</label>
                                            <label for="thumbnailFile" class="file-upload-text">
                                                <p class="file_name">
                                                    {{ getFileName(getArrayValue('image', $course->video)) }}</p>
                                                <span class="file-btn">{{ __('choose_file') }}</span>
                                            </label>
                                            <input class="d-none thumb_picker" name="video" type="file"
                                                   id="thumbnailFile">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('video_file') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- End Upload Video -->
                                    <div
                                        class="col-lg-6 col-md-6 video_link {{ old('video_source', $course->video_source) && old('video_source', $course->video_source) != 'upload' ? '' : 'd-none' }}">
                                        <div class="mb-4">
                                            <label for="videoLink" class="form-label">{{ __('video_link') }}</label>
                                            <input type="text" class="form-control rounded-2" name="video_link"
                                                   id="videoLink" placeholder="{{ __('enter_video_link') }}"
                                                   value="{{ $course->video_source == 'upload' ? getFileName(getArrayValue('image', $course->video)) : $course->video }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('video') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    @include('backend.common.media-input', [
                                        'title' => 'Slider Image',
                                        'name' => 'image_media_id',
                                        'col' => 'col-12',
                                        'size' => '(402x248)',
                                        'image' => old('image_media_id', $course->image_media_id),
                                        'label' => __('thumbnail'),
                                        'edit' => $course,
                                        'image_object' => $course->image,
                                        'media_id' => $course->image_media_id,
                                    ])
                                    <div class="col-lg-6 col-md-6">
                                        <div class="custom-checkbox mt-20">
                                            <label>
                                                <input type="checkbox" value="1"
                                                    {{ old('is_downloadable', $course->is_downloadable) == 1 ? 'checked' : '' }}>
                                                <span class="">{{ __('downloadable') }}</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mt-30">
                                            <a href="#" type="button"
                                               class="btn sg-btn-outline-primary btn_action" data-bs-toggle="tab"
                                               data-bs-target="#basicInformation">{{ __('back') }}</a>

                                            <a href="#" type="button" class="btn sg-btn-primary btn_action"
                                               data-bs-toggle="tab" data-bs-target="#pricing">{{ __('next') }}</a>
                                        </div>
                                    </div>
                                    <!-- End Next Page BTN -->
                                </div>
                            </div>
                            <!-- End Course Media Images -->

                            <div
                                class="tab-pane fade {{ $request_tab == 'pricing' ? 'show active' : '' }} {{ $step_3_error && (!$step_1_error || !$step_2_error || !session()->has('faq')) ? 'show active' : '' }}"
                                id="coursePricing" role="tabpanel" aria-labelledby="pricing" tabindex="0">
                                <div class="row gx-20">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="price-checkbox d-flex gap-12 mb-4">
                                            <label for="is_free">{{ __('free_course') }}</label>
                                            <div class="setting-check">
                                                <input type="checkbox" id="is_free" name="is_free" value="1"
                                                    {{ old('is_free', $course->is_free) == 1 ? 'checked' : '' }}>
                                                <label for="is_free"></label>
                                            </div>
                                        </div>
                                        <div
                                            class="price-checkbox d-flex gap-12 mb-4 not_free_div {{ old('is_free', $course->is_free) == 1 ? 'd-none' : '' }}">
                                            <label for="discountable_course">{{ __('discountable_course') }}</label>
                                            <div class="setting-check">
                                                <input type="checkbox" id="discountable_course" name="is_discountable"
                                                       value="1"
                                                    {{ old('is_discountable', $course->is_discountable) == 1 ? 'checked' : '' }}>
                                                <label for="discountable_course"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6"></div>
                                    <!-- End Price Checkbox -->

                                    <div
                                        class="col-lg-6 col-md-6 not_free_div {{ old('is_free', $course->is_free) == 1 ? 'd-none' : '' }}">
                                        <div class="mb-4">
                                            <label for="coursePrice" class="form-label">{{ __('course_price') }}</label>
                                            <input type="number" class="form-control rounded-2" id="coursePrice"
                                                   name="price" value="{{ old('price', priceFormatUpdate($course->price,setting('default_currency'),$type="*")) }}"
                                                   placeholder="{{ __('enter_course_price') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('price') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Course Price -->

                                    <div
                                        class="col-lg-6 col-md-6 discountable_div {{ old('is_discountable', $course->is_discountable) == 1 ? '' : 'd-none' }}">
                                        <div class="">
                                            <label for="discountType" class="form-label">{{ __('discount') }}</label>

                                            <div class="customDiscountField">
                                                <input type="text" class="form-control rounded-2" placeholder="e.g.20"
                                                       id="discountType" name="discount"
                                                       value="{{ old('discount', $course->discount) }}">

                                                <div class="select-type-v2 selectField">
                                                    <select class="form-select form-select-lg mb-3 without_search"
                                                            name="discount_type">
                                                        <option value="">{{ __('select_discount_type') }}</option>
                                                        <option value="percent"
                                                            {{ old('discount_type', $course->discount_type) == 'percent' ? 'selected' : 'd-none' }}>
                                                            {{ __('percent') }}</option>
                                                        <option value="amount"
                                                            {{ old('discount_type', $course->discount_type) == 'amount' ? 'selected' : 'd-none' }}>
                                                            {{ __('amount') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('discount') }}</p>
                                            </div>
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('discount_type') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Discount Type -->

                                    <div
                                        class="col-lg-6 col-md-6 discountable_div {{ old('is_discountable', $course->is_discountable) == 1 ? '' : 'd-none' }}">
                                        <div class="mb-20">
                                            <label for="dateRangePicker"
                                                   class="form-label">{{ __('discount_period') }}</label>
                                            <input id="dateRangePicker" name="discount_period" type="text"
                                                   class="form-control rounded-2" value="{{ old('discount_period') }}"
                                                   placeholder="{{ __('select_date') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="dateRange_error error">{{ $errors->first('price') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Date Range Picker -->


                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mt-30">
                                            <a href="#" type="button"
                                               class="btn sg-btn-outline-primary btn_action" data-bs-toggle="tab"
                                               data-bs-target="#mediaImages">{{ __('back') }}</a>

                                            <a href="#" type="button" class="btn sg-btn-primary btn_action"
                                               data-bs-toggle="tab" data-bs-target="#seo">{{ __('next') }}</a>
                                        </div>
                                    </div>
                                    <!-- End Next Page BTN -->
                                </div>
                                <!-- End Product images section -->
                            </div>
                            <!-- End Course Pricing -->

                            <div
                                class="tab-pane fade tab-pane fade {{ $request_tab == 'seo' ? 'show active' : '' }} {{ $step_1_error || $step_2_error || $step_3_error }}"
                                id="courseSEO" role="tabpanel" aria-labelledby="seo" tabindex="0">
                                <div class="row gx-20">
                                    @include('components.meta-fields', [
                                        'meta_title_class' => 'col-lg-6 col-md-6',
                                        'meta_description_class' => 'col-lg-12',
                                        'meta_keywords_class' => 'col-lg-6',
                                        'meta_image_class' => 'col-lg-12',
                                        'meta_title' => old('meta_title', $course->meta_title),
                                        'meta_keywords' => old('meta_keywords', $course->meta_keywords),
                                        'meta_description' => old('meta_description', $course->meta_description),
                                        'meta_image' => $course->meta_image,
                                        'edit' => $course,
                                    ])
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mt-30">
                                            <a href="#" class="btn sg-btn-outline-primary btn_action"
                                               data-bs-toggle="tab" data-bs-target="#pricing">{{ __('back') }}</a>
                                            {{-- <button type="submit" class="btn sg-btn-primary">{{ __('next') }}</button> --}}
                                            <a href="#" type="button" class="btn sg-btn-primary btn_action"
                                               data-bs-toggle="tab"
                                               data-bs-target="#curriculum">{{ __('next') }}</a>
                                        </div>
                                    </div>
                                    <!-- End Next Page BTN -->
                                </div>
                            </div>

                            <!-- start Curriculum Tab -->
                            <div
                                class="tab-pane fade {{ $step_3_error || $step_1_error || $step_2_error }} {{ $request_tab == 'curriculum' ? 'show active' : '' }}"
                                id="courseCurriculum" role="tabpanel" aria-labelledby="curriculum" tabindex="0">
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mb-20">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#section"
                                                    class="btn sg-btn-primary add_modal">{{ __('add_module') }} <i
                                                    class="las la-plus"></i></button>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="accordion editCourseCurriculum" id="editCourse">
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($sections as $key => $section)
                                                <div class="accordion-item" data-id="{{ $section->id }}">
                                                    <input type="hidden" name="order_no"
                                                           class="sections section_{{ $section->id }}"
                                                           value="{{ $section->order_no }}">
                                                    <h2 class="accordion-header" id="{{ $key }}">
                                                        <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#courseSection{{ $id = $section->id }}"
                                                                aria-expanded="true"
                                                                aria-controls="courseSection{{ $id }}">
                                                            {{ __('module') }} {{ ++$key }} :
                                                            {{ $section->title }}
                                                        </button>
                                                        <ul class="d-flex align-items-center course-edit-action gap-12">
                                                            <li class="dropdown">
                                                                <a class="dropdown-toggle" href="#"
                                                                   data-bs-toggle="dropdown" aria-expanded="false">
                                                                    {{ __('add_lesson') }}
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item lesson_modal"
                                                                           href="#" data-bs-toggle="modal"
                                                                           data-section="{{ json_encode($section) }}"
                                                                           data-bs-target="#video_lesson">{{ __('add_video_lesson') }}</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item lesson_modal"
                                                                           href="#" data-bs-toggle="modal"
                                                                           data-section="{{ json_encode($section) }}"
                                                                           data-bs-target="#audio_lesson">{{ __('add_audio_lesson') }}</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item lesson_modal"
                                                                           href="#" data-bs-toggle="modal"
                                                                           data-section="{{ json_encode($section) }}"
                                                                           data-bs-target="#doc_lesson">{{ __('add_doc_lesson') }}</a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <a href="#"
                                                                   class="btn sg-btn-outline-primary lesson_modal"
                                                                   data-section="{{ json_encode($section) }}"
                                                                   data-bs-toggle="modal"
                                                                   data-bs-target="#add_quiz">{{ __('add_quiz') }}</a>
                                                            </li>
                                                            <li class="listMove">
                                                                <a href="#" class="icon btn sg-btn-outline-primary">
                                                                    <i class="las la-arrows-alt"></i>
                                                                </a>
                                                            </li>
                                                            <li class="dropdown pe-0">
                                                                <a class="dropdown-toggle icon" href="#"
                                                                   data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                        class="las la-ellipsis-v"></i></a>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item edit_modal"
                                                                           href="javascript:void(0)"
                                                                           data-fetch_url="{{ route('sections.edit', $section->id) }}"
                                                                           data-route="{{ route('sections.update', $section->id) }}"
                                                                           data-modal="editSection">{{ __('edit_section') }}</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item"
                                                                           href="javascript:void(0)"
                                                                           onclick="delete_row('{{ route('sections.destroy', $section->id) }}',null,true)"
                                                                           data-toggle="tooltip"
                                                                           data-original-title="{{ __('delete') }}">{{ __('delete') }}</a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </h2>
                                                    <div id="courseSection{{ $id }}"
                                                         class="accordion-collapse collapse {{ $i == 0 && (count($lessons->where('section_id', $section->id)) > 0 || count($section->quizzes) > 0) ? 'show' : '' }}"
                                                         aria-labelledby="courseSectionOne"
                                                         data-bs-parent="#editCourse">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="moveable-list-view mt-20 mt-md-0"
                                                                         id="lesson_sortable">
                                                                        @if (count($lessons) > 0)
                                                                            @foreach ($lessons->where('section_id', $section->id) as $k => $lesson)
                                                                                <div class="list-view"
                                                                                     data-id="{{ $lesson->id }}">
                                                                                    <div
                                                                                        class="list-view-content d-flex align-items-center gap-30">
                                                                                        <span class="icon"><i
                                                                                                @class([
                                                                                                    'las',
                                                                                                    'la-play' => $lesson->lesson_type == 'video',
                                                                                                    'la-music' => $lesson->lesson_type == 'audio',
                                                                                                    'la-file-invoice' => $lesson->lesson_type == 'doc',
                                                                                                ])></i></span>
                                                                                        <p>{{ __('lesson') }}
                                                                                            {{ ++$k }}
                                                                                            : {{ $lesson->title }}</p>
                                                                                    </div>


                                                                                    <ul
                                                                                        class="d-flex align-items-center gap-20">
                                                                                        <li><a href="#"
                                                                                               class="icon edit_modal"
                                                                                               data-fetch_url="{{ route('lessons.edit', $lesson->id) }}"
                                                                                               data-route="{{ route('lessons.update', $lesson->id) }}"
                                                                                               data-modal="edit_{{ $lesson->lesson_type }}_lesson"
                                                                                               data-bs-custom-class="custom-tooltip"
                                                                                               data-bs-toggle="tooltip"
                                                                                               data-bs-placement="top"
                                                                                               data-bs-title="{{ __('edit') }}"><i
                                                                                                    class="lar la-edit"></i></a>
                                                                                        </li>

                                                                                        <li><a href="#"
                                                                                               class="icon"
                                                                                               onclick="delete_row('{{ route('lessons.destroy', $lesson->id) }}',null,true)"
                                                                                               data-bs-toggle="tooltip"
                                                                                               data-bs-placement="top"
                                                                                               data-bs-title="{{ __('delete') }}"><i
                                                                                                    class="las la-times"></i></a>
                                                                                        </li>

                                                                                        <li
                                                                                            class="list-view-icon lessonMove lesson_modal">
                                                                                            <a href="#"><i
                                                                                                    class="las la-arrows-alt"></i></a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <!-- End List View -->
                                                                            @endforeach
                                                                        @endif

                                                                    </div>
                                                                    @foreach ($section->quizzes as $quiz)
                                                                        <div class="list-view fixed-list-view mt-20">
                                                                            <div
                                                                                class="list-view-content d-flex align-items-center gap-30">
                                                                                <span class="icon"><i
                                                                                        class="las la-question"></i></span>
                                                                                <div>
                                                                                    <h6>{{ $quiz->title }}</h6>
                                                                                    <p>Question 5
                                                                                        | {{ __('time') }}
                                                                                        {{ $quiz->duration }}
                                                                                        {{ __('minutes') }}
                                                                                        | {{ __('total_marks') }}
                                                                                        {{ $quiz->total_marks }} </p>
                                                                                </div>
                                                                            </div>


                                                                            <ul
                                                                                class="action-btn d-flex align-items-center gap-20 px-20">
                                                                                <li><a href="#"
                                                                                        @class(['active', 'bg-danger' => $quiz->status == 0])>{{ $quiz->status == 1 ? __('active') : __('in_active') }}</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="{{ route('quizzes.edit', $quiz->id) }}"
                                                                                       class="icon"
                                                                                       data-bs-toggle="tooltip"
                                                                                       data-bs-placement="top"
                                                                                       data-bs-title="{{ __('edit') }}"><i
                                                                                            class="lar la-edit"></i></a>
                                                                                </li>
                                                                                <li><a href="#" class="icon"
                                                                                       data-bs-toggle="tooltip"
                                                                                       onclick="delete_row('{{ route('quizzes.destroy', $quiz->id) }}',null,true)"
                                                                                       data-bs-placement="top"
                                                                                       data-bs-title="{{ __('destroy') }}"><i
                                                                                            class="lar la-trash-alt"></i></a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                            <!-- End Course Module 1 Accordion ITEM -->
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mt-30">
                                            <a href="#" type="button"
                                               class="btn sg-btn-outline-primary btn_action" data-bs-toggle="tab"
                                               data-bs-target="#seo">{{ __('back') }}</a>
                                            <a href="#" type="button" class="btn sg-btn-primary btn_action"
                                               data-bs-toggle="tab"
                                               data-bs-target="#assignment">{{ __('next') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Curriculum Tab -->

                            <!-- Start Live Class Tab -->
                            <div class="tab-pane fade {{ $step_6_error && (!$step_1_error && !$step_2_error && !$step_3_error) ? 'show active' : '' }}" id="courseLiveClass" role="tabpanel" aria-labelledby="courseLiveClass"
                                 tabindex="0">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-20">
                                            <div class="col">
                                                <div class="mb-20">
                                                    <label for="liveClassDate" class="form-label">Live Class
                                                        Date</label>
                                                    <input id="liveClassDateRangePicker" name="dateRange" type="text"
                                                           class="form-control rounded-2"
                                                           placeholder="{{ __('select_date') }}">
                                                    <div class="nk-block-des text-danger">
                                                        <p class="dateRange_error error"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('dateRange') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Date Range Picker -->

                                    <div class="col-lg-12">
                                        <div class="mb-3 d-flex">
                                            <label class="form-label">Meeting Method :</label>
                                            <div class="custom-radio mx-20">
                                                <label>
                                                    <input type="radio" name="LiveClassmeetingMethod"
                                                           value="zoom" {{$liveClass && $liveClass->meeting_method === 'zoom' ? 'checked' : '' }} >
                                                    <span class="ms-12">Zoom</span>
                                                </label>
                                            </div>

                                            <div class="custom-radio mx-20">
                                                <label>
                                                    <input type="radio" name="LiveClassmeetingMethod"
                                                           value="google_meet" {{$liveClass && $liveClass->meeting_method === 'google_meet' ? 'checked' : '' }} >
                                                    <span class="ms-12">Google Meet</span>
                                                </label>
                                            </div>

                                            <div class="custom-radio mx-20">
                                                <label>
                                                    <input type="radio" name="LiveClassmeetingMethod"
                                                           value="jitsi" {{$liveClass && $liveClass->meeting_method === 'jitsi' ? 'checked' : '' }} >
                                                    <span class="ms-12">Jitsi</span>
                                                </label>
                                            </div>

                                            <div class="custom-radio mx-20">
                                                <label>
                                                    <input type="radio" name="LiveClassmeetingMethod"
                                                           value="team" {{$liveClass && $liveClass->meeting_method === 'team' ? 'checked' : '' }} >
                                                    <span class="ms-12">Team</span>
                                                </label>
                                            </div>

                                            <div class="custom-radio mx-20">
                                                <label>
                                                    <input type="radio" name="LiveClassmeetingMethod"
                                                           value="microsoft_team" {{$liveClass && $liveClass->meeting_method === 'microsoft_team' ? 'checked' : '' }} >
                                                    <span class="ms-12">Microsoft Teams</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="nk-block-des text-danger">
                                            <p class="error">{{ $errors->first('LiveClassmeetingMethod') }}</p>
                                        </div>
                                    </div>
                                    <!-- End Meeting Method -->

                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="liveDescription" class="form-label">Description</label>
                                            <textarea class="form-control" id="liveDescription"
                                                      name="liveClassDescription"
                                                      style="height: 100px"> {{ $liveClass->description??  '' }}</textarea>
                                        </div>
                                        <div class="nk-block-des text-danger">
                                            <p class="error">{{ $errors->first('liveClassDescription') }}</p>
                                        </div>
                                    </div>
                                    <!-- End Description -->


                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="meetingLink" class="form-label">Meeting Link</label>
                                            <input type="text" class="form-control rounded-2"
                                                   name="LiveClassmeetingLink" id="meetingLink"
                                                   placeholder="https://"
                                                   value="{{ $liveClass->meeting_link ??  old('metting_link') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('LiveClassmeetingLink') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Meeting Link -->

                                    <div class="col-lg-6">
                                        <label for="MeetingID" class="form-label">Meeting ID</label>
                                        <input type="number" class="form-control rounded-2" name="LiveClassMeetingID"
                                               id="MeetingID"
                                               placeholder="756 3546 14256"
                                               value="{{ $liveClass->meeting_id ??  old('metting_id') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="error">{{ $errors->first('LiveClassMeetingID') }}</p>
                                        </div>
                                    </div>
                                    <!-- End Meeting ID -->

                                    <div class="col-lg-6">
                                        <label for="meetingPassword" class="form-label">Meeting Password</label>
                                        <input type="text" class="form-control rounded-2"
                                               name="LiveClassmeetingPassword" id="meetingPassword"
                                               placeholder="K465G465"
                                               value="{{ $liveClass->meeting_password ??  old('metting_password')}}">
                                        <div class="nk-block-des text-danger">
                                            <p class="error">{{ $errors->first('LiveClassmeetingPassword') }}</p>
                                        </div>
                                    </div>
                                    <!-- End Meeting Password -->

                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mt-30">
                                            <a href="#" type="button"
                                               class="btn sg-btn-outline-primary btn_action" data-bs-toggle="tab"
                                               data-bs-target="#curriculum">{{ __('back') }}</a>
                                            <a href="#" type="button" class="btn sg-btn-primary btn_action"
                                               data-bs-toggle="tab"
                                               data-bs-target="#assignment">{{ __('next') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Live Class Tab -->

                            <!-- Start assignment Tab -->
                            <div
                                class="tab-pane fade {{ $request_tab == 'assignment' ? 'show active' : '' }} {{ $step_1_error || $step_2_error || $step_3_error }}"
                                id="courseAssignment" role="tabpanel" aria-labelledby="assignment" tabindex="0">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-12">
                                    </div>

                                    <div class="col-lg-7 col-md-7 col-sm-12">
                                        <div class="oftions-content-right mb-20">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_assignment"
                                               class="d-flex align-items-center button-default gap-2">
                                                <i class="las la-plus"></i>
                                                <span>{{ __('add_assignment') }}</span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="default-list-table edit-course yajra-dataTable">
                                            {{ $dataTable->table() }}
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mt-30">
                                            <a href="#" type="button"
                                               class="btn sg-btn-outline-primary btn_action" data-bs-toggle="tab"
                                               data-bs-target="#curriculum">{{ __('back') }}</a>
                                            <a href="#" type="button" class="btn sg-btn-primary btn_action"
                                               data-bs-toggle="tab" data-bs-target="#resource">{{ __('next') }}</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- End Assignment Tab -->


                            <!-- Start Resource Tab -->
                            <div
                                class="tab-pane fade {{ $request_tab == 'resource' ? 'show active' : '' }} {{ $step_1_error || $step_2_error || $step_3_error }}"
                                id="courseResource" role="tabpanel" aria-labelledby="resource" tabindex="0">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-12">
                                    </div>

                                    <div class="col-lg-7 col-md-7 col-sm-12">
                                        <div class="oftions-content-right mb-20">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#resourcesAddModal"
                                               class="d-flex align-items-center button-default gap-2">
                                                <i class="las la-plus"></i>
                                                <span>{{ __('add_resource') }}</span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div id="resourceListContainer" class="row gy-20">
                                            @include('backend.admin.course.resource_list')
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mt-30">
                                            <a href="#" type="button"
                                               class="btn sg-btn-outline-primary btn_action" data-bs-toggle="tab"
                                               data-bs-target="#assignment">{{ __('back') }}</a>
                                            <a href="#" type="button" class="btn sg-btn-primary btn_action"
                                               data-bs-toggle="tab" data-bs-target="#faq">{{ __('next') }}</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- End Resource Tab -->

                            <!-- Start faq Tab -->
                            <div
                                class="tab-pane fade {{ $request_tab == 'faq' ? 'show active' : '' }} {{ $step_1_error || $step_2_error || $step_3_error }}"
                                id="courseFAQ" role="tabpanel" aria-labelledby="faq" tabindex="0">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="oftions-content-right mb-20">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_faq"
                                               class="button-default">{{ __('add_faq') }} <i
                                                    class="las la-plus"></i></a>
                                        </div>
                                        <div class="accordion accordion-v2" id="faqsContent">
                                            @foreach ($faqs as $key => $faq)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="faq{{ $key }}">
                                                        <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#faq{{ $key }}Collapse"
                                                                aria-expanded="true"
                                                                aria-controls="faq{{ $key }}Collapse">
                                                            {{ $faq->question }}
                                                            <ul class="d-flex align-items-center gap-20">
                                                                <li data-bs-toggle="modal"
                                                                    data-bs-target="#faqsEditModal">
                                                                    <a class="icon edit_modal" href="javascript:void(0)"
                                                                       data-fetch_url="{{ route('faqs.edit', $faq->id) }}"
                                                                       data-route="{{ route('faqs.update', $faq->id) }}"
                                                                       data-modal="edit_faq"
                                                                       data-bs-custom-class="custom-tooltip"
                                                                       data-bs-toggle="tooltip" data-bs-placement="top"
                                                                       data-bs-title="{{ __('edit') }}"><i
                                                                            class="lar la-edit"></i></a>
                                                                </li>

                                                                <li><a href="javascript:void(0)"
                                                                       onclick="delete_row('{{ route('faqs.destroy', $faq->id) }}',null,true)"
                                                                       data-toggle="tooltip"
                                                                       data-original-title="{{ __('delete') }}"
                                                                       class="icon" data-bs-toggle="tooltip"
                                                                       data-bs-placement="top"
                                                                       data-bs-title="{{ __('delete') }}"><i
                                                                            class="las la-times"></i></a></li>
                                                            </ul>
                                                        </button>
                                                    </h2>
                                                    <div id="faq{{ $key }}Collapse"
                                                         class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}"
                                                         aria-labelledby="faq{{ $key }}"
                                                         data-bs-parent="#faqsContent">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="faqAns">
                                                                        <p>{!! $faq->answer !!}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mt-30">
                                            <a href="#" type="button"
                                               class="btn sg-btn-outline-primary btn_action" data-bs-toggle="tab"
                                               data-bs-target="#resource">{{ __('back') }}</a>


                                            <div class="d-flex align-items-center gap-3">
                                                <button type="submit"
                                                        class="btn sg-btn-primary mr-1">{{ __('update') }}</button>

                                                <button type="submit" name="save_and_published" value="1"
                                                        class="btn sg-btn-primary">{{ __('save_&_publish') }}</button>
                                            </div>


                                            @include('backend.common.loading-btn', [
                                                'class' => 'btn sg-btn-primary',
                                            ])
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End FAQ Tab -->
                        </div>
                    </form>
                </div>
                <!-- End Default Tab List -->
            </div>
        </div>
    </div>
    @include('backend.admin.course.modals')
    @include('backend.common.delete-script')
    @include('backend.common.gallery-modal')
@endsection
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ static_asset('admin/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ static_asset('admin/css/bootstrap-datepicker.min.css') }}">
@endpush
@push('js_asset')
    <!--====== media.js ======-->
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/moment.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/daterangepicker.js') }}"></script>
    <script src="{{ static_asset('admin/js/sortable.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/bootstrap-datepicker.min.js') }}"></script>
@endpush
@push('js')
    {{ $dataTable->scripts() }}
    <script src="{{ static_asset('admin/js/media.js?ver=1.0.0') }}"></script>
    <script src="{{ static_asset('admin/js/ai_writer.js') }}"></script>
    <script>
        let section_id = '';
        var numbeonelive = 7;
        var numbeone = 6;
        var numbertwoLive = 8;
        var numbertwo = 7;
        var numberthreeLive = 9;
        var numberThree = 8;
        $(document).ready(function () {
            searchCategory($('#select_category'));
            searchOrganization($('#ins_by_org'));
            searchSubjects($('#select_subject'));
            $(document).on('click', "#mgCourse-tabContent a.btn_action", function () {
                const triggerTab = $(this).data('bs-target');
                const tabInstance = new bootstrap.Tab(triggerTab)
                tabInstance.show()
            });
            /*$(document).on('click', "#select_subject", function () {
                searchSubjects($('#select_subject'));
            });*/

            let sections = document.getElementById("editCourse");
            if (sections) {
                new Sortable(sections, {
                    handle: '.listMove',
                    animation: 150,
                    onSort: function (evt) {
                        let form = {
                            _token: '{{ csrf_token() }}',
                            ids: [],
                            course_id: '{{ $course->id }}',
                        };
                        let nodes = evt.from.childNodes;

                        $.each(nodes, function (index, value) {
                            if ($(this).hasClass('accordion-item')) {
                                form.ids.push($(this).data('id'));
                            }
                        });
                        $.ajax({
                            url: '{{ route('course.sections.order') }}',
                            type: 'POST',
                            data: form,
                            success: function (data) {
                                if (data.error) {
                                    toastr.error(data.error);
                                }
                            },
                            error: function (data) {
                                toastr.error('Something went wrong');
                            }
                        });
                    },
                });
            }
            let lessons = document.getElementById("lesson_sortable");
            if (lessons) {
                new Sortable(lessons, {
                    handle: '.lessonMove',
                    animation: 150,
                    onSort: function (evt) {
                        let form = {
                            _token: '{{ csrf_token() }}',
                            ids: [],
                            section_id: section_id,
                        };
                        let nodes = evt.from.childNodes;

                        $.each(nodes, function (index, value) {
                            if ($(this).hasClass('list-view')) {
                                form.ids.push($(this).data('id'));
                            }
                        });
                        $.ajax({
                            url: '{{ route('section.lessons.order') }}',
                            type: 'POST',
                            data: form,
                            success: function (data) {
                                if (data.error) {
                                    toastr.error(data.error);
                                }
                                else{
                                    toastr.success(data.success);
                                }
                            },
                            error: function (data) {
                                toastr.error('Something went wrong');
                            }
                        });
                    },
                });
            }
            $('#dateRangePicker').daterangepicker({
                startDate: '{{ Carbon\Carbon::parse($course->discount_start_at)->format('m/d/Y') }}',
                endDate: '{{ Carbon\Carbon::parse($course->discount_end_at)->format('m/d/Y') }}',
            });
            $('.datePickerUP').datepicker({});
            $('#liveClassDateRangePicker').daterangepicker({
                startDate: '{{ Carbon\Carbon::parse($course->discount_start_at)->format('m/d/Y') }}',
                endDate: '{{ Carbon\Carbon::parse($course->discount_end_at)->format('m/d/Y') }}',
            });
            $('.liveClassDateRangePicker').datepicker({});
            $(document).on('change', "#video_source", function () {
                let video_source = $(this).val();

                if (!video_source) {
                    $('.video_link').addClass('d-none');
                    $('.upload_div').addClass('d-none');
                } else if (video_source == 'upload') {
                    $('.video_link').addClass('d-none');
                    $('.upload_div').removeClass('d-none');
                } else {
                    $('.video_link').removeClass('d-none');
                    $('.upload_div').addClass('d-none');
                }
            });
            $(document).on('change', ".lesson_source", function () {
                let video_source = $(this).val();

                if (video_source == 'upload') {
                    $('.lesson_link').addClass('d-none');
                    $('.lesson_upload_div').removeClass('d-none');
                } else {
                    $('.lesson_link').removeClass('d-none');
                    $('.lesson_upload_div').addClass('d-none');
                }
            });
            $(document).on('change', "#is_free", function () {
                let is_free = $(this).is(':checked');

                if (is_free) {
                    $('.not_free_div').addClass('d-none');
                    $('.discountable_div').addClass('d-none');
                    $('.renewable_div').addClass('d-none');
                    $("#discountable_course").prop('checked', false);
                } else {
                    $('.not_free_div').removeClass('d-none');
                }
            });
            $(document).on('change', "#discountable_course", function () {
                let is_discountable = $(this).is(':checked');
                if (is_discountable) {
                    $('.discountable_div').removeClass('d-none');
                } else {
                    $('.discountable_div').addClass('d-none');
                }
            });
            $(document).on('click', ".lesson_modal", function () {
                let section = $(this).data('section');
                section_id = section.id;
                $('.section_id').val(section.id);
            });
            /*$(document).on('click', "#basicInformation", function () {
                searchCategory($('#select_category'));
                searchSubjects($('#select_subject'));
                searchOrganization($('#ins_by_org'));
            });*/
            $(document).on('change','#courseType',function () {
                var selectedValue = $(this).val();
                if (selectedValue === 'live_class') {
                    $("#notLiveClass").removeClass('d-none');
                    $('.courseAssignmentIndex').text(numbeonelive);
                    $('.courseresourceIndex').text(numbertwoLive);
                    $('.coursefaqIndex').text(numberthreeLive);

                } else if (selectedValue === 'course') {
                    $("#notLiveClass").addClass('d-none');
                    $('.courseAssignmentIndex').text(numbeone);
                    $('.courseresourceIndex').text(numbertwo);
                    $('.coursefaqIndex').text(numberThree);

                }
            });
            $(document).on('click', '.tab_change', function () {
                var tab = $(this).attr('data-tab');
                changeUrl('tab', tab);
            });
            $(document).on('click', '.deleteResource', function (event) {
                event.preventDefault();
                let url = $(this).data('url');
                axios.delete(url, {
                    params: {
                        method: 'DELETE',
                        course_id: $(this).data('course'),
                    }
                })
                    .then(response => {
                        console.log(response.data);
                        $('#resourceListContainer').html(response.data);
                        toastr.success('Deleted Successfully')
                    })
                    .catch(error => {
                        console.log(error.message);
                    })
            });
            $(document).on("submit", "#storeResource", function (e) {
                e.preventDefault();
                let selector = this;
                $(selector).find(".loading_button").removeClass("d-none");
                $(selector).find("p.error").text("");
                $(selector).find(":submit").addClass("d-none");
                let action = $(selector).attr("action");
                let method = $(selector).attr("method");
                let formData = new FormData(selector);
                let modal = $(selector).find('.is_modal').val();

                axios.post(action, formData)

                    .then(response => {

                        $('#resourceListContainer').html(response.data);

                        if (modal_id && !modal) {
                            $(selector).find(".loading_button").addClass("d-none");
                            $(selector).find(":submit").removeClass("d-none");
                            toastr.success('Created Successfully');
                            modal_id.modal("hide");
                            $(selector).trigger("reset");
                            modal_id
                                .find(".create_sub_title")
                                .removeClass("d-none");
                            modal_id.find(".edit_sub_title").addClass("d-none");
                            $(".dataTable").DataTable().ajax.reload();
                        } else {
                            if (response.route) {
                                window.location.href = response.route;
                            } else {
                                location.reload();
                            }
                        }

                    })
                    .catch(error => {
                        let message = error.response.data.errors.file[0] || error.response.data.error
                        toastr.error(message)
                        $(selector).find(".loading_button").addClass("d-none");
                        $(selector).find(":submit").removeClass("d-none");

                    })

            });
        });

        function changeUrl(type, val) {
            var url = new URL(window.location.href);
            var params = new URLSearchParams(url.search);

            params.set(type, val);

            var newUrl = url.origin + url.pathname + '?' + params.toString();
            window.history.pushState({
                path: newUrl
            }, '', newUrl);
        }
    </script>
@endpush
