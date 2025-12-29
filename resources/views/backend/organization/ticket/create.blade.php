@extends('backend.layouts.master')
@section('title', __('create_ticket'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{ __('add_new_ticket') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('organization.tickets.store') }}" method="POST" class="form">@csrf
                            <div class="row gx-20 add-coupon">
                                <input type="hidden" name="is_modal" class="is_modal" value="0">
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="first_name" class="form-label">{{ __('first_name') }} <span class="text-danger">*</span> </label>
                                        <input type="text" name="first_name" class="form-control rounded-2" id="first_name" placeholder="{{ __('enter_first_name') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="first_name_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End First Name -->

                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="last_name" class="form-label">{{ __('last_name') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="last_name" class="form-control rounded-2" id="last_name" placeholder="{{ __('enter_last_name') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="last_name_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Last Name -->

                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="email" class="form-label">{{ __('email') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control rounded-2" id="email" name="email" placeholder="{{ __('enter_email') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="email_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Email Address -->

                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="subject" class="form-label">{{ __('subject') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control rounded-2" name="subject" id="subject" placeholder="{{ __('enter_subject') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="subject_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Subject -->

                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="department" class="form-label">{{ __('department') }} <span class="text-danger">*</span></label>
                                        <select id="department" name="department_id" class="form-select form-select-lg mb-3 without_search">
                                            <option value="">{{ __('select_department') }}</option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->title }}</option>
                                            @endforeach
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="department_id_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Category -->

                                <div class="col-lg-6">
                                    <div class="select-type-v2 mb-4">
                                        <label for="priority" class="form-label">{{ __('priority') }} <span class="text-danger">*</span></label>
                                        <select id="priority" name="priority" class="form-select form-select-lg mb-3 without_search">
                                            <option value="">{{ __('select_priority') }}</option>
                                            <option value="low">{{ __('low') }}</option>
                                            <option value="medium">{{ __('medium') }}</option>
                                            <option value="high">{{ __('high') }}</option>
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="priority_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Priority -->
                                <div class="col-lg-6">
                                    <div class="select-type-v2 mb-4">
                                        <label for="status" class="form-label">{{ __('status') }} <span class="text-danger">*</span></label>
                                        <select id="status" name="status" class="form-select form-select-lg mb-3 without_search">
                                            <option value="">{{ __('select_status') }}</option>
                                            <option value="pending">{{ __('pending') }}</option>
                                            <option value="answered">{{ __('answered') }}</option>
                                            <option value="hold">{{ __('on_hold') }}</option>
                                            <option value="open">{{ __('open') }}</option>
                                            <option value="close">{{ __('close') }}</option>
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="status_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Status -->

                                <div class="col-lg-12">
                                    <div class="editor-wrapper">
                                        <label for="product-update-editor" class="form-label">{{ __('description') }}</label>
                                        <textarea class="form-control h-150" name="description" id="product-update-editor" placeholder="{{ __('write_something_here') }}"></textarea>
                                    </div>
                                    <div class="nk-block-des text-danger">
                                        <p class="description_error error"></p>
                                    </div>
                                </div>
                                <!-- End Description -->
                                @include('backend.common.media-input',[
                                        'title' => 'Slider Image',
                                        'name'  => 'file',
                                        'col'   => 'col-12 mt-4',
                                        'size'  => '',
                                        'image' => old('image'),
                                        'label' => __('file'),
                                        'for' => '',
                                        'selection' => 'multiple',
                                    ])
                                <div class="d-flex justify-content-end align-items-center mt-30">
                                    <button type="submit" class="btn sg-btn-primary">{{ __('save') }}</button>
                                    @include('backend.common.loading-btn', ['class' => 'btn sg-btn-primary'])
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('backend.common.gallery-modal')
    <!-- End Oftions Section -->
@endsection
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@push('js_asset')
    <!--====== media.js ======-->
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
@endpush
@push('js')
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
@endpush
