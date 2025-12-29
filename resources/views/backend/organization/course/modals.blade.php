<div class="modal fade" id="section" tabindex="-1" aria-labelledby="sectionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <h6 class="sub-title create_sub_title">{{__('add_module') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="form_div">
                <form action="{{ route('organization.sections.store') }}" method="POST" class="form">
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

            <form action="{{ route('organization.lessons.store') }}" method="post" class="form" enctype="multipart/form-data">@csrf
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
                                    'size'  => '(350x150)',
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

            <form action="{{ route('organization.lessons.store') }}" method="post" class="form" enctype="multipart/form-data">@csrf
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
                                    'size'  => '(350x150)',
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

            <form action="{{ route('organization.lessons.store') }}" method="post" class="form" enctype="multipart/form-data">@csrf
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
                                    'size'  => '(350x150)',
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
                <form action="{{ route('organization.faqs.store') }}" method="POST" class="form">
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
                            <div class="mb-4">
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
            <form action="{{ route('organization.quizzes.store') }}" method="post" class="form"
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
            <form action="{{ route('organization.assignments.store') }}" method="post" class="form"
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
                                    aria-label=".form-select-lg example" data-url="{{ route('organization.ajax.lessons') }}">
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
                        <div class="mb-4">
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
