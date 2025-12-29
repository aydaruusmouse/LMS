@extends('backend.layouts.master')
@section('title', __('miscellaneous_setting'))
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-lg-8 col-md-9">
                <h3 class="section-title">{{ __('miscellaneous_setting') }}</h3>
                <div class="bg-white redious-border pt-30 p-20 p-sm-30">
                    <div class="section-top">
                        <h6>{{__('miscellaneous_setting') }}</h6>
                    </div>
                    <form action="{{ route('miscellaneous.setting') }}" method="post"  enctype="multipart/form-data" class="form">@csrf
                        <input type="hidden" name="r" value="{{ url()->current() }}" class="r">
                        <input type="hidden" name="is_modal" value="0">


                        <div class="row gx-20">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="paginate" class="form-label">{{__('pagination_size') }}</label>
                                    <input type="text" class="form-control rounded-2" id="paginate"
                                           placeholder="{{__('pagination_size') }}" name="paginate" value="{{ old('paginate', setting('paginate') ) }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="paginate_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Pagination Size -->
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="api_paginate" class="form-label">{{__('api_pagination_size') }}</label>
                                    <input type="text" class="form-control rounded-2" id="api_paginate"
                                           placeholder="{{__('api_pagination_size') }}" name="api_paginate" value="{{ old('api_paginate', setting('api_paginate') ) }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="api_paginate_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End API Pagination  Size -->
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="index_form_pagination_size" class="form-label">{{__('index_form_pagination_size') }}</label>
                                    <input type="text" class="form-control rounded-2" id="index_form_pagination_size"
                                           placeholder="{{__('index_form_pagination_size') }}" name="index_form_pagination_size" value="{{ old('index_form_pagination_size', setting('index_form_pagination_size') ) }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="index_form_pagination_size_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Index Form Pagination Size -->

                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="media_paginate" class="form-label">{{__('media_pagination_size') }}</label>
                                    <input type="text" class="form-control rounded-2" id="media_paginate"
                                           placeholder="{{__('media_pagination_size') }}" name="media_paginate" value="{{ old('media_paginate', setting('media_paginate') ) }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="media_paginate_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Media pagination Size -->
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="order_prefix" class="form-label">{{__('invoice_prefix') }}</label>
                                    <input type="text" class="form-control rounded-2" id="order_prefix"
                                           placeholder="{{__('invoice_prefix') }}" name="order_prefix" value="{{ old('order_prefix', setting('order_prefix') ) }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="order_prefix_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Media pagination Size -->

                        </div>
                        <div class="d-flex justify-content-start align-items-center">
                            <button type="submit" class="btn sg-btn-primary">{{ __('update') }}</button>
                            @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $(document).on('change', '#default_storage', function () {
                var storage = $(this).val();
                if (storage == 'aws_s3') {
                    $('.aws_div').removeClass('d-none');
                    $('.wasabi_div').addClass('d-none');
                } else if (storage == 'wasabi') {
                    $('.aws_div').addClass('d-none');
                    $('.wasabi_div').removeClass('d-none');
                } else {
                    $('.aws_div').addClass('d-none');
                    $('.wasabi_div').addClass('d-none');
                }
            });
        });
    </script>
@endpush
