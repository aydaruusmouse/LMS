<form action="{{ route('packages.store') }}" method="POST" class="form">@csrf
    <input type="hidden"  class="is_modal" value="0">
    <div class="row gx-20">
        <div class="col-lg-12">
            <div class="mb-4">
                <label for="packageName" class="form-label">{{__('package_name')}}</label>

                <div class="select-type-v2">
                    <select id="packageName" name="name" class="form-select form-select-lg mb-3 without_search">
                        <option value="basic">{{__('basic')}}</option>
                        <option value="standard">{{__('standard')}}</option>
                        <option value="premium">{{__('premium')}}</option>
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
                <textarea class="form-control" name="description" placeholder="{{__('description')}}" id="description"></textarea>
                <div class="nk-block-des text-danger">
                    <p class="description_error error"></p>
                </div>
            </div>
        </div>
        <!-- End Description -->

        <div class=col-lg-6>
            <div class="mb-4">
                <label for="packagePrice" class="form-label">{{__('package_price')}}</label>
                <input type="text" class="form-control rounded-2" id="packagePrice" name="price" placeholder="{{__('package_price')}}" >
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
                        <option value="1">1 {{__('months')}}</option>
                        <option value="5">5 {{__('months')}}</option>
                        <option value="6">6 {{__('months')}}</option>
                        <option value="10">10 {{__('months')}}</option>
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
                <input type="text" class="form-control rounded-2" id="courseUploadLimit" name="upload_limit" placeholder="{{__('course_upload_limit')}}" >
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
                        <option value="1">1</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="10">10</option>
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
                        <option value="1">{{__('yes')}}</option>
                        <option value="0">{{__('no')}}</option>
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
                <input type="text" class="form-control rounded-2" id="expertiseAddLimit" placeholder="{{__('expertise_add_limit')}}" name="add_limit">
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
                        <option value="1" selected>{{__('active')}}</option>
                        <option value="0">{{__('inactive')}}</option>
                    </select>
                    <div class="nk-block-des text-danger">
                        <p class="status_error error"></p>
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
