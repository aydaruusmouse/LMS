@extends('backend.layouts.master')
@section('title', __('payout_request'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h3 class="section-title">{{ __('payout_request') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('payouts.store') }}" method="POST" class="form">@csrf
                            <div class="row gx-20 add-coupon">
                                <input type="hidden" class="is_modal" value="0"/>
                                <input type="hidden" name="admin_payout" value="admin">
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="paymentMethod " class="form-label">{{__('organization')}}</label>
                                        <div class="select-type-v2">
                                            <select id="organization " class="form-select form-select-lg mb-3 with_search organization_balance" name="organization" data-url="<?php echo e(route('ajax.organizations-balanceCheck')); ?>">
                                                <option value="">{{__('organization_name')}}</option>
                                                @foreach($organizations as $organization)
                                                    <option value="{{ $organization->id  }}">{{ $organization->org_name  }}</option>
                                                @endforeach
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
                                                    <option value="bank">{{__('bank')}}</option>
                                                @endif
                                                @if(setting('enable_paypal_payout'))
                                                     <option value="paypal">{{__('paypal')}}</option>
                                                 @endif
                                                 @if(setting('enable_payonner_payout'))
                                                    <option value="payoneer">{{__('payoneer')}}</option>
                                                 @endif
                                                  @if(setting('enable_bKash_payout'))
                                                    <option value="bKash">{{__('bKash')}}</option>
                                                  @endif
                                                  @if(setting('enable_nagad_payout'))
                                                    <option value="nagad">{{__('nagad')}}</option>
                                                  @endif
                                                  @if(setting('enable_mollie_payout'))
                                                    <option value="mollie">{{__('mollie')}}</option>
                                                  @endif
                                                  @if(setting('enable_skrill_payout'))
                                                    <option value="skrill">{{__('skrill')}}</option>
                                                  @endif
                                                  @if(setting('enable_sslCommerze_payout'))
                                                    <option value="sslCommerze">{{__('sslCommerze')}}</option>
                                                  @endif
                                                  @if(setting('enable_amarpay_payout'))
                                                     <option value="aamarpay">{{__('aamarpay')}}</option>
                                                  @endif
                                                  @if(setting('enable_hitPay_payout'))
                                                    <option value="hitPay">{{__('hitPay')}}</option>
                                                    @endif
                                                  @if(setting('enable_strip_payout'))
                                                     <option value="strip">{{__('strip')}}</option>
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
                                        <input type="text" class="form-control rounded-2" id="Amount" name="amount">
                                        <div class="nk-block-des text-danger">
                                            <p class="amount_error error">{{ $errors->first('amount') }}</p>
                                        </div>
                                        <div class="nk-block-des text-info">
                                            <p class="available_balance"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Amount -->
                                <div class="d-flex justify-content-between align-items-center mt-30">

                                    <div class="custom-checkbox">
                                        <label>
                                            <input type="checkbox" value="1" name="terms_and_conditions">
                                            <span>{{__('terms_and_conditions')}}</span>
                                        </label>
                                        <div class="nk-block-des text-danger">
                                            <p class="terms_and_conditions_error error">{{ $errors->first('terms_and_conditions') }}</p>
                                        </div>
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
    <!-- End Oftions Section -->
@endsection

