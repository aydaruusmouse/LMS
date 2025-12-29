@props(['label', 'meta_image', 'id'])
@php
    // $media = \App\Models\MediaLibrary::find($meta_image);
    $media = $meta_image;

@endphp
<div class="col-12 mb-4 custom-image">
    <div class="mb-4 gallery-modal" data-for="image" data-selection="single">
        <label for="{{ $id }}" class="form-label mb-1">{{ $label }}</label>
        <label for="{{ $id }}" class="file-upload-text">
            <p>
                <span class="file_selected">
                    1
                </span>
                Files Selected
            </p>
            <span class="file-btn">Choose file</span>
        </label>
        <input class="d-none" type="hidden" name="meta_image" data-type="" id="{{ $id }}" value="">
    </div>
    <div class="selected-files d-flex flex-wrap gap-20">
        @if ($media)
            <div class="selected-files-item">
                <img src="{{ getFileLink('80x80', $media) }}" alt="gallery image" class="selected-img">
                <div class="remove-icon" data-id="">
                    <i class="las la-times"></i>
                </div>
            </div>
        @endif
        <div class="selected-files-item {{ $media ? 'd-none' : '' }}">
            <img class="selected-img" src="{{ static_asset('images/default/default-image-80x80.png') }}"
                alt="Headphone">
        </div>
    </div>
</div>
