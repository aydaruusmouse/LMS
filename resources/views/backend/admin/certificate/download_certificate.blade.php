<html>

<head>
    <meta charset="utf-8">
    <title></title>
    {{-- <link rel="stylesheet" href="{{ static_asset('admin/css/app.css') }}" type="text/css" media="all"> --}}
    <style>
        .certificate {
            width: 730px;
            height: 516px;
            position: relative;
            background: #F1F2EB;
            margin: 0 auto !important;
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
            font-size: 26px;
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
            top: 60px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
        }

        .certificate_sign_info {
            margin-top: 30px;
        }

        .fleft {
            float: left;
            margin-right: 46px;
        }

        .fleft:last-child {
            margin-right: 0;
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
</head>

<body>
    <div class="col-xl-6 col-lg-12 col-md-6">
        <div class="student-certificate">
            <div class="certificate">
                <div class="certificate_img">
                    <img src="{{ static_asset('admin/certificate/certificate-border.png') }}" alt="Certificate">
                </div>
                <div class="certificate_content_wrap">

                    <div class="certificate_info_img">
                        <img src="{{ static_asset('admin/certificate/certificate-top.png') }}" alt="">
                    </div>

                    <div class="certificate_content">
                        <h2>{{ $certificate->title }}</h2>
                        <h4>{{Auth::user()->first_name.' '.Auth::user()->last_name }}</h4>
                        <p>{{ $certificate->body }}</p>
                    </div>

                    <div class=" certificate_sign_info">
                        <div class=" signature fleft">
                            <img src="{{ getFileLink('170x74', $certificate->instructor_signature) }}"
                                alt="{{ __('instructor_signature') }}">
                            <h6>{{ __('instructor_signature') }}</h6>
                        </div>
                        <div class="org_logo fleft">
                            <img src="{{ getFileLink('84x85', $certificate->background_image) }}"
                                alt="{{ __('background_image') }}">
                        </div>
                        <div class="signature fleft">
                            <img src="{{ getFileLink('170x74', $certificate->administrator_signature) }}"
                                alt="{{ __('administrator_signature') }}">
                            <h6>{{ __('administrator_signature') }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
