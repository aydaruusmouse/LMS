@extends('backend.layouts.master')
@section('title', __('testimonial'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{ __('add_new_testimonial') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('testimonials.store') }}" method="POST" class="form">@csrf
                            <div class="row gx-20 add-coupon">
                                <input type="hidden" class="is_modal" value="0"/>
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="name" class="form-label">{{ __('name') }}</label>
                                        <input type="text" class="form-control rounded-2 ai_content_name" id="name" name="name"
                                               placeholder="{{ __('name') }}">
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
                                        <textarea class="form-control ai_short_description" id="description" name="description"></textarea>
                                        <div class="nk-block-des text-danger">
                                            <p class="description_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                @include('backend.common.media-input',[
                                    'title' => __('image'),
                                    'name'  => 'testimonial_media_id',
                                    'col'   => 'col-12 mb-4',
                                    'size'  => '(282x282)',
                                    'label' => __('image'),
                                    'image' => old('testimonial_media_id')
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
