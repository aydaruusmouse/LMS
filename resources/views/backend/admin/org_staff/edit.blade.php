@extends('backend.layouts.master')
@section('title', __('org_staff'))

@section('content')
    <!-- Organisation Details -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="header-top d-flex justify-content-between align-items-center">
                    <h3 class="section-title">{{ __('Update Organization Staff') }}</h3>

                </div>
                <div
                    class="default-tab-list table-responsive default-tab-list-v2 activeItem-bd-md bg-white redious-border p-20 p-sm-30">

                    @include('backend.admin.organization.topber')
                    <!-- End Organisation Details Tab -->
                    <div class="default-list-table yajra-dataTable">
                        <form class="form"
                            action="{{ route('organizations.staff.update', [
                                'org_id' => request()->route('org_id'),
                                'id' => $user->id,
                            ]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <input type="hidden" name="type" value="tab_form">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="basicInfo" role="tabpanel"
                                    aria-labelledby="basicInformation" tabindex="0">
                                    <input type="hidden" name="organization_id" value="{{ $staff->organization_id }}">
                                    <div class="row gx-20">
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="firstName" class="form-label">{{ __('first_name') }}</label>
                                                <input type="text" class="form-control rounded-2" id="firstName"
                                                    name="first_name" value="{{ $user->first_name }}"
                                                    placeholder="{{ __('enter_first_name') }}">
                                                <div class="nk-block-des text-danger">
                                                    <p class="first_name_error error">{{ $errors->first('first_name') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End First Name -->

                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="lastName" class="form-label">{{ __('last_name') }}</label>
                                                <input type="text" class="form-control rounded-2" id="lastName"
                                                    name="last_name" value="{{ $user->last_name }}"
                                                    placeholder="{{ __('enter_last_name') }}">
                                                <div class="nk-block-des text-danger">
                                                    <p class="last_name_error error">{{ $errors->first('last_name') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Last Name -->

                                        <div class="col-lg-6">
                                            @include('backend.common.tel-input', [
                                                'name' => 'phone',
                                                'value' => $user->phone,
                                                'label' => __('phone_number'),
                                                'id' => 'phoneNumber',
                                                'country_id_field' => 'phone_country_id',
                                                'country_id' =>
                                                    $user->phone_country_id ?: (setting('default_country') ?: 19),
                                            ])
                                        </div>
                                        <!-- End Phone Number Field -->

                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="emailAddress"
                                                    class="form-label">{{ __('email_address') }}</label>
                                                <input type="email" class="form-control rounded-2" id="emailAddress"
                                                    name="email" value="{{ $user->email }}"
                                                    placeholder="{{ __('enter_email_address') }}">
                                                <div class="nk-block-des text-danger">
                                                    <p class="email_error error">{{ $errors->first('email') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Email Address -->
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="designation" class="form-label">{{ __('designation') }}</label>
                                                <input type="text" class="form-control rounded-2" id="designation"
                                                    name="designation" value="{{ $staff->designation }}"
                                                    placeholder="{{ __('enter_designation') }}">
                                                <div class="nk-block-des text-danger">
                                                    <p class="designation_error error">{{ $errors->first('designation') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Designation -->
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="website" class="form-label">{{ __('website') }}</label>
                                                <input type="text" class="form-control rounded-2" id="website"
                                                    name="website" value="{{ $staff->website }}"
                                                    placeholder="{{ __('enter_website') }}">
                                                <div class="nk-block-des text-danger">
                                                    <p class="website_error error">{{ $errors->first('website') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End website -->

                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="expertises" class="form-label">{{ __('expertises') }}</label>
                                                <select multiple class="with_search" name="expertises[]"
                                                    placeholder="{{ __('expertises') }}" aria-hidden="true">
                                                    @foreach ($expertises as $expertise)
                                                        <option value="{{ $expertise->id }}"
                                                            {{ $staff->expertises && in_array($expertise->id, $staff->expertises) ? 'selected' : '' }}>
                                                            {{ $expertise->expertise_title ?: $expertise->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-4">
                                                <label for="address" class="form-label">{{ __('address') }}</label>
                                                <input type="text" value="{{ $user->address }}"
                                                    class="form-control rounded-2" id="address" name="address"
                                                    placeholder="{{ __('enter_address') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="editor-wrapper mb-4">
                                                <label for="about" class="form-label">{{ __('about') }}</label>
                                                <textarea class="form-control rounded-2 summernote" id="about" name="about">{{ $user->about }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <h6 class="sub-title mb-3">{{ __('social_link') }}</h6>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="facebook" class="form-label">{{ __('facebook') }}</label>
                                                <input type="text"
                                                    value="{{ getArrayValue('facebook', $staff->social_links) }}"
                                                    class="form-control rounded-2" id="facebook"
                                                    name="social_links[facebook]"
                                                    placeholder="{{ __('facebook_link') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="twitter" class="form-label">{{ __('twitter') }}</label>
                                                <input type="text"
                                                    value="{{ getArrayValue('twitter', $staff->social_links) }}"
                                                    class="form-control rounded-2" id="twitter"
                                                    name="social_links[twitter]" placeholder="{{ __('twitter_link') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="instagram" class="form-label">{{ __('instagram') }}</label>
                                                <input type="text"
                                                    value="{{ getArrayValue('instagram', $staff->social_links) }}"
                                                    class="form-control rounded-2" id="instagram"
                                                    name="social_links[instagram]"
                                                    placeholder="{{ __('instagram_link') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="linkedin" class="form-label">{{ __('linkedin') }}</label>
                                                <input type="text"
                                                    value="{{ getArrayValue('linkedin', $staff->social_links) }}"
                                                    class="form-control rounded-2" id="linkedin"
                                                    name="social_links[linkedin]"
                                                    placeholder="{{ __('linkedin_link') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="youtube" class="form-label">{{ __('youtube') }}</label>
                                                <input type="text"
                                                    value="{{ getArrayValue('youtube', $staff->social_links) }}"
                                                    class="form-control rounded-2" id="youtube"
                                                    name="social_links[youtube]" placeholder="{{ __('youtube_link') }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-12 input_file_div mb-4">
                                            <div class="mb-3">
                                                <label class="form-label mb-1">{{ __('upload_profile_photo') }}</label>
                                                <label for="profilePhoto" class="file-upload-text">
                                                    <p></p>
                                                    <span class="file-btn">{{ __('choose_file') }}</span>
                                                </label>
                                                <input class="d-none file_picker" type="file" id="profilePhoto"
                                                    name="image">
                                                <div class="nk-block-des text-danger">
                                                    <p class="image_error error">{{ $errors->first('image') }}</p>
                                                </div>
                                            </div>
                                            <div class="selected-files d-flex flex-wrap gap-20">
                                                <div class="selected-files-item">
                                                    <img class="selected-img"
                                                        src="{{ getFileLink('80x80', $user->images) }}" alt="favicon">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-12">
                                            <h6 class="sub-title mb-3">{{ __('permissions') }}</h6>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="price-checkbox d-flex gap-12 mb-2">
                                                <label for="checkbox1">{{ __('manage_course') }}</label>
                                                <div class="setting-check">
                                                    <input name="permissions[manage_course]" type="checkbox"
                                                        id="checkbox1"
                                                        {{ in_array('manage_course', $user->permissions) ? 'checked' : '' }}
                                                        value="1">
                                                    <label for="checkbox1"></label>
                                                </div>
                                            </div>
                                            <div class="price-checkbox d-flex gap-12 mb-4">
                                                <label for="checkbox2">{{ __('manage_student') }}</label>
                                                <div class="setting-check">
                                                    <input name="permissions[manage_student]" type="checkbox"
                                                        id="checkbox2"
                                                        {{ in_array('manage_student', $user->permissions) ? 'checked' : '' }}
                                                        value="1">
                                                    <label for="checkbox2"></label>
                                                </div>
                                            </div>

                                            <div class="price-checkbox d-flex gap-12 mb-2">
                                                <label for="checkbox3">{{ __('manage_certificate') }}</label>
                                                <div class="setting-check">
                                                    <input name="permissions[manage_certificate]" type="checkbox"
                                                        id="checkbox3"
                                                        {{ in_array('manage_certificate', $user->permissions) ? 'checked' : '' }}
                                                        value="1">
                                                    <label for="checkbox3"></label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="price-checkbox d-flex gap-12 mb-4">
                                                <label for="checkbox4">{{ __('manage_instructor') }}</label>
                                                <div class="setting-check">
                                                    <input name="permissions[manage_instructor]" type="checkbox"
                                                        id="checkbox4"
                                                        {{ in_array('manage_instructor', $user->permissions) ? 'checked' : '' }}
                                                        value="1">
                                                    <label for="checkbox4"></label>
                                                </div>
                                            </div>

                                            <div class="price-checkbox d-flex gap-12 mb-4">
                                                <label for="checkbox5">{{ __('manage_staff') }}</label>
                                                <div class="setting-check">
                                                    <input name="permissions[manage_staff]" type="checkbox"
                                                        id="checkbox5"
                                                        {{ in_array('manage_staff', $user->permissions) ? 'checked' : '' }}
                                                        value="1">
                                                    <label for="checkbox5"></label>
                                                </div>
                                            </div>

                                            <div class="price-checkbox d-flex gap-12 mb-4">
                                                <label for="checkbox6">{{ __('manage_media_library') }}</label>
                                                <div class="setting-check">
                                                    <input name="permissions[manage_media_library]" type="checkbox"
                                                        id="checkbox6"
                                                        {{ in_array('manage_media_library', $user->permissions) ? 'checked' : '' }}
                                                        value="1">
                                                    <label for="checkbox6"></label>
                                                </div>
                                            </div>


                                        </div>




                                        <div class="col-lg-4">
                                            <div class="price-checkbox d-flex gap-12 mb-4">
                                                <label for="checkbox7">{{ __('manage_statement') }}</label>
                                                <div class="setting-check">
                                                    <input name="permissions[manage_statement]" type="checkbox"
                                                        id="checkbox7"
                                                        {{ in_array('manage_statement', $user->permissions) ? 'checked' : '' }}
                                                        value="1">
                                                    <label for="checkbox7"></label>
                                                </div>
                                            </div>

                                            <div class="price-checkbox d-flex gap-12 mb-4">
                                                <label for="checkbox8">{{ __('manage_finance') }}</label>
                                                <div class="setting-check">
                                                    <input name="permissions[manage_finance]" type="checkbox"
                                                        id="checkbox8"
                                                        {{ in_array('manage_finance', $user->permissions) ? 'checked' : '' }}
                                                        value="1">
                                                    <label for="checkbox8"></label>
                                                </div>
                                            </div>

                                            <div class="price-checkbox d-flex gap-12 mb-4">
                                                <label for="checkbox9">{{ __('manage_setting') }}</label>
                                                <div class="setting-check">
                                                    <input name="permissions[manage_setting]" type="checkbox"
                                                        id="checkbox9"
                                                        {{ in_array('manage_setting', $user->permissions) ? 'checked' : '' }}
                                                        value="1">
                                                    <label for="checkbox9"></label>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- End Upload Profile Photo -->
                                        <div class="d-flex justify-content-end align-items-center mt-30">
                                            <button type="submit"
                                                class="btn sg-btn-primary">{{ __('save') }}</button>
                                            @include('backend.common.loading-btn', [
                                                'class' => 'btn sg-btn-primary',
                                            ])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        @include('backend.common.delete-script')
        @include('backend.common.change-status-script')
        <script src="{{ static_asset('admin/js/countries.js') }}"></script>
        <script>
            searchOrganization($('.org_select'));
        </script>
    @endpush
@endsection
