@extends('backend.layouts.master')
@section('title', __('organization'))
@section('content')

    <!-- Organisation List -->
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('organization_list') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <div class="row">
                            <div class="col-xxl-3 col-lg-6 col-md-6 mb-20 mb-xxl-0">
                                <div class="bg-white redious-border p-20 p-sm-30">
                                    <div class="analytics clr-1">
                                        <div class="analytics-icon">
                                            <i class="las la-landmark"></i>
                                        </div>

                                        <div class="analytics-content">
                                            <h4>{{ $organizations }}</h4>
                                            <p>{{__('total_organisation') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-6 col-md-6 mb-20 mb-xxl-0">
                                <div class="bg-white redious-border p-20 p-sm-30">
                                    <div class="analytics clr-2">
                                        <div class="analytics-icon">
                                            <i class="lar la-thumbs-up"></i>
                                        </div>

                                        <div class="analytics-content">
                                            <h4>{{ $approved_organizations }}</h4>
                                            <p>{{__('approved_organisation') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-6 col-md-6 mb-20 mb-lg-0">
                                <div class="bg-white redious-border p-20 p-sm-30">
                                    <div class="analytics clr-3">
                                        <div class="analytics-icon">
                                            <i class="las la-hourglass-start"></i>
                                        </div>

                                        <div class="analytics-content">
                                            <h4>{{ $suspend_organizations }}</h4>
                                            <p>{{__('suspend_organisation') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-6 col-md-6">
                                <div class="bg-white redious-border p-20 p-sm-30">
                                    <div class="analytics clr-4">
                                        <div class="analytics-icon">
                                            <i class="las la-ban"></i>
                                        </div>

                                        <div class="analytics-content">
                                            <h4>{{ $inactive_organizations }}</h4>
                                            <p>{{__('inactive_organization') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Pagination -->
                    </div>
                    <div class="bg-white redious-border p-20 p-sm-30 mt-30">
                        <div class="row mb-20">
                            <div class="col-lg-12">
                                <div class="default-list-table table-responsive yajra-dataTable">
                                    {{ $dataTable->table() }}
                                    {{-- {{ $dataTable->table(['class' => 'dt-responsive'], true) }} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@include('backend.common.change-status-script')
@include('backend.common.delete-script')

@push('js')
    {{ $dataTable->scripts() }}
@endpush
