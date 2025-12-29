@extends('backend.layouts.master')

@section('title', __('course_list'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="header-top d-flex justify-content-between align-items-center">
                    <h3 class="section-title">{{ __('course_list') }}</h3>
                    @if (request()->routeIs('instructor.courses.index'))
                        <div class="oftions-content-right mb-12">
                            <a href="#" class="d-flex align-items-center btn sg-btn-primary gap-2" id="filterBTN">
                                <i class="las la-filter"></i>
                            </a>
                            <a href="{{ route('instructor.courses.create') }}"
                                class="d-flex align-items-center btn sg-btn-primary gap-2">
                                <i class="las la-plus"></i>
                                <span>{{ __('add_new_course') }}</span>
                            </a>
                        </div>
                    @endif
                </div>
                <div class="row">
                    @if (request()->routeIs('instructor.courses.index'))
                        <div class="col-lg-12" id="filterSection">
                            <div class="hidden-filter bg-white redious-border p-20 p-sm-30 mb-4">
                                <form action="{{ route('instructor.courses.index') }}" method="GET">

                                    <input type="hidden" value="{{ $organization->id }}" name="organization_id">

                                    <div class="selection-row ">
                                        <div class="col-custom">
                                            <div class="multi-select-v2">
                                                <label for="select_category"
                                                    class="form-label">{{ __('select_category') }}</label>
                                                <select id="select_category" name="category_ids[]" multiple
                                                    placeholder="{{ __('select_category') }}"
                                                    class="form-select-lg rounded-0 mb-3"
                                                    data-route="{{ route('instructor.ajax.categories') }}"
                                                    aria-label=".form-select-lg example">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" selected>{{ $category->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
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
                                                    <option value="active" {{ $status == 'active' ? 'selected' : '' }}>
                                                        {{ __('active') }}</option>
                                                    <option value="inactive" {{ $status == 'inactive' ? 'selected' : '' }}>
                                                        {{ __('inactive') }}</option>
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

                <div class="default-tab-list default-tab-list-v2 activeItem-bd-md bg-white redious-border p-20 p-sm-30">
                    @if (!request()->routeIs('instructor.courses.index'))
                        @include('backend.instructor.organization.topber')
                    @endif
                    <div class="default-list-table table-responsive yajra-dataTable">
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
        $(document).ready(function() {
            searchCategory($('#select_category'));
            searchInstructor($('#instructor_ids'));

            $('#filterBTN').click(function() {
                $('#filterSection').toggleClass('show');
            });
        });
    </script>
@endpush
