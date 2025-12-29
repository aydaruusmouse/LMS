@extends('backend.layouts.master')
@section('title', __('brand'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{ __('add_new_brand') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('brands.store') }}" method="POST" class="form">@csrf
                            <div class="row gx-20 add-coupon">
                                <input type="hidden" class="is_modal" value="0"/>
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="order_no" class="form-label">{{ __('order_no') }}</label>
                                        <input type="text" class="form-control rounded-2" id="order_no" name="order_no"
                                               placeholder="{{ __('order_no') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="order_no_error error"></p>
                                        </div>
                                    </div>
                                </div>

                                @include('backend.common.media-input',[
                                    'title' => __('logo'),
                                    'name'  => 'brand_media_id',
                                    'col'   => 'col-12 mb-4',
                                    'size'  => '(195x34)',
                                    'label' => __('logo'),
                                    'image' => old('brand_media_id')
                                ])
                                <div class="nk-block-des text-danger">
                                    <p class="brand_media_id_error error"></p>
                                </div>
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
    <link rel="stylesheet" href="{{ static_asset('admin/css/daterangepicker.css') }}">
@endpush
@push('js_asset')
    <!--====== media.js ======-->
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/moment.min.js') }}"></script>
@endpush
@push('js')
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
@endpush
