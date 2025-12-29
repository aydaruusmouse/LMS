@extends('backend.layouts.master')
@section('title', __('edit_blog_category'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('edit_blog_category') }}</h3>
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
                            <form action="{{ route('blog-categories.update',$category->id) }}" class="form-validate form" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $category->id }}">
                                <input type="hidden" value="{{ $lang }}" name="lang">
                                <input type="hidden" value="{{ $category_language->translation_null == 'not-found' ? '' : $category_language->id }}" name="translate_id">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="title" class="form-label">{{__('title') }} <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control rounded-2" id="title" name="title"
                                               placeholder="{{ __('enter_title') }}" value="{{ $category_language->title }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="title_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="is_modal" value="0"/>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="link" class="form-label">{{__('slug') }}</label>
                                        <input type="text" class="form-control rounded-2" id="slug" name="slug"
                                               placeholder="{{ __('enter_slug') }}" value="{{ $category->slug }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="slug_error error"></p>
                                        </div>
                                    </div>
                                </div>

                                @include('components.meta-fields',[
                                                    'meta_title' => $category_language->meta_title,
                                                    'meta_keywords' => $category_language->meta_keywords,
                                                    'meta_description' => $category_language->meta_description,
                                                    'meta_image' => $category->meta_image,
                                                    'edit' => $category,
])

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
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@push('js')
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
@endpush
