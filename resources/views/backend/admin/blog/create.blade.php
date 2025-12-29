@extends('backend.layouts.master')
@section('title', __('create_blog'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('create_blog') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <div class="row">
                            <form action="{{ route('blogs.store') }}" class="form-validate form" method="POST" enctype="multipart/form-data">@csrf
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="title" class="form-label">{{__('title') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control rounded-2 ai_content_name" id="title"
                                               name="title"
                                               placeholder="{{ __('enter_title') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="title_error error">{{ $errors->first('title') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="is_modal" value="0"/>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="category" class="form-label">{{__('category') }} <span
                                                class="text-danger">*</span></label>
                                        <select name="blog_category_id" class="with_search" id="category">
                                            <option value="">{{ __('select_category') }}</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="blog_category_id_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="status" class="form-label">{{__('status') }}</label>
                                        <select name="status" class="without_search" id="status">
                                            <option value="published">{{ __('published') }}</option>
                                            <option value="draft">{{ __('draft') }}</option>
                                            <option value="pending">{{ __('pending') }}</option>
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="status_error error"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-12 sandbox_mode_div mb-4">
                                    <input type="hidden" name="is_featured" value="1">
                                    <label class="form-label"
                                           for="is_featured">{{ __('is_featured') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="is_featured"
                                               class="sandbox_mode">
                                        <label for="is_featured"></label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between">
                                            <label for="category" class="form-label">{{__('short_description') }} <span
                                                    class="text-danger">*</span> </label>
                                            @include('backend.common.ai_btn',[
                                                    'name' => 'ai_short_description',
                                                    'length' => '200',
                                                    'topic' => 'ai_content_name',
                                                    'use_case' => 'short description for blog',
                                                   ])
                                        </div>
                                        <textarea class="form-control ai_short_description" name="short_description"
                                                  placeholder="{{ __('enter_short_description') }}"></textarea>
                                        <div class="nk-block-des text-danger">
                                            <p class="short_description_error error"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="editor-wrapper mb-4">
                                        <div class="d-flex justify-content-between">
                                            <label for="description" class="form-label">{{__('description') }}</label>
                                            @include('backend.common.ai_btn',[
                                                    'name' => 'ai_long_description',
                                                    'length' => '259',
                                                    'topic' => 'ai_content_name',
                                                     'long_description' => 1,
                                                    'use_case' => 'long description for blog',
                                                   ])
                                        </div>
                                        <textarea class="template-body ai_long_description" id="product-update-editor"
                                                  name="description"></textarea>
                                        <div class="nk-block-des text-danger">
                                            <p class="description_error error">{{ $errors->first('content') }}</p>
                                        </div>
                                    </div>
                                </div>

                                @include('backend.common.media-input',[
                                    'title' => __('image'),
                                    'name'  => 'image_media_id',
                                    'col'   => 'col-12 mb-4',
                                    'size'  => '(406x240)',
                                    'label' => __('image'),
                                    'image' => old('image_media_id')
                                ])

                                @include('components.meta-fields')

                                <div class="d-flex justify-content-end align-items-center mt-30">
                                    <button type="submit" class="btn sg-btn-primary">{{__('submit') }}</button>
                                    @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                                </div>
                            </form>
                        </div>

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
    <!--====== media.js ======-->
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/ai_writer.js') }}"></script>
@endpush
@push('js')
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
@endpush
