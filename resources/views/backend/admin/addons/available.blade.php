@extends('backend.layouts.master')
@section('content')
    <!-- Addons -->
    <section class="addons-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('addon')}}</h3>
                    <div class="bg-white redious-border p-20 p-md-30">
                        <form action="#">
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="default-tab-list default-tab-list-v2">
                                        <ul class="nav pb-12 mb-20" id="pills-tab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link ps-0" id="installedAddons" data-bs-toggle="pill" data-bs-target="#installedAddonsTab" role="tab" aria-controls="installedAddonsTab" aria-selected="true">{{__('installed')}}</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="availableAddons" data-bs-toggle="pill" data-bs-target="#availableAddonsTab" role="tab" aria-controls="availableAddonsTab" aria-selected="false">{{__('available')}}</a>
                                            </li>
                                            <div class="ms-auto">
                                                <a href="#" class="btn btn-sm btn-primary rounded-2" data-bs-toggle="modal" data-bs-target="#addAddons"><i class="las la-plus"></i>{{__('add_new')}}</a>
                                            </div>
                                        </ul>

                                        <!-- End Instructor Profile Tab -->

                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade" id="installedAddonsTab" role="tabpanel" aria-labelledby="installedAddons" tabindex="0">
                                                {{__('lorem_ipsum_dolor_sit.')}}
                                            </div>
                                            <!-- END Installed Tab====== -->

                                            <div class="tab-pane fade show active" id="availableAddonsTab" role="tabpanel" aria-labelledby="availableAddons" tabindex="0">
                                                <div class="row">
                                                    <div class="col-lg-5 col-md-5 col-sm-12">
                                                        <div class="oftions-content-left mb-3">
                                                            <form action="#" class="">
                                                                <div class="select-type-v2 d-flex align-items-center gap-20">
                                                                    <label for="customer" class="order-1">Addons Per Page</label>
                                                                    <select name="customer" id="customer" class="customer-length form-select without_search" aria-label=".form-select-lg example">
                                                                        <option value="8">8</option>
                                                                        <option value="25">25</option>
                                                                        <option value="50">50</option>
                                                                        <option value="100">100</option>
                                                                    </select>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-7 col-md-7 col-sm-12">
                                                        <div class="oftions-content-right mb-3">
                                                            <form action="#" class="oftions-content-search">
                                                                <input type="search" name="search" id="search" placeholder="Search">
                                                                <button type="submit"><img src="{{url('admin/img/icons/search.svg')}}" alt="Search"></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                                                        <div class="course-item addons-item mb-4" data-aos="fade-up" data-aos-delay="100">
                                                            <a href="#" target="_blank" class="course-item-thumb">
                                                                <img src="assets/img/addons/a1.png" alt="Addons Thumbnail">
                                                            </a>
                                                            <div class="course-item-body">
                                                                <div class="meta-box d-flex align-items-center justify-content-between">
                                                                    <p><span>Released</span> : 15/06/2023</p>
                                                                    <p><span>Version </span>: V1.1.1</p>
                                                                </div>
                                                                <h4 class="title">
                                                                    <a href="#" target="_blank">OTP System Add-on for YOORI PWA eCommerce</a>
                                                                </h4>
                                                                <div class="course-price">$24.00</div>
                                                            </div>

                                                            <div class="course-item-footer">
                                                                <a href="#" class="btn btn-sm sg-btn-outline-primary rounded-2">{{__('details')}}</a>
                                                                <a href="#" class="btn btn-sm btn-primary rounded-2">{{__('purchase')}}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Addons Item -->

                                                    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                                                        <div class="course-item addons-item mb-4" data-aos="fade-up" data-aos-delay="100">
                                                            <a href="#" target="_blank" class="course-item-thumb">
                                                                <img src="assets/img/addons/a2.png" alt="Addons Thumbnail">
                                                            </a>
                                                            <div class="course-item-body">
                                                                <div class="meta-box d-flex align-items-center justify-content-between">
                                                                    <p><span>Released</span> : 15/06/2023</p>
                                                                    <p><span>Version </span>: V1.1.1</p>
                                                                </div>
                                                                <h4 class="title">
                                                                    <a href="#" target="_blank">Refund System Add-on for YOORI PWA eCommerce</a>
                                                                </h4>
                                                                <div class="course-price">$24.00</div>
                                                            </div>

                                                            <div class="course-item-footer">
                                                                <a href="#" class="btn btn-sm sg-btn-outline-primary rounded-2">{{__('details')}}</a>
                                                                <a href="#" class="btn btn-sm btn-primary rounded-2">{{__('purchase')}}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Addons Item -->

                                                    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                                                        <div class="course-item addons-item mb-4" data-aos="fade-up" data-aos-delay="100">
                                                            <a href="#" target="_blank" class="course-item-thumb">
                                                                <img src="assets/img/addons/a3.png" alt="Addons Thumbnail">
                                                            </a>
                                                            <div class="course-item-body">
                                                                <div class="meta-box d-flex align-items-center justify-content-between">
                                                                    <p><span>Released</span> : 15/06/2023</p>
                                                                    <p><span>Version </span>: V1.1.1</p>
                                                                </div>
                                                                <h4 class="title">
                                                                    <a href="#" target="_blank">Wholesale(B2B) Add-on for YOORI PWA eCommerce</a>
                                                                </h4>
                                                                <div class="course-price">$24.00</div>
                                                            </div>

                                                            <div class="course-item-footer">
                                                                <a href="#" class="btn btn-sm sg-btn-outline-primary rounded-2">{{__('details')}}</a>
                                                                <a href="#" class="btn btn-sm btn-primary rounded-2">{{__('purchase')}}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Addons Item -->

                                                    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                                                        <div class="course-item addons-item" data-aos="fade-up" data-aos-delay="100">
                                                            <a href="#" target="_blank" class="course-item-thumb">
                                                                <img src="assets/img/addons/a4.png" alt="Addons Thumbnail">
                                                            </a>
                                                            <div class="course-item-body">
                                                                <div class="meta-box d-flex align-items-center justify-content-between">
                                                                    <p><span>Released</span> : 15/06/2023</p>
                                                                    <p><span>Version </span>: V1.1.1</p>
                                                                </div>
                                                                <h4 class="title">
                                                                    <a href="#" target="_blank">Offline Payment Addon for YOORI eCommerce CMS</a>
                                                                </h4>
                                                                <div class="course-price">$24.00</div>
                                                            </div>

                                                            <div class="course-item-footer">
                                                                <a href="#" class="btn btn-sm sg-btn-outline-primary rounded-2">{{__('details')}}</a>
                                                                <a href="#" class="btn btn-sm btn-primary rounded-2">{{__('purchase')}}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Addons Item -->
                                                </div>
                                            </div>
                                            <!-- END Available Tab====== -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Addons Section -->
    <div class="modal fade" id="addAddons" tabindex="-1" aria-labelledby="addAddonsLabel" aria-hidden="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <h6 class="sub-title">{{__('add_new_addon')}}</h6>
                <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>

               @include('backend.admin.addons.create')
            </div>
        </div>
    </div>
    @include('backend.common.delete-script')
@endsection
