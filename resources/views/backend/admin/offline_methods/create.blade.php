@extends('backend.layouts.master')
@section('title', __('create_offline_method'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{ __('add_new_offline_method') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('offline-methods.store') }}" method="POST" class="form">@csrf
                            <div class="row gx-20 add-coupon">
                                <input type="hidden" class="is_modal" value="0"/>
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="name" class="form-label">{{ __('name') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control rounded-2" id="name" name="name"
                                               placeholder="{{ __('name') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="name_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Payment Type -->
                                <div class="col-lg-6">
                                    <div class="select-type-v2 mb-4">
                                        <label for="couponType"
                                               class="form-label">{{ __('payment_type') }}</label>
                                        <select class="mb-3 without_search" name="type" id="type">
                                            <option value="">{{ __('select_payment_type') }}</option>
                                            <option value="custom_payment">{{ __('custom_payment') }}</option>
                                            <option value="bank_payment">{{ __('bank_payment') }}</option>
                                            <option value="cheque_payment">{{ __('cheque_payment') }}</option>
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="type_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                @include('backend.admin.offline_methods.partials')
                                @include('backend.common.media-input',[
                                    'title' => __('banner'),
                                    'name'  => 'offline_method_media_id',
                                    'col'   => 'col-12 mb-4',
                                    'size'  => '(147x90)',
                                    'label' => __('image'),
                                    'image' => old('offline_method_media_id')
                                ])
                                <div class="col-lg-12">
                                    <textarea id="product-update-editor" name="instructions"></textarea>
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
@endpush
@push('js_asset')
    <!--====== media.js ======-->
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
@endpush
