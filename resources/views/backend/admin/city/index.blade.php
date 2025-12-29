@extends('backend.layouts.master')
@section('title', __('currency'))
@section('content')
    <!-- Currency -->
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-top d-flex justify-content-between align-items-center">
                        <h3 class="section-title">{{__('cities') }}</h3>
                        @if(hasPermission('cities.create'))
                            <div class="oftions-content-right mb-12">
                                <a href="#" class="d-flex align-items-center btn sg-btn-primary gap-2"
                                   data-bs-toggle="modal" data-bs-target="#city">
                                    <i class="las la-plus"></i>
                                    <span>{{__('add') }} {{__('city') }}</span>
                                </a>
                            </div>
                        @endif
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
    @include('backend.admin.city.city')
    <div class="modal fade" id="edit_city" tabindex="-1" aria-labelledby="editCityLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <h6 class="sub-title">{{__('edit_city') }}</h6>
                <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="form_div"></div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    {{ $dataTable->scripts() }}
@endpush
