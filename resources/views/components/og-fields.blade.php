<div class="pageTitle">
    <h6 class="sub-title">{{ __('open_graph') }}</h6>
</div>
<div class="{{ $og_title_class ?? 'col-12'}}">
    <div class="mb-4">
        <label for="og_title" class="form-label">{{__('og_title') }}</label>
        <input type="text" class="form-control rounded-2" id="og_title" name="og_title"
               placeholder="{{ __('enter_og_title') }}" value="{{ $og_title ?? '' }}">
        <div class="nk-block-des text-danger">
            <p class="og_title_error error">{{ $errors->first('og_title') }}</p>
        </div>
    </div>
</div>

<div class="{{ $og_description_class ?? 'col-12'}}">
    <div class="mb-4">
        <label for="og_description" class="form-label">{{__('og_description') }}</label>
        <textarea class="form-control" id="og_description" name="og_description" placeholder="{{ __('enter_og_description') }}">{{ $og_description ?? '' }}</textarea>
        <div class="nk-block-des text-danger">
            <p class="og_description_error error">{{ $errors->first('og_description') }}</p>
        </div>
    </div>
</div>

<div class="{{ $meta_image_class ?? 'col-12'}}">
    <div class="col-lg-12 input_file_div mb-3">
        <div class="mb-3">
            <label for="ogUpload" class="form-label mb-1">{{ __('image') }} (1200x630)</label>
            <label for="ogUpload" class="file-upload-text">
                <p>{{ isset($og_image) && arrayCheck('image_80x80',$og_image) ? getFileName($og_image['image_80x80']) : '0 ' .__('file_selected') }}</p>
                <span class="file-btn">{{ __('choose_file') }}</span>
            </label>
            <input class="d-none file_picker" type="file" name="og_image" id="ogUpload">
        </div>
        <div class="selected-files d-flex flex-wrap gap-20">
            <div class="selected-files-item">
                <img class="selected-img" src="{{  getFileLink('80x80',$og_image ?? []) }}" alt="favicon">
            </div>
        </div>
    </div>
</div>
