@extends('backend.layouts.master')
@section('title', __('edit_certificate'))
@push('css')
    <style>
        .certificate {
            width: 730px;
            height: 516px;
            position: relative;
            background: #F1F2EB;
        }
        .certificate_img img {
            height: 100%;
            width: 100%;
        }
        .certificate_info_img img {
            width: 250px;
            height: auto;
            margin: 0 auto;
        }
        .certificate_content h2 {
            font-size: 28px;
        }
        .certificate_content p {
            width: 520px;
            line-height: 22px;
        }
        .org_logo img {
            width: 85px;
            height: 85px;
            border-radius: 50%;
        }
        .certificate_content_wrap {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .certificate_sign_info {
            margin-top: 20px;
        }
        .fleft {
            float: left;
        }

        .fleft:not(:last-child) {
            margin-right: 46px;
        }

        .signature.fleft {
            margin-top: 20px;
        }
        .signature h6 {
            font-size: 16px;
            border-top: 1px solid #666;
            padding-top: 6px;
            color: #333;
        }
        .signature img {
            max-width: 170px;
            height: auto;
            padding-bottom: 4px;
            object-fit: contain;
        }
        .certificate_content {
            margin-top: 16px;
        }
        .registration-number {
            position: absolute;
            top: 70px;
            left: 70px;
        }
        .registration-number span {
            color: #556068;
            font-size: 12px;
            line-height: 28px;
            font-weight: 400;
        }
    </style>
@endpush
@section('content')
    <!-- Add Certificate -->
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('edit_certificate')}}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('certificates.update', $course->id) }}" method="POST" class="form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <div class="row gx-20">
                                <div class="col-xl-6 col-md-12">
                                    <div class="section-top">
                                        <h6>{{__('certificate_information')}}</h6>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="courseTitle" class="form-label">{{__('course_title')}}</label>
                                            <input type="text" class="form-control rounded-2" id="courseTitle" name="title" value="{{ $course->title  }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="title_error error"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Course Title -->

                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="bodyText" class="form-label">{{__('body_text')}}</label>
                                            <textarea class="form-control" placeholder="" id="bodyText" name="body">{{$course->certificate ?  $course->certificate->body:'' }}</textarea>
                                            <div class="nk-block-des text-danger">
                                                <p class="body_error error"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Body Text -->
                                    @include('backend.common.media-input',[
                                        'title' => __('instructor_signature'),
                                        'name'  => 'instructor_signature_media_id',
                                        'col'   => 'col-12 mb-4',
                                        'size'  => '(170x74)',
                                        'label' => __('instructor_signature'),
                                        'image' =>$course->certificate ?  $course->certificate->instructor_signature:'',
                                        'edit'  =>$course->certificate ? $course->certificate: '',
                                        'image_object'  =>$course->certificate ?  $course->certificate->instructor_signature: '',
                                        'media_id'  =>$course->certificate ?  $course->certificate->instructor_signature_media_id: '',
                                    ])
                                    <!-- End Instructor Signature -->
                                    <div class="nk-block-des text-danger">
                                        <p class="instructor_signature_media_id_error error"></p>
                                    </div>

                                    @include('backend.common.media-input',[
                                        'title' => __('administrator_signature'),
                                        'name'  => 'administrator_signature_media_id',
                                        'col'   => 'col-12 mb-4',
                                        'size'  => '(170x74)',
                                        'label' => __('administrator_signature'),
                                        'image' =>$course->certificate ?  $course->certificate->administrator_signature:'',
                                        'edit'  =>$course->certificate ? $course->certificate:'',
                                        'image_object'  =>$course->certificate ?  $course->certificate->administrator_signature: '',
                                        'media_id'  =>$course->certificate ?  $course->certificate->administrator_signature_media_id: '',
                                    ])
                                    <!-- End Administrator Signature -->
                                    <div class="nk-block-des text-danger">
                                        <p class="administrator_signature_media_id_error error"></p>
                                    </div>


                                    @include('backend.common.media-input',[
                                       'title' => __('logo_image'),
                                       'name'  => 'background_image_media_id',
                                       'col'   => 'col-12 mb-4',
                                       'size'  => '(84x85)',
                                       'label' => __('logo_image'),
                                       'image' =>$course->certificate ? $course->certificate->background_image: '',
                                       'edit'  =>$course->certificate ? $course->certificate:'',
                                       'image_object'  =>$course->certificate ? $course->certificate->background_image:'',
                                       'media_id'  =>$course->certificate ? $course->certificate->background_image_media_id:'',
                                   ])
                                    <!-- End Background Image -->
                                    <div class="nk-block-des text-danger">
                                        <p class="background_image_media_id_error error"></p>
                                    </div>

                                    <div class="d-flex justify-content-start align-items-center mt-30 mb-4 mb-lg-0">
                                        <button type="submit" class="btn sg-btn-primary">{{__('submit') }}</button>
                                        @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-12">
                                    <div class="section-top">
                                        <h6>{{__('preview')}}</h6>
                                    </div>

                                    <div class="certificate-scrollable">
                                        <div class="certificate certificate-respon">
                                        <div class="certificate_img">
                                            <img src="{{ static_asset('admin/certificate/certificate-border.png') }}" alt="Certificate">
                                        </div>
                                        <div class="registration-number"><span>Reg : 12453620</span></div>
                                        <div class="certificate_content_wrap">
                                            <div class="certificate_info_img">
                                                <img src="{{ static_asset('admin/certificate/certificate-top.png') }}" alt="">
                                            </div>
                                            <div class="certificate_content">
                                                <h2>{{ $course->title }}</h2>
                                                <p>{{ $course->certificate ? $course->certificate->body: '' }}</p>
                                            </div>

                                            <div class="certificate_sign_info">
                                            <div class="signature">
                                                <img src="{{ getFileLink('170x74', $course->certificate ? $course->certificate->instructor_signature: '') }}" alt="{{__('instructor_signature')}}">
                                                <h6>{{__('instructor_signature') }}</h6>
                                            </div>
                                            <div class="org_logo">
                                                <img src="{{ getFileLink('84x85', $course->certificate ? $course->certificate->background_image: '') }}" alt="{{__('background_image')}}">
                                            </div>
                                            <div class="signature">
                                                <!-- <h3>Shakib Al Hasan</h3> -->
                                                <!-- <h3>Shakib Al Hasan</h3> -->
                                                <img src="{{ getFileLink('170x74', $course->certificate ? $course->certificate->administrator_signature: '') }}" alt="{{__('administrator_signature')}}">
                                                <h6>{{__('administrator_signature') }}</h6>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End Oftions Module -->
    @include('backend.common.gallery-modal')
@endsection

@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@push('js_asset')
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/moment.min.js') }}"></script>
@endpush
@push('js')
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
@endpush
