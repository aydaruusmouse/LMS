@extends('backend.layouts.master')
@section('title', __('reply_ticket'))
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="section-title">{{ __('edit_reply') }}</h3>
                <div class="bg-white redious-border p-20 p-sm-30">
                    <form action="{{ route('ticket.reply.update',$reply->id) }}" class="form" method="post">@csrf
                        <input type="hidden" class="is_modal" value="0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="editor-wrapper mb-4">
                                    <label class="form-label mb-1" for="product-update-editor">{{ __('reply') }}</label>
                                    <textarea id="product-update-editor" name="reply">{!! $reply->reply !!}</textarea>
                                    <div class="nk-block-des text-danger">
                                        <p class="reply_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Text Editor -->

                            @include('backend.common.media-input',[
                                        'title' => 'Slider Image',
                                        'name'  => 'file_media_id',
                                        'col'   => 'col-12 mt-4',
                                        'size'  => '',
                                        'label' => __('file'),
                                        'for' => '',
                                        'selection' => 'multiple',
                                        'image' => $reply->file,
                                        'edit'  => $reply,
                                        'image_object'  => $reply->image,
                                        'media_id'  => $reply->file_media_id,
                                    ])
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-30">
                            <button type="submit" class="btn sg-btn-primary">{{ __('save') }}</button>
                            @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                        </div>
                    </form>
                </div>
                <!-- END Add Reply Tab====== -->
            </div>
        </div>
    </div>
    @include('backend.common.gallery-modal')
@endsection

@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@push('js_asset')
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
@endpush
@push('js')
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
@endpush
