@extends('backend.layouts.master')
@section('title', __('packages'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex align-items-center justify-content-between mb-12">
                        <h3 class="section-title">{{__('all')}} {{__('packages')}}</h3>
                        <a href="#" class="d-flex align-items-center btn sg-btn-primary gap-2" data-bs-toggle="modal" data-bs-target="#addPackage">
                            <i class="las la-plus"></i>
                            <span>{{__('add_package')}}</span>
                        </a>
                    </div>

                    <div class="bg-white redious-border p-20 p-sm-30">
                        <div class="row gx-20">
                            <div class="col-lg-12">
                                @foreach($packages as $key => $package)
                                <div class="list-group package-list-group">
                                    <div class="list-view">
                                        <div class="list-view-content d-flex align-items-center gap-30">
                                            <h3>{{__($package->name)}}</h3>
                                        </div>

                                        <ul class="d-flex align-items-center gap-20">
                                            @if(hasPermission('packages.edit'))
                                                <li><a href="{{ route('packages.edit', $package->id) }}" class="icon"><i class="lar la-edit"></i></a></li>
                                            @endif
                                            @if(hasPermission('packages.destroy'))
                                                <li>
                                                    <a href="javascript:void(0)"
                                                       onclick="delete_row('{{ route('packages.destroy', $package->id) }}')"
                                                       data-toggle="tooltip"
                                                       data-original-title="{{ __('delete') }}"><i class="las la-trash-alt"></i></a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>

                                    <div class="list-view-body">
                                        <div class="row">
                                            <div class="list-view-box d-flex">
                                                <div class="list-box">
                                                    <p>{{__($package->description)}}</p>
                                                    <p class="price">{{ get_price($package->price, userCurrency())}}</p>
                                                </div>

                                                <div class="list-box">
                                                    <h6 class="mb-2">{{__('course_upload_limit')}}</h6>
                                                    <p>{{__($package->upload_limit)}}</p>
                                                </div>

                                                <div class="list-box">
                                                    <h6 class="mb-2">{{__('course_bundle')}}</h6>
                                                    <p>{{__($package->bundle)}}</p>
                                                </div>

                                                <div class="list-box">
                                                    <h6 class="mb-2">{{__('package_validity')}}</h6>
                                                    <p>{{ $package->validity }} {{__('months')}}</p>
                                                </div>

                                                <div class="d-flex gap-12">
                                                    <div class="setting-check">
                                                        <input type="checkbox" class="status-change"
                                                               {{ ($package->status == 1) ? 'checked' : '' }} data-id="{{ $package->id }}" value="package-status/{{$package->id}}"
                                                               id="customSwitch2-{{$package->id}}">
                                                        <label for="customSwitch2-{{ $package->id }}"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($packages->count()  != $key +1 )
                                    <hr style="margin: 60px 0 30px">
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- End Oftions Section -->
    <!-- Modal For Add Package======================== -->
    <div class="modal fade" id="addPackage" tabindex="-1" aria-labelledby="addPackageLabel" aria-hidden="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <h6 class="sub-title">{{__('add_new_package')}}</h6>
                <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
                @include('backend.admin.package_solution.create')
            </div>
        </div>
    </div>
    <!-- END Modal For Add Package======================== -->
    @include('backend.common.delete-script')
@endsection

