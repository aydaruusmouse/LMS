@extends('backend.layouts.master')
@section('title', __('edit_staff'))
@push('css')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="section-title">Edit Staff</h3>
                <div class="default-tab-list default-tab-list-v2  bg-white redious-border p-20 p-sm-30">
                    <ul class="nav pb-12 mb-20" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active ps-0" id="basicInformation" data-bs-toggle="pill"
                                data-bs-target="#basicInfo" role="tab" aria-controls="basicInfo"
                                aria-selected="true">Basic Information</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="permissions" data-bs-toggle="pill" data-bs-target="#staffPermissions"
                                role="tab" aria-controls="staffPermissions" aria-selected="false">Permissions</a>
                        </li>
                    </ul>

                    <form method="POST" action="{{ route('staffs.update', $staff->id) }}" enctype="multipart/form-data"
                        class="form">
                        @csrf
                        @method('patch')
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="basicInfo" role="tabpanel"
                                aria-labelledby="basicInformation" tabindex="0">
                                <!-- <h6 class="sub-title">Product Information</h6> -->
                                <div class="row gx-20">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="firstName" class="form-label">{{ __('first_name') }}</label>
                                            <input type="text" class="form-control rounded-2" id="firstName"
                                                name="first_name" value="{{ $staff->first_name }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error first_name_error">{{ $errors->first('first_name') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End First Name Input Field -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="LastName" class="form-label">{{ __('last_name') }}</label>
                                            <input type="text" class="form-control rounded-2" id="LastName"
                                                name="last_name" value="{{ $staff->last_name }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error last_name_error">{{ $errors->first('last_name') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Last Name Input Field -->

                                    <div class="col-lg-6">
                                        @include('backend.common.tel-input', [
                                            'name' => 'phone',
                                            'value' => $staff->phone,
                                            'label' => __('phone_number'),
                                            'id' => 'phoneNumber',
                                            'country_id_field' => 'phone_country_id',
                                            'country_id' =>
                                                $staff->phone_country_id ?: (setting('default_country') ?: 19),
                                        ])
                                    </div>
                                    <!-- End Phone Number Field -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="emailAddress" class="form-label">{{ __('email_address') }}</label>
                                            <input type="text" class="form-control rounded-2" id="emailAddress"
                                                name="email" value="{{ $staff->email }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error email_error">{{ $errors->first('email') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                    <div class="col-lg-6"> --}}
                                    {{--                        <div class="mb-4"> --}}
                                    {{--                            <label for="password" class="form-label">{{__('password') }}</label> --}}
                                    {{--                            <input type="password" class="form-control rounded-2" id="password" --}}
                                    {{--                                   name="password"> --}}
                                    {{--                            <div class="nk-block-des text-danger"> --}}
                                    {{--                                <p class="error password_error">{{ $errors->first('password') }}</p> --}}
                                    {{--                            </div> --}}
                                    {{--                        </div> --}}
                                    {{--                    </div> --}}
                                    <!-- End Password Field -->

                                    {{--                    <div class="col-lg-6"> --}}
                                    {{--                        <div class="mb-4"> --}}
                                    {{--                            <label for="confirmPassword" --}}
                                    {{--                                   class="form-label">{{__('confirm_password') }}</label> --}}
                                    {{--                            <input type="password" class="form-control rounded-2" id="confirmPassword" --}}
                                    {{--                                   name="password_confirmation"> --}}
                                    {{--                        </div> --}}
                                    {{--                    </div> --}}
                                    <div class="col-lg-12 input_file_div">
                                        <div class="mb-3">
                                            <label class="form-label mb-1">{{ __('upload_profile_photo') }}</label>
                                            <label for="profilePhoto"
                                                class="file-upload-text"><span>{{ __('choose_file') }}</span></label>
                                            <input class="d-none file_picker" type="file" id="profilePhoto"
                                                name="image">
                                            <div class="nk-block-des text-danger">
                                                <p class="image_error error">{{ $errors->first('image') }}</p>
                                            </div>
                                        </div>
                                        <div class="selected-files d-flex flex-wrap gap-20">
                                            <div class="selected-files-item">
                                                <img class="selected-img" src="{{ getFileLink('80x80', $staff->images) }}"
                                                    alt="favicon">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Upload Profile Photo Input Field -->
                                    <div class="d-flex justify-content-end align-items-center mt-30">
                                        <button type="button"
                                            class="btn sg-btn-primary tab_switcher">{{ __('next') }}</button>
                                    </div>
                                </div>
                            </div>
                            <!-- END Basic Information Tab====== -->

                            <div class="tab-pane fade" id="staffPermissions" role="tabpanel" aria-labelledby="permissions"
                                tabindex="0">
                                <div class="row gx-20">
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="role-select" class="form-label mb-1">Role</label>
                                                <select id="role-select"
                                                    class="form-select form-select-lg rounded-2 mb-3 change-role without_search"
                                                    aria-label=".form-select-lg example" name="role_id">
                                                    @foreach ($roles as $role)
                                                        <option {{ $role->id === $staff->role_id ? 'selected' : '' }}
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
                                                <table class="table table" >
                                                    <tbody>
                                                        @foreach ($permissions as $permission)
                                                            <tr>
                                                                <td> <span class="text-capitalize">
                                                                        {{ $permission->name }} </span></td>
                                                                <td>
                                                                    @foreach ($permission->keywords as $key => $keyword)
                                                                        <div class="custom-checkbox mb-2">
                                                                            <label>
                                                                                @if (!empty($staff->permissions))
                                                                                    <input name="permissions[]"
                                                                                        type="checkbox"
                                                                                        value="{{ $keyword }}"
                                                                                        {{ in_array($keyword, $staff->permissions) ? 'checked' : '' }}>
                                                                                @else
                                                                                    <input name="permissions[]"
                                                                                        type="checkbox"
                                                                                        value="{{ $keyword }}">
                                                                                @endif
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
                                        @if (hasPermission('staffs.edit'))
                                            <button type="submit"
                                                class="btn sg-btn-primary">{{ __('update') }}</button>
                                            @include('backend.common.loading-btn', [
                                                'class' => 'btn sg-btn-primary',
                                            ])
                                        @endif
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
    <script>
        $(document).ready(function() {
            $('#role-select').trigger('change');
        })
    </script>
@endpush
