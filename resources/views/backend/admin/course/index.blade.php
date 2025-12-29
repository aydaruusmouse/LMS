@extends('backend.layouts.master')
@section('title', __('course_list'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="header-top d-flex justify-content-between align-items-center">
                    <h3 class="section-title">{{__('course_list') }}</h3>
                    @if(request()->routeIs('courses.index'))
                        <div class="oftions-content-right mb-12">
                            <a href="#"
                               class="d-flex align-items-center btn sg-btn-primary gap-2" id="filterBTN">
                                <i class="las la-filter"></i>
                            </a>
                            @if(hasPermission('courses.create'))
                                <a href="{{ route('courses.create') }}"
                                   class="d-flex align-items-center btn sg-btn-primary gap-2">
                                    <i class="las la-plus"></i>
                                    <span>{{__('add_new_course') }}</span>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="row">
                    @if(request()->routeIs('courses.index'))
                        <div class="col-lg-12" id="filterSection">
                            <div class="hidden-filter bg-white redious-border p-20 p-sm-30 mb-4">
                                <form action="{{ route('courses.index') }}" method="GET">
                                    <div class="selection-row ">
                                        <div class="col-custom">
                                            <div class="multi-select-v2">
                                                <label for="select_category"
                                                       class="form-label">{{ __('select_category') }}</label>
                                                <select id="select_category" name="category_ids[]" multiple
                                                        placeholder="{{ __('select_category') }}"
                                                        class="form-select-lg rounded-0 mb-3"
                                                        data-route="{{ route('ajax.categories') }}"
                                                        aria-label=".form-select-lg example">
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                                selected>{{ $category->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-custom">
                                            <div class="multi-select-v2">
                                                <label for="ins_by_org"
                                                       class="form-label">{{ __('select_organization') }}</label>
                                                <select id="ins_by_org" name="organization_id"
                                                        data-route="{{ route('ajax.organizations') }}"
                                                        data-url="{{ route('ajax.instructors') }}"
                                                        class="form-select-lg rounded-0 mb-3"
                                                        aria-label=".form-select-lg example">
                                                    <option value="" selected>{{ __('select_organization') }}</option>
                                                    @if($organization)
                                                        <option value="{{ $organization->id }}"
                                                                selected>{{ $organization->org_name }}</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-custom">
                                            <div class="select-type-v2">
                                                <label for="instructor_ids"
                                                       class="form-label">{{ __('instructor') }}</label>
                                                <select id="instructor_ids" name="instructor_ids[]" multiple
                                                        class="form-select form-select-lg mb-3 without_search"
                                                        aria-label=".form-select-lg">
                                                    @foreach($instructors as $instructor)
                                                        <option
                                                            value="{{ $instructor->id }}" {{ $instructor_ids && in_array($instructor->id,$instructor_ids) ? 'selected' : '' }}>{{ $instructor->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('instructor_ids') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Select Instructor -->

                                        <div class="col-custom">
                                            <div class="select-type-v2">
                                                <label for="courseStatus"
                                                       class="form-label">{{ __('course_status') }}</label>
                                                <select id="courseStatus" name="status"
                                                        class="form-select form-select-lg mb-3 without_search"
                                                        aria-label=".form-select-lg example">
                                                    <option value="">{{ __('select_status') }}</option>
                                                    <option
                                                        value="DRAFT" {{ $status == "DRAFT" ? 'selected' : '' }}>{{ __('draft') }}</option>
                                                    <option
                                                        value="IN_REVIEW" {{ $status == "IN_REVIEW" ? 'selected' : '' }}>{{ __('in_review') }}</option>
                                                    <option
                                                        value="REJECTED" {{ $status == "REJECTED" ? 'selected' : '' }}>{{ __('rejected') }}</option>
                                                    <option
                                                        value="APPROVED" {{ $status == "APPROVED" ? 'selected' : '' }}>{{ __('approved') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- End Course Status -->
                                        <div class="col-custom">
                                            <button type="submit"
                                                    class="btn sg-btn-primary w-100 mt-30">{{ __('filter') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>

                <div
                    class="default-tab-list table-responsive default-tab-list-v2 activeItem-bd-md bg-white redious-border p-20 p-sm-30">
                    @if(!request()->routeIs('courses.index'))
                        @include('backend.admin.organization.topber')
                    @endif
                    <div class="default-list-table yajra-dataTable">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('backend.common.delete-script')
@push('js')
    {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function () {
            searchCategory($('#select_category'));
            searchOrganization($('#ins_by_org'));

            $('#filterBTN').click(function () {
                $('#filterSection').toggleClass('show');
            });
        });
    </script>
@endpush
