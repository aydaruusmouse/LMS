@extends('backend.layouts.master')
@section('title', __('update_password'))
@section('content')
    <!-- Update Profile -->
    <section class="update-profile-section">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h3 class="section-title">{{__('update_password')}}</h3>
                    <div class="bg-white redious-border">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="admin-profile">
                                    <img src="{{ getFileLink('80x80',auth()->user()->images) }}" alt="User Profile img">
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('organization.profile.password-update') }}" enctype="multipart/form-data" class="form">
                            @csrf
                            <div class="row p-20 p-md-30">
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="password" class="form-label mb-1">{{__('password')}}</label>
                                        <div class="admin-passwordField user-password">
                                            <div class="position-relative">
                                                <input type="password" class="passField form-control rounded-2" id="password" placeholder="" name="current_password">
                                                <label for="password" class="toggle-password"><i class="lar la-eye"></i></label>
                                            </div>
                                            <div class="nk-block-des text-danger">
                                                <p class="current_password_error error">{{ $errors->first('current_password') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Password -->

                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="newPassword" class="form-label mb-1">{{__('new_password')}}</label>
                                        <div class="admin-passwordField user-password">
                                            <div class="position-relative">
                                                <input type="password" class="passField form-control rounded-2" id="newPassword" placeholder="" name="password">
                                                <label for="newPassword" class="toggle-password"><i class="lar la-eye"></i></label>
                                            </div>
                                            <div class="nk-block-des text-danger">
                                                <p class="password_error error">{{ $errors->first('password') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End New Password -->

                                <div class="col-lg-12">
                                    <div class="">
                                        <label for="confirmNewPassword" class="form-label mb-1">{{__('confirm_new_password')}}</label>
                                        <div class="admin-passwordField  user-password">
                                            <div class="position-relative">
                                                <input type="password" class="passField form-control rounded-2" id="confirmNewPassword" placeholder="" name="password_confirmation">
                                                <label for="confirmNewPassword" class="toggle-password"><i class="lar la-eye"></i></label>
                                            </div>
                                            <div class="nk-block-des text-danger">
                                                <p class="password_confirmation_error error">{{ $errors->first('password_confirmation') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Confirm New Password -->

                                <div class="d-flex justify-content-start mt-30">
                                    <button type="submit" class="btn sg-btn-primary">{{ __('update') }}</button>
                                    @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
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

