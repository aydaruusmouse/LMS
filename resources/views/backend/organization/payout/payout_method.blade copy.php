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
                            @include('backend.admin.payout.payout_gateways.bank')
                            @include('backend.admin.payout.payout_gateways.paypal')
                            @include('backend.admin.payout.payout_gateways.payonner')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
