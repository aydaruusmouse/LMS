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
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 100px;
        }

        .certificate_sign_info {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 48px;
            margin-top: 40px;
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

        @media (min-width: 1200px) {
            .certificate.certificate-respon {
                width: inherit;
                height: inherit;
            }
            .certificate-respon .certificate_sign_info {
                gap: 30px;
                margin-top: 30px;
            }
            .certificate-respon .certificate_info_img img {
                width: 145px;
            }
            .certificate-respon .certificate_content h2 {
                font-size: 18px;
            }
            .certificate-respon .certificate_content p {
                width: 430px;
                line-height: 22px;
            }
            .certificate-respon .signature img {
                max-width: 110px;
            }
            .certificate-respon .signature h6 {
                font-size: 14px;
            }
            .certificate-respon .org_logo img {
                width: 60px;
                height: 60px;
                border-radius: 50%;
            }
        }
        @media screen and (min-width: 992px) and (max-width: 1199px) {
            .certificate.certificate-respon {
                width: inherit;
                height: inherit;
            }
            .certificate-respon .certificate_info_img img {
                width: 130px;
            }
            .certificate-respon .certificate_content h2 {
                font-size: 14px;
            }
            .certificate-respon .certificate_content p {
                width: 350px;
                font-size: 14px;
            }
            .certificate-respon .certificate_sign_info {
                gap: 30px;
                margin-top: 15px;
            }
            .certificate-respon .signature img {
                max-width: 100px;
                padding-bottom: 4px;
            }
            .certificate-respon .signature h6 {
                font-size: 11px;
            }
            .certificate-respon .org_logo img {
                width: 50px;
                height: 50px;
            }
        }
        @media screen and (max-width: 991px) {
            .certificate {
                width: inherit;
                height: inherit;
            }
            .certificate_info_img img {
                width: 200px;
            }
        }
        @media screen and (max-width: 775px) {
            .certificate_content h2 {
                font-size: 18px;
            }
            .certificate_content p {
                width: 420px;
                font-size: 14px;
            }
            .certificate_sign_info {
                gap: 30px;
                margin-top: 30px;
            }
            .signature img {
                max-width: 125px;
            }
            .signature h6 {
                font-size: 14px;
            }
            .org_logo img {
                width: 60px;
                height: 60px;
            }
        }

        @media screen and (max-width: 575px) {
            .certificate_info_img img {
                width: 150px;
            }
            .certificate_content h2 {
                font-size: 16px;
            }
            .certificate_content p {
                width: 350px;
                font-size: 14px;
            }
            .certificate_sign_info {
                gap: 25px;
                margin-top: 20px;
            }
            .signature img {
                max-width: 120px;
            }
            .signature h6 {
                font-size: 12px;
            }
            .org_logo img {
                width: 50px;
                height: 50px;
            }
        }

    </style>
@endpush

@foreach($courses as $course)
    <div class="col-xxl-6 col-xl-12 col-md-12">
        <a href="{{ route('instructor.certificates.download', $course->id) }}">
            <div class="student-certificate">
                <div class="certificate certificate-respon">
                    <div class="certificate_img">
                        <img src="{{ static_asset('admin/certificate/certificate-border.png') }}" alt="Certificate">
                    </div>
                    <div class="certificate_content_wrap">
                        <div class="certificate_info_img">
                            <img src="{{ static_asset('admin/certificate/certificate-top.png') }}" alt="">
                        </div>
                        <div class="certificate_content">
                            <h2>{{ $course->title  }}</h2>
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
                                <img src="{{ getFileLink('170x74', $course->certificate ? $course->certificate->administrator_signature: '') }}" alt="{{__('administrator_signature')}}">
                                <h6>{{__('administrator_signature') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endforeach

