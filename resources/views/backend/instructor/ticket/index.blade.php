@extends('backend.layouts.master')
@section('title', __('tickets'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="bg-white redious-border p-20 p-sm-30 pt-sm-30">
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="bg-white redious-border rounded-10 p-20 p-sm-30 mb-4 mb-xl-0">
                            <div class="analytics clr-4 system-support">
                                <div class="analytics-content">
                                    <p>{{ $open }}</p>
                                    <h4>{{ __('open_tickets') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="bg-white redious-border rounded-10 p-20 p-sm-30 mb-4 mb-xl-0">
                            <div class="analytics clr-2 system-support">
                                <div class="analytics-content">
                                    <p>{{ $hold }}</p>
                                    <h4>{{ __('on_hold') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="bg-white redious-border rounded-10 p-20 p-sm-30 mb-4 mb-md-0">
                            <div class="analytics clr-3 system-support">
                                <div class="analytics-content">
                                    <p>{{ $pending }}</p>
                                    <h4>{{ __('pending') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="bg-white redious-border rounded-10 p-20 p-sm-30">
                            <div class="analytics clr-1 system-support">
                                <div class="analytics-content">
                                    <p>{{ $close }}</p>
                                    <h4>{{ __('closed') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="header-top d-flex justify-content-between align-items-center">
                        <h3 class="section-title">{{__('tickets') }}</h3>
                        <div class="oftions-content-right mb-12">
                            <a href="{{ route('tickets.create') }}"
                               class="d-flex align-items-center btn sg-btn-primary gap-2">
                                <i class="las la-plus"></i>
                                <span>{{__('add_new_ticket') }}</span>
                            </a>
                        </div>
                    </div>

                    <div class="bg-white redious-border p-20 p-sm-30 pt-sm-30">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="default-list-table  yajra-dataTable">
                                    {{ $dataTable->table() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('backend.common.delete-script')
@endsection
@push('js')
    {{ $dataTable->scripts() }}
@endpush
