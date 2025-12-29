@extends('frontend.layouts.master')
@section('title', $organization->org_name)
@section('content')
    <section class="instructor-details-area p-t-50 p-t-sm-30 p-b-50 p-b-sm-30">
        <div class="container container-1278">
            <!-- Instructor Profile Overview -->
            <div class="instructor-profile-preview m-b-50 m-b-sm-40">
                <div class="instructor-profile-picture">
                    <img src="{{ getFileLink('417x384',$organization->logo) }}" alt="Instructor Thumbnail">
                </div>
                <div class="instructor-preview-content">
                    <div class="instructor-title-with-rating">
                        <div class="instructor-title-with-rating-content">
                            <h3 class="title">{{ $organization->org_name }}</h3>
                            <p class="designation">{{ $organization->tagline }}</p>
                            <!-- <div class="rating-review">
                                <ul class="all-rating star-4">
                                    <li>
                                        <div class="main-rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="blank-rating">
                                            <i class="fal fa-star"></i>
                                            <i class="fal fa-star"></i>
                                            <i class="fal fa-star"></i>
                                            <i class="fal fa-star"></i>
                                            <i class="fal fa-star"></i>
                                        </div>
                                    </li>
                                </ul>
                                <span class="total-review">(469 Reviews)</span>
                            </div> -->

                            @if($total_review > 0)
                                <div class="rating-review">
                                    <div class="my-rating all-rating star-2.6"></div>
                                    <div class="total-review">({{ $total_review }} {{ __('reviews') }})</div>
                                </div>
                            @endif
                        </div>
                        <div class="instructor-badges">
                            <ul>
                                @foreach($badges as $badge)
                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-original-title="{{ $badge->badge_name }}"><img
                                            src="{{ static_asset($badge->logo) }}"
                                            alt="{{ $badge->badge_name }}"></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="instructor-current-content">
                        <a href="#" class="instructor-content-countdown">
                            <img src="{{ static_asset('frontend/img/icons/instructor/instructor.svg') }}" alt="Student">
                            <div class="name">
                                <span>{{ $total_instructors }}</span>
                                <h6>Instructors</h6>
                            </div>
                        </a>
                        <a href="#" class="instructor-content-countdown">
                            <img src="{{ static_asset('frontend/img/icons/instructor/books.svg') }}" alt="Books">
                            <div class="name">
                                <span>{{ $total_courses }}</span>
                                <h6>Courses</h6>
                            </div>
                        </a>
                        <a href="#" class="instructor-content-countdown">
                            <img src="{{ static_asset('frontend/img/icons/instructor/student.svg') }}" alt="Student">
                            <div class="name">
                                <span>{{ $total_students }}</span>
                                <h6>Students</h6>
                            </div>
                        </a>
                        <a href="#" class="instructor-content-countdown">
                            <img src="{{ static_asset('frontend/img/icons/instructor/course.svg') }}" alt="Course">
                            <div class="name">
                                <span>{{ $total_enrolls }}</span>
                                <h6>Enrolment</h6>
                            </div>
                        </a>
                    </div>
                    <!--                    <div class="instructor-social-activity">
                                            <div class="instructor-follow-wrapper">
                                                <ul class="following-and-followers">
                                                    <li><span>98</span>Following</li>
                                                    <li><span>06</span>Followers</li>
                                                </ul>
                                                <div class="follow-btn">
                                                    <a href="#" class="template-btn"> <i class="fal fa-plus ms-0 m-r-5"></i> Follow</a>
                                                </div>
                                            </div>
                                            <ul class="social-profile">
                                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                            </ul>
                                        </div>-->
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- Instructor Details Tab -->
                    <div class="instructor-details-tabs main-tabs">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="about-instructor-tab" data-bs-toggle="pill"
                                        data-bs-target="#about-instructor" type="button" role="tab"
                                        aria-controls="about-instructor" aria-selected="true">About
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="instructor-book-tab" data-bs-toggle="pill"
                                        data-bs-target="#instructor-book" type="button" role="tab"
                                        aria-controls="instructor-book" aria-selected="false">Instructor
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="instructor-course-tab" data-bs-toggle="pill"
                                        data-bs-target="#instructor-course" type="button" role="tab"
                                        aria-controls="instructor-course" aria-selected="false">Course
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="instructor-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#instructor-contact" type="button" role="tab"
                                        aria-controls="instructor-contact" aria-selected="false">Contact
                                </button>
                            </li>
                        </ul>

                        <div class="instructor-details-tab-content tab-content" id="pills-tabContent">
                            <!-- About Instructor Tab -->
                            <div class="tab-pane fade show active" id="about-instructor" role="tabpanel"
                                 aria-labelledby="about-instructor-tab">
                                <div class="about-instructor-content">
                                    {!! $organization->about !!}
                                </div>
                            </div>

                            <!-- Instructor Book Tab -->
                            <div class="instructor-book-tab tab-pane fade" id="instructor-book" role="tabpanel"
                                 aria-labelledby="instructor-book-tab">
                                <div class="team-member-wrap">
                                    <div class="row load_more_area team-member-items-v2">
                                        @if(count($instructors) > 0)
                                            @foreach($instructors as $key=> $instructor)
                                                @include('frontend.instructor.component.instructor_load_more')
                                            @endforeach
                                        @else
                                            @include('frontend.not_found',$data=['title'=> 'instructors'])
                                        @endif
                                    </div>
                                    @if($instructors->nextPageUrl())
                                        <div class="m-t-10 text-align-start text-align-md-center load_more_div">
                                            <a data-page="{{ $instructors->currentPage() }}"
                                               data-url="{{ route('organization.instructor') }}"
                                               href="javascript:void(0)"
                                               class="template-btn load_more">{{__('see_more') }}
                                                <i class="fas fa-long-arrow-right d-none d-md-inline-block"></i></a>
                                            @include('components.frontend_loading_btn', ['class' => 'template-btn see-more'])
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Instructor Course Tab -->
                            <div class="instructor-course-tab tab-pane fade" id="instructor-course" role="tabpanel"
                                 aria-labelledby="instructor-course-tab">
                                <div class="row load_more_area course-items-v3">
                                    @foreach($courses as $key=> $course)
                                        @include('frontend.course.component',['col' => 'col-lg-4'])
                                    @endforeach
                                </div>
                                @if($courses->nextPageUrl())
                                    <div class="m-t-10 text-align-start text-align-md-center load_more_div">
                                        <a href="javascript:void(0)"
                                           class="template-btn load_more"
                                           data-page="{{ $courses->currentPage() }}"
                                           data-url="{{ route('organization.course') }}">{{ __('load_more') }}</a>
                                        @include('components.frontend_loading_btn', ['class' => 'template-btn'])
                                    </div>
                                @endif
                            </div>

                            <!-- Instructor Contact Tab -->
                            <div class="instructor-contact-tab m-b-30 m-b-sm-15 tab-pane fade" id="instructor-contact"
                                 role="tabpanel" aria-labelledby="instructor-contact-tab">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="organiztion">
                                            <div class="organiztion-icon">
                                                <img src="{{ getFileLink('127x102',$organization->logo) }}"
                                                     alt="Organization">
                                            </div>
                                            <div class="organiztion-content">
                                                <div class="organiztion-head mb-4">
                                                    <h3>{{ $organization->org_name }}</h3>
                                                </div>
                                                <div class="organiztion-body">
                                                    <ul>
                                                        <li>
                                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M5.41022 1.875C5.08307 1.875 4.76081 1.99219 4.49225 2.20703L4.45319 2.22656L4.43366 2.24609L2.48053 4.25781L2.50006 4.27734C1.89704 4.83398 1.71149 5.6665 1.97272 6.38672C1.97516 6.3916 1.97028 6.40137 1.97272 6.40625C2.50251 7.92236 3.85749 10.8496 6.50397 13.4961C9.16022 16.1523 12.1265 17.4536 13.5938 18.0273H13.6133C14.3726 18.2812 15.1954 18.1006 15.7813 17.5977L17.754 15.625C18.2715 15.1074 18.2715 14.209 17.754 13.6914L15.2149 11.1523L15.1954 11.1133C14.6778 10.5957 13.7598 10.5957 13.2423 11.1133L11.9923 12.3633C11.5406 12.146 10.4639 11.5894 9.43366 10.6055C8.41071 9.62891 7.88825 8.50586 7.69538 8.06641L8.94538 6.81641C9.47028 6.2915 9.48004 5.41748 8.92585 4.90234L8.94538 4.88281L8.88678 4.82422L6.38678 2.24609L6.36725 2.22656L6.32819 2.20703C6.05964 1.99219 5.73737 1.875 5.41022 1.875ZM5.41022 3.125C5.45661 3.125 5.50299 3.14697 5.54694 3.18359L8.04694 5.74219L8.10553 5.80078C8.10065 5.7959 8.14215 5.86182 8.06647 5.9375L6.50397 7.5L6.211 7.77344L6.34772 8.16406C6.34772 8.16406 7.06549 10.0854 8.57428 11.5234L8.711 11.6406C10.1636 12.9663 11.8751 13.6914 11.8751 13.6914L12.2657 13.8672L14.1212 12.0117C14.2286 11.9043 14.209 11.9043 14.3165 12.0117L16.8751 14.5703C16.9825 14.6777 16.9825 14.6387 16.8751 14.7461L14.961 16.6602C14.6729 16.9067 14.3677 16.958 14.004 16.8359C12.588 16.2793 9.83649 15.0708 7.38288 12.6172C4.90973 10.144 3.61823 7.33887 3.1446 5.97656C3.04938 5.72266 3.11774 5.34668 3.33991 5.15625L3.37897 5.11719L5.2735 3.18359C5.31745 3.14697 5.36383 3.125 5.41022 3.125Z"
                                                                    fill="#7E7F92"/>
                                                            </svg>
                                                            {{ $organization->phone }}
                                                        </li>
                                                        <li>
                                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M1.875 5V16.25H18.125V5H1.875ZM4.57031 6.25H15.4297L10 9.86328L4.57031 6.25ZM3.125 6.79688L9.64844 11.1523L10 11.3672L10.3516 11.1523L16.875 6.79688V15H3.125V6.79688Z"
                                                                    fill="#7E7F92"/>
                                                            </svg>
                                                            {{ $organization->email }}
                                                        </li>
                                                        <li>
                                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M10 1.875C6.90186 1.875 4.375 4.40186 4.375 7.5C4.375 8.37891 4.73145 9.38721 5.21484 10.4883C5.69824 11.5894 6.3208 12.7588 6.95312 13.8477C8.21777 16.0278 9.49219 17.8516 9.49219 17.8516L10 18.5938L10.5078 17.8516C10.5078 17.8516 11.7822 16.0278 13.0469 13.8477C13.6792 12.7588 14.3018 11.5894 14.7852 10.4883C15.2686 9.38721 15.625 8.37891 15.625 7.5C15.625 4.40186 13.0981 1.875 10 1.875ZM10 3.125C12.4243 3.125 14.375 5.07568 14.375 7.5C14.375 8.00049 14.1064 8.94775 13.6523 9.98047C13.1982 11.0132 12.5708 12.1582 11.9531 13.2227C10.9717 14.917 10.3613 15.813 10 16.3477C9.63867 15.813 9.02832 14.917 8.04688 13.2227C7.4292 12.1582 6.80176 11.0132 6.34766 9.98047C5.89355 8.94775 5.625 8.00049 5.625 7.5C5.625 5.07568 7.57568 3.125 10 3.125ZM10 6.25C9.30908 6.25 8.75 6.80908 8.75 7.5C8.75 8.19092 9.30908 8.75 10 8.75C10.6909 8.75 11.25 8.19092 11.25 7.5C11.25 6.80908 10.6909 6.25 10 6.25Z"
                                                                    fill="#7E7F92"/>
                                                            </svg>
                                                            {{ $organization->address }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    @if($organization->person_name || $organization->person_email || $organization->person_phone)
                                        <div class="col-lg-6 col-md-6">
                                            <div class="organiztion">
                                                <div class="organiztion-icon">
                                                    <img src="{{ getFileLink('127x102',$organization->person_image) }}"
                                                         alt="Organization">
                                                </div>
                                                <div class="organiztion-content">
                                                    <div class="organiztion-head mb-4">
                                                        <h3>{{ $organization->person_name }}</h3>
                                                        <p>{{ $organization->person_designation }}</p>
                                                    </div>
                                                    <div class="organiztion-body">
                                                        <ul>
                                                            <li>
                                                                <svg width="20" height="20" viewBox="0 0 20 20"
                                                                     fill="none"
                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M5.41022 1.875C5.08307 1.875 4.76081 1.99219 4.49225 2.20703L4.45319 2.22656L4.43366 2.24609L2.48053 4.25781L2.50006 4.27734C1.89704 4.83398 1.71149 5.6665 1.97272 6.38672C1.97516 6.3916 1.97028 6.40137 1.97272 6.40625C2.50251 7.92236 3.85749 10.8496 6.50397 13.4961C9.16022 16.1523 12.1265 17.4536 13.5938 18.0273H13.6133C14.3726 18.2812 15.1954 18.1006 15.7813 17.5977L17.754 15.625C18.2715 15.1074 18.2715 14.209 17.754 13.6914L15.2149 11.1523L15.1954 11.1133C14.6778 10.5957 13.7598 10.5957 13.2423 11.1133L11.9923 12.3633C11.5406 12.146 10.4639 11.5894 9.43366 10.6055C8.41071 9.62891 7.88825 8.50586 7.69538 8.06641L8.94538 6.81641C9.47028 6.2915 9.48004 5.41748 8.92585 4.90234L8.94538 4.88281L8.88678 4.82422L6.38678 2.24609L6.36725 2.22656L6.32819 2.20703C6.05964 1.99219 5.73737 1.875 5.41022 1.875ZM5.41022 3.125C5.45661 3.125 5.50299 3.14697 5.54694 3.18359L8.04694 5.74219L8.10553 5.80078C8.10065 5.7959 8.14215 5.86182 8.06647 5.9375L6.50397 7.5L6.211 7.77344L6.34772 8.16406C6.34772 8.16406 7.06549 10.0854 8.57428 11.5234L8.711 11.6406C10.1636 12.9663 11.8751 13.6914 11.8751 13.6914L12.2657 13.8672L14.1212 12.0117C14.2286 11.9043 14.209 11.9043 14.3165 12.0117L16.8751 14.5703C16.9825 14.6777 16.9825 14.6387 16.8751 14.7461L14.961 16.6602C14.6729 16.9067 14.3677 16.958 14.004 16.8359C12.588 16.2793 9.83649 15.0708 7.38288 12.6172C4.90973 10.144 3.61823 7.33887 3.1446 5.97656C3.04938 5.72266 3.11774 5.34668 3.33991 5.15625L3.37897 5.11719L5.2735 3.18359C5.31745 3.14697 5.36383 3.125 5.41022 3.125Z"
                                                                        fill="#7E7F92"/>
                                                                </svg>
                                                                {{ $organization->person_phone }}
                                                            </li>
                                                            <li>
                                                                <svg width="20" height="20" viewBox="0 0 20 20"
                                                                     fill="none"
                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M1.875 5V16.25H18.125V5H1.875ZM4.57031 6.25H15.4297L10 9.86328L4.57031 6.25ZM3.125 6.79688L9.64844 11.1523L10 11.3672L10.3516 11.1523L16.875 6.79688V15H3.125V6.79688Z"
                                                                        fill="#7E7F92"/>
                                                                </svg>
                                                                {{ $organization->person_email }}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ static_asset('frontend/css/star-rating-svg.css') }}">
@endpush
@push('js')
    <script src="{{ static_asset('frontend/js/jquery.star-rating-svg.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(".my-rating").starRating({
                initialRating: parseFloat('{{ $total_rating }}'),
                starShape: 'rounded',
                starSize: 20,
                readOnly: true,
                activeColor: '#fdcc0d',
                useGradient: false
            });
            $(document).on('click', '.load_more', function () {
                var that = $(this);
                let page = parseInt(that.data('page')) + 1;

                var btn_selector = $(that).closest('.tab-pane').find('.load_more_div');
                btn_selector.find('.loading_button').removeClass('d-none');
                that.addClass('d-none');
                let url = that.data('url');

                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        page: page,
                        id: '{{ $organization->id }}'
                    },
                    success: function (data) {
                        let selector = $(that).closest('.tab-pane').find('.load_more_area');
                        selector.append(data.html);
                        that.data('page', page);
                        initAOS();

                        if (data.next_page) {
                            btn_selector.find('.loading_button').addClass('d-none');
                            that.removeClass('d-none');
                        } else {
                            btn_selector.find('.loading_button').addClass('d-none');
                            that.addClass('d-none');
                        }
                    }
                });
            });
        })
    </script>
@endpush
