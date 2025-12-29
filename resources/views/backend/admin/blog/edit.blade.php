@extends('backend.layouts.master')
@section('title', __('edit_blog'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('edit_blog') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <div class="row">
                            <form>
                                <div class="col-lg-12">
                                    <input type="hidden" name="r" value="{{ url()->current() }}" class="r">
                                    <div class="mb-4">
                                        <label for="lang" class="form-label">{{__('language') }}</label>
                                        <select id="lang"
                                                class="form-select form-select-lg mb-3 with_search" name="lang">
                                            <option value="">{{__('select_language') }}</option>
                                            @foreach($languages as $language)
                                                <option value="{{ $language->locale }}" {{ $lang == $language->locale ? 'selected' : '' }}>{{ $language->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="lang_error error">{{ $errors->first('lang') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('blogs.update',$blog->id) }}" class="form-validate form" method="POST"
                                enctype="multipart/form-data">@csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $blog->id }}">
                                <input type="hidden" value="{{ $lang }}" name="lang">
                                <input type="hidden" value="{{ $blog_language->translation_null == 'not-found' ? '' : $blog_language->id }}" name="translate_id">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="title" class="form-label">{{__('title') }} <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control rounded-2 ai_content_name" id="title" name="title"
                                               placeholder="{{ __('enter_title') }}" value="{{ $blog_language->title }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="title_error error">{{ $errors->first('title') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="is_modal" value="0"/>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="link" class="form-label">{{__('slug') }}</label>
                                        <input type="text" class="form-control rounded-2" id="link" name="slug"
                                               placeholder="{{ __('enter_slug') }}" value="{{ $blog->slug }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="slug_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="category" class="form-label">{{__('category') }} <span class="text-danger">*</span> </label>
                                        <select name="blog_category_id" class="with_search" id="category">
                                            <option value="">{{ __('select_category') }}</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $blog->blog_category_id == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
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
                                            <option value="published" {{ $blog->status == "published" ? 'selected' : '' }}>{{ __('published') }}</option>
                                            <option value="draft" {{ $blog->status == "draft" ? 'selected' : '' }}>{{ __('draft') }}</option>
                                            <option value="pending" {{ $blog->status == "pending" ? 'selected' : '' }}>{{ __('pending') }}</option>
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
                                        <input type="checkbox" value="{{ $blog->is_featured }}" id="is_featured"
                                               class="sandbox_mode"
                                               {{ $blog->is_featured == "1" ? 'checked' : '' }}>
                                        <label for="is_featured"></label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-4">
                                        <div class="f-dlex justify-content-between">
                                            <label for="category" class="form-label">{{__('short_description') }} <span class="text-danger">*</span> </label>
                                            @include('backend.common.ai_btn',[
                                                        'name' => 'ai_short_description',
                                                        'length' => '259',
                                                        'topic' => 'ai_content_name',
                                                        'use_case' => 'short description for blog',
                                                       ])
                                        </div>
                                        <textarea class="form-control ai_short_description" name="short_description" placeholder="{{ __('enter_short_description') }}">{{ $blog_language->short_description }}</textarea>
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
                                                    'use_case' => 'long description for blog',
                                                    'long_description' => 1

                                                   ])
                                        </div>
                                        <textarea class="template-body" id="product-update-editor" name="description">{!! $blog_language->description !!}</textarea>
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
                                    'image' => $blog->image,
                                    'edit'  => $blog,
                                    'image_object'  => $blog->image,
                                    'media_id'  => $blog->image_media_id,
                                ])


                                @include('components.meta-fields',[
                                                    'meta_title' => $blog_language->meta_title,
                                                    'meta_keywords' => $blog_language->meta_keywords,
                                                    'meta_description' => $blog_language->meta_description,
                                                    'meta_image' => $blog->meta_image,
                                                    'edit' => $blog,])

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
