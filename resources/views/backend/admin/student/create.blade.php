@extends('backend.layouts.master')
@section('title', __('create_student'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="section-title">{{ __('create_student') }}</h3>
                <div class="bg-white redious-border p-20 p-sm-30">

                    <form class="form" action="{{ route('students.store') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row gx-20">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="firstName" class="form-label">{{__('first_name') }}</label>
                                    <input type="text" class="form-control rounded-2" id="firstName" name="first_name"
                                           value="{{ old('first_name') }}" placeholder="{{ __('enter_first_name') }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="first_name_error error">{{ $errors->first('first_name') }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- End First Name -->

                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="lastName" class="form-label">{{__('last_name') }}</label>
                                    <input type="text" class="form-control rounded-2" id="lastName" name="last_name"
                                           value="{{ old('last_name') }}" placeholder="{{ __('enter_last_name') }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="last_name_error error">{{ $errors->first('last_name') }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Last Name -->

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
                                    <label for="emailAddress" class="form-label">{{__('email_address') }}</label>
                                    <input type="email" class="form-control rounded-2" id="emailAddress" name="email"
                                           value="{{ old('email') }}" placeholder="{{ __('enter_email_address') }}" autocomplete="off">
                                    <div class="nk-block-des text-danger">
                                        <p class="email_error error">{{ $errors->first('email') }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Email Address -->

                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="password" class="form-label">{{__('password') }}</label>
                                    <input type="password" class="form-control rounded-2" id="password" name="password"
                                           placeholder="{{ __('enter_password') }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="password_error error">{{ $errors->first('password') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="confirm_password" class="form-label">{{__('confirm_password') }}</label>
                                    <input type="password" class="form-control rounded-2" id="confirm_password"
                                           name="password_confirmation" placeholder="{{ __('re_enter_password') }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="address" class="form-label">{{__('address') }}</label>
                                    <input type="text" class="form-control rounded-2" id="address"
                                           name="address" placeholder="{{ __('enter_address') }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="postal_code" class="form-label">{{__('postal_code') }}</label>
                                    <input type="number" class="form-control rounded-2" id="postal_code"
                                           name="postal_code" placeholder="{{ __('enter_postal_code') }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="country" class="form-label">{{__('country') }}</label>
                                    <select class="with_search" id="country" aria-hidden="true" name="country_id" data-url="{{ route('ajax.states') }}">
                                        <option value="">{{ __('select_country') }}</option>
                                        @foreach($countries as $country)
                                            <option
                                                value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="state" class="form-label">{{__('state') }}</label>
                                    <select class="with_search" aria-hidden="true" id="state" name="state_id" data-url="{{ route('ajax.cities') }}">
                                        <option value="">{{ __('select_state') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="city" class="form-label">{{__('city') }}</label>
                                    <select class="with_search" id="city" aria-hidden="true" name="city_id">
                                        <option value="">{{ __('select_city') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="expertises" class="form-label">{{__('gender') }}</label>
                                    <select class="without_search" aria-hidden="true" name="gender">
                                            <option value="male">{{ __('male') }}</option>
                                            <option value="female">{{ __('female') }}</option>
                                            <option value="other">{{ __('other') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="about" class="form-label">{{__('about') }}</label>
                                    <textarea class="form-control rounded-2" id="about" placeholder="{{ __('write_something_about_yourself') }}"
                                              name="about"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12 input_file_div">
                                <div class="mb-3">
                                    <label class="form-label">{{__('upload_profile_photo') }}</label>
                                    <label for="profilePhoto" class="file-upload-text">
                                        <p></p>
                                        <span class="file-btn">{{__('choose_file') }}</span>
                                    </label>
                                    <input class="d-none file_picker" type="file" id="profilePhoto" name="image">
                                    <div class="nk-block-des text-danger">
                                        <p class="image_error error">{{ $errors->first('image') }}</p>
                                    </div>
                                </div>
                                <div class="selected-files d-flex flex-wrap gap-20">
                                    <div class="selected-files-item">
                                        <img class="selected-img" src="{{ getFileLink('80x80',[]) }}" alt="favicon">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end align-items-center mt-30">
                            <button type="submit" class="btn sg-btn-primary">{{__('save') }}</button>
                            @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ static_asset('admin/js/countries.js') }}"></script>
@endpush
