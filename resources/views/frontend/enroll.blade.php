@extends('frontend.layouts.master')
@section('title', __('about'))
@section('content')
<!--====== Start Enroll Course Section ======-->
<section class="enroll-course-section p-t-50 p-t-sm-30 p-b-100">
    <div class="container container-1278">
        <div class="row">
            <div class="col-12">                    
                <div class="section-title text-align-center text-align-lg-start m-b-15 m-b-md-10">
                    <h3>Purchase Course</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="course-items-wrap">
                    <div class="row justify-content-center course-items-v3 list-view">
                        <div class="col-md-12 col-sm-7">
                            <div class="course-item">
                                <a href="course-details.html" class="course-item-thumb">
                                    <img src="assets/img/course/course-list-thumbnail-10.jpg" alt="Course thumbnail">
                                </a>
                                <div class="course-item-body p-0">
                                    <div class="course-item-body-inner">
                                        <div class="course-item-header course-item-info justify-content-end">
                                            <ul class="course-category">
                                                <li>
                                                    <a href="#">Bangla</a>
                                                </li>
                                            </ul>
                                            <div class="rating-review">
                                                <span class="total-review"><i class="fas fa-star"></i> 4.5</span>
                                            </div>
                                        </div>
                                        <h4 class="title">
                                            <a href="#">Mathematics with Animated Lessons & Art Design with Video Courses</a>
                                        </h4>
                                        <ul class="course-item-info">
                                            <li><i class="fal fa-file-alt"></i> 45 Lessons</li>
                                            <li><i class="fal fa-user-friends"></i> 567 Enroll</li>
                                        </ul>
                                    </div>
                                    <div class="course-item-footer">
                                        <div class="course-price">$390.00</div>
                                        <ul>
                                            <li>
                                                <a href="course-details.html" class="template-btn">Details</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-10 col-lg-12">
                            <div class="course-pagination text-align-center text-align-lg-start m-t-20">
                                <a href="#" class="template-btn d-block d-lg-inline-block">Purchase Now <i class="fal fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== End Enroll Course Section ======-->
@endsection
