@extends('frontend.layouts.master')
@section('title', __('view_cart'))
@section('content')
    <!--====== Start Cart Section ======-->
    <section class="cart-section p-t-50 p-t-sm-30 p-b-80 p-b-sm-50">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title-with-progress-bar m-b-50 m-b-sm-30 text-center">
                        <h4>{{__('view_cart')}}</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="cart-product-table m-b-15 m-b-sm-30 table-responsive">
                        <table class="table align-middle" style="min-width: 1000px;">
                            <thead>
                            <tr>
                                <th>{{__('course')}}</th>
                                <th>{{__('price')}}</th>
                                <th class="text-end">{{__('action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($carts['courses'] as $course)
                                <tr>
                                    <td class="w-50">
                                        <div class="cart-product product-type-course p-r-lg-60 p-r-100">
                                            <div class="book-thumbnail">
                                                <a href="{{ route('course.details', $course->slug) }}"><img
                                                        src="{{ getFileLink('295x248', $course->image) }}"
                                                        alt="product"></a>
                                            </div>
                                            <div class="book-text-content">
                                                <h6><a href="{{ route('course.details', $course->slug) }}"
                                                       class="title">{{ $course->title  }}</a></h6>
                                                <p class="author">{{__('by')}} <a
                                                        href="#">{{ $course->organization->org_name }}</a></p>
                                                <p class="file-type">{{ __('course')}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $course->is_free ? __('free') : get_price($course->price, userCurrency()) }}</td>
                                    <td class="text-end">
                                        <a href="{{ url("item/remove?id=$course->id&type=course") }}"
                                           data-id="{{ $course->id }}" data-type="course"
                                           class="remove-from-cart" data-toggle="tooltip"
                                           onclick="return confirm('{{__('are_you_sure')}}')" data-toggle="tooltip"
                                           data-original-title="{{ __('Delete') }}">{{__('delete')}}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">{{__('no_items_in_cart')}}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-lg-4 col-md-5 col-sm-6">
                    <div class="cart-product-calculation">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>{{ __('sub_total') }}</td>
                                <td class="sub_total">{{ get_price($user_carts->sum('sub_total'), userCurrency()) }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('discount') }}</td>
                                <td>{{ get_price($user_carts->sum('discount'), userCurrency()) }}</td>
                            </tr>
                            @if(auth()->check() && setting('coupon_system'))
                                <tr>
                                    <td>{{__('coupon_discount')}}</td>
                                    <td class="coupon_discount">{{ get_price($coupons->sum('coupon_discount'), userCurrency()) }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td>{{__('total')}}</td>
                                <td class="total">{{ get_price($user_carts->sum('total_amount') - $total_discount, userCurrency()) }}</td>
                            </tr>

                            </tbody>
                        </table>
                        @if(auth()->check() && setting('coupon_system'))
                            <div class="coupon-container">
                                <div class="applied_coupons">
                                    @foreach($coupons as $applied_coupon)
                                        @include('frontend.components.coupon')
                                    @endforeach
                                </div>

                                <form action="{{ route('apply.coupon') }}" class="coupon-input m-b-10"
                                      method="POST">@csrf
                                    <input type="text" class="form-control code error code_error" name="code"
                                           placeholder="{{__('apply_coupon_code')}}">
                                    <button type="submit" class="button">{{__('apply')}}</button>
                                    @include('components.frontend_loading_btn', ['class' => 'button'])
                                </form>
                                <div class="invalid-coupon-status d-none">
                                    <p><i class="fal fa-exclamation-circle"></i><span class="coupon_error"></span></p>
                                </div>
                            </div>
                        @endif
                        @if(count($user_carts) > 0)
                            @if($user_carts->sum('total_amount') > 0)
                                <a href="{{ route('checkout')  }}"
                                   class="template-btn d-block m-t-30 text-center">{{__('checkout')}}</a>
                            @else
                                <a href="{{ route('free.course') }}"
                                   class="template-btn d-block m-t-30 text-center">{{__('free_course')}}</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Cart Section ======-->
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $(document).on('submit', '.coupon-input', function (e) {
                e.preventDefault();
                let selector = this;
                let action = $(selector).attr("action");
                let method = $(selector).attr("method");
                let formData = new FormData(selector);
                if (!formData.get('code')) {
                    $('.invalid-coupon-status').removeClass('d-none');
                    $('.coupon_error').text('{{__('coupon_code_required')}}');
                    return false;
                }
                $(selector).find(".loading_button").removeClass("d-none");
                $(selector).find(":submit").addClass("d-none");

                $.ajax({
                    url: action,
                    method: method,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $(selector).find(".loading_button").addClass("d-none");
                        $(selector).find(":submit").removeClass("d-none");
                        if (response.success) {
                            $('.coupon_discount').text(response.coupon_discount);
                            $('.total').text(response.total);
                            $('.invalid-coupon-status').addClass('d-none');
                            $('.code').val('');
                            $('.applied_coupons').append(response.html);
                            toastr.success(response.success);
                        } else {
                            $('.invalid-coupon-status').removeClass('d-none');
                            $('.coupon_error').text(response.error);
                        }
                    },
                    error: function (response) {
                        $(selector).find(".loading_button").addClass("d-none");
                        $(selector).find(":submit").removeClass("d-none");
                        toastr.error(response.responseJSON.error);
                    },
                });
            });
        });
    </script>
@endpush
