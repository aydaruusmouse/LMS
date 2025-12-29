@extends('backend.layouts.master')
@section('title', __('add_staff'))
@push('css')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="section-title">{{__('add') }}  {{__('staff') }}</h3>
                <div class="default-tab-list default-tab-list-v2  bg-white redious-border p-20 p-sm-30">
                    <ul class="nav pb-12 mb-20" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active ps-0" id="basicInformation" data-bs-toggle="pill"
                               data-bs-target="#basicInfo" role="tab" aria-controls="basicInfo"
                               aria-selected="true">{{ __('basic_information') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="permissions" data-bs-toggle="pill"
                               data-bs-target="#staffPermissions" role="tab" aria-controls="staffPermissions"
                               aria-selected="false">{{ __('permissions') }}</a>
                        </li>
                    </ul>
                    <form method="POST" action="{{ route('staffs.store') }}" enctype="multipart/form-data" class="form">
                        @csrf
                        <input type="hidden" name="type" value="tab_form">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="basicInfo" role="tabpanel"
                                 aria-labelledby="basicInformation" tabindex="0">
                                <!-- <h6 class="sub-title">Product Information</h6> -->
                                <div class="row gx-20">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="firstName" class="form-label">{{__('first_name') }}</label>
                                            <input type="text" class="form-control rounded-2" id="firstName"
                                                   name="first_name" value="{{ old('first_name') }}">
                                                <div class="nk-block-des text-danger">
                                                    <p class="error first_name_error">{{ $errors->first('first_name') }}</p>
                                                </div>
                                        </div>
                                    </div>
                                    <!-- End First Name Input Field -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="LastName" class="form-label">{{__('last_name') }}</label>
                                            <input type="text" class="form-control rounded-2" id="LastName"
                                                   name="last_name" value="{{ old('last_name') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error last_name_error">{{ $errors->first('last_name') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Last Name Input Field -->

                                    <div class="col-lg-6">
                                        @include('backend.common.tel-input',[
                                            'name' => 'phone',
                                            'value' => old('phone'),
                                            'label' => __('phone_number'),
                                            'id' => 'phoneNumber',
                                            'country_id_field' => 'phone_country_id',
                                            'country_id' => old('phone_country_id') ? : (setting('default_country') ? : 19)
                                            ])
                                    </div>
                                    <!-- End Phone Number Field -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="emailAddress"
                                                   class="form-label">{{__('email_address') }}</label>
                                            <input type="text" class="form-control rounded-2" id="emailAddress"
                                                   name="email" value="{{ old('email') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error email_error">{{ $errors->first('email') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Email Address Input Field -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="password" class="form-label">{{__('password') }}</label>
                                            <input type="password" class="form-control rounded-2" id="password"
                                                   name="password">
                                            <div class="nk-block-des text-danger">
                                                <p class="error password_error">{{ $errors->first('password') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Password Field -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="confirmPassword"
                                                   class="form-label">{{__('confirm_password') }}</label>
                                            <input type="password" class="form-control rounded-2" id="confirmPassword"
                                                   name="password_confirmation">
                                        </div>
                                    </div>
                                    <!-- End Confirm Password Input Field -->

                                    <div class="col-lg-12 input_file_div">
                                        <div class="mb-3">
                                            <label class="form-label mb-1">{{__('upload_profile_photo') }}</label>
                                            <label for="profilePhoto" class="file-upload-text">
                                                <p></p>
                                                <span class="file-btn">{{__('choose_file') }}</span>
                                            </label>
                                            <input class="d-none file_picker" type="file" id="profilePhoto"
                                                   name="image">
                                            <div class="nk-block-des text-danger">
                                                <p class="image_error error">{{ $errors->first('image') }}</p>
                                            </div>
                                        </div>
                                        <div class="selected-files d-flex flex-wrap gap-20">
                                            <div class="selected-files-item">
                                                <img class="selected-img" src="{{ getFileLink('80x80',[]) }}"
                                                     alt="favicon">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Upload Profile Photo Input Field -->
                                    <div class="d-flex justify-content-end align-items-center mt-30">
                                        <button type="button" class="btn sg-btn-primary tab_switcher">{{__('next') }}</button>
                                    </div>
                                </div>
                            </div>
                            <!-- END Basic Information Tab====== -->

                            <div class="tab-pane fade" id="staffPermissions" role="tabpanel"
                                 aria-labelledby="permissions" tabindex="0">
                                <div class="row gx-20">
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="role-select" class="form-label mb-1">{{__('role') }}</label>
                                                <select id="role-select"
                                                        class="form-select form-select-lg rounded-2 mb-3 change-role without_search"
                                                        aria-label=".form-select-lg example" name="role_id">
                                                    @foreach($roles as $role)
                                                        <option selected
                                                                value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error role_id_error">{{ $errors->first('role_id') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Role selection field -->

                                    <div class="col-lg-12">
                                        <div class="staff-role-heigh simplebar">
                                            <div class="default-list-table table-responsive staff-role-table">
                                                <table class="table table" id="permissions-table">
                                                    <tbody>
                                                    @foreach($permissions as $permission)
                                                        <tr>
                                                            <td><span
                                                                    class="text-capitalize"> {{ $permission->name }} </span>
                                                            </td>
                                                            <td>
                                                                @foreach($permission->keywords as $key=>$keyword)
                                                                    <div class="custom-checkbox mb-2">
                                                                        <label>
                                                                            <input name="permissions[]" type="checkbox"
                                                                                   value="{{ $keyword }}">
                                                                            <span
                                                                                class="text-capitalize">{{ $key }}</span>
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-40">
                                        <button type="submit" class="btn sg-btn-primary">{{ __('save') }}</button>
                                        @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                                    </div>
                                </div>
                            </div>
                            <!-- END Permissions Tab====== -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('backend.admin.staff.staff-script')
@push('js')
    <script src="{{ static_asset('admin/js/countries.js') }}"></script>
@endpush
