<form action="{{ route('instructor.lessons.update',$lesson->id) }}" method="POST" class="form" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row gx-20">
        <input type="hidden" name="course_id" value="{{ $lesson->course_id }}">
        <input type="hidden" name="section_id" class="section_id" value="{{ $lesson->section_id }}">
        <input type="hidden" class="is_modal" value="0">
        <div class="{{ $lesson->lesson_type == 'doc' ? 'col-12' : 'col-6' }}">
            <div class="mb-4">
                <label class="form-label">{{ __('title') }}</label>
                <input type="text" name="title" class="form-control rounded-2" id="videoLessonTitle"
                       placeholder="{{ __('enter_title') }}" value="{{ $lesson->title }}">
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
                    <select class="form-select form-select-lg mb-3 without_search lesson_source" name="source">
                        <option
                            value="upload" {{ $lesson->source == 'upload' ? 'selected' : '' }}>{{ __('upload') }}</option>
                        <option
                            value="youtube" {{ $lesson->source == 'youtube' ? 'selected' : '' }}>{{ __('youtube') }}</option>
                        <option
                            value="vimeo" {{ $lesson->source == 'vimeo' ? 'selected' : '' }}>{{ __('vimeo') }}</option>
                        <option value="mp4" {{ $lesson->source == 'mp4' ? 'selected' : '' }}>{{ __('mp4') }}</option>
                    </select>
                    <div class="nk-block-des text-danger">
                        <p class="source_error error"></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Video Source -->

        <div class="col-lg-6 lesson_upload_div {{ $lesson->source != 'upload' ? 'd-none' : '' }}">
            <div class="mb-3">
                <label for="edit_lesson_{{$lesson->id}}"
                       class="form-label">{{ __('upload') }}</label>
                <label for="edit_lesson_{{$lesson->id}}" class="file-upload-text">
                    <p class="file_name">{{ getFileName($lesson->source_data) }}</p>
                    <span class="file-btn">{{ __('choose_file') }}</span>
                </label>
                <input class="d-none thumb_picker" name="source_data" type="file" id="edit_lesson_{{$lesson->id}}">
                <div class="nk-block-des text-danger">
                    <p class="source_data_error error">{{ $errors->first('video_file') }}</p>
                </div>
            </div>
        </div>

        <div class="col-6 lesson_link {{ $lesson->source != 'upload' ? '' : 'd-none' }}">
            <div class="mb-4">
                <label class="form-label">{{ __('link') }}</label>
                <input type="text" class="form-control rounded-2" name="source_data" value="{{ $lesson->source_data }}"
                       placeholder="https://">
                <div class="nk-block-des text-danger">
                    <p class="source_data_error error"></p>
                </div>
            </div>
        </div>
        <!-- End Video Link -->
        @if($lesson->lesson_type != 'doc')
            <div class="col-6">
                <div class="mb-4">
                    <label class="form-label">{{ __('duration') }}</label>
                    <input type="text" name="duration" class="form-control rounded-2" placeholder="hh:mm:ss" value="{{ $lesson->duration }}">
                    <div class="nk-block-des text-danger">
                        <p class="duration_error error"></p>
                    </div>
                </div>
            </div>
            <!-- End Video Duration -->
        @endif

        <div class="col-lg-12">
            <div class="mb-4">
                <label class="form-label">{{ __('description') }}</label>
                <textarea class="form-control" name="description"
                          placeholder="{{ __('enter_description') }}">{{ $lesson->description }}</textarea>
            </div>
        </div>
        <!-- End Course Description -->

        @include('backend.common.media-input',[
                        'title' => 'Slider Image',
                        'name'  => 'image_media_id',
                        'col'   => 'col-12 mb-3',
                        'size'  => '(402x238)',
                        'label' => __('thumbnail'),
                        'image' => old('image_media_id', $lesson->image_media_id),
                        'edit'  => $lesson,
                        'image_object'  => $lesson->image,
                        'media_id'  => $lesson->image_media_id,
                    ])
        <!-- End Video Thumbnail -->
        <div class="col-lg-12 p-0">
            <div class="custom-checkbox">
                <label>
                    <input type="checkbox" name="is_free" value="1" {{ $lesson->is_free == 1 ? 'checked' : '' }}>
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
