@extends('backend.layouts.master')
@section('title', __('edit_on_board'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('edit_on_board')}}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('onboards.update', $onboard->id) }}" method="POST"
                                enctype="multipart/form-data" class="form">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="0" class="is_modal" name="is_modal">
                            <input type="hidden" value="{{ $onboard->id }}" name="onboard_id">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="title" class="form-label">{{__('title')}}</label>
                                        <input type="text" class="form-control rounded-2" id="title" name="title"
                                                value="{{ $onboard->title }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="title_error error">{{ $errors->first('title') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Title -->

                                <div class="col-lg-12">
                                    <label for="description" class="form-label">{{__('description')}}</label>
                                    <div class=" mb-4">
                    <textarea
                        class="form-control"
                        placeholder="Leave a comment here"
                        id="description"
                        name="description">{{ $onboard->description }}</textarea>
                                        <div class="nk-block-des text-danger">
                                            <p class="description_error error">{{ $errors->first('description') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Description -->
                                @include('backend.common.media-input',[
                                        'title' => 'On-board image',
                                        'name'  => 'image',
                                        'col'   => 'col-12',
                                        'size'  => '(350x150)',
                                        'image' => $onboard->image,
                                        'label' => __('select_image'),
                                        'edit'  => $onboard,
                                        'image_object'  => $onboard->image,
                                        'media_id'  => $onboard->onboard_media_id,
                                    ])
                                <!-- End Select Image -->

                                <div class="d-flex justify-content-between align-items-center mt-30">
                                    <div class="d-flex gap-12">
                                        <label for="skipable">{{__('skipable')}}</label>
                                        <div class="setting-check">
                                            <input type="checkbox" id="skipable"
                                                    name="is_skipable" {{ ($onboard->is_skipable == 1) ? 'checked' : ''  }}>
                                            <label for="skipable"></label>
                                        </div>
                                    </div>
                                    @if(hasPermission('onboards.edit'))
                                        <button type="submit"
                                                class="btn sg-btn-outline-primary">{{__('update')}}</button>
                                        @include('backend.common.loading-btn',['class' => 'btn sg-btn-outline-primary'])
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- End Oftions Section -->

    @include('backend.common.gallery-modal')
@endsection
@push('js')
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
@endpush
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@push('js_asset')
    <!--====== media.js ======-->
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
@endpush
