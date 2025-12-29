@extends('backend.layouts.master')
@section('title', __('payout_method'))
@section('content')
    <!-- Organisation Details -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="section-title">{{__('organisation_details') }}</h3>
                <div class="default-tab-list default-tab-list-v2 activeItem-bd-md bg-white redious-border p-20 p-sm-30">
                    @include('backend.admin.organization.topber')
                    <div class="row align-items-center g-20">
                        @if(setting('enable_paypal_payout'))
                            @include('backend.admin.organization.payout.payout_gateways.paypal', compact('organization'))
                        @endif
                        @if(setting('enable_bank_payout'))
                            @include('backend.admin.organization.payout.payout_gateways.bank', compact('organization'))
                        @endif
                        @if(setting('enable_payonner_payout'))
                            @include('backend.admin.organization.payout.payout_gateways.payonner', compact('organization'))
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
