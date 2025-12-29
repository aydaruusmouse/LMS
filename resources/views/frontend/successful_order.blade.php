@extends('frontend.layouts.master')
@section('title', __('order_success'))
@section('content')
    <!--====== Start Successful Order Section ======-->
    <section class="sucessful-order-section p-t-50 p-t-sm-30 p-b-80 p-b-sm-50">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title-with-progress-bar m-b-sm-45 m-b-70 text-center">
                        <h4>{{__('successful_order')}}</h4>
                        <p>{{__('order_id')}}: {{ $checkout->invoice_no }}</p>
                        <div class="progress-bar-wrapper">
                            <div class="progress-bar-container">
                                <div class="progress-bar" style="width: 100%"></div>
                                <div class="indicator" style="inset-inline-start: auto; inset-inline-end: 0px">
                                    <i class="fas fa-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gx-3 gx-md-4 simple-image-box-wrapper m-b-sm-0 m-b-20">
                <div class="col-md-6 col-6">
                    <div class="simple-text-infobox height-100 m-b-30">
                        <h6>{{__('account_info')}}:</h6>
                        <ul>
                            <li>{{__('name')}}: {{ auth()->user()->name }}</li>
                            <li>{{__('email')}}: {{ auth()->user()->email }}</li>
                            @if(auth()->user()->phone)
                                <li>Phone: {{ auth()->user()->phone }}</li>
                            @endif
                            @if(auth()->user()->country)
                                <li>{{__('country')}}: {{ auth()->user()->country->name }}</li>
                            @endif
                            @if(auth()->user()->state)
                                <li>{{__('state')}}: {{ auth()->user()->state->name }}</li>
                            @endif
                            @if(auth()->user()->city)
                                <li>{{__('city')}}: {{ auth()->user()->city->name }}</li>
                            @endif
                            @if(auth()->user()->postal_code)
                                <li>{{__('postal_code')}}: {{ auth()->user()->postal_code }}</li>
                            @endif
                            @if(auth()->user()->address)
                                <li>{{__('street_address')}}: {{ auth()->user()->address }}</li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-6">
                    <div class="simple-text-infobox height-100 m-b-30">
                        <h6>{{__('other_info')}}:</h6>
                        <ul>
                            <li>{{__('order_date')}}: {{ Carbon\Carbon::parse($checkout->invoice_date)->format('Y-m-d') }}</li>
                            <li>{{__('order_status')}}: Completed</li>
                            <li>{{__('phone')}}: {{ auth()->user()->phone }}</li>
                            <li>{{__('payment_type')}}: {{ $checkout->formatted_payment_type }}</li>
                            <li>{{__('payment_status')}}: Paid</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="cart-product-table m-t-sm-20 m-b-15 m-b-sm-30 table-responsive">
                        <table class="table table-v2 align-middle" style="min-width: 700px;">
                            <thead>
                            <tr>
                                <th>{{__('name')}}</th>
                                <th>{{__('price')}}</th>
                                <th>{{__('quantity')}}</th>
                                <th>{{__('sub_total')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($checkout->enrolls as $enroll)
                                <tr>
                                    @if($enroll->enrollable_type == 'App\Models\Course')
                                        <td>
                                            <div class="cart-product">
                                                <div class="book-text-content">
                                                    <h6><a href="{{ route('course.details',$enroll->enrollable->slug) }}">{{ $enroll->enrollable->title }}</a></h6>
                                                    <p class="author">By <a href="#">{{ @$enroll->enrollable->organization->org_name }}</a></p>
                                                </div>
                                            </div>
                                        </td>
                                    @else
                                        <td>
                                            <div class="cart-product">
                                                <div class="book-text-content">
                                                    <h6><a href="book-details.html">{{ $enroll->enrollable->title }}</a></h6>
                                                    <p class="author">{{__('by')}} <a href="#">{{ @$enroll->enrollable->instructor->name }}</a></p>
                                                    <p class="file-type">{{__('hard_copy')}}</p>
                                                </div>
                                            </div>
                                        </td>
                                    @endif
                                    <td>{{ get_price($enroll->price, userCurrency()) }}</td>
                                    <td>{{ $enroll->quantity }}</td>
                                    <td>{{ get_price($enroll->sub_total, userCurrency()) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end align-items-end">
                <div class="col-lg-8">
                    <a href="{{route('my-course',$checkout->enrolls[0]->enrollable->slug)}}" class="template-btn bordered-btn d-block text-center">{{__('start_learning')}}</a>
                </div>
                <div class="col-lg-4 col-md-5 col-sm-6">
                    <div class="cart-product-calculation">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>{{__('subtotal')}}</td>
                                <td>{{ get_price($checkout->sub_total, userCurrency()) }}</td>
                            </tr>
<!--                            <tr>
                                <td>Tax</td>
                                <td>{{ get_price($checkout->tax, userCurrency()) }}</td>
                            </tr>-->
                            <tr>
                                <td>{{__('discount')}}</td>
                                <td>{{ get_price($checkout->discount, userCurrency()) }}</td>
                            </tr>
<!--                            <tr>
                                <td>Shipping Cost</td>
                                <td>{{ get_price($checkout->shipping_cost, userCurrency()) }}</td>
                            </tr>-->
                            <tr>
                                <td>{{__('coupon_discount')}}</td>
                                <td>{{ get_price($checkout->coupon_discount, userCurrency()) }}</td>
                            </tr>
                            <tr>
                                <td>{{__('total')}}</td>
                                <td>{{ get_price($checkout->payable_amount, userCurrency()) }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <a href="{{route('download.invoice',$checkout->trx_id)}}" class="template-btn">{{__('download_invoice')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Successful Order Section ======-->
@endsection
