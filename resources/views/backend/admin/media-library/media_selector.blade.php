@if(count($medias) > 0)
    @foreach($medias as $media)
        <div class="col-auto">
            <div class="custom-checkbox custom-radio">
                <label>
                    <input class="media_selector" data-type="{{ $media->type }}" data-size="{{ formatBytes($media->size) }}" data-ext="{{ $media->extension }}" data-name="{{ $media->name }}"
                           data-url="{{ $media->type == 'image' ? getFileLink('80x80',$media->image_variants) : static_asset('images/default/default-'.$media->type.'-190x230.png') }}" name="media" type="checkbox" value="{{ $media->id }}">
                    <span class="redious-border-5 select-box"></span>
                    <div class="media-box">
                        <div class="media-card">
                            <div class="media-card-thumb">
                                @if($media->type == 'image' && @is_file_exists($media->image_variants['image_190x230'] , $media->storage))
                                    <img
                                        src="{{ get_media($media->image_variants['image_190x230'], $media->storage) }}"
                                        alt="{{ $media->name }}"
                                        class="imagecheck-image article-image">
                                @else
                                    <img
                                        src="{{ static_asset('images/default/default-'.$media->type.'-190x230.png') }}"
                                        alt="{{ $media->name }}"
                                        class="imagecheck-image article-image">
                                @endif
                            </div>
                            <div class="media-card-body">
                                <h6>{{ $media->name.'.'.$media->extension }}</h6>
                                <p>{{ formatBytes($media->size) }}</p>
                            </div>
                        </div>
                    </div>
                </label>
            </div>
        </div>
    @endforeach
    @else
    <div class="text-center">
        <p class="text-danger">{{ __('no_media_found') }}</p>
    </div>
@endif

