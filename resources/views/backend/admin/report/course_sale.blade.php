@extends('backend.layouts.master')
@section('title', __('course_sales'))
@section('content')
    <div class="container-fluid">
        <div class="row gx-20">
            <div class="col-lg-12">
                <h3 class="section-title">{{__('course_sales')}}</h3>
                @if(request()->routeIs('backend.admin.report.course_sale'))
                    <form action="{{ route('backend.admin.report.course_sale') }}" method="GET">
                        <div class="bg-white redious-border p-20 p-sm-30 mb-4">
                            <div class="selection-row gx-20">
                                <div class="col-custom">
                                    <div class="multi-select-v2">
                                        <label for="select_category"
                                               class="form-label">{{ __('select_course') }}</label>
                                        <select id="select_category" name="course_ids[]" multiple
                                                placeholder="{{ __('select_course') }}"
                                                class="form-select-lg rounded-0 mb-3"
                                                data-route="{{ route('ajax.courses') }}"
                                                aria-label=".form-select-lg example">
                                            @foreach($courses as $course)
                                                <option value="{{$course->id}}" selected>{{__($course->title)}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <!-- End Course -->
                                <div class="col-custom">
                                    <div class="select-type-v2">
                                        <label for="category" class="form-label">{{__('select_category')}}</label>
                                        <select id="category" class="form-select form-select-lg mb-3 with_search" aria-label=".form-select-lg example" name="category_id">
                                            <option value="" selected>{{__('all')}}</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{ $category_id == $category->id ? 'selected': '' }}>{{__($category->title)}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <!-- End Categories -->

                                <div class="col-custom">
                                    <div class="select-type-v2">
                                        <label for="organisation" class="form-label">{{__('organisation')}}</label>
                                        <select id="organisation" class="form-select form-select-lg mb-3 with_search" aria-label=".form-select-lg example" name="organization_id">
                                            <option value="" selected>{{__('all')}}</option>
                                            @foreach($organizations as $organization)
                                                <option value="{{$organization->id}}" {{ $organization_id == $organization->id ? 'selected': '' }}>{{__($organization->org_name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- End Organisation -->

                                <div class="col">
                                    <div class="mb-20">
                                        <label for="dateRangePicker"
                                               class="form-label">{{ __('data_range') }} </label>
                                        <input id="dateRangePicker" name="dateRange" type="text"
                                               class="form-control rounded-2" placeholder="{{ __('select_date') }}" name="date_range" value="{{ $dateRange }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="dateRange_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Data Range -->

                                <div class="col-custom">
                                    <button type="submit" class="btn sg-btn-primary py-2 w-100 mt-30">{{__('filter')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif

                @if ($category_id != null)
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <div class="row mb-30">
                            <div class="col-lg-12">
                                <div class="default-list-table table-responsive yajra-dataTable">
                                    {{ $dataTable->table() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                    <div class="bg-white redious-border p-20 p-sm-30">
                        <div class="row mb-10">
                            <div class="col-lg-12 " style="text-align: center">
                                <p>{{ __('no_matching_records_found') }} </p>
                            </div>
                        </div>
                    </div>


            </div>
        </div>
    </div>
@endsection
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/daterangepicker.css') }}">
@endpush
@push('js_asset')
    <!--====== media.js ======-->
    <script src="{{ static_asset('admin/js/moment.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/daterangepicker.js') }}"></script>
@endpush
@push('js')
    <script>
        $(document).ready(function () {
            $('#dateRangePicker').daterangepicker({
                autoUpdateInput: false
            });
            searchCourse($('#select_category'));
        });
    </script>
        {{ $dataTable->scripts() }}
@endpush
