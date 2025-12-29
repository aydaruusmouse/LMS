@extends('backend.layouts.master')
@section('title', __('add_on_board'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('add_on_board')}}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('onboards.store') }}" method="POST" enctype="multipart/form-data"
                                class="form">
                            @csrf
                            <input type="hidden" value="0" class="is_modal" name="is_modal">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="title" class="form-label">{{__('title')}}</label>
                                        <input type="text" class="form-control rounded-2" id="title" name="title"
                                                value="{{ old('title') }}" placeholder="{{ __('title') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="title_error error">{{ $errors->first('title') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Title -->

                                <div class="col-lg-12">
                                    <label for="description" class="form-label">{{__('description')}}</label>
                                    <div class="mb-4">
                                        <textarea class="form-control" id="description"
                                                    name="description"></textarea>
                                        {{-- <label for="description">{{__('write_something_here') }} ...</label> --}}
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
                                    'image' => old('image'),
                                    'label' => __('select_image')

                                ])
                                <!-- End Select Image -->

                                <div class="d-flex justify-content-between align-items-center mt-30">
                                    <div class="d-flex gap-12">
                                        <label for="skipable">{{__('skipable')}}</label>
                                        <div class="setting-check">
                                            <input type="checkbox" id="skipable" checked name="is_skipable">
                                            <label for="skipable"></label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn sg-btn-outline-primary">{{__('save')}}</button>
                                    @include('backend.common.loading-btn',['class' => 'btn sg-btn-outline-primary'])
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
