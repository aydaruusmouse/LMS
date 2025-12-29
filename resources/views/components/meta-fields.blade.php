<div class="{{ $meta_title_class ?? 'col-12' }}">
    <div class="mb-4">
        <label for="meta_title" class="form-label">{{ __('meta_title') }}</label>
        <input type="text" class="form-control rounded-2" id="meta_title" name="meta_title"
               placeholder="{{ __('enter_meta_title') }}" value="{{ $meta_title ?? '' }}">
        <div class="nk-block-des text-danger">
            <p class="meta_title_error error">{{ $errors->first('meta_title') }}</p>
        </div>
    </div>
</div>
<div class="{{ $meta_keywords_class ?? 'col-12' }}">
    <div class="mb-4">
        <label for="inputTagActive" class="form-label">{{ __('meta_keywords') }}</label>
        <input id="inputTagActive" type="text" class="form-control rounded-2" name="meta_keywords"
               placeholder="{{ __('enter_meta_keywords') }}" value="{{ $meta_keywords ?? '' }}">
        <div class="nk-block-des text-danger">
            <p class="meta_keywords_error error">{{ $errors->first('meta_keywords') }}</p>
        </div>
    </div>
</div>

@isset($is_input)
    <div class="{{ $meta_image_class ?? 'col-12'}}">
        <div class="col-lg-12 input_file_div mb-3">
            <div class="mb-3">
                <label for="logoUpload" class="form-label mb-1">{{ __('image') }} (1200x630)</label>
                <label for="logoUpload" class="file-upload-text">
                    <p>{{ isset($meta_image) && arrayCheck('image_80x80',$meta_image) ? getFileName($meta_image['image_80x80']) : '0 ' .__('file_selected') }} </p>
                    <span class="file-btn">{{ __('choose_file') }}</span>
                </label>
                <input class="d-none file_picker" type="file" name="meta_image" id="logoUpload">
            </div>
            <div class="selected-files d-flex flex-wrap gap-20">
                <div class="selected-files-item">
                    <img class="selected-img" src="{{  getFileLink('80x80',$meta_image ?? []) }}" alt="favicon">
                </div>
            </div>
        </div>
    </div>
@else
    @include('backend.common.media-input', [
        'title' => __('meta_image'),
        'name' => 'meta_image',
        'col' => 'col-12 mb-4',
        'size' => '(1200x630)',
        'label' => __('og_image'),
        'image' => $meta_image ?? [],
        'edit' => $meta_image ?? [],
        'image_object' => $meta_image ?? [],
        'media_id' => null,
    ])
@endisset


<div class="{{ $meta_description_class ?? 'col-12' }}">
    <div class="mb-4">
        <div class="d-flex justify-content-between">
            <label for="meta_description" class="form-label">{{ __('meta_description') }}</label>
            @include('backend.common.ai_btn', [
                'name' => 'ai_meta_description',
                'length' => '200',
                'topic' => 'ai_content_name',
                'use_case' => 'meta description',
            ])
        </div>
        <textarea class="form-control ai_meta_description" id="meta_description" name="meta_description"
                  placeholder="{{ __('enter_meta_description') }}">{{ $meta_description ?? '' }}</textarea>
        <div class="nk-block-des text-danger">
            <p class="meta_description_error error">{{ $errors->first('meta_description') }}</p>
        </div>
    </div>
</div>


@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/inputTags.min.css') }}">
@endpush
@push('js_asset')
    <script src="{{ static_asset('admin/js/inputTags.jquery.min.js') }}"></script>
@endpush
@push('js')
    <script>
        $("#inputTagActive").inputTags();
    </script>
@endpush
