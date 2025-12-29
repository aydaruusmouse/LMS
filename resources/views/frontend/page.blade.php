@extends('frontend.layouts.master')
@section('title', __($page_info->title))
@section('content')
    <!--====== Start Course Video Section ======-->
    <section class="course-video-section p-t-50 p-b-100 p-t-sm-30">
        <div class="container container-1278">
            <div class="row">
                <div class="col-lg-12">
                    {!! __($page_info->content) !!}
                </div>

            </div>
        </div>
    </section>
    <!--====== End Course Video Section ======-->
@endsection
