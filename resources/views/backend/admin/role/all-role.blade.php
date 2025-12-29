@extends('backend.layouts.master')
@section('title', __('staff_role'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-top d-flex justify-content-between align-items-center">
                        <h3 class="section-title">{{__('staff_role') }}</h3>
                        @if(hasPermission('roles.create'))
                            <div class="oftions-content-right mb-12">
                                <a href="{{ route('roles.create') }}" class="d-flex align-items-center btn sg-btn-primary gap-2">
                                    <i class="las la-plus"></i>
                                    <span>{{__('add_role') }}</span>
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="bg-white rounded-20 p-20 p-sm-30">
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
    </section> <!-- End Oftions Section -->
@endsection
@include('backend.common.delete-script')
@push('js')
    {{ $dataTable->scripts() }}
@endpush
