@extends('backend.layouts.master')
@section('title', __('wishlist'))
@section('content')
    <div class="container-fluid">
        <div class="row gx-20">
            <div class="col-lg-12">
                <h3 class="section-title">{{__('wishlist')}}</h3>
                <div class="bg-white redious-border p-20 p-sm-30 mb-4">
                    @if(request()->routeIs('backend.admin.report.wishlist'))
                    <form action="{{ route('backend.admin.report.wishlist') }}" method="GET">
                        <div class="row gx-20">
                            <div class="col">
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
                            <!-- End Category -->

                            <div class="col">
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
                            <!-- End Organization -->
                            <div class="col-lg-3">
                                <button type="submit" class="btn sg-btn-primary py-2 w-100 mt-sm-30 mt-0">{{__('filter')}}</button>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
                <div class="bg-white redious-border p-20 p-sm-30">
                    <div class="row mb-30">
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
@endsection
@push('js')
    {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function () {
            searchCategory($('#select_category'));
            searchOrganization($('#ins_by_org'));

            $('#filterBTN').click(function() {
                $('#filterSection').toggleClass('show');
            });
        });
    </script>
@endpush
