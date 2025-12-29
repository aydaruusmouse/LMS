@extends('backend.layouts.master')
@section('title', __('create_new_category'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{ __('create_new_category') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('category.store') }}" method="POST" class="form">@csrf
                            <div class="row gx-20 add-coupon">
                                <input type="hidden" class="is_modal" value="0"/>
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="title" class="form-label">{{ __('title') }}</label>
                                        <input type="text" class="form-control rounded-2 ai_content_name" id="title" name="title"
                                               placeholder="{{ __('enter_title') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="title_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="ordering" class="form-label">{{ __('order') }}</label>
                                        <input type="number" class="form-control rounded-2" id="ordering" name="ordering"
                                               placeholder="e.g.10">
                                        <div class="nk-block-des text-danger">
                                            <p class="ordering_error error"></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- End Select Instructor -->
                                <div class="col-lg-12 category_div">
                                    <div class="multi-select-v2 mb-4">
                                        <label for="select_category"
                                               class="form-label">{{ __('select_parent_category') }}</label>
                                        <select id="select_category" name="parent_id" data-route="{{ route('ajax.categories') }}"
                                                class="multiple-select-1 form-select-lg rounded-0 mb-3"
                                                aria-label=".form-select-lg example">
                                                <option value="0"></option>
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="parent_id_error error"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-12 sandbox_mode_div mb-4">
                                    <input type="hidden" name="is_featured" value="1">
                                    <label class="form-label"
                                           for="is_featured">{{ __('is_featured') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="is_featured"
                                               class="sandbox_mode" checked>
                                        <label for="is_featured"></label>
                                    </div>
                                </div>


                                @include('backend.common.media-input',[
                                    'title' => __('image'),
                                    'name'  => 'image_media_id',
                                    'col'   => 'col-12 mb-4',
                                    'size'  => '(828x490)',
                                    'label' => __('image'),
                                    'image' => old('image_media_id')
                                ])

                                <input type="hidden" name="type" value="course">

                                @include('components.meta-fields')

                                <div class="d-flex justify-content-end align-items-center mt-30">
                                    <button type="submit" class="btn sg-btn-primary">{{__('submit') }}</button>
                                    @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('backend.common.gallery-modal')
    <!-- End Oftions Section -->
@endsection
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@push('js_asset')
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/ai_writer.js') }}"></script>
@endpush
@push('js')
    <script src="{{ static_asset('admin/js/media.js') }}"></script>

    <script>
        $(document).ready(function () {
            searchCategory($('#select_category'));
        });
    </script>
@endpush
