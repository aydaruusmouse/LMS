@if($source == 'mp4' || $source == 'upload')
    <video class="{{ $class }}" playsinline controls
           @if($image)
               data-poster="{{ getFileLink($size, $image) }}"
        @endif>
        <source
            src="{{ $source == 'upload' ? get_media(getArrayValue('image',$video),getArrayValue('storage',$video)) : $video }}"
            type="video/mp4"/>
    </video>
@else
    <div class="{{ $class }} yt_player"
         @if($image)
             data-poster="{{ getFileLink($size, $image) }}"
         @endif
         data-plyr-provider="{{ $source }}"
         data-plyr-embed-id="{{ $video }}"
    ></div>
@endif
