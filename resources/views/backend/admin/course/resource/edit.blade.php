<form action="{{ route('resources.update',$resource->id) }}" method="post" class="form"
      enctype="multipart/form-data">@csrf
    @method('PUT')
    <div class="row gx-20">
        <div class="col-6">
            <div class="mb-4">
                <label class="form-label">{{ __('title') }}</label>
                <input type="text" name="title" class="form-control rounded-2"
                       placeholder="{{ __('enter_title') }}" value="{{ $resource->title }}">
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
                    <input id="datePicker" type="text" name="deadline" value="{{ \Carbon\Carbon::parse($resource->deadline)->format('m/d/Y') }}"
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
                            <option value="{{ $instructor->id }}" {{ $resource->instructor_id == $instructor->id ? 'selected' : '' }}>{{ $instructor->name }}</option>
                        @endforeach
                    </select>
                    <div class="nk-block-des text-danger">
                        <p class="instructor_id_error error"></p>
                    </div>
                </div>
            </div>
        @endif


        <div class="col-12">
            <div class="mb-4">
                <label for="description" class="form-label">{{__('description') }}</label>
                <textarea class="summernote" id="description" name="description">{!! $resource->description !!}</textarea>
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
                        'label' => __('file'),
                        'image' => old('file_media_id', $resource->file_media_id),
                        'edit'  => $resource,
                        'image_object'  => $resource->media->image_variants ?? '',
                        'media_id'  => $assignment->file_media_id,
                    ])
        <!-- End Video Thumbnail -->
        <div class="col-lg-12 p-0">
            <div class="custom-checkbox">
                <label>
                    <input type="checkbox" name="is_free" value="1" {{ $resource->is_free == 1 ? 'checked' : '' }}>
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
