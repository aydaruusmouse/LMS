@extends('frontend.layouts.master')
@section('title', __('download'))
@section('content')
    <style>


/*======= Certificate =======*/
/* .certificate {
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
    } */
.certificate {
  width: 720px;
  height: 516px;
  position: relative;
  background: #f1f2eb;
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

.certificate_content h2, .certificate_content .h2 {
  font-size: 26px;
}

.certificate_content p {
  width: 520px;
  line-height: 22px;
  margin: 0 auto;
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

.signature h6, .signature .h6 {
  font-size: 16px;
  border-top: 1px solid #666;
  padding-top: 6px;
  color: #333;
}

.signature img {
  max-width: 170px;
  height: auto;
  padding-bottom: 4px;
  -o-object-fit: contain;
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

@media screen and (min-width: 1600px) and (max-width: 1799px) {
  .certificate-scrollable .certificate {
    width: 615px !important;
    height: 436px;
  }
  .certificate_info_img img {
    width: 190px !important;
  }
  .certificate_sign_info {
    gap: 35px !important;
    margin-top: 22px !important;
  }
}
@media screen and (min-width: 1200px) and (max-width: 1599px) {
  .certificate-scrollable {
    overflow-y: scroll !important;
  }
  .certificate-scrollable .certificate {
    width: 470px !important;
  }
  .certificate.certificate-respon {
    width: inherit;
    height: inherit;
  }
  .certificate-respon .certificate_sign_info {
    gap: 30px;
    margin-top: 15px;
  }
  .certificate-respon .certificate_info_img img {
    width: 145px;
  }
  .certificate-respon .certificate_content h2, .certificate-respon .certificate_content .h2 {
    font-size: 18px;
  }
  .certificate-respon .certificate_content p {
    width: 398px;
    line-height: 16px;
    margin: 0 auto;
    font-size: 13px;
  }
  .certificate-respon .signature img {
    max-width: 110px;
  }
  .certificate-respon .signature h6, .certificate-respon .signature .h6 {
    font-size: 14px;
  }
  .certificate-respon .org_logo img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
  }
  .certificate-respon .registration-number {
    position: absolute;
    top: 70px;
    left: 50px;
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
  .certificate_content h2, .certificate_content .h2 {
    font-size: 18px;
  }
  .certificate_content p {
    width: 420px;
    font-size: 14px;
    margin: 0 auto;
  }
  .certificate_sign_info {
    gap: 30px;
    margin-top: 30px;
  }
  .signature img {
    max-width: 125px;
  }
  .signature h6, .signature .h6 {
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
  .certificate_content h2, .certificate_content .h2 {
    font-size: 16px;
  }
  .certificate_content p {
    width: 350px;
    font-size: 14px;
    margin: 0 auto;
  }
  .certificate_sign_info {
    gap: 25px;
    margin-top: 20px;
  }
  .signature img {
    max-width: 120px;
  }
  .signature h6, .signature .h6 {
    font-size: 12px;
  }
  .org_logo img {
    width: 50px;
    height: 50px;
  }
  .certificate-scrollable {
    overflow-y: scroll;
  }
  .certificate-scrollable .certificate {
    width: 470px !important;
  }
}
    </style>

    <!--====== Start Download Certificate Section ======-->
    <section class="download-certificate-section p-t-50 p-t-sm-30 p-b-80 p-b-sm-100">
        <div class="container container-1278">
            <div class="row">

                @include('frontend.profile.sidebar')
                {{-- <div class="col-md-4">
                    <div class="profile-sidebar d-none d-md-block">
                        <div class="profile-card">
                            <div class="profile-cover"></div>
                            <div class="profile-info">
                                <div class="profile-picture">
                                    <img src="{{ getFileLink('80x80', Auth()->user()->images) }}" alt="{{ Auth()->user()->first_name }}">
                                </div>
                                <h3>{{ Auth()->user()->first_name }} {{ Auth()->user()->last_name }}</h3>
                                <p>{{ Auth()->user()->gmail }}</p>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-md-8">
                    <div class="download-certificate-wrapper">
                        <div class="section-title-v3 color-dark m-b-40 m-b-sm-15">
                            <h3><i class="fal m-r-10 fa-long-arrow-left"></i>{{__('download_certificate')}}</h3>
                        </div>
                        <div class="download-certificate m-b-50" data-aos="zoom-in">
                            <div class="certificate-scrollable">
                                <div class="certificate certificate-respon">
                                <div class="certificate_img">
                                    <img src="{{ static_asset('frontend/certificate/certificate-border.png') }}" alt="Certificate">
                                </div>
                                <div class="registration-number"><span>Reg : 12453620</span></div>

                                <div class="certificate_content_wrap">
                                    <div class="certificate_info_img">
                                        <img src="{{ static_asset('frontend/certificate/certificate-top.png') }}" alt="">
                                    </div>
                                    <div class="certificate_content">
                                        <h2>{{ $course->title }}</h2>
                                        <p>{{ $course->certificate ? $course->certificate->body: '' }}</p>
                                    </div>
                                    {{Auth::user()->first_name. ' ' . Auth::user()->last_name }}
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
                                        <img src="{{ getFileLink('170x74', $course->certificate ? $course->certificate->administrator_signature: '') }}" alt="{{__('administrator_signature')}}">
                                        <h6>{{__('administrator_signature') }}</h6>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                        </div>
                        <div class="text-center" data-aos="fade-up">
                            <a href="{{ route('course.certificate-download', $course->id) }}" class="template-btn template-btn-secondary">{{__('download_certificate')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Download Certificate Section ======-->
@endsection
