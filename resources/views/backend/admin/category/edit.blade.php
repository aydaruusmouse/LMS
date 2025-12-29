@extends('backend.layouts.master')
@section('title', __('edit_category'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('edit_category') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form>
                            <div class="col-lg-12">
                                <input type="hidden" name="r" value="{{ url()->current() }}" class="r">
                                <div class="mb-4">
                                    <label for="lang" class="form-label">{{__('language') }}</label>
                                    <select id="lang"
                                            class="form-select form-select-lg mb-3 with_search" name="lang">
                                        <option value="">{{__('select_language') }}</option>
                                        @foreach($languages as $language)
                                            <option
                                                value="{{ $language->locale }}" {{ $lang == $language->locale ? 'selected' : '' }}>{{ $language->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="nk-block-des text-danger">
                                        <p class="lang_error error">{{ $errors->first('lang') }}</p>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form action="{{ route('category.update',$category->id) }}" class="form-validate form"
                              method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $category->id }}">
                            <input type="hidden" value="{{ $lang }}" name="lang">
                            <input type="hidden" value="{{ $category_language->translation_null == 'not-found' ? '' : $category_language->id }}" name="translate_id">
                            <div class="row gx-20 add-coupon">
                                <input type="hidden" class="is_modal" value="0"/>
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="title" class="form-label">{{ __('title') }}</label>
                                        <input type="text" class="form-control rounded-2 ai_content_name" id="title" name="title"
                                               placeholder="{{ __('enter_title') }}"
                                               value="{{ $category_language->title }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="title_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="slug" class="form-label">{{ __('slug') }}</label>
                                        <input type="text" class="form-control rounded-2" id="slug" name="slug"
                                               placeholder="{{ __('enter_slug') }}" value="{{ $category->slug }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="slug_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="ordering" class="form-label">{{ __('order') }}</label>
                                        <input type="number" class="form-control rounded-2" id="ordering" name="ordering"
                                               placeholder="e.g.10" value="{{ $category->ordering }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="ordering_error error"></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- End Select Instructor -->
                                <div class="col-lg-12 category_div">
                                    <div class="multi-select-v2 mb-4">
                                        <label for="select_category"
                                               class="form-label">{{ __('select_category') }}</label>
                                        <select id="select_category" name="parent_id" data-route="{{ route('ajax.categories',['excluded_ids' => [$category->id,$category->parent_id] ]) }}"
                                                class="multiple-select-1 form-select-lg rounded-0 mb-3"
                                                aria-label=".form-select-lg example">
                                            @if($parent_category)
                                                <option value="{{ $parent_category->id }}" selected>{{ $parent_category->title }}</option>
                                            @endif
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="category_ids_error error"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-12 sandbox_mode_div mb-4">
                                    <input type="hidden" name="is_featured" value="{{ $category->is_featured }}">
                                    <label class="form-label"
                                           for="is_featured">{{ __('is_featured') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="is_featured"
                                               class="sandbox_mode" {{ $category->is_featured == 1 ? 'checked' : '' }}>
                                        <label for="is_featured"></label>
                                    </div>
                                </div>


                                @include('backend.common.media-input',[
                                    'title' => __('image'),
                                    'name'  => 'image_media_id',
                                    'col'   => 'col-12 mb-4',
                                    'size'  => '(828x490)',
                                    'label' => __('image'),
                                    'image' => $category->image,
                                    'edit'  => $category,
                                    'image_object'  => $category->image,
                                    'media_id'  => $category->image_media_id,
                                ])

                                @include('components.meta-fields',[
                                                'meta_title' => $category_language->meta_title,
                                                'meta_keywords' => $category_language->meta_keywords,
                                                'meta_description' => $category_language->meta_description,
                                                'meta_image' => $category->meta_image,
                                                'edit' => $category,
                                            ])

                                <div class="d-flex justify-content-end align-items-center mt-30">
                                    <button type="submit" class="btn sg-btn-outline-primary">{{__('submit') }}</button>
                                    @include('backend.common.loading-btn',['class' => 'btn btn-primary'])
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('backend.common.gallery-modal')
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
