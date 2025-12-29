@extends('backend.layouts.master')
@section('title', __('edit_student'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="section-title">{{ __('edit_student') }}</h3>
                <div class="bg-white redious-border p-20 p-sm-30">

                    <form class="form" action="{{ route('organization.students.update',$user->id) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row gx-20">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="firstName" class="form-label">{{__('first_name') }}</label>
                                    <input type="text" class="form-control rounded-2" id="firstName" name="first_name"
                                           value="{{ $user->first_name }}" placeholder="{{ __('enter_first_name') }}">
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
                                           value="{{ $user->last_name }}" placeholder="{{ __('enter_last_name') }}">
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
                                    <label for="emailAddress" class="form-label">{{__('email_address') }}</label>
                                    <input type="email" class="form-control rounded-2" id="emailAddress" name="email"
                                           value="{{ $user->email }}" placeholder="{{ __('enter_email_address') }}">
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
                                           name="address" placeholder="{{ __('enter_address') }}" value="{{ $user->address }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="postal_code" class="form-label">{{__('postal_code') }}</label>
                                    <input type="number" class="form-control rounded-2" id="postal_code"
                                           name="postal_code" placeholder="{{ __('enter_postal_code') }}" value="{{ $user->postal_code }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="country" class="form-label">{{__('country') }}</label>
                                    <select class="with_search" id="country" aria-hidden="true" name="country_id" data-url="{{ route('organization.ajax.states') }}">
                                        <option value="">{{ __('select_country') }}</option>
                                        @foreach($countries as $country)
                                            <option
                                                value="{{ $country->id }}" {{ $user->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="state" class="form-label">{{__('state') }}</label>
                                    <select class="with_search" aria-hidden="true" id="state" name="state_id" data-url="{{ route('organization.ajax.cities') }}">
                                        <option value="">{{ __('select_state') }}</option>
                                        @foreach($states as $state)
                                            <option
                                                value="{{ $state->id }}" {{ $user->state_id == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="city" class="form-label">{{__('city') }}</label>
                                    <select class="with_search" id="city" aria-hidden="true" name="city_id">
                                        <option value="">{{ __('select_city') }}</option>
                                        @foreach($cities as $city)
                                            <option
                                                value="{{ $city->id }}" {{ $user->city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="expertises" class="form-label">{{__('gender') }}</label>
                                    <select class="without_search" aria-hidden="true" name="gender">
                                        <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>{{ __('male') }}</option>
                                        <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>{{ __('female') }}</option>
                                        <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>{{ __('other') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="about" class="form-label">{{__('about') }}</label>
                                    <textarea class="form-control rounded-2" id="about" placeholder="{{ __('write_something_about_yourself') }}"
                                              name="about">{{ $user->about }}</textarea>
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
                                        <img class="selected-img" src="{{ getFileLink('80x80',$user->images) }}" alt="favicon">
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
