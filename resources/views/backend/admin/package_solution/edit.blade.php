@extends('backend.layouts.master')
@section('title', __('edit_package'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('edit_package') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('packages.update',$package->id) }}" class="form-validate form"
                              method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $package->id }}">

                            <div class="row gx-20 add-coupon">
                                <input type="hidden" class="is_modal" value="0"/>
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="packageName" class="form-label">{{__('package_name')}}</label>

                                        <div class="select-type-v2">
                                            <select id="packageName" name="name" class="form-select form-select-lg mb-3 without_search">
                                                <option {{ ($package->name == 'basic') ? 'selected': '' }} value="basic">{{__('basic')}}</option>
                                                <option {{ ($package->name == 'standard') ? 'selected': '' }} value="standard">{{__('standard')}}</option>
                                                <option {{ ($package->name == 'premium') ? 'selected': '' }} value="premium">{{__('premium')}}</option>
                                            </select>
                                            <div class="nk-block-des text-danger">
                                                <p class="name_error error"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Package Name -->

                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="description" class="form-label">{{__('description')}}</label>
                                        <textarea class="form-control" name="description" placeholder="{{__('description')}}" id="description"> {{ $package->description }} </textarea>
                                        <div class="nk-block-des text-danger">
                                            <p class="description_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Description -->

                                <div class=col-lg-6>
                                    <div class="mb-4">
                                        <label for="packagePrice" class="form-label">{{__('package_price')}}</label>
                                        <input type="text" class="form-control rounded-2" id="packagePrice" name="price" placeholder="{{__('package_price')}}" value="{{old('price', $package->price)}}">
                                        <div class="nk-block-des text-danger">
                                            <p class="price_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Package Price -->

                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="packageValidity" class="form-label">{{__('package_validity')}}</label>
                                        <div class="select-type-v2">
                                            <select id="packageValidity" name="validity" class="form-select form-select-lg mb-3 without_search">
                                                <option {{ ($package->validity == '1') ? 'selected': '' }} value="1">1 {{__('months')}}</option>
                                                <option {{ ($package->validity == '5') ? 'selected': '' }} value="5">5 {{__('months')}}</option>
                                                <option {{ ($package->validity == '6') ? 'selected': '' }} value="6">6 {{__('months')}}</option>
                                                <option {{ ($package->validity == '10') ? 'selected': '' }} value="10">10 {{__('months')}}</option>
                                            </select>
                                            <div class="nk-block-des text-danger">
                                                <p class="validity_error error"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Package Validity -->

                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="courseUploadLimit" class="form-label">{{__('course_upload_limit')}}</label>
                                        <input type="text" class="form-control rounded-2" id="courseUploadLimit" name="upload_limit" placeholder="{{__('course_upload_limit')}}" value="{{old('upload_limit', $package->upload_limit)}}">
                                        <div class="nk-block-des text-danger">
                                            <p class="upload_limit_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Course Upload Limit -->

                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="courseBundle" class="form-label">{{__('course_bundle')}}</label>
                                        <div class="select-type-v2">
                                            <select id="courseBundle" class="form-select form-select-lg mb-3 without_search" name="bundle">
                                                <option {{ ($package->bundle == '1') ? 'selected': '' }} value="1">1</option>
                                                <option {{ ($package->bundle == '5') ? 'selected': '' }} value="5">5</option>
                                                <option {{ ($package->bundle == '6') ? 'selected': '' }} value="6">6</option>
                                                <option {{ ($package->bundle == '10') ? 'selected': '' }} value="10">10</option>
                                            </select>
                                            <div class="nk-block-des text-danger">
                                                <p class="bundle_error error"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Course Bundle -->

                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="liveClassFacilities" class="form-label">{{__('live_class_facilities')}}</label>
                                        <div class="select-type-v2">
                                            <select id="liveClassFacilities" class="form-select form-select-lg mb-3 without_search" name="facilities">
                                                <option {{ ($package->facilities == '1') ? 'selected': '' }} value="1">{{__('yes')}}</option>
                                                <option {{ ($package->facilities == '0') ? 'selected': '' }} value="0">{{__('no')}}</option>
                                            </select>
                                            <div class="nk-block-des text-danger">
                                                <p class="facilities_error error"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Live Class Facilities -->

                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="expertiseAddLimit" class="form-label">{{__('expertise_add_limit')}}</label>
                                        <input type="text" class="form-control rounded-2" id="expertiseAddLimit" placeholder="{{__('expertise_add_limit')}}" name="add_limit" value="{{old('add_limit', $package->add_limit)}}">
                                        <div class="nk-block-des text-danger">
                                            <p class="add_limit_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Course Upload Limit -->

                                <div class="col-lg-12">
                                    <div class="">
                                        <label for="packageStatus" class="form-label">{{__('package_status')}}</label>
                                        <div class="select-type-v2">
                                            <select id="packageStatus" class="form-select form-select-lg mb-3 without_search" name="status">
                                                <option {{ ($package->status == '1') ? 'selected': '' }} value="1" selected>{{__('active')}}</option>
                                                <option {{ ($package->status == '1') ? 'selected': '' }} value="0">{{__('inactive')}}</option>
                                            </select>
                                            <div class="nk-block-des text-danger">
                                                <p class="title_error error"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Package Status -->

                                <div class="d-flex justify-content-end align-items-center mt-30">
                                    <button type="submit" class="btn sg-btn-primary">{{__('submit') }}</button>
                                    @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
