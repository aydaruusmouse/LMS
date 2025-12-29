@extends('backend.layouts.master')
@section('title', __('payout_method'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{ __('payout_method') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30 pt-sm-30">
                        <div class="row align-items-center g-20">
                            @if(setting('enable_paypal_payout'))
                                 @include('backend.organization.payout.payout_gateways.paypal', compact('instructor'))
                            @endif
                            @if(setting('enable_bank_payout'))
                                @include('backend.organization.payout.payout_gateways.bank', compact('instructor'))
                            @endif
                            @if(setting('enable_payonner_payout'))
                                @include('backend.organization.payout.payout_gateways.payonner', compact('instructor'))
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
