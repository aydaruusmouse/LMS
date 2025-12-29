@extends('frontend.layouts.master')
@section('title', __('home'))
@section('content')
    <!--====== Start Edit Profile Section ======-->
    <section class="edit-profile-section p-t-50 p-t-sm-30 p-b-md-50 p-b-80">
        <div class="container container-1278">
            <div class="row">
                @include('frontend.profile.sidebar')
                <div class="col-md-8">
                    <div class="edit-profile-wrapper">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title-v3 color-dark m-b-40 m-b-sm-15">
                                    <h3>
                                        <i class="fal m-r-10 fa-long-arrow-left d-none d-sm-inline-block"></i>{{__('edit_profile') }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <form method="post" action="{{ route('profile-update') }}" class="user-form p-0"
                              enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ Auth()->user()->id }}" name="user_id">
                            <div class="row">

                                <div class="col-sm-6">
                                    <label for="first_name">{{__('first_name') }}</label>
                                    <input type="text" class="form-control" name="first_name" id="first_name"
                                           placeholder="{{__('first_name') }}"
                                           value="{{ old('first_name', Auth()->user()->first_name) }}">
                                    @if ($errors->has('first_name'))
                                        <div class="nk-block-des text-danger">
                                            <p>{{ $errors->first('first_name') }}</p>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-sm-6">
                                    <label for="last_name">{{__('last_name') }}</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name"
                                           placeholder="{{__('last_name') }}"
                                           value="{{ old('last_name', Auth()->user()->last_name) }}">
                                    @if ($errors->has('last_name'))
                                        <div class="nk-block-des text-danger">
                                            <p>{{ $errors->first('last_name') }}</p>
                                        </div>
                                    @endif
                                </div>
                                {{-- <div class="col-sm-6">
                                    <label for="designation">{{__('designation') }}</label>
                                    <input type="text" class="form-control" name="designation" id="designation"
                                           placeholder="{{__('designation') }}">
                                    @if ($errors->has('designation'))
                                        <div class="nk-block-des text-danger">
                                            <p>{{ $errors->first('designation') }}</p>
                                        </div>
                                    @endif
                                </div> --}}
                                <div class="col-sm-6">
                                    <label for="phone">{{__('phone') }}</label>
                                    <input type="tel" class="form-control" name="phone" id="phone"
                                           placeholder="{{__('phone') }}"
                                           value="{{ old('phone', Auth()->user()->phone) }}">
                                    @if ($errors->has('phone'))
                                        <div class="nk-block-des text-danger">
                                            <p>{{ $errors->first('phone') }}</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label for="email">{{__('email') }}</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                           placeholder="{{__('email') }}"
                                           value="{{ old('email', Auth()->user()->email) }}">
                                    @if ($errors->has('email'))
                                        <div class="nk-block-des text-danger">
                                            <p>{{ $errors->first('email') }}</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label for="address">{{__('address') }}</label>
                                    <input type="text" class="form-control" name="address" id="address"
                                           placeholder="{{__('address') }}"
                                           value="{{ old('address', Auth()->user()->address) }}">
                                    @if ($errors->has('address'))
                                        <div class="nk-block-des text-danger">
                                            <p>{{ $errors->first('address') }}</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6 position-relative">
                                    <label>{{__('image') }}</label>
                                    <label class="img_uploader" for="file">
                                        <input type="text" placeholder="Change Profile Image">
                                        <input type="file" class="d-none" id="file" name="image">
                                        <span class="upload-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                             viewBox="0 0 20 20" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M14.3287 0C17.7204 0 20 2.37694 20 5.91378V14.0862C20 17.6231 17.7204 20 14.3287 20H5.66132C2.27455 20 0 17.6231 0 14.0862V5.91378C0 2.37694 2.27455 0 5.66132 0H14.3287ZM14.3287 1.50376H5.66132C3.13527 1.50376 1.50301 3.23509 1.50301 5.91378V14.0862C1.50301 16.7659 3.13527 18.4962 5.66132 18.4962H14.3287C16.8607 18.4962 18.497 16.7659 18.497 14.0862V5.91378C18.497 3.23509 16.8607 1.50376 14.3287 1.50376ZM14.9689 10.1247C14.9753 10.1299 14.9815 10.135 14.9946 10.1472L15.0139 10.1657C15.0179 10.1695 15.0222 10.1737 15.0269 10.1783L15.0828 10.2339C15.2635 10.4149 15.763 10.9253 17.2515 12.4545C17.5411 12.7513 17.5361 13.2275 17.2385 13.5172C16.9419 13.8089 16.4649 13.7999 16.1754 13.5032C16.1754 13.5032 14.1222 11.3949 13.976 11.2525C13.8206 11.1252 13.5711 11.051 13.3257 11.0751C13.0762 11.1002 12.8517 11.2194 12.6924 11.4129C10.3637 14.239 10.3357 14.2661 10.2976 14.3032C9.43788 15.1473 8.0501 15.1332 7.20541 14.2711C7.20541 14.2711 6.27355 13.3247 6.25752 13.3057C6.02605 13.0911 5.61323 13.1052 5.36573 13.3668L3.83267 14.9839C3.68437 15.1403 3.48597 15.2184 3.28758 15.2184C3.1012 15.2184 2.91583 15.1503 2.77054 15.0119C2.46894 14.7272 2.45691 14.25 2.74249 13.9503L4.27355 12.3332C5.08417 11.4721 6.4519 11.43 7.31663 12.242L8.27655 13.2164C8.54409 13.4871 8.97896 13.4921 9.2475 13.2275C9.3487 13.1082 11.5311 10.4565 11.5311 10.4565C11.9459 9.95328 12.5311 9.64251 13.1814 9.57835C13.8327 9.5212 14.4649 9.71068 14.9689 10.1247ZM6.57134 4.6405C7.95611 4.6415 9.08136 5.76832 9.08136 7.15078C9.08136 8.53524 7.95511 9.66206 6.57134 9.66206C5.18758 9.66206 4.06232 8.53524 4.06232 7.15078C4.06232 5.76632 5.18758 4.6405 6.57134 4.6405ZM6.57034 6.14426C6.01623 6.14426 5.56533 6.59539 5.56533 7.15078C5.56533 7.70617 6.01623 8.1583 6.57134 8.1583C7.12645 8.1583 7.57836 7.70617 7.57836 7.15078C7.57836 6.59639 7.12645 6.14526 6.57034 6.14426Z"
                                                  fill="#333333"></path>
                                        </svg>
                                    </span>
                                    </label>
                                </div>
                                <div class="col-12 m-t-10 text-align-center text-align-md-end">
                                    <button class="template-btn w-auto d-inline-block"
                                            type="submit">{{__('update_profile') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Edit Profile Section ======-->
@endsection
