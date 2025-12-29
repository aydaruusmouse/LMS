@extends('backend.layouts.master')
@section('title', __('edit_testimonial'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('edit_testimonial') }}</h3>
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
                            <form action="{{ route('testimonials.update',$testimonial->id) }}" class="form-validate form"
                                  method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <input type="hidden" name="id" value="{{ $testimonial->id }}">
                                    <input type="hidden" value="{{ $lang }}" name="lang">
                                    <input type="hidden"
                                           value="{{ $testimonial_language->translation_null == 'not-found' ? '' : $testimonial_language->id }}"
                                           name="translate_id">
                                    <input type="hidden" class="is_modal" value="0"/>
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="name" class="form-label">{{ __('name') }}</label>
                                            <input type="text" class="form-control rounded-2 ai_content_name" id="name"
                                                   name="name"
                                                   placeholder="{{ __('name') }}"
                                                   value="{{ $testimonial_language->name }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="name_error error"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Success Description -->
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <div class="d-flex justify-content-between">
                                                <label for="description" class="form-label">{{ __('description') }}</label>
                                                @include('backend.common.ai_btn',[
                                                        'name' => 'ai_short_description',
                                                        'length' => '200',
                                                        'topic' => 'ai_content_name',
                                                        'use_case' => 'short testimonial description for an learning website',
                                                       ])
                                            </div>
                                            <textarea class="form-control ai_short_description" id="description" name="description">{{ __($testimonial->description)  }}</textarea>
                                            <div class="nk-block-des text-danger">
                                                <p class="description_error error"></p>
                                            </div>
                                        </div>
                                    </div>
                                    @include('backend.common.media-input',[
                                        'title' => __('image'),
                                        'name'  => 'media_id',
                                        'col'   => 'col-12 mb-4',
                                        'size'  => '(282x282)',
                                        'label' => __('image'),
                                        'image' => $testimonial->image,
                                        'edit'  => $testimonial,
                                        'image_object'  => $testimonial->image,
                                        'media_id'  => $testimonial->media_id,
                                    ])
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
        </div>
    </section>
    @include('backend.common.gallery-modal')
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
