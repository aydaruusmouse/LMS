<div class="modal fade" id="section" tabindex="-1" aria-labelledby="sectionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <h6 class="sub-title create_sub_title">{{__('add_module') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="form_div">
                <form action="{{ route('instructor.sections.store') }}" method="POST" class="form">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <input type="hidden" class="is_modal" value="0">
                    <div class="row gx-20">
                        <div class="col-12">
                            <div class="mb-4">
                                <label for="section_title" class="form-label">{{__('title') }}</label>
                                <input type="text" class="form-control rounded-2 currency_name" id="section_title"
                                       placeholder="{{ __('enter_title') }}" name="title" value="{{ old('title') }}">
                                <div class="nk-block-des text-danger">
                                    <p class="title_error error"></p>
                                </div>
                            </div>
                        </div>
                        <!-- End Currency Name -->
                    </div>
                    <!-- END Permissions Tab====== -->
                    <div class="d-flex justify-content-end align-items-center mt-30">
                        <button type="submit" class="btn sg-btn-primary">{{__('submit') }}</button>
                        @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editSection" tabindex="-1" aria-labelledby="sectionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <h6 class="sub-title create_sub_title">{{__('add_module') }}</h6>
            <h6 class="sub-title edit_sub_title d-none">{{__('edit_section') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="form_div">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="video_lesson" tabindex="-1" aria-labelledby="lessonLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <h6 class="sub-title">{{ __('add_video_lesson') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>

            <form action="{{ route('instructor.lessons.store') }}" method="post" class="form" enctype="multipart/form-data">@csrf
                <div class="row gx-20">
                    <input type="hidden" name="lesson_type" value="video">
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <input type="hidden" name="section_id" class="section_id">
                    <input type="hidden" class="is_modal" value="0">
                    <div class="col-6">
                        <div class="mb-4">
                            <label class="form-label">{{ __('title') }}</label>
                            <input type="text" name="title" class="form-control rounded-2" id="videoLessonTitle"
                                   placeholder="{{ __('enter_title') }}">
                            <div class="nk-block-des text-danger">
                                <p class="title_error error"></p>
                            </div>
                        </div>
                    </div>
                    <!-- End Lesson Title -->

                    <div class="col-6">
                        <div class="mb-4">
                            <label class="form-label">{{ __('source') }}</label>
                            <div class="select-type-v2">
                                <select class="form-select form-select-lg mb-3 without_search lesson_source"
                                        name="source">
                                    <option value="upload">{{ __('upload') }}</option>
                                    <option value="youtube">{{ __('youtube') }}</option>
                                    <option value="vimeo">{{ __('vimeo') }}</option>
                                    <option value="mp4">{{ __('mp4') }}</option>
                                </select>
                                <div class="nk-block-des text-danger">
                                    <p class="source_error error"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Video Source -->

                    <div class="col-lg-6 lesson_upload_div">
                        <div class="mb-3">
                            <label for="video_thumb"
                                   class="form-label">{{ __('upload_video') }}</label>
                            <label for="video_thumb" class="file-upload-text">
                                <p class="file_name">{{ __('choose_video') }}</p>
                                <span class="file-btn">{{ __('choose_file') }}</span>
                            </label>
                            <input class="d-none thumb_picker" name="source_data" type="file" id="video_thumb">
                            <div class="nk-block-des text-danger">
                                <p class="error source_data_error">{{ $errors->first('video_file') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 lesson_link d-none">
                        <div class="mb-4">
                            <label class="form-label">{{ __('link') }}</label>
                            <input type="text" class="form-control rounded-2" name="source_data" placeholder="https://">
                            <div class="nk-block-des text-danger">
                                <p class="source_data_error error"></p>
                            </div>
                        </div>
                    </div>
                    <!-- End Video Link -->

                    <div class="col-6">
                        <div class="mb-4">
                            <label class="form-label">{{ __('duration') }}</label>
                            <input type="text" name="duration" class="form-control rounded-2" placeholder="hh:mm:ss">
                            <div class="nk-block-des text-danger">
                                <p class="duration_error error"></p>
                            </div>
                        </div>
                    </div>
                    <!-- End Video Duration -->

                    <div class="col-lg-12">
                        <div class="mb-4">
                            <label class="form-label">{{ __('description') }}</label>
                            <textarea class="form-control" name="description"
                                      placeholder="{{ __('enter_description') }}"></textarea>
                        </div>
                    </div>
                    <!-- End Course Description -->

                    @include('backend.common.media-input',[
                                    'title' => 'Slider Image',
                                    'name'  => 'image_media_id',
                                    'col'   => 'col-12 mb-3',
                                    'size'  => '(402x238)',
                                    'image' => old('image'),
                                    'label' => __('thumbnail'),
                                ])
                    <!-- End Video Thumbnail -->
                    <div class="col-lg-12 p-0">
                        <div class="custom-checkbox">
                            <label>
                                <input type="checkbox" name="is_free" value="1">
                                <span class="ms-12">{{ __('free') }}</span>
                            </label>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn sg-btn-primary">{{ __('save') }}</button>
                        @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="audio_lesson" tabindex="-1" aria-labelledby="lessonLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <h6 class="sub-title">{{ __('add_audio_lesson') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>

            <form action="{{ route('instructor.lessons.store') }}" method="post" class="form" enctype="multipart/form-data">@csrf
                <div class="row gx-20">
                    <input type="hidden" name="lesson_type" value="audio">
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <input type="hidden" name="section_id" class="section_id">
                    <input type="hidden" class="is_modal" value="0">
                    <div class="col-6">
                        <div class="mb-4">
                            <label class="form-label">{{ __('title') }}</label>
                            <input type="text" name="title" class="form-control rounded-2" id="videoLessonTitle"
                                   placeholder="{{ __('enter_title') }}">
                            <div class="nk-block-des text-danger">
                                <p class="title_error error"></p>
                            </div>
                        </div>
                    </div>
                    <!-- End Lesson Title -->

                    <div class="col-6">
                        <div class="mb-4">
                            <label class="form-label">{{ __('source') }}</label>
                            <div class="select-type-v2">
                                <select class="form-select form-select-lg mb-3 without_search lesson_source"
                                        name="source">
                                    <option value="upload">{{ __('upload') }}</option>
                                    <option value="youtube">{{ __('youtube') }}</option>
                                    <option value="vimeo">{{ __('vimeo') }}</option>
                                    <option value="mp4">{{ __('mp4') }}</option>
                                </select>
                                <div class="nk-block-des text-danger">
                                    <p class="source_error error"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Video Source -->

                    <div class="col-lg-6 lesson_upload_div">
                        <div class="mb-3">
                            <label for="audio_thumb"
                                   class="form-label">{{ __('upload_audio') }}</label>
                            <label for="audio_thumb" class="file-upload-text">
                                <p class="file_name">{{ __('choose_audio') }}</p>
                                <span class="file-btn">{{ __('choose_file') }}</span>
                            </label>
                            <input class="d-none thumb_picker" name="source_data" type="file" id="audio_thumb">
                            <div class="nk-block-des text-danger">
                                <p class="source_data_error error">{{ $errors->first('video_file') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 lesson_link d-none">
                        <div class="mb-4">
                            <label class="form-label">{{ __('link') }}</label>
                            <input type="text" class="form-control rounded-2" name="source_data" placeholder="https://">
                            <div class="nk-block-des text-danger">
                                <p class="source_data_error error"></p>
                            </div>
                        </div>
                    </div>
                    <!-- End Video Link -->

                    <div class="col-6">
                        <div class="mb-4">
                            <label class="form-label">{{ __('duration') }}</label>
                            <input type="text" name="duration" class="form-control rounded-2" placeholder="hh:mm:ss">
                            <div class="nk-block-des text-danger">
                                <p class="duration_error error"></p>
                            </div>
                        </div>
                    </div>
                    <!-- End Video Duration -->

                    <div class="col-lg-12">
                        <div class="mb-4">
                            <label class="form-label">{{ __('description') }}</label>
                            <textarea class="form-control" name="description"
                                      placeholder="{{ __('enter_description') }}"></textarea>
                        </div>
                    </div>
                    <!-- End Course Description -->

                    @include('backend.common.media-input',[
                                    'title' => 'Slider Image',
                                    'name'  => 'image_media_id',
                                    'col'   => 'col-12 mb-3',
                                    'size'  => '(402x238)',
                                    'image' => old('image'),
                                    'label' => __('thumbnail'),
                                ])
                    <!-- End Video Thumbnail -->
                    <div class="col-lg-12 p-0">
                        <div class="custom-checkbox">
                            <label>
                                <input type="checkbox" value="1">
                                <span class="ms-12">{{ __('free') }}</span>
                            </label>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn sg-btn-primary">{{ __('save') }}</button>
                        @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="doc_lesson" tabindex="-1" aria-labelledby="lessonLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <h6 class="sub-title">{{ __('add_doc_lesson') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>

            <form action="{{ route('instructor.lessons.store') }}" method="post" class="form" enctype="multipart/form-data">@csrf
                <div class="row gx-20">
                    <input type="hidden" name="lesson_type" value="doc">
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <input type="hidden" name="section_id" class="section_id">
                    <input type="hidden" class="is_modal" value="0">
                    <div class="col-12">
                        <div class="mb-4">
                            <label class="form-label">{{ __('title') }}</label>
                            <input type="text" name="title" class="form-control rounded-2" id="videoLessonTitle"
                                   placeholder="{{ __('enter_title') }}">
                            <div class="nk-block-des text-danger">
                                <p class="title_error error"></p>
                            </div>
                        </div>
                    </div>
                    <!-- End Lesson Title -->

                    <div class="col-6">
                        <div class="mb-4">
                            <label class="form-label">{{ __('source') }}</label>
                            <div class="select-type-v2">
                                <select class="form-select form-select-lg mb-3 without_search lesson_source"
                                        name="source">
                                    <option value="upload">{{ __('upload') }}</option>
                                    <option value="youtube">{{ __('youtube') }}</option>
                                    <option value="vimeo">{{ __('vimeo') }}</option>
                                    <option value="mp4">{{ __('mp4') }}</option>
                                </select>
                                <div class="nk-block-des text-danger">
                                    <p class="source_error error"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Video Source -->

                    <div class="col-lg-6 lesson_upload_div">
                        <div class="mb-3">
                            <label for="doc_thumb"
                                   class="form-label">{{ __('upload_audio') }}</label>
                            <label for="doc_thumb" class="file-upload-text">
                                <p class="file_name">{{ __('choose_audio') }}</p>
                                <span class="file-btn">{{ __('choose_file') }}</span>
                            </label>
                            <input class="d-none thumb_picker" name="source_data" type="file" id="doc_thumb">
                            <div class="nk-block-des text-danger">
                                <p class="source_data_error error">{{ $errors->first('video_file') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 lesson_link d-none">
                        <div class="mb-4">
                            <label class="form-label">{{ __('link') }}</label>
                            <input type="text" class="form-control rounded-2" name="source_data" placeholder="https://">
                            <div class="nk-block-des text-danger">
                                <p class="source_data_error error"></p>
                            </div>
                        </div>
                    </div>
                    <!-- End Video Link -->

                    <div class="col-lg-12">
                        <div class="mb-4">
                            <label class="form-label">{{ __('description') }}</label>
                            <textarea class="form-control" name="description"
                                      placeholder="{{ __('enter_description') }}"></textarea>
                        </div>
                    </div>
                    <!-- End Course Description -->

                    @include('backend.common.media-input',[
                                    'title' => 'Slider Image',
                                    'name'  => 'image_media_id',
                                    'col'   => 'col-12 mb-3',
                                    'size'  => '(402x238)',
                                    'image' => old('image'),
                                    'label' => __('thumbnail'),
                                ])
                    <!-- End Video Thumbnail -->
                    <div class="col-lg-12 p-0">
                        <div class="custom-checkbox">
                            <label>
                                <input type="checkbox" value="1">
                                <span class="ms-12">{{ __('free') }}</span>
                            </label>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn sg-btn-primary">{{ __('save') }}</button>
                        @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit_video_lesson" tabindex="-1" aria-labelledby="lessonLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <h6 class="sub-title">{{ __('edit_video_lesson') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="form_div">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="edit_audio_lesson" tabindex="-1" aria-labelledby="lessonLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <h6 class="sub-title">{{ __('edit_audio_lesson') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="form_div">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="edit_doc_lesson" tabindex="-1" aria-labelledby="lessonLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <h6 class="sub-title">{{ __('edit_doc_lesson') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="form_div">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add_faq" tabindex="-1" aria-labelledby="add_faq" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <h6 class="sub-title create_sub_title">{{__('add_faq') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="form_div">
                <form action="{{ route('instructor.faqs.store') }}" method="POST" class="form">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <input type="hidden" class="is_modal" value="0">
                    <div class="row gx-20">
                        <div class="col-12">
                            <div class="mb-4">
                                <label for="question" class="form-label">{{__('question') }}</label>
                                <input type="text" class="form-control rounded-2" id="question"
                                       placeholder="{{ __('enter_question') }}" name="question">
                                <div class="nk-block-des text-danger">
                                    <p class="question_error error"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="editor-wrapper mb-4">
                                <label for="answer" class="form-label">{{__('answer') }}</label>
                                <textarea class="summernote" id="answer"
                                          placeholder="{{ __('enter_answer') }}" name="answer"></textarea>
                                <div class="nk-block-des text-danger">
                                    <p class="answer_error error"></p>
                                </div>
                            </div>
                        </div>
                        <!-- End Currency Name -->

                    </div>
                    <!-- END Permissions Tab====== -->
                    <div class="d-flex justify-content-end align-items-center mt-30">
                        <button type="submit" class="btn sg-btn-primary">{{__('submit') }}</button>
                        @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="edit_faq" tabindex="-1" aria-labelledby="edit_faq" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <h6 class="sub-title create_sub_title">{{__('edit_faq') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="form_div">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add_quiz" tabindex="-1" aria-labelledby="add_quiz" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <h6 class="sub-title">{{ __('add_quiz') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <form action="{{ route('instructor.quizzes.store') }}" method="post" class="form"
                  enctype="multipart/form-data">@csrf
                <div class="row gx-20">
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <input type="hidden" name="section_id" class="section_id">
                    <input type="hidden" class="is_modal" value="0">
                    <div class="col-6">
                        <div class="mb-4">
                            <label class="form-label">{{ __('title') }}</label>
                            <input type="text" name="title" class="form-control rounded-2"
                                   placeholder="{{ __('enter_title') }}">
                            <div class="nk-block-des text-danger">
                                <p class="title_error error"></p>
                            </div>
                        </div>
                    </div>
                    <!-- End Lesson Title -->
                    <div class="col-6">
                        <div class="mb-4">
                            <label class="form-label">{{ __('duration') }} ({{ __('in_minutes') }})</label>
                            <input type="number" name="duration" class="form-control rounded-2"
                                   placeholder="e.g.30">
                            <div class="nk-block-des text-danger">
                                <p class="duration_error error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-4">
                            <label class="form-label">{{ __('total_marks') }}</label>
                            <input type="number" name="total_marks" class="form-control rounded-2"
                                   placeholder="e.g.100">
                            <div class="nk-block-des text-danger">
                                <p class="total_marks_error error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-4">
                            <label class="form-label">{{ __('pass_marks') }}</label>
                            <input type="number" name="pass_marks" class="form-control rounded-2"
                                   placeholder="e.g.50">
                            <div class="nk-block-des text-danger">
                                <p class="pass_marks_error error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-12 mb-4">
                        <label for="certificate_included">{{ __('certificate_included') }}</label>
                        <div class="setting-check">
                            <input type="checkbox" id="certificate_included" name="certificate_included"
                                   value="1">
                            <label for="certificate_included"></label>
                        </div>
                    </div>
                    <div
                        class="d-flex gap-12 mb-4 ">
                        <label for="status">{{ __('status') }}</label>
                        <div class="setting-check">
                            <input type="checkbox" id="status" name="status"
                                   value="1" checked>
                            <label for="status"></label>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn sg-btn-primary">{{ __('save') }}</button>
                        @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="add_assignment" tabindex="-1" aria-labelledby="add_assignment" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <h6 class="sub-title">{{ __('add_assignment') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <form action="{{ route('instructor.assignments.store') }}" method="post" class="form"
                  enctype="multipart/form-data">@csrf
                <div class="row gx-20">
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <div class="col-6">
                        <div class="mb-4">
                            <label class="form-label">{{ __('title') }}</label>
                            <input type="text" name="title" class="form-control rounded-2"
                                   placeholder="{{ __('enter_title') }}">
                            <div class="nk-block-des text-danger">
                                <p class="title_error error"></p>
                            </div>
                        </div>
                    </div>
                    <!-- End Lesson Title -->

                    <div class="col-6">
                        <div class="mb-4">
                            <div class="mb-20">
                                <label for="datePicker" class="form-label">{{ __('deadline') }}</label>
                                <input id="datePicker" type="text" name="deadline"
                                       class="datePickerUP form-control rounded-2">
                            </div>
                            <div class="nk-block-des text-danger">
                                <p class="deadline_error error"></p>
                            </div>
                        </div>
                    </div>
                    <!-- End Video Link -->

                    @if(auth()->user()->role_id == 2)
                        <input type="hidden" name="instructor_id" value="{{ auth()->id() }}">
                    @else
                        <div class="col-lg-6">
                            <div class="multi-select-v2 mb-4">
                                <label for="selectInstructor"
                                       class="form-label">{{ __('select_instructor') }}</label>
                                <select id="selectInstructor" name="instructor_id"
                                        class="multiple-select-1 form-select-lg rounded-0 mb-3 without_search"
                                        aria-label=".form-select-lg example">
                                    @foreach($instructors as $instructor)
                                        <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                                    @endforeach
                                </select>
                                <div class="nk-block-des text-danger">
                                    <p class="instructor_id_error error"></p>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-lg-6">
                        <div class="multi-select-v2 mb-4">
                            <label for="section_id"
                                   class="form-label">{{ __('select_section') }}</label>
                            <select id="section_id" name="section_id"
                                    class="multiple-select-1 form-select-lg rounded-0 mb-3 without_search"
                                    aria-label=".form-select-lg example" data-url="{{ route('instructor.ajax.lessons') }}">
                                <option value="">{{ __('select_section') }}</option>
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->title }}</option>
                                @endforeach
                            </select>
                            <div class="nk-block-des text-danger">
                                <p class="section_id_error error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="multi-select-v2 mb-4">
                            <label for="lesson_id"
                                   class="form-label">{{ __('select_lesson') }}</label>
                            <select id="lesson_id" name="lesson_id"
                                    class="multiple-select-1 form-select-lg rounded-0 mb-3 without_search"
                                    aria-label=".form-select-lg example">
                                <option value="">{{ __('select_lesson') }}</option>
                            </select>
                            <div class="nk-block-des text-danger">
                                <p class="section_id_error error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-4">
                            <label class="form-label">{{ __('total_marks') }}</label>
                            <input type="number" name="total_marks" class="form-control rounded-2"
                                   placeholder="e.g.100">
                            <div class="nk-block-des text-danger">
                                <p class="total_marks_error error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-4">
                            <label class="form-label">{{ __('pass_marks') }}</label>
                            <input type="number" name="pass_marks" class="form-control rounded-2"
                                   placeholder="e.g.50">
                            <div class="nk-block-des text-danger">
                                <p class="pass_marks_error error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="editor-wrapper mb-4">
                            <label for="description" class="form-label">{{__('description') }}</label>
                            <textarea class="summernote" id="description" name="description"></textarea>
                            <div class="nk-block-des text-danger">
                                <p class="description_error error"></p>
                            </div>
                        </div>
                    </div>

                    @include('backend.common.media-input',[
                                    'title' => 'Slider Image',
                                    'name'  => 'file_media_id',
                                    'col'   => 'col-12 mb-3',
                                    'size'  => '(350x150)',
                                    'image' => old('file_media_id'),
                                    'label' => __('file'),
                                    'for'   => '',
                                ])
                    <!-- End Video Thumbnail -->
                    <div class="col-lg-12 p-0">
                        <div class="custom-checkbox">
                            <label>
                                <input type="checkbox" name="is_free" value="1">
                                <span class="ms-12">{{ __('free') }}</span>
                            </label>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn sg-btn-primary">{{ __('save') }}</button>
                        @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit_assignment" tabindex="-1" aria-labelledby="edit_assignment" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <h6 class="sub-title create_sub_title">{{__('edit_assignment') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="form_div">
            </div>
        </div>
    </div>
</div>
<!-- Add Resource Module -->

<div class="modal fade" id="resourcesAddModal" tabindex="-1" aria-labelledby="resourcesAddModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <h6 class="sub-title">Add Resource</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>

            <form id="storeResource" action="{{ route('instructor.resources.store') }}" method="post"
                  enctype="multipart/form-data">@csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <div class="dropzone_file_container"></div>
                <div class="row gx-20">
                    <div class="col-sm-12">
                        <div class="mb-4">
                            <label for="title" class="form-label">Resource Title</label>
                            <input type="text" class="form-control rounded-2" id="title" name="title"
                                   required placeholder="Title here">
                        </div>
                    </div>
                    <!-- End Title -->

                    <div class="col-lg-12">
                        <div class="description-img">
                            <div class="media-uploader dropzone dropzone-multiple p-0 text-center d-flex align-items-center justify-content-center"
                                 data-dropzone="data-dropzone">

                                <div class="media-message">
                                    <svg width="60" height="60" viewBox="0 0 60 60" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <g id="file 3" clip-path="url(#clip0_3238_44660)">
                                            <g id="surface1">
                                                <path id="Vector"
                                                      d="M38.6614 0.346528C38.3863 0.056763 38.0091 -0.117188 37.6182 -0.117188H14.2122C9.8932 -0.117188 6.32812 3.43369 6.32812 7.75224V52.013C6.32812 56.3321 9.8932 59.8829 14.2122 59.8829H45.9801C50.2992 59.8829 53.8642 56.3321 53.8642 52.013V16.8682C53.8642 16.4914 53.6903 16.1293 53.444 15.8538L38.6614 0.346528ZM39.0816 4.99879L48.9803 15.39H42.5455C40.6325 15.39 39.0816 13.8538 39.0816 11.9408V4.99879ZM45.9801 56.9844H14.2122C11.5022 56.9844 9.22669 54.7381 9.22669 52.013V7.75224C9.22669 5.04228 11.4876 2.78138 14.2122 2.78138H36.1831V11.9408C36.1831 15.4624 39.024 18.2886 42.5455 18.2886H50.9657V52.013C50.9657 54.7381 48.7048 56.9844 45.9801 56.9844Z"
                                                      fill="#666666" />
                                                <path id="Vector_2"
                                                      d="M42.0231 46.9844H18.168C17.3711 46.9844 16.7188 47.6362 16.7188 48.4337C16.7188 49.2306 17.3711 49.8829 18.168 49.8829H42.0377C42.8347 49.8829 43.487 49.2306 43.487 48.4337C43.487 47.6362 42.8347 46.9844 42.0231 46.9844Z"
                                                      fill="#666666" />
                                                <path id="Vector_3"
                                                      d="M22.674 31.3906L28.6451 24.97V40.7963C28.6451 41.5933 29.2974 42.2456 30.0944 42.2456C30.8918 42.2456 31.5437 41.5933 31.5437 40.7963V24.97L37.5148 31.3906C37.8045 31.6946 38.1817 31.8543 38.5727 31.8543C38.9206 31.8543 39.2831 31.7239 39.5582 31.4629C40.1382 30.9123 40.1817 29.999 39.631 29.4195L31.1381 20.3036C30.8625 20.0138 30.4858 19.8398 30.0802 19.8398C29.6742 19.8398 29.2974 20.0138 29.0223 20.3036L20.5294 29.4195C19.9787 29.999 20.0222 30.9264 20.6017 31.4629C21.2106 32.0136 22.1233 31.9701 22.674 31.3906Z"
                                                      fill="#666666" />
                                            </g>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_3238_44660">
                                                <rect width="60" height="60" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span class="d-block mt-4">Drag and Drop file here or <a href="#">Choose
                                            File</a></span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-2">
                                <span class="">Supported file type : Zip</span>
                                <span class="">Maximum file size : 20MB</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-30">
                        <a href="#" type="button" class="modal-close btn sg-btn-outline-primary btn_action"
                           data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        <button type="submit" class="btn sg-btn-primary">Save</button>
                        @include('backend.common.loading-btn', ['class' => 'btn sg-btn-primary'])
                    </div>
                </div>
                <!-- END Permissions Tab====== -->
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit_resource" tabindex="-1" aria-labelledby="edit_resource" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <h6 class="sub-title create_sub_title">{{ __('edit_resource') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            <div class="form_div">
            </div>
        </div>
    </div>
</div>
