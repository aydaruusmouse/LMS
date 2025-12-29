@isset($edit)
    @php
        $image = $image_object;
    @endphp
    <div class="{{ $col }} custom-image">
        <div class="mb-4 gallery-modal" data-for="{{ $for ?? 'image' }}" data-selection="{{ $selection ?? 'single' }}">
            <label for="apkThumb"
                   class="form-label mb-1">{{ $label }}
                {{ $size }}</label>
            <label for="apkThumb" class="file-upload-text">
                <p>
                    <span class="file_selected"></span>
                    {{ __('files_selected') }}
                </p>
                <span class="file-btn">{{ __('choose_file') }}</span>
            </label>
            <input class="d-none" type="hidden" name="{{ $name }}" data-type="{{ $type ?? '' }}" id="apkThumb"
                   value="{{ old('image') ? old('image') : ($media_id ? : '') }}">
        </div>
        <div class="selected-files d-flex flex-wrap gap-20">
            @if($image)
                <div class="selected-files-item">
                    @if (arrayCheck('image_80x80',$image) && is_file_exists($image['image_80x80'], $image['storage']))
                        <img
                            src="{{ getFileLink('80x80',$image) }}"
                            alt="gallery image"
                            class="selected-img">
                    @else
                        <img src="{{ static_asset('images/default/default-image-80x80.png') }}"
                             data-default="{{ static_asset('images/default/default-image-80x80.png') }}"
                             alt="category-banner" class="selected-img">
                    @endif
                    <div class="remove-icon" data-id="{{ $media_id }}">
                        <i class='las la-times'></i>
                    </div>
                </div>
            @endif
            <div class="selected-files-item {{ $image && arrayCheck('image_80x80',$image) && is_file_exists($image['image_80x80'], $image['storage']) ? 'd-none' : '' }}">
                <img class="selected-img"
                     src="{{ static_asset('images/default/default-image-80x80.png') }}"
                     alt="Headphone">
            </div>
        </div>
    </div>
@else
    @php
        $media = '';
        if ($image) {
            $media = \App\Models\MediaLibrary::find($image);
        }
    @endphp
    <div class="{{ $col }} custom-image">
        <div class="mb-4 gallery-modal" data-for="{{ $for ?? 'image' }}" data-selection="{{ $selection ?? 'single' }}">
            <label for="apkThumb" class="form-label mb-1">{{ $label }}
                {{ $size }}</label>
            <label for="apkThumb" class="file-upload-text">
                <p><span
                        class="file_selected">{{ $media && $media->image_variants && arrayCheck('image_80x80',$media->image_variants) && is_file_exists($media->image_variants['image_80x80'], $media->image_variants['storage']) ? 1 : '0' }} </span>{{ __('files_selected') }}
                </p>
                <span class="file-btn">{{ __('choose_file') }}</span>
            </label>
            <input class="d-none" type="hidden" name="{{ $name }}" data-type="{{ $type ?? '' }}" id="apkThumb"
                   value="{{ $image }}">
        </div>
        <div class="selected-files d-flex flex-wrap gap-20">
            @if($media)
                <div class="selected-files-item">
                    @if (arrayCheck('image_80x80',$media->image_variants) && is_file_exists($media->image_variants['image_80x80'], $media->image_variants['storage']))
                        <img
                            src="{{ getFileLink('80x80',$media->image_variants) }}"
                            alt="{{ $media->name }}"
                            class="selected-img">
                    @else
                        <img src="{{ static_asset('images/default/default-image-80x80.png') }}"
                             data-default="{{ static_asset('images/default/default-image-80x80.png') }}"
                             alt="category-banner" class="selected-img">
                    @endif
                    <div class="remove-icon" data-id="{{ $media->id }}">
                        <i class='las la-times'></i>
                    </div>
                </div>
            @endif
            <div class="selected-files-item {{ $media && arrayCheck('image_80x80',$media->image_variants) && is_file_exists($media->image_variants['image_80x80'], $media->image_variants['storage']) ? 'd-none' : '' }}">
                <img class="selected-img"
                     src="{{ static_asset('images/default/default-image-80x80.png') }}"
                     alt="Headphone">
            </div>
        </div>
    </div>
@endif
