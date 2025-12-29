@extends('backend.layouts.master')
@section('title', __('edit_instructor'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="section-title">{{ __('edit_instructor') }}</h3>
                <div class="default-tab-list default-tab-list-v2  bg-white redious-border p-20 p-sm-30">
                    <form class="form" action="{{ route('instructors.update',$user->id) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <input type="hidden" name="type" value="tab_form">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="basicInfo" role="tabpanel"
                                 aria-labelledby="basicInformation" tabindex="0">
                                <input type="hidden" name="organization_id" value="{{ $instructor->organization_id }}">
                                <div class="row gx-20">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="firstName" class="form-label">{{__('first_name') }}</label>
                                            <input type="text" class="form-control rounded-2" id="firstName"
                                                   name="first_name"
                                                   value="{{ $user->first_name }}"
                                                   placeholder="{{ __('enter_first_name') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="first_name_error error">{{ $errors->first('first_name') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End First Name -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="lastName" class="form-label">{{__('last_name') }}</label>
                                            <input type="text" class="form-control rounded-2" id="lastName"
                                                   name="last_name"
                                                   value="{{ $user->last_name }}"
                                                   placeholder="{{ __('enter_last_name') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="last_name_error error">{{ $errors->first('last_name') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Last Name -->

                                    <div class="col-lg-6">
                                        @include('backend.common.tel-input',[
                                            'name'              => 'phone',
                                            'value'             => $user->phone,
                                            'label'             => __('phone_number'),
                                            'id'                => 'phoneNumber',
                                            'country_id_field'  => 'phone_country_id',
                                            'country_id'        => $user->phone_country_id ? : (setting('default_country') ? : 19)
                                            ])
                                    </div>
                                    <!-- End Phone Number Field -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="emailAddress"
                                                   class="form-label">{{__('email_address') }}</label>
                                            <input type="email" class="form-control rounded-2" id="emailAddress"
                                                   name="email"
                                                   value="{{ $user->email }}"
                                                   placeholder="{{ __('enter_email_address') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="email_error error">{{ $errors->first('email') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Email Address -->

{{--                                    <div class="col-lg-6">--}}
{{--                                        <div class="mb-4">--}}
{{--                                            <label for="password" class="form-label">{{__('password') }}</label>--}}
{{--                                            <input type="password" class="form-control rounded-2" id="password"--}}
{{--                                                   name="password" placeholder="{{ __('enter_password') }}">--}}
{{--                                            <div class="nk-block-des text-danger">--}}
{{--                                                <p class="password_error error">{{ $errors->first('password') }}</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="col-lg-6">--}}
{{--                                        <div class="mb-4">--}}
{{--                                            <label for="confirm_password"--}}
{{--                                                   class="form-label">{{__('confirm_password') }}</label>--}}
{{--                                            <input type="password" class="form-control rounded-2" id="confirm_password"--}}
{{--                                                   name="password_confirmation"--}}
{{--                                                   placeholder="{{ __('re_enter_password') }}">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="designation" class="form-label">{{__('designation') }}</label>
                                            <input type="text" class="form-control rounded-2" id="designation"
                                                   name="designation"
                                                   value="{{ $instructor->designation }}"
                                                   placeholder="{{ __('enter_designation') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="designation_error error">{{ $errors->first('designation') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Designation -->
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="website" class="form-label">{{__('website') }}</label>
                                            <input type="text" class="form-control rounded-2" id="website"
                                                   name="website" value="{{ $instructor->website }}"
                                                   placeholder="{{ __('enter_website') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="website_error error">{{ $errors->first('website') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End website -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="expertises" class="form-label">{{__('expertises') }}</label>
                                            <select multiple class="with_search" name="expertises[]"
                                                    placeholder="{{ __('expertises') }}" aria-hidden="true">
                                                @foreach($expertises as $expertise)
                                                    <option
                                                        value="{{ $expertise->id }}" {{ $instructor->expertises && in_array($expertise->id,$instructor->expertises) ? 'selected' : '' }}>{{ $expertise->expertise_title ? : $expertise->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="address" class="form-label">{{__('address') }}</label>
                                            <input type="text" value="{{ $user->address }}"
                                                   class="form-control rounded-2"
                                                   id="address"
                                                   name="address" placeholder="{{ __('enter_address') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="editor-wrapper mb-4">
                                            <label for="about" class="form-label">{{__('about') }}</label>
                                            <textarea class="form-control rounded-2 summernote" id="about"
                                                      name="about">{{ $user->about }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <h6 class="sub-title mb-3">{{ __('social_link') }}</h6>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="facebook" class="form-label">{{__('facebook') }}</label>
                                            <input type="text"
                                                   value="{{ getArrayValue('facebook',$instructor->social_links) }}"
                                                   class="form-control rounded-2" id="facebook"
                                                   name="social_links[facebook]"
                                                   placeholder="{{ __('facebook_link') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="twitter" class="form-label">{{__('twitter') }}</label>
                                            <input type="text"
                                                   value="{{ getArrayValue('twitter',$instructor->social_links) }}"
                                                   class="form-control rounded-2" id="twitter"
                                                   name="social_links[twitter]" placeholder="{{ __('twitter_link') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="instagram" class="form-label">{{__('instagram') }}</label>
                                            <input type="text"
                                                   value="{{ getArrayValue('instagram',$instructor->social_links) }}"
                                                   class="form-control rounded-2" id="instagram"
                                                   name="social_links[instagram]"
                                                   placeholder="{{ __('instagram_link') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="linkedin" class="form-label">{{__('linkedin') }}</label>
                                            <input type="text"
                                                   value="{{ getArrayValue('linkedin',$instructor->social_links) }}"
                                                   class="form-control rounded-2" id="linkedin"
                                                   name="social_links[linkedin]"
                                                   placeholder="{{ __('linkedin_link') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="youtube" class="form-label">{{__('youtube') }}</label>
                                            <input type="text"
                                                   value="{{ getArrayValue('youtube',$instructor->social_links) }}"
                                                   class="form-control rounded-2" id="youtube"
                                                   name="social_links[youtube]"
                                                   placeholder="{{ __('youtube_link') }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 input_file_div mb-4">
                                        <div class="mb-3">
                                            <label class="form-label mb-1">{{__('upload_profile_photo') }}(417x384)</label>
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
                                                <img class="selected-img" src="{{ getFileLink('80x80',$user->images) }}"
                                                     alt="favicon">
                                            </div>
                                        </div>
                                    </div>
                                  
                                    <!-- End Upload Profile Photo -->
                                    <div class="d-flex justify-content-end align-items-center mt-30">
                                        <button type="submit" class="btn sg-btn-primary">{{__('save') }}</button>
                                        @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ static_asset('admin/js/countries.js') }}"></script>
    <script>
        searchInstructor($('.form-select'));
    </script>
@endpush
