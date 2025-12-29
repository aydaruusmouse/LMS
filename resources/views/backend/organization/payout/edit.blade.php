@extends('backend.layouts.master')
@section('title', __('edit_payout_request'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h3 class="section-title">{{__('edit_payout_request') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <div class="row">
                            <form action="{{ route('payouts.update',$payout->id) }}" class="form-validate form"
                                  method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <input type="hidden" name="id" value="{{ $payout->id }}">
                                    <input type="hidden" class="is_modal" value="0"/>
                                    <input type="hidden" value="1" name="terms_and_conditions">
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="paymentMethod " class="form-label">{{__('organization')}}</label>
                                            <div class="select-type-v2">
                                                <select id="organization " class="form-select form-select-lg mb-3 with_search organization_balance" name="organization" data-url="<?php echo e(route('ajax.organizations-balanceCheck')); ?>">
                                                        <option value="{{ $payout->organization_id  }}" selected>{{ $payout->organization->org_name  }}</option>
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="organization_error error">{{ $errors->first('organization_id') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Payment Method -->
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="paymentMethod " class="form-label">{{__('payment_method')}}</label>
                                            <div class="select-type-v2">
                                                <select id="paymentMethod " class="form-select form-select-lg mb-3 with_search" name="payment_method">
                                                    <option value="">{{__('payment_method')}}</option>
                                                    @if(setting('enable_bank_payout'))
                                                        <option {{ $payout->payment_method == 'bank' ? 'selected': '' }} value="bank">{{__('bank')}}</option>
                                                    @endif
                                                    @if(setting('enable_paypal_payout'))
                                                        <option {{ $payout->payment_method == 'paypal' ? 'selected': '' }} value="paypal">{{__('paypal')}}</option>
                                                    @endif
                                                    @if(setting('enable_payonner_payout'))
                                                        <option {{ $payout->payment_method == 'payoneer' ? 'selected': '' }} value="payoneer">{{__('payoneer')}}</option>
                                                    @endif
                                                    @if(setting('enable_bKash_payout'))
                                                        <option {{ $payout->payment_method == 'bKash' ? 'selected': '' }} value="bKash">{{__('bKash')}}</option>
                                                    @endif
                                                    @if(setting('enable_nagad_payout'))
                                                        <option {{ $payout->payment_method == 'nagad' ? 'selected': '' }} value="nagad">{{__('nagad')}}</option>
                                                    @endif
                                                    @if(setting('enable_mollie_payout'))
                                                        <option {{ $payout->payment_method == 'mollie' ? 'selected': '' }} value="mollie">{{__('mollie')}}</option>
                                                    @endif
                                                    @if(setting('enable_skrill_payout'))
                                                        <option {{ $payout->payment_method == 'skrill' ? 'selected': '' }} value="skrill">{{__('skrill')}}</option>
                                                    @endif
                                                    @if(setting('enable_sslCommerze_payout'))
                                                        <option {{ $payout->payment_method == 'sslCommerze' ? 'selected': '' }} value="sslCommerze">{{__('sslCommerze')}}</option>
                                                    @endif
                                                    @if(setting('enable_aamarpay_payout'))
                                                        <option {{ $payout->payment_method == 'aamarpay' ? 'selected': '' }} value="aamarpay">{{__('aamarpay')}}</option>
                                                    @endif
                                                    @if(setting('enable_hitPay_payout'))
                                                        <option {{ $payout->payment_method == 'hitPay' ? 'selected': '' }} value="hitPay">{{__('hitPay')}}</option>
                                                    @endif
                                                    @if(setting('enable_strip_payout'))
                                                        <option {{ $payout->payment_method == 'strip' ? 'selected': '' }} value="strip">{{__('strip')}}</option>
                                                    @endif
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="payment_method_error error">{{ $errors->first('payment_method') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Payment Method -->

                                    <div class="col-lg-12">
                                        <div class="">
                                            <label for="Amount" class="form-label">{{__('amount')}}</label>
                                            <input type="text" class="form-control rounded-2" id="Amount" name="amount" value="{{$payout->amount}}">
                                            <div class="nk-block-des text-danger">
                                                <p class="amount_error error">{{ $errors->first('amount') }}</p>
                                            </div>
                                            <div class="nk-block-des text-info">
                                                <p class="available_balance">{{__('available_balance') }} {{ get_price($balance, userCurrency()) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Amount -->

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
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/moment.min.js') }}"></script>
@endpush
@push('js')
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
@endpush
