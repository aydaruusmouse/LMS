@extends('backend.layouts.master')
@section('title', __('currency'))
@section('content')
    <!-- Currency -->
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-top d-flex justify-content-between align-items-center">
                        <h3 class="section-title">{{__('currencies') }}</h3>
                        <div class="oftions-content-right mb-12">
                            @if(hasPermission('set.currency.format'))
                                <a href="#" class="d-flex align-items-center btn sg-btn-primary gap-2"
                                   data-bs-toggle="modal" data-bs-target="#currency_format">
                                    <i class="las la-plus"></i>
                                    <span>{{__('currency_formats') }}</span>
                                </a>
                            @endif
                            @if(hasPermission('currencies.create'))
                                <a href="#" class="d-flex align-items-center btn sg-btn-primary gap-2"
                                   data-bs-toggle="modal" data-bs-target="#currency">
                                    <i class="las la-plus"></i>
                                    <span>{{__('add') }} {{__('currency') }}</span>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="bg-white redious-border p-20 p-sm-30 pt-sm-30">
                        <div class="row">
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
    </section>
    @include('backend.common.delete-script')
    @include('backend.admin.currency.currency')
    @include('backend.admin.currency.currency_formats')
@endsection
@push('js')
    {{ $dataTable->scripts() }}
@endpush
