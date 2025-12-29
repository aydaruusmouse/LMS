@extends('backend.layouts.master')
@section('title', __('payment_history'))
@section('content')
    <div class="container-fluid">
        <div class="row gx-20">
            <div class="col-lg-12">
                <h3 class="section-title">{{__('payment_history')}}</h3>
                <div class="bg-white redious-border p-20 p-sm-30 mb-4">
                    @if(request()->routeIs('backend.admin.report.payment_history'))
                        <form action="{{ route('backend.admin.report.payment_history') }}" method="GET">
                            <div class="row gx-20">
                                <div class="col">
                                    <div class="select-type-v2">
                                        <label for="paymentType" class="form-label">{{__('payment_type')}}</label>
                                        <select id="paymentType" class="form-select form-select-lg mb-3 without_search"
                                                aria-label=".form-select-lg example" name="payment_type">
                                            <option value="" selected>{{__('all')}}</option>
                                                <option {{ $payment_type == 'bank' ? 'selected': '' }} value="bank">{{__('bank')}}</option>
                                                <option {{ $payment_type == 'paypal' ? 'selected': '' }} value="paypal">{{__('paypal')}}</option>
                                                <option {{ $payment_type == 'payoneer' ? 'selected': '' }} value="payoneer">{{__('payoneer')}}</option>
                                                <option {{ $payment_type == 'bKash' ? 'selected': '' }} value="bKash">{{__('bKash')}}</option>
                                                <option {{ $payment_type == 'nagad' ? 'selected': '' }} value="nagad">{{__('nagad')}}</option>
                                                <option {{ $payment_type == 'mollie' ? 'selected': '' }} value="mollie">{{__('mollie')}}</option>
                                                <option {{ $payment_type == 'skrill' ? 'selected': '' }} value="skrill">{{__('skrill')}}</option>
                                                <option {{ $payment_type == 'sslCommerze' ? 'selected': '' }} value="sslCommerze">{{__('sslCommerze')}}</option>
                                                <option {{ $payment_type == 'aamarpay' ? 'selected': '' }} value="aamarpay">{{__('aamarpay')}}</option>
                                                <option {{ $payment_type == 'hitPay' ? 'selected': '' }} value="hitPay">{{__('hitPay')}}</option>
                                                <option {{ $payment_type == 'stripe' ? 'selected': '' }} value="stripe">{{__('stripe')}}</option>

                                        </select>
                                    </div>
                                </div>
                                <!-- End Payment Type -->

                                <div class="col">
                                    <div class="mb-20">
                                        <label for="dateRangePicker"
                                               class="form-label">{{ __('data_range') }} </label>
                                        <input id="dateRangePicker" name="dateRange" type="text"
                                               class="form-control rounded-2" placeholder="{{ __('select_date') }}" name="date_range" value="{{ $dateRange }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="dateRange_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Data Range -->
                                <div class="col-lg-3">
                                    <button type="submit" class="btn sg-btn-primary py-2 w-100 mt-sm-30 mt-0">{{__('filter')}}</button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
                <div class="bg-white redious-border p-20 p-sm-30">
                    <div class="row mb-30">
                        <div class="col-lg-12">
                            <div class="default-list-table table-responsive yajra-dataTable">
                                {{ $dataTable->table() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/daterangepicker.css') }}">
@endpush
@push('js_asset')
    <!--====== media.js ======-->
    <script src="{{ static_asset('admin/js/moment.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/daterangepicker.js') }}"></script>
@endpush
@push('js')
    {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function () {
            $('#dateRangePicker').daterangepicker({
                autoUpdateInput: false
            });
        });
    </script>
@endpush
