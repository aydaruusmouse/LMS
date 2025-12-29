@extends('backend.layouts.master')
@section('title', __('organization'))
@section('content')
    <!-- Organisation Details -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="section-title">{{__('organisation_details') }}</h3>
                <div class="default-tab-list default-tab-list-v2 activeItem-bd-md bg-white redious-border p-20 p-sm-30">
                    @include('backend.admin.organization.topber')
                    <!-- End Organisation Details Tab -->
                    <form action="#">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="organisationOverview" role="tabpanel"
                                 aria-labelledby="overview" tabindex="0">
                                <div class="row mb-4">
                                    <div class="col-xxl-6 col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="bg-white redious-border p-20 p-sm-40 mb-4 mb-xxl-0">
                                                    <div class="analytics clr-1 analytics-v2">
                                                        <div class="analytics-icon">
                                                            <img src="{{ static_asset('admin/img/icons/profit.svg') }}"
                                                                 alt="Profit">
                                                        </div>

                                                        <div class="analytics-content">
                                                            <p>{{__('total_earning_amount') }}</p>
                                                            <h4>{{ get_price($total_earning, userCurrency()) }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Analytics -->

                                            <div class="col-lg-6 col-md-6">
                                                <div class="bg-white redious-border p-20 p-sm-40 mb-4 mb-xxl-0">
                                                    <div class="analytics clr-2 analytics-v2">
                                                        <div class="analytics-icon">
                                                            <img
                                                                src=" {{ static_asset('admin/img/icons/revenue.svg') }} "
                                                                alt="Profit">
                                                        </div>

                                                        <div class="analytics-content">
                                                            <p>{{__('total_withdraw_amount') }}</p>
                                                            <h4>$576835.00</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Analytics -->
                                        </div>
                                    </div>

                                    <div class="col-xxl-6 col-lg-12">
                                        <div class="row gy-24">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="bg-white redious-border mb-4 p-20 p-sm-30">
                                                    <div class="analytics clr-1">
                                                        <div class="analytics-icon">
                                                            <i class="las la-landmark"></i>
                                                        </div>

                                                        <div class="analytics-content">
                                                            <h4>{{ $total_course }}</h4>
                                                            <p>{{__('total_course') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Analytics -->

                                            <div class="col-lg-6 col-md-6">
                                                <div class="bg-white redious-border mb-4 p-20 p-sm-30">
                                                    <div class="analytics clr-2">
                                                        <div class="analytics-icon">
                                                            <i class="lar la-thumbs-up"></i>
                                                        </div>

                                                        <div class="analytics-content">
                                                            <h4>{{ $total_instructor }}</h4>
                                                            <p>{{__('total_instructor') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Analytics -->

                                            <div class="col-lg-6 col-md-6">
                                                <div class="bg-white redious-border mb-4 mb-md-0 p-20 p-sm-30">
                                                    <div class="analytics clr-3">
                                                        <div class="analytics-icon">
                                                            <i class="las la-hourglass-start"></i>
                                                        </div>

                                                        <div class="analytics-content">
                                                            <h4>{{ $total_student }}</h4>
                                                            <p>{{__('total_student') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Analytics -->

                                            <div class="col-lg-6 col-md-6">
                                                <div class="bg-white redious-border p-20 p-sm-30">
                                                    <div class="analytics clr-4">
                                                        <div class="analytics-icon">
                                                            <i class="las la-ban"></i>
                                                        </div>

                                                        <div class="analytics-content">
                                                            <h4>{{ $total_enrolls }}</h4>
                                                            <p>{{__('total_enrolment') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Analytics -->

                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="section-top">
                                            <h6>{{__('organisation_information') }}</h6>
                                            <div class=" d-flex gap-20">
                                                <a href="{{ route('organizations.settings', $organization->id) }}"><i
                                                        class="las la-cog"></i> <span>{{__('settings') }}</span></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="bg-white redious-border p-20 p-md-40 mb-4 mb-md-0">
                                            <div class="analytics clr-2 analytics-v3">
                                                <div class="analytics-icon">
                                                    <img src="{{ getFileLink('140x140',$organization->logo) }} "
                                                         alt="Organisation">
                                                </div>

                                                <div class="analytics-content">
                                                    <div class="analytics-head">
                                                        <h3>{{__($organization->org_name) }}</h3>
                                                    </div>
                                                    <div class="analytics-body">
                                                        <ul>
                                                            <li>{{__($organization->phone) }}</li>
                                                            <li>{{ $organization->email }}</li>
                                                            <li>{{__($organization->address) }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Analytics -->
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="bg-white redious-border p-20 p-md-40">
                                            <div class="analytics clr-2 analytics-v3">
                                                <div class="analytics-icon">
                                                    <img src="{{ getFileLink('140x140',$organization->person_image) }} "
                                                         alt="Organisation">
                                                </div>

                                                <div class="analytics-content">
                                                    <div class="analytics-head">
                                                        <h3>{{__($organization->person_name) }}</h3>
                                                        <span
                                                            class="designation">{{__($organization->person_designation) }}</span>
                                                    </div>
                                                    <div class="analytics-body">
                                                        <ul>
                                                            <li>{{__( $organization->person_phone) }}</li>
                                                            <li>{{ $organization->person_email }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Analytics -->
                                    </div>

                                </div>
                            </div>
                            <!-- END Overview Tab====== -->
@endsection
@include('backend.common.change-status-script')
