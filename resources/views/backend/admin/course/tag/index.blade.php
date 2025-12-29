@extends('backend.layouts.master')
@section('title', __('tags'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col col-lg-8 col-md-9">
                    <div class="header-top d-flex justify-content-between align-items-center">
                        <h3 class="section-title">{{__('tags') }}</h3>
                        @if(hasPermission('tag.create'))
                            <div class="oftions-content-right mb-12">
                                <a href="#" class="d-flex align-items-center btn sg-btn-primary gap-2"
                                   data-bs-toggle="modal" data-bs-target="#expertise">
                                    <i class="las la-plus"></i>
                                    <span>{{__('add_new_tag') }}</span>
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
    <div class="modal fade" id="expertise" tabindex="-1" aria-labelledby="department" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <h6 class="sub-title create_sub_title">{{__('add_new_tag') }}</h6>
                <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
                @include('backend.admin.course.tag.create')
            </div>
        </div>
    </div>
    @include('backend.common.delete-script')
@endsection
@push('js')
    {{ $dataTable->scripts() }}
@endpush
