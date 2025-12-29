@extends('backend.layouts.master')
@section('title', __('organization'))
@section('content')
    <div class="main-content-wrapper">
        <section class="oftions">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="section-title">{{__('add_organization') }}</h3>
                        <form action="{{ route('organizations.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="bg-white redious-border p-20 p-sm-30">
                                <h6 class="sub-title">{{__('organisation_information')  }}</h6>
                                <div class="row gx-20">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="organisationName"
                                                   class="form-label">{{__('organization_name') }}</label>
                                            <input type="text" class="form-control rounded-2" id="organisationName"
                                                   name="org_name" value="{{ old('org_name') }}">
                                            @if ($errors->has('org_name'))
                                                <div class="nk-block-des text-danger">
                                                    <p>{{ str_replace('org', 'organization', $errors->first('org_name')) }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <label for="organisationName" class="form-label">{{__('tagline') }}</label>
                                            <input type="text" class="form-control rounded-2" id="tagline" name="tagline" value="{{ old('tagline') }}">
                                            @if ($errors->has('tagline'))
                                                <div class="nk-block-des text-danger">
                                                    <p>{{ str_replace('org', 'organization', $errors->first('tagline')) }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- End Organisation Name -->
                                    <div class="col-lg-6">
                                        @include('backend.common.tel-input',[
                                                                                'name' => 'phone',
                                                                                'value' => old('phone'),
                                                                                'label' => __('phone_number'),
                                                                                'id' => 'orgPhoneNumber',
                                                                                'country_id_field' => 'phone_country_id',
                                                                                'country_id' => old('phone_country_id') ? : (setting('default_country') ? : 19)
                                                                                ])

                                    </div>
                                    <!-- End Phone Number Field -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="emailAddress"
                                                   class="form-label">{{__('email_address') }}</label>
                                            <input type="email" class="form-control rounded-2" id="emailAddress"
                                                   name="email" value="{{ old('email') }}" autocomplete="off">
                                            @if ($errors->has('email'))
                                                <div class="nk-block-des text-danger">
                                                    <p>{{ $errors->first('email') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- End Email Address -->

                                    <div class="col-lg-6">
                                        <div class="select-type-v2 mb-4 list-space">
                                            <label for="country" class="form-label">{{__('country') }}</label>
                                            <div class="select-type-v1 list-space">
                                                <select class="form-select form-select-lg rounded-0 mb-3 with_search"
                                                        aria-label=".form-select-lg example" name="country_id">
                                                    <option value="" selected>{{ __('select_country') }}</option>
                                                    @foreach ($countries as $country)
                                                        <option
                                                            value="{{ $country->id }}">{{__($country->name) }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('country_id'))
                                                    <div class="nk-block-des text-danger">
                                                        <p>{{ str_replace('id', '', $errors->first('country_id')) }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Country -->

                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="addressLine" class="form-label">{{__('address_line') }}</label>
                                            <textarea class="form-control" id="addressLine"
                                                      name="address">{{ old('address') }}</textarea>
                                            @if ($errors->has('address'))
                                                <div class="nk-block-des text-danger">
                                                    <p>{{ $errors->first('address') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="editor-wrapper mb-4">
                                            <label for="about" class="form-label">{{__('about') }}</label>
                                            <textarea class="form-control rounded-2 summernote" id="about" placeholder="asdasd"
                                                      name="about">{!! old('about') !!}</textarea>
                                        </div>
                                    </div>
                                    <!-- End Address Line -->
                                    @include('backend.common.media-input',[
                                        'title' => 'Organization logo',
                                        'name'  => 'logo',
                                        'col'   => 'col-12 mb-4',
                                        'size'  => '(350x150)',
                                        'image' => old('logo'),
                                        'label' => __('upload_organisation_logo')

                                    ])
                            <!-- End Select Image -->
                                    <!-- End Upload Organisation Logo -->

                                    <div class="col-12">
                                        <h6 class="sub-title mb-3">{{__('contact_person') }}</h6>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="fullName" class="form-label">{{__('name') }}</label>
                                            <input type="text" class="form-control rounded-2" id="fullName"
                                                   name="person_name" value="{{ old('person_name') }}">
                                            @if ($errors->has('person_name'))
                                                <div class="nk-block-des text-danger">
                                                    <p>{{ $errors->first('person_name') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- End Full Name -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="designation" class="form-label">{{__('designation')  }}</label>
                                            <input type="text" class="form-control rounded-2" id="designation"
                                                   name="person_designation" value="{{ old('person_designation') }}">
                                            @if ($errors->has('person_designation'))
                                                <div class="invalid-feedback">
                                                    <p>{{ $errors->first('person_designation') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- End Designation -->

                                    <div class="col-lg-6">
                                        @include('backend.common.tel-input',[
                                                                                'name' => 'person_phone',
                                                                                'value' => old('person_phone'),
                                                                                'label' => __('phone_number'),
                                                                                'id' => 'person_number',
                                                                                'country_id_field' => 'person_country_id',
                                                                                'country_id' => old('person_country_id') ? : (setting('default_country') ? : 19)
                                                                                ])
                                    </div>
                                    <!-- End Phone Number Field -->

                                    <div class="col-lg-6">
                                        <div class="">
                                            <label for="emailAddress2"
                                                   class="form-label">{{__('email_address') }}</label>
                                            <input type="email" class="form-control rounded-2" id="emailAddress2"
                                                   name="person_email" value="{{ old('person_email') }}">
                                            @if ($errors->has('person_email'))
                                                <div class="nk-block-des text-danger">
                                                    <p>{{ $errors->first('person_email') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- End Email Address -->
                                    @include('backend.common.media-input',[
                                                                            'title' => __('person_image'),
                                                                            'name'  => 'person_media_id',
                                                                            'col'   => 'col-12',
                                                                            'size'  => '(140x140)',
                                                                            'image' => old('person_media_id'),
                                                                            'label' => __('person_image')

                                                                        ])

                                    <div class="d-flex justify-content-end align-items-center mt-30">
                                        <button type="submit" class="btn sg-btn-primary">{{__('submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('backend.common.gallery-modal')
@endsection
@push('js')
    <script src="{{ static_asset('admin/js/countries.js') }}"></script>
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
@endpush
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@push('js_asset')
    <!--====== media.js ======-->
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
@endpush
