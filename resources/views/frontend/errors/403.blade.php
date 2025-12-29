@extends('frontend.layouts.master')
@section('content')
    <section class="error-section">
        <div class="container container-1278">
            <div class="row align-items-center justify-content-center text-center vh-100">
                <div class="col-lg-8 col-md-10 col-sm-10">
                    <div class="error-page-title">
                        <h1 class="m-b-65 m-b-md-30 m-b-sm-20"><span>403</span></h1>
                        <h2 class="m-b-15">{{__('permission_denied')}}</h2>
                        <p class="m-b-55 m-b-md-30 m-b-sm-20">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                        <a href="index.html" class="template-btn">
                            {{__('back_to_homepage')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
