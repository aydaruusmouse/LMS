@extends('backend.layouts.master')
@section('title', __('update_profile'))
@section('content')
    <!-- Update Profile -->
    <section class="update-profile-section">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h3 class="section-title mb-0">{{__('update_profile')}}</h3>
                        <a href="{{ route('instructor.user.password-change') }}" class="d-flex align-items-center btn sg-btn-primary gap-2">
                            <i class="las la-arrow-right"></i>
                            <span>{{__('change_password') }}</span>
                        </a>
                    </div>
                    <div class="bg-white redious-border">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="admin-profile">
                                    <img src="{{ getFileLink('80x80', $user->images) }}"
                                         alt="{{ $user->name }}">
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('instructor.user.update') }}" enctype="multipart/form-data" class="form">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="row p-20 p-md-30">
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="fullName" class="form-label">{{__('first_name')}}</label>
                                        <input type="text" class="form-control rounded-2" id="fullName" placeholder="{{__('first_name')}}" name="first_name" value="{{ old('first_name', $user->first_name) }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="first_name_error error">{{ $errors->first('first_name') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="fullName" class="form-label">{{__('last_name')}}</label>
                                        <input type="text" class="form-control rounded-2" id="fullName" placeholder="{{__('last_name')}}" name="last_name" value="{{ old('last_name', $user->last_name) }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="last_name_error error">{{ $errors->first('last_name') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Full Name -->

                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="emailAddress" class="form-label">{{__('email_address')}}</label>
                                        <input type="text" class="form-control rounded-2" id="emailAddress" placeholder="{{__('email_address')}}" name="email" value="{{ old('email', $user->email) }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="email_error error">{{ $errors->first('email') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Email Address -->

                                <div class="col-lg-6">
                                    @include('backend.common.tel-input',[
                                    'name' => 'phone',
                                    'value' => $user->phone,
                                    'label' => __('phone_number'),
                                    'id' => 'phoneNumber',
                                    'country_id_field' => 'phone_country_id',
                                    'country_id' => $user->phone_country_id ? : (setting('default_country') ? : 19)
                                    ])
                                </div>
                                <!-- End Phone Number Field -->
                                <div class="col-lg-6 input_file_div">
                                    <div class="mb-3">
                                        <label class="form-label mb-1">{{ __('change_profile_photo') }}</label>
                                        <label for="profilePhoto" class="file-upload-text">
                                            <p></p>
                                            <span class="file-btn">{{ __('choose_file') }}</span>
                                        </label>
                                        <input class="d-none file_picker" type="file" id="profilePhoto" name="image">
                                        <div class="nk-block-des text-danger">
                                            <p class="image_error error">{{ $errors->first('image') }}</p>
                                        </div>
                                    </div><div class="selected-files d-flex flex-wrap gap-20">
                                        <div class="selected-files-item">
                                            <img class="selected-img" src="{{ getFileLink('80x80', $user->images) }}"
                                                alt="favicon">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Upload Profile Photo Input Field -->

                                <div class="col-lg-6">
                                    <div class=" mb-4">
                                        <label for="address" class="form-label mb-1">{{__('address')}}</label>
                                        <input type="text" class="form-control rounded-2" id="address" placeholder="{{__('address')}}" name="address" value="{{ old('address', $user->address) }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="address_error error">{{ $errors->first('address') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Address -->


                                <div class="d-flex justify-content-start mt-30">
                                    <button type="submit" class="btn sg-btn-primary">{{ __('update') }}</button>
                                    @include('backend.common.loading-btn', [
                                        'class' => 'btn sg-btn-primary',
                                    ])
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Update Profile Section -->
@endsection
@push('js')
    <script src="{{ static_asset('admin/js/countries.js') }}"></script>
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
@endpush
