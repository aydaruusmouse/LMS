@foreach($medias as $key => $media)
    <div class="col-auto">
        <div class="custom-checkbox">
            <label>
                <input type="checkbox" data-name="{{ $media->name }}" data-text="{{ get_media($media->original_file, $media->storage) }}" class="select_media" value="{{ $media->id }}">
                <span class="redious-border-5 select-box"></span>
                    <div class="media-box">
                        <div class="media-box-interaction">
                            <div class="media-info-box">
                                <a href="#" class="info-icon">
                                    <i class="las la-ellipsis-v"></i>
                                </a>
                                <ul class="info-box">
                                    <li><a class="file_info" data-media="{{ json_encode($media) }}" data-file_url="{{ get_media($media->original_file, $media->storage) }}"
                                           data-created_at="{{ Carbon\Carbon::parse($media->created_at)->format('d M Y') }}"
                                           data-uploaded_by="{{ @$media->user->name }}"
                                           data-file_size="{{ formatBytes($media->size) }}" data-bs-toggle="modal" data-bs-target="#file_info" href="javascript:void(0)">{{ __('file_information') }}</a></li>
                                    <li><a href="{{ get_media($media->original_file, $media->storage) }}"
                                           target="_blank"
                                           download="{{ $media->name }}.{{ $media->extension }}">{{ __('download_file') }}</a></li>
                                    <li><a href="javascript:void(0)" data-text="{{ get_media($media->original_file, $media->storage) }}" class="copy_text">{{ __('copy_link') }}</a></li>
                                    <li><a href="javascript:void(0)"
                                           onclick="delete_row('{{ route('organization.media.destroy') }}',{{ $media->id }},true)"
                                           data-toggle="tooltip"
                                           data-original-title="{{ __('Delete') }}">{{ __('delete_file') }}</a></li>
                                </ul>
                            </div>
                        </div>
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
<div class="pagination_container">
    @if($medias->total() > 0)
        <div class="pagination pt-20">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-between">

                    <div class="col-lg-6 col-sm-6">
                        <div class="pagination-content-left">
                            {{ __('showing') }} {{ $medias->firstItem() }} {{ __('to') }} {{ $medias->lastItem() }} {{ __('of') }} {{ $medias->total() }}
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6">
                        <div class="pagination-content-right d-sm-flex justify-content-end">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    {{ $medias->appends([
                                        'type'          => $type,
                                        'q'             => $q,
                                        'start_date'    => $start_date,
                                        'end_date'      => $end_date,
                                        ])->links('vendor.pagination.bootstrap-4') }}
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif
</div>
<!-- End pagination -->
