<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ 'Faculty - LMS Online Education Course HTML Template || Successful Order' }}</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        a {
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease-out 0s;
            text-decoration: none;
        }

        ul,
        ol {
            margin: 0px;
            padding: 0px;
            list-style-type: none;
        }

        .mt-20 {
            margin-top: 20px;
        }

        .mt-55 {
            margin-top: 55px;
        }

        .mb-40 {
            margin-bottom: 40px;
        }

        .mb-15 {
            margin-bottom: 15px;
        }

        .mb-30 {
            margin-bottom: 30px;
        }

        .mr-16 {
            margin-right: 16px;
        }

        .text-ctr {
            text-align: center
        }

        .fw-medium {
            font-weight: 500 !important;
        }

        .fw-semibold {
            font-weight: 600 !important;
        }

        .color-secondary {
            color: #25ab7c;
        }

        .text-al {
            text-align: left !important;
        }

        .text-al-right {
            text-align: right;
        }

        .float-left {
            float: left;
        }

        .float-right {
            float: right;
        }

        .clearfix:after {
            content: "";
            visibility: hidden;
            display: block;
            height: 0;
            clear: both;
        }

        .invoice-wrapper {
            border-radius: 3px;
            background: #fff;
            box-shadow: 0px 7px 40px 0px rgba(0, 0, 0, 0.10);
            padding: 20px 30px;
        }

        .invoice-logo svg,
        .invoice-logo img {
            width: 180px;
            height: 48px;
        }

        .invoice-meta {
            margin: 20px 0 30px;
        }

        .invoice-info-box {
            text-align: right;
        }

        .invoice-info-box h4 {
            color: #333;
            font-size: 20px;
            font-weight: 600;
        }

        .invoice-info-box ul li {
            color: #666;
            font-size: 16px;
            font-weight: 400;
        }

        .invoice-meta {
            border-top: 1px solid #dcdcdc;
            border-bottom: 1px solid #dcdcdc;
            padding: 12px 0;
        }

        .invoice-meta p {
            color: #666;
            font-size: 16px;
            font-weight: 500;
        }

        .cart-product-table .table {
            border-color: #eeeeee;
        }

        .cart-product-table .table.table-v2 tr td:first-child {
            padding-left: 20px;
            border-left: 1px solid #eeeeee;
        }

        .cart-product-table .table tr td {
            font-size: 16px;
            font-weight: 400;
            padding: 20px 0;
            border-color: #555;
        }

        .invoice-table .table.table-v2 thead th {
            color: #FFF;
            background-color: #25ab7c;
            padding: 15px;
        }

        .cart-product-table .table.table-v2 thead th {
            padding: 14px 0;
            border-color: red .0;
            border-top: 1px solid #eeeeee;
        }

        .cart-product-table .table th {
            font-size: 16px;
            font-weight: 600;
        }

        .cart-product-table .table tbody {
            border-top: 0;
        }

        .invoice-table .table tr td {
            padding: 15px;
            border: 1px solid #eeeeee;
        }

        .cart-product-table .table tr td {
            color: #666;
            font-size: 16px;
            font-weight: 400;
            padding: 20px 0;
            border-color: #eeeeee;
        }

        .cart-product-table .table tr td a {
            color: #333;
            font-size: 16px;
            font-weight: 500;
        }

        .cart-product-table .cart-product .book-text-content h6 {
            font-weight: 600;
            font-size: 18px;
            line-height: 25px;
            margin-bottom: 5px;
        }

        .cart-product-table .cart-product .book-text-content .author {
            color: #666;
            font-size: 12px;
            font-weight: 400;
            display: inline-block;
        }

        .cart-product-table .cart-product .book-text-content .author a {
            color: #666;
            font-size: 12px;
            font-weight: 400;
        }

        .authorised-sign p {
            color: #666666;
            text-align: center;
            font-size: 16px;
            font-weight: 400;
            border-top: 1px solid #eeeeee;
        }

        .invoice-btns p {
            color: #666666;
            font-size: 16px;
            font-weight: 400;
        }
    </style>

</head>

<body>

<div class="invoice-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="invoice-wrapper">
                    <div class="invoice-header">
                        <div class="dashboard-logo float-left">
                            <a href="{{ route('home') }}" class="sticky-logo">
                                {{-- <img src="https://lms.spagreen.net/public/frontend/img/logo.png" alt="logo" height="30"> --}}
                                <img src="{{ $logo_url }}" alt="logo" height="30">
                            </a>
                        </div>

                        <div class="invoice-info-box float-right">
                            <h4>{{ setting('system_name') }}</h4>
                            <ul>
                                <li>{{ setting('phone') }}</li>
                                <li>{{ setting('email_address') }}</li>
                                <li>{{ setting('address') }}</li>
                            </ul>
                        </div>

                        <div class="clearfix"></div>

                        <div class="invoice-meta mt-20 mb-40">
                            <p class="float-left">{{ __('invoice') }} : {{ $checkout->invoice_no }}</p>
                            <p class="float-right">{{ __('date') }} :
                                {{ Carbon\Carbon::parse($checkout->invoice_date)->format('Y-m-d') }}</li>
                            </p>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!-- End Invoice Header -->

                    <div class="invoice-content">
                        <div class="invoice-info-box float-left text-al mb-30">
                            <h4 class="mb-15">{{ __('customer_details') }}</h4>
                            <ul>
                                <li>{{ $checkout->user->name }}</li>
                                <li>{{ $checkout->user->phone }}</li>
                                <li>{{ $checkout->user->email }}</li>
                                <li>{{ $checkout->user->address }}</li>
                            </ul>
                        </div>

                        <div class="clearfix"></div>

                        <div class="cart-product-table invoice-table mb-15 table-responsive">
                            <table class="table table-v2 align-middle" cellspacing="0"
                                   style="min-width: 100% !important;">
                                <thead>
                                <tr>
                                    <th>{{ __('item') }}</th>
                                    <th>{{ __('price') }}</th>
                                    <th>{{ __('quantity') }}</th>
                                    <th>{{ __('subtotal') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($checkout->enrolls as $enroll)
                                    <tr>
                                        <td>
                                            <div class="cart-product">
                                                <div class="book-text-content">
                                                    <h6><a
                                                            href="{{ route('course.details', $enroll->enrollable->slug) }}">{{ $enroll->enrollable->title }}</a>
                                                    </h6>
                                                    <p class="author">{{ __('by') }} :
                                                        {{ @$enroll->enrollable->organization->org_name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ get_price($enroll->price,$currency_code) }}</td>
                                        <td>{{ $enroll->quantity }}</td>
                                        <td class="text-al-right">{{ get_price($enroll->price,$currency_code) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <p>{{ __('subtotal') }}</p>
                                        <p>{{ __('discount') }}</p>
                                        @if($checkout->coupon_discount > 0)
                                            <p>{{ __('coupon_discount') }}</p>
                                        @endif
                                    </td>
                                    <td class="text-al-right">
                                        <p>{{ get_price($checkout->sub_total,$currency_code) }}</p>
                                        <p>{{ get_price($checkout->discount,$currency_code) }}</p>
                                        @if($checkout->coupon_discount > 0)
                                            <p>{{ get_price($checkout->coupon_discount,$currency_code) }}</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <p class="color-secondary fw-semibold">{{ __('grand_total') }}</p>
                                    </td>
                                    <td class="text-al-right">
                                        <p class="color-secondary fw-semibold">
                                            {{ get_price($checkout->payable_amount,$currency_code) }}</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="authorised-sign float-left text-ctr mt-55">
                            {{--                                <img src="http://localhost/lms/public/frontend/img/signature.png" alt="Signature"> --}}
                            <p>{{ __('authorised_sign') }}</p>
                        </div>
                        <div class="clearfix"></div>

                        <div class="invoice-btns">
                            <span>{{ setting('copyright_title', app()->getLocale()) }}</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
