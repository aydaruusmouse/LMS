@extends('backend.layouts.master')
@section('title', __('languages'))
@section('content')

    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mb-30 justify-content-end">
                        <div class="col-lg-12">
                            <div class="header-top d-flex justify-content-between align-items-center">
                                <h3 class="section-title">{{__('languages') }}</h3>
                                @if(hasPermission('languages.create'))
                                    <div class="oftions-content-right mb-12">
                                        <a href="javascript:void(0)" data-bs-target="#language" data-bs-toggle="modal"
                                           class="d-flex align-items-center btn sg-btn-primary gap-2">
                                            <i class="las la-plus"></i>
                                            <span>{{__('add_language') }}</span>
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="bg-white redious-border p-20 p-sm-30 pt-sm-30">
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
    @include('backend.admin.language.form')
@endsection
@include('backend.common.delete-script')
@push('js')
    {{ $dataTable->scripts() }}
@endpush
