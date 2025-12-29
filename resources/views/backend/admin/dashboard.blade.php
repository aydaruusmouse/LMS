@extends('backend.layouts.master')
@section('title', __('dashboard'))
@push('css')
    <!--====== Dropzone CSS ======-->
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@section('content')
    <section class="oftions">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                    <div class="statistics-card bg-white color-success redious-border mb-20 p-20 p-md-20">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="statistics-info mb-3">
                                    <h6>Total Enrolments</h6>
                                    <h4>{{ $total_enrolment_count }} {{ $total_enrolment_count >= 1000 ? 'K' : '' }}</h4>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="statistics-gChart mb-20 mb-lg-0">
                                    <canvas id="statisticsChart1"></canvas>
                                </div>
                            </div>
                            <div class="statistics-footer d-flex align-items-center gap-3">
                                <p class="sales-price">+3k</p>
                                <h6>Since last Month</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Statistics Chart1 -->

                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                    <div class="statistics-card bg-white color-warning redious-border mb-20 p-20 p-sm-20">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="statistics-info mb-3">
                                    <h6>Total Earning</h6>
                                    <h4>$755.5K</h4>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="statistics-gChart mb-20 mb-lg-0">
                                    <canvas id="statisticsChart2"></canvas>
                                </div>
                            </div>
                            <div class="statistics-footer d-flex align-items-center gap-3">
                                <p class="sales-price">+$25.5k</p>
                                <h6>Since last Month</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Statistics Chart2 -->

                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                    <div class="statistics-card bg-white color-danger redious-border mb-20 p-20 p-sm-20">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="statistics-info mb-3">
                                    <h6>Free Course</h6>
                                    <h4>145</h4>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="statistics-gChart mb-20 mb-lg-0">
                                    <canvas id="statisticsChart7"></canvas>
                                </div>
                            </div>
                            <div class="statistics-footer d-flex align-items-center gap-3">
                                <p class="sales-price">14</p>
                                <h6>Since last Month</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Statistics Chart3 -->

                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                    <div class="statistics-card bg-white color-blue redious-border mb-20 p-20 p-sm-20">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="statistics-info mb-3">
                                    <h6>{{__('total_invest')}}</h6>
                                    <h4>$950K</h4>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="statistics-gChart mb-20 mb-lg-0">
                                    <canvas id="statisticsChart4"></canvas>
                                </div>
                            </div>
                            <div class="statistics-footer d-flex align-items-center gap-3">
                                <p class="sales-price">+$25.5k</p>
                                <h6>{{__('since_last_month')}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Statistics Chart4 -->
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                    <div class="statistics-card bg-white color-blue redious-border mb-20 p-20 p-sm-20">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="statistics-info mb-3">
                                    <h6>Total Course</h6>
                                    <h4>{{ $total_course_count }}</h4>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="statistics-gChart mb-20 mb-lg-0">
                                    <canvas id="statisticsChart4"></canvas>
                                </div>
                            </div>
                            <div class="statistics-footer d-flex align-items-center gap-3">
                                <p class="sales-price">102</p>
                                <h6>Since last Month</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Statistics Chart4 -->

            </div>

            <div class="row">
                <div class="col-xl-8 col-md-12">

                    <div class="bg-white redious-border mb-4 pt-20 p-30">
                        <div class="section-top">
                            <h4>Earning Report</h4>

                            <div class="statistics-view dropdown pe-4">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Last 7 Days
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            Last 14 Days
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            Last Month
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            Last 6 Months
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            Last 12 Months
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Statistics Report -->

                        <div class="statistics-report">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="analytics clr-1 mb-40">
                                        <div class="analytics-icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <g id="uil:users-alt">
                                                    <path id="Vector"
                                                          d="M16.4026 16.2933C17.114 15.6775 17.6847 14.9158 18.0758 14.06C18.4669 13.2042 18.6693 12.2743 18.6693 11.3333C18.6693 9.56522 17.9669 7.86953 16.7167 6.61929C15.4664 5.36904 13.7707 4.66666 12.0026 4.66666C10.2345 4.66666 8.5388 5.36904 7.28856 6.61929C6.03832 7.86953 5.33594 9.56522 5.33594 11.3333C5.33593 12.2743 5.53834 13.2042 5.92944 14.06C6.32054 14.9158 6.89117 15.6775 7.6026 16.2933C5.73612 17.1385 4.15256 18.5034 3.04124 20.2247C1.92993 21.9461 1.3379 23.9511 1.33594 26C1.33594 26.3536 1.47641 26.6928 1.72646 26.9428C1.97651 27.1929 2.31565 27.3333 2.66927 27.3333C3.02289 27.3333 3.36203 27.1929 3.61208 26.9428C3.86213 26.6928 4.0026 26.3536 4.0026 26C4.0026 23.8783 4.84546 21.8434 6.34575 20.3431C7.84604 18.8429 9.88087 18 12.0026 18C14.1243 18 16.1592 18.8429 17.6595 20.3431C19.1597 21.8434 20.0026 23.8783 20.0026 26C20.0026 26.3536 20.1431 26.6928 20.3931 26.9428C20.6432 27.1929 20.9823 27.3333 21.3359 27.3333C21.6896 27.3333 22.0287 27.1929 22.2787 26.9428C22.5288 26.6928 22.6693 26.3536 22.6693 26C22.6673 23.9511 22.0753 21.9461 20.964 20.2247C19.8527 18.5034 18.2691 17.1385 16.4026 16.2933ZM12.0026 15.3333C11.2115 15.3333 10.4381 15.0987 9.78032 14.6592C9.12253 14.2197 8.60984 13.595 8.30709 12.8641C8.00434 12.1332 7.92512 11.3289 8.07946 10.553C8.2338 9.77705 8.61477 9.06431 9.17418 8.5049C9.73359 7.94549 10.4463 7.56453 11.2222 7.41019C11.9982 7.25585 12.8024 7.33506 13.5333 7.63781C14.2642 7.94056 14.889 8.45325 15.3285 9.11105C15.768 9.76885 16.0026 10.5422 16.0026 11.3333C16.0026 12.3942 15.5812 13.4116 14.831 14.1618C14.0809 14.9119 13.0635 15.3333 12.0026 15.3333ZM24.9893 15.76C25.8426 14.7991 26.4 13.6121 26.5943 12.3418C26.7887 11.0715 26.6118 9.7721 26.085 8.6C25.5581 7.4279 24.7037 6.43306 23.6246 5.73523C22.5455 5.0374 21.2877 4.66632 20.0026 4.66666C19.649 4.66666 19.3098 4.80714 19.0598 5.05719C18.8097 5.30724 18.6693 5.64638 18.6693 6C18.6693 6.35362 18.8097 6.69276 19.0598 6.94281C19.3098 7.19285 19.649 7.33333 20.0026 7.33333C21.0635 7.33333 22.0809 7.75476 22.831 8.5049C23.5812 9.25505 24.0026 10.2725 24.0026 11.3333C24.0007 12.0336 23.815 12.7212 23.464 13.3272C23.113 13.9332 22.6091 14.4365 22.0026 14.7867C21.8049 14.9007 21.6398 15.0635 21.5231 15.2597C21.4064 15.4558 21.3419 15.6785 21.3359 15.9067C21.3304 16.133 21.3825 16.3571 21.4875 16.5577C21.5925 16.7583 21.7468 16.9289 21.9359 17.0533L22.4559 17.4L22.6293 17.4933C24.2365 18.2556 25.5924 19.4613 26.5372 20.9684C27.4821 22.4755 27.9767 24.2212 27.9626 26C27.9626 26.3536 28.1031 26.6928 28.3531 26.9428C28.6032 27.1929 28.9423 27.3333 29.2959 27.3333C29.6496 27.3333 29.9887 27.1929 30.2387 26.9428C30.4888 26.6928 30.6293 26.3536 30.6293 26C30.6402 23.9539 30.1277 21.939 29.1406 20.1467C28.1534 18.3545 26.7244 16.8444 24.9893 15.76Z"
                                                          fill="#3F52E3"/>
                                                </g>
                                            </svg>
                                        </div>

                                        <div class="analytics-content">
                                            <p>New Students</p>
                                            <h4>550</h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="analytics clr-2 mb-40">
                                        <div class="analytics-icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <g id="book-open-solid 1">
                                                    <path id="Vector"
                                                          d="M3 6V25H13C14.1016 25 15 25.8984 15 27H17C17 25.8984 17.8984 25 19 25H29V6H19C17.8086 6 16.7344 6.52734 16 7.35938C15.2656 6.52734 14.1914 6 13 6H3ZM5 8H13C14.1016 8 15 8.89844 15 10H17C17 8.89844 17.8984 8 19 8H27V23H19C17.8086 23 16.7344 23.5273 16 24.3594C15.2656 23.5273 14.1914 23 13 23H5V8ZM15 12V14H17V12H15ZM15 16V18H17V16H15ZM15 20V22H17V20H15Z"
                                                          fill="#24D6A5"/>
                                                </g>
                                            </svg>
                                        </div>

                                        <div class="analytics-content">
                                            <p>New Enrolled</p>
                                            <h4>750</h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="analytics clr-4 mb-40">
                                        <div class="analytics-icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <g id="Money/funds">
                                                    <g id="Vector">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                              d="M5.0639 5.20407C3.96377 5.75414 3.66406 6.32902 3.66406 6.66667C3.66406 7.00432 3.96377 7.5792 5.0639 8.12926C6.10421 8.64942 7.61136 9 9.33073 9C11.0501 9 12.5573 8.64942 13.5976 8.12926C14.6977 7.5792 14.9974 7.00432 14.9974 6.66667C14.9974 6.32902 14.6977 5.75414 13.5976 5.20407C12.5573 4.68392 11.0501 4.33334 9.33073 4.33334C7.61136 4.33334 6.10421 4.68392 5.0639 5.20407ZM4.16947 3.41522C5.54202 2.72895 7.3682 2.33334 9.33073 2.33334C11.2933 2.33334 13.1194 2.72895 14.492 3.41522C15.8047 4.07159 16.9974 5.16337 16.9974 6.66667C16.9974 8.16997 15.8047 9.26175 14.492 9.91812C13.1194 10.6044 11.2933 11 9.33073 11C7.3682 11 5.54202 10.6044 4.16947 9.91812C2.85674 9.26175 1.66406 8.16997 1.66406 6.66667C1.66406 5.16337 2.85674 4.07159 4.16947 3.41522Z"
                                                              fill="#FF5630"/>
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                              d="M2.66406 5.66667C3.21635 5.66667 3.66406 6.11438 3.66406 6.66667H1.66406C1.66406 6.11438 2.11178 5.66667 2.66406 5.66667ZM16.9974 6.66667V11.3333C16.9974 12.8366 15.8047 13.9284 14.492 14.5848C13.1194 15.2711 11.2932 15.6667 9.33073 15.6667C7.36819 15.6667 5.54202 15.2711 4.16947 14.5848C2.85674 13.9284 1.66406 12.8366 1.66406 11.3333V6.66667H3.66406V11.3333C3.66406 11.671 3.96377 12.2459 5.0639 12.7959C6.10421 13.3161 7.61136 13.6667 9.33073 13.6667C11.0501 13.6667 12.5572 13.3161 13.5975 12.7959C14.6977 12.2459 14.9974 11.671 14.9974 11.3333V6.66667H16.9974ZM16.9974 6.66667C16.9974 6.11438 16.5497 5.66667 15.9974 5.66667C15.4451 5.66667 14.9974 6.11438 14.9974 6.66667H16.9974Z"
                                                              fill="#FF5630"/>
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                              d="M2.66406 10.3333C3.21635 10.3333 3.66406 10.7811 3.66406 11.3333H1.66406C1.66406 10.7811 2.11178 10.3333 2.66406 10.3333ZM16.9974 11.3333V16C16.9974 17.5033 15.8047 18.5951 14.492 19.2514C13.1194 19.9377 11.2932 20.3333 9.33073 20.3333C7.36819 20.3333 5.54202 19.9377 4.16947 19.2514C2.85674 18.5951 1.66406 17.5033 1.66406 16V11.3333H3.66406V16C3.66406 16.3376 3.96377 16.9125 5.0639 17.4626C6.10421 17.9827 7.61136 18.3333 9.33073 18.3333C11.0501 18.3333 12.5572 17.9827 13.5975 17.4626C14.6977 16.9125 14.9974 16.3376 14.9974 16V11.3333H16.9974ZM16.9974 11.3333C16.9974 10.7811 16.5497 10.3333 15.9974 10.3333C15.4451 10.3333 14.9974 10.7811 14.9974 11.3333H16.9974Z"
                                                              fill="#FF5630"/>
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                              d="M2.66406 15C3.21635 15 3.66406 15.4477 3.66406 16H1.66406C1.66406 15.4477 2.11178 15 2.66406 15ZM16.9974 16V20.6667C16.9974 22.17 15.8047 23.2617 14.492 23.9181C13.1194 24.6044 11.2932 25 9.33073 25C7.36819 25 5.54202 24.6044 4.16947 23.9181C2.85674 23.2617 1.66406 22.17 1.66406 20.6667V16H3.66406V20.6667C3.66406 21.0043 3.96377 21.5792 5.0639 22.1293C6.10421 22.6494 7.61136 23 9.33073 23C11.0501 23 12.5572 22.6494 13.5975 22.1293C14.6977 21.5792 14.9974 21.0043 14.9974 20.6667V16H16.9974ZM16.9974 16C16.9974 15.4477 16.5497 15 15.9974 15C15.4451 15 14.9974 15.4477 14.9974 16H16.9974Z"
                                                              fill="#FF5630"/>
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                              d="M2.66406 19.6667C3.21635 19.6667 3.66406 20.1144 3.66406 20.6667H1.66406C1.66406 20.1144 2.11178 19.6667 2.66406 19.6667ZM16.9974 20.6667V25.3333C16.9974 26.8366 15.8047 27.9284 14.492 28.5848C13.1194 29.2711 11.2932 29.6667 9.33073 29.6667C7.36819 29.6667 5.54202 29.2711 4.16947 28.5848C2.85674 27.9284 1.66406 26.8366 1.66406 25.3333V20.6667H3.66406V25.3333C3.66406 25.671 3.96377 26.2459 5.0639 26.7959C6.10421 27.3161 7.61136 27.6667 9.33073 27.6667C11.0501 27.6667 12.5572 27.3161 13.5975 26.7959C14.6977 26.2459 14.9974 25.671 14.9974 25.3333V20.6667H16.9974ZM16.9974 20.6667C16.9974 20.1144 16.5497 19.6667 15.9974 19.6667C15.4451 19.6667 14.9974 20.1144 14.9974 20.6667H16.9974Z"
                                                              fill="#FF5630"/>
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                              d="M18.3972 14.5374C17.2971 15.0875 16.9974 15.6624 16.9974 16C16.9974 16.3376 17.2971 16.9125 18.3972 17.4626C19.4375 17.9828 20.9447 18.3333 22.6641 18.3333C24.3834 18.3333 25.8906 17.9828 26.9309 17.4626C28.031 16.9125 28.3307 16.3376 28.3307 16C28.3307 15.6624 28.031 15.0875 26.9309 14.5374C25.8906 14.0173 24.3834 13.6667 22.6641 13.6667C20.9447 13.6667 19.4375 14.0173 18.3972 14.5374ZM17.5028 12.7486C18.8754 12.0623 20.7015 11.6667 22.6641 11.6667C24.6266 11.6667 26.4528 12.0623 27.8253 12.7486C29.1381 13.4049 30.3307 14.4967 30.3307 16C30.3307 17.5033 29.1381 18.5951 27.8253 19.2515C26.4528 19.9377 24.6266 20.3333 22.6641 20.3333C20.7015 20.3333 18.8754 19.9377 17.5028 19.2515C16.1901 18.5951 14.9974 17.5033 14.9974 16C14.9974 14.4967 16.1901 13.4049 17.5028 12.7486Z"
                                                              fill="#FF5630"/>
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                              d="M15.9974 15C16.5497 15 16.9974 15.4477 16.9974 16H14.9974C14.9974 15.4477 15.4451 15 15.9974 15ZM30.3307 16V20.6667C30.3307 22.17 29.138 23.2617 27.8253 23.9181C26.4528 24.6044 24.6266 25 22.6641 25C20.7015 25 18.8754 24.6044 17.5028 23.9181C16.1901 23.2617 14.9974 22.17 14.9974 20.6667V16H16.9974V20.6667C16.9974 21.0043 17.2971 21.5792 18.3972 22.1293C19.4376 22.6494 20.9447 23 22.6641 23C24.3834 23 25.8906 22.6494 26.9309 22.1293C28.031 21.5792 28.3307 21.0043 28.3307 20.6667V16H30.3307ZM30.3307 16C30.3307 15.4477 29.883 15 29.3307 15C28.7784 15 28.3307 15.4477 28.3307 16H30.3307Z"
                                                              fill="#FF5630"/>
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                              d="M15.9974 19.6667C16.5497 19.6667 16.9974 20.1144 16.9974 20.6667H14.9974C14.9974 20.1144 15.4451 19.6667 15.9974 19.6667ZM30.3307 20.6667V25.3333C30.3307 26.8366 29.138 27.9284 27.8253 28.5848C26.4528 29.2711 24.6266 29.6667 22.6641 29.6667C20.7015 29.6667 18.8754 29.2711 17.5028 28.5848C16.1901 27.9284 14.9974 26.8366 14.9974 25.3333V20.6667H16.9974V25.3333C16.9974 25.671 17.2971 26.2459 18.3972 26.7959C19.4376 27.3161 20.9447 27.6667 22.6641 27.6667C24.3834 27.6667 25.8906 27.3161 26.9309 26.7959C28.031 26.2459 28.3307 25.671 28.3307 25.3333V20.6667H30.3307ZM30.3307 20.6667C30.3307 20.1144 29.883 19.6667 29.3307 19.6667C28.7784 19.6667 28.3307 20.1144 28.3307 20.6667H30.3307Z"
                                                              fill="#FF5630"/>
                                                    </g>
                                                </g>
                                            </svg>

                                        </div>

                                        <div class="analytics-content">
                                            <p>Total Sale</p>
                                            <h4>$5486.48K</h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="statistics-report-chart">
                            <canvas id="statisticsBarChart2"></canvas>
                        </div>

                    </div>
                </div>

                <div class="col-xl-4 col-md-12">
                    <div class="row">
                        <div class="col-xxl-6 col-md-6">
                            <div class="statistics-card bg-white color-success redious-border mb-4 p-20 p-sm-20">
                                <div class="statistics-icon">
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <g id="user-tie-solid 1">
                                            <path id="Vector"
                                                  d="M16 4C12.1445 4 9 7.14453 9 11C9 13.3789 10.2109 15.4844 12.0312 16.75C7.92578 18.3516 5 22.3516 5 27H7C7 22.6016 10.1914 18.9258 14.375 18.1562L15 20H17L17.625 18.1562C21.8086 18.9258 25 22.6016 25 27H27C27 22.3516 24.0742 18.3516 19.9688 16.75C21.7891 15.4844 23 13.3789 23 11C23 7.14453 19.8555 4 16 4ZM16 6C18.7734 6 21 8.22656 21 11C21 13.7734 18.7734 16 16 16C13.2266 16 11 13.7734 11 11C11 8.22656 13.2266 6 16 6ZM15 21L14 27H18L17 21H15Z"
                                                  fill="#24D6A5"/>
                                        </g>
                                    </svg>
                                </div>

                                <div class="statistics-gChart">
                                    <canvas id="statisticsChart5"></canvas>
                                </div>

                                <div class="statistics-info mt-1">
                                    <h6>Total Instructors</h6>
                                    <h4>35721</h4>
                                </div>
                            </div>
                        </div>
                        <!-- End Statistics Chart5 -->

                        <div class="col-xxl-6 col-md-6">
                            <div class="statistics-card bg-white color-danger redious-border mb-4 p-20 p-sm-20">
                                <div class="statistics-icon">
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <g id="uil:users-alt">
                                            <path id="Vector"
                                                  d="M16.4026 16.2933C17.114 15.6775 17.6847 14.9158 18.0758 14.06C18.4669 13.2042 18.6693 12.2743 18.6693 11.3333C18.6693 9.56522 17.9669 7.86953 16.7167 6.61929C15.4664 5.36904 13.7707 4.66666 12.0026 4.66666C10.2345 4.66666 8.5388 5.36904 7.28856 6.61929C6.03832 7.86953 5.33594 9.56522 5.33594 11.3333C5.33593 12.2743 5.53834 13.2042 5.92944 14.06C6.32054 14.9158 6.89117 15.6775 7.6026 16.2933C5.73612 17.1385 4.15256 18.5034 3.04124 20.2247C1.92993 21.9461 1.3379 23.9511 1.33594 26C1.33594 26.3536 1.47641 26.6928 1.72646 26.9428C1.97651 27.1929 2.31565 27.3333 2.66927 27.3333C3.02289 27.3333 3.36203 27.1929 3.61208 26.9428C3.86213 26.6928 4.0026 26.3536 4.0026 26C4.0026 23.8783 4.84546 21.8434 6.34575 20.3431C7.84604 18.8429 9.88087 18 12.0026 18C14.1243 18 16.1592 18.8429 17.6595 20.3431C19.1597 21.8434 20.0026 23.8783 20.0026 26C20.0026 26.3536 20.1431 26.6928 20.3931 26.9428C20.6432 27.1929 20.9823 27.3333 21.3359 27.3333C21.6896 27.3333 22.0287 27.1929 22.2787 26.9428C22.5288 26.6928 22.6693 26.3536 22.6693 26C22.6673 23.9511 22.0753 21.9461 20.964 20.2247C19.8527 18.5034 18.2691 17.1385 16.4026 16.2933ZM12.0026 15.3333C11.2115 15.3333 10.4381 15.0987 9.78032 14.6592C9.12253 14.2197 8.60984 13.595 8.30709 12.8641C8.00434 12.1332 7.92512 11.3289 8.07946 10.553C8.2338 9.77705 8.61477 9.06431 9.17418 8.5049C9.73359 7.94549 10.4463 7.56453 11.2222 7.41019C11.9982 7.25585 12.8024 7.33506 13.5333 7.63781C14.2642 7.94056 14.889 8.45325 15.3285 9.11105C15.768 9.76885 16.0026 10.5422 16.0026 11.3333C16.0026 12.3942 15.5812 13.4116 14.831 14.1618C14.0809 14.9119 13.0635 15.3333 12.0026 15.3333ZM24.9893 15.76C25.8426 14.7991 26.4 13.6121 26.5943 12.3418C26.7887 11.0715 26.6118 9.7721 26.085 8.6C25.5581 7.4279 24.7037 6.43306 23.6246 5.73523C22.5455 5.0374 21.2877 4.66632 20.0026 4.66666C19.649 4.66666 19.3098 4.80714 19.0598 5.05719C18.8097 5.30724 18.6693 5.64638 18.6693 6C18.6693 6.35362 18.8097 6.69276 19.0598 6.94281C19.3098 7.19285 19.649 7.33333 20.0026 7.33333C21.0635 7.33333 22.0809 7.75476 22.831 8.5049C23.5812 9.25505 24.0026 10.2725 24.0026 11.3333C24.0007 12.0336 23.815 12.7212 23.464 13.3272C23.113 13.9332 22.6091 14.4365 22.0026 14.7867C21.8049 14.9007 21.6398 15.0635 21.5231 15.2597C21.4064 15.4558 21.3419 15.6785 21.3359 15.9067C21.3304 16.133 21.3825 16.3571 21.4875 16.5577C21.5925 16.7583 21.7468 16.9289 21.9359 17.0533L22.4559 17.4L22.6293 17.4933C24.2365 18.2556 25.5924 19.4613 26.5372 20.9684C27.4821 22.4755 27.9767 24.2212 27.9626 26C27.9626 26.3536 28.1031 26.6928 28.3531 26.9428C28.6032 27.1929 28.9423 27.3333 29.2959 27.3333C29.6496 27.3333 29.9887 27.1929 30.2387 26.9428C30.4888 26.6928 30.6293 26.3536 30.6293 26C30.6402 23.9539 30.1277 21.939 29.1406 20.1467C28.1534 18.3545 26.7244 16.8444 24.9893 15.76Z"
                                                  fill="#3F52E3"/>
                                        </g>
                                    </svg>
                                </div>

                                <div class="statistics-gChart">
                                    <canvas id="statisticsChart6"></canvas>
                                </div>

                                <div class="statistics-info mt-1">
                                    <h6>Total Students</h6>
                                    <h4>254836</h4>
                                </div>
                            </div>
                        </div>
                        <!-- End Statistics Chart6 -->

                        <div class="col-lg-12">
                            <div class="bg-white redious-border mb-4 pt-20 p-30">
                                <div class="section-top mb-2">
                                    <h4>Recent Enrolments</h4>

                                    <div class="statistics-view dropdown pe-4">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"
                                           aria-expanded="false">
                                            Today
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Last Week</a></li>
                                            <li><a class="dropdown-item" href="#">Last Month</a></li>
                                            <li><a class="dropdown-item" href="#">Last 6 Months</a></li>
                                            <li><a class="dropdown-item" href="#">Last 12 Months</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Recent Transactions -->

                                <table
                                    class="table table-borderless best-selling-courses recent-transactions two-call-table">
                                    <thead>
                                    <tr>
                                        <th>Course Name</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    <tr>
                                        <td>
                                            <div class="instructors-pro d-flex align-items-center">
                                                <div class="inst-avtar">
                                                    <img src="./assets/img/user/user1.png" alt="">
                                                </div>
                                                <div class="inst-intro">
                                                    <h6>Esther Howard</h6>
                                                    <p>Spoken English Basic To Advance.</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="sell">$500.00</span></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="instructors-pro d-flex align-items-center">
                                                <div class="inst-avtar">
                                                    <img src="./assets/img/user/user1.png" alt="">
                                                </div>
                                                <div class="inst-intro">
                                                    <h6>Robert Fox</h6>
                                                    <p>Laravel Basic To Advance.</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="sell">$250.00</span></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="instructors-pro d-flex align-items-center">
                                                <div class="inst-avtar">
                                                    <img src="./assets/img/user/user1.png" alt="">
                                                </div>
                                                <div class="inst-intro">
                                                    <h6>Robert Fox</h6>
                                                    <p>Laravel Basic To Advance.</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="sell">$250.00</span></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="instructors-pro d-flex align-items-center">
                                                <div class="inst-avtar">
                                                    <img src="./assets/img/user/user1.png" alt="">
                                                </div>
                                                <div class="inst-intro">
                                                    <h6>Robert Fox</h6>
                                                    <p>Laravel Basic To Advance.</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="sell">$250.00</span></td>
                                    </tr>

                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row ">
                <div class="col-lg-12 col-xxl-6">
                    <div class="bg-white redious-border mb-4 pt-20 p-30">
                        <div class="section-top mb-2">
                            <h4>Best Selling Courses</h4>

                            <div class="statistics-view dropdown pe-4">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Last Month
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Last Week</a></li>
                                    <li><a class="dropdown-item" href="#">Last Month</a></li>
                                    <li><a class="dropdown-item" href="#">Last 6 Months</a></li>
                                    <li><a class="dropdown-item" href="#">Last 12 Months</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Best Selling Courses -->

                        <table class="table table-borderless best-selling-courses">
                            <thead>
                            <tr>
                                <th>Course Title</th>
                                <th>Price</th>
                                <th>Enrolle</th>
                                <th>Stock</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <td>
                                    <div class="selling-course-title d-flex align-items-center">
                                        <div class="selling-course-thumb">
                                            <img src="./assets/img/course/c1.png" alt="">
                                        </div>
                                        <p>How To Get People To Like Web Development.</p>
                                    </div>
                                </td>
                                <td><span class="price">$150.00</span></td>
                                <td><span class="enrolle">550</span></td>
                                <td><span class="stock sg-text-primary">In - Stock</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="selling-course-title d-flex align-items-center">
                                        <div class="selling-course-thumb">
                                            <img src="./assets/img/course/c1.png" alt="">
                                        </div>
                                        <p>How To Get People To Like Web Development.</p>
                                    </div>
                                </td>
                                <td><span class="price">$150.00</span></td>
                                <td><span class="enrolle">550</span></td>
                                <td><span class="stock sg-text-primary">In - Stock</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="selling-course-title d-flex align-items-center">
                                        <div class="selling-course-thumb">
                                            <img src="./assets/img/course/c1.png" alt="">
                                        </div>
                                        <p>How To Get People To Like Web Development.</p>
                                    </div>
                                </td>
                                <td><span class="price">$150.00</span></td>
                                <td><span class="enrolle">550</span></td>
                                <td><span class="stock text-danger">In - Stock</span></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="selling-course-title d-flex align-items-center">
                                        <div class="selling-course-thumb">
                                            <img src="./assets/img/course/c1.png" alt="">
                                        </div>
                                        <p>How To Get People To Like Web Development.</p>
                                    </div>
                                </td>
                                <td><span class="price">$150.00</span></td>
                                <td><span class="enrolle">550</span></td>
                                <td><span class="stock sg-text-primary">In - Stock</span></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="selling-course-title d-flex align-items-center">
                                        <div class="selling-course-thumb">
                                            <img src="./assets/img/course/c1.png" alt="">
                                        </div>
                                        <p>How To Get People To Like Web Development.</p>
                                    </div>
                                </td>
                                <td><span class="price">$150.00</span></td>
                                <td><span class="enrolle">550</span></td>
                                <td><span class="stock sg-text-primary">In - Stock</span></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="selling-course-title d-flex align-items-center">
                                        <div class="selling-course-thumb">
                                            <img src="./assets/img/course/c1.png" alt="">
                                        </div>
                                        <p>How To Get People To Like Web Development.</p>
                                    </div>
                                </td>
                                <td><span class="price">$150.00</span></td>
                                <td><span class="enrolle">550</span></td>
                                <td><span class="stock text-danger">In - Stock</span></td>
                            </tr>
                            <!-- style='height:50px;overflow:auto;display:block;width:317px;' -->
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="col-lg-12 col-xxl-6">
                    <div class="bg-white redious-border pt-20 p-30">
                        <div class="section-top mb-2">
                            <h4>Best Instructors</h4>

                            <div class="statistics-view dropdown pe-4">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Last Month
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Last Week</a></li>
                                    <li><a class="dropdown-item" href="#">Last Month</a></li>
                                    <li><a class="dropdown-item" href="#">Last 6 Months</a></li>
                                    <li><a class="dropdown-item" href="#">Last 12 Months</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Best Instructors -->

                        <table class="table table-borderless best-selling-courses best-instructor">
                            <thead>
                            <tr>
                                <th>Instructor Name</th>
                                <th>Rating</th>
                                <th>Course</th>
                                <th>Total Sell</th>
                            </tr>
                            </thead>

                            <tbody>

                            <tr>
                                <td>
                                    <div class="instructors-pro d-flex align-items-center">
                                        <div class="inst-avtar">
                                            <img src="./assets/img/user/user1.png" alt="">
                                        </div>
                                        <div class="inst-intro">
                                            <h6>Arlene McCoy</h6>
                                            <p>Organisation Name</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="rating"><i class="las la-star"></i> 4.8 (1264)</span>
                                </td>
                                <td><span class="ins-course">29</span></td>
                                <td><span class="sell">$8567.50</span></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="instructors-pro d-flex align-items-center">
                                        <div class="inst-avtar">
                                            <img src="./assets/img/user/user1.png" alt="">
                                        </div>
                                        <div class="inst-intro">
                                            <h6>Arlene McCoy</h6>
                                            <p>Organisation Name</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="rating"><i class="las la-star"></i> 4.8 (1264)</span>
                                </td>
                                <td><span class="ins-course">29</span></td>
                                <td><span class="sell">$8567.50</span></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="instructors-pro d-flex align-items-center">
                                        <div class="inst-avtar">
                                            <img src="./assets/img/user/user1.png" alt="">
                                        </div>
                                        <div class="inst-intro">
                                            <h6>Arlene McCoy</h6>
                                            <p>Organisation Name</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="rating"><i class="las la-star"></i> 4.8 (1264)</span>
                                </td>
                                <td><span class="ins-course">29</span></td>
                                <td><span class="sell">$8567.50</span></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="instructors-pro d-flex align-items-center">
                                        <div class="inst-avtar">
                                            <img src="./assets/img/user/user1.png" alt="">
                                        </div>
                                        <div class="inst-intro">
                                            <h6>Arlene McCoy</h6>
                                            <p>Organisation Name</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="rating"><i class="las la-star"></i> 4.8 (1264)</span>
                                </td>
                                <td><span class="ins-course">29</span></td>
                                <td><span class="sell">$8567.50</span></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="instructors-pro d-flex align-items-center">
                                        <div class="inst-avtar">
                                            <img src="./assets/img/user/user1.png" alt="">
                                        </div>
                                        <div class="inst-intro">
                                            <h6>Arlene McCoy</h6>
                                            <p>Organisation Name</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="rating"><i class="las la-star"></i> 4.8 (1264)</span>
                                </td>
                                <td><span class="ins-course">29</span></td>
                                <td><span class="sell">$8567.50</span></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="instructors-pro d-flex align-items-center">
                                        <div class="inst-avtar">
                                            <img src="./assets/img/user/user1.png" alt="">
                                        </div>
                                        <div class="inst-intro">
                                            <h6>Arlene McCoy</h6>
                                            <p>Organisation Name</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="rating"><i class="las la-star"></i> 4.8 (1264)</span>
                                </td>
                                <td><span class="ins-course">29</span></td>
                                <td><span class="sell">$8567.50</span></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="instructors-pro d-flex align-items-center">
                                        <div class="inst-avtar">
                                            <img src="./assets/img/user/user1.png" alt="">
                                        </div>
                                        <div class="inst-intro">
                                            <h6>Arlene McCoy</h6>
                                            <p>Organisation Name</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="rating"><i class="las la-star"></i> 4.8 (1264)</span>
                                </td>
                                <td><span class="ins-course">29</span></td>
                                <td><span class="sell">$8567.50</span></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="instructors-pro d-flex align-items-center">
                                        <div class="inst-avtar">
                                            <img src="./assets/img/user/user1.png" alt="">
                                        </div>
                                        <div class="inst-intro">
                                            <h6>Arlene McCoy</h6>
                                            <p>Organisation Name</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="rating"><i class="las la-star"></i> 4.8 (1264)</span>
                                </td>
                                <td><span class="ins-course">29</span></td>
                                <td><span class="sell">$8567.50</span></td>
                            </tr>

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>

            <div class="row">

                <div class="col-lg-4">
                    <div class="bg-white redious-border mb-4 mb-lg-0 pt-20 p-30">
                        <div class="section-top mb-4">
                            <h4>Manpower Information</h4>
                        </div>
                        <!-- End Recent Transactions -->

                        <table class="table table-borderless best-selling-courses recent-transactions two-call-table">

                            <tbody>
                            <tr>
                                <td>
                                    <div class="instructors-pro">
                                        <div class="inst-intro">
                                            <h6>Total Admin</h6>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="sell">10</span></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="instructors-pro">
                                        <div class="inst-intro">
                                            <h6>Total Stuff</h6>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="sell">25</span></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="instructors-pro">
                                        <div class="inst-intro">
                                            <h6>Total Instructors</h6>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="sell">216</span></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="instructors-pro">
                                        <div class="inst-intro">
                                            <h6>Total user</h6>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="sell">216</span></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
                <!-- End Manpower Information -->

                <div class="col-lg-4">
                    <div class="bg-white redious-border mb-4 mb-lg-0 pt-20 p-30">
                        <div class="section-top mb-4">
                            <h4>Course Information</h4>
                        </div>
                        <!-- End Recent Transactions -->

                        <table class="table table-borderless best-selling-courses recent-transactions two-call-table">

                            <tbody>
                            <tr>
                                <td>
                                    <div class="instructors-pro">
                                        <div class="inst-intro">
                                            <h6>Total Course</h6>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="sell">2458</span></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="instructors-pro">
                                        <div class="inst-intro">
                                            <h6>Free Course</h6>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="sell">352</span></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="instructors-pro">
                                        <div class="inst-intro">
                                            <h6>Paid Course</h6>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="sell">2354</span></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="instructors-pro">
                                        <div class="inst-intro">
                                            <h6>Total Lesson</h6>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="sell">54876</span></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="instructors-pro">
                                        <div class="inst-intro">
                                            <h6>Assignments</h6>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="sell">5142</span></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
                <!-- End Course Information -->

                <div class="col-lg-4">
                    <div class="bg-white redious-border mb-4 mb-lg-0 pt-20 p-30">
                        <div class="section-top mb-4">
                            <h4>Sales Information</h4>
                        </div>
                        <!-- End Recent Transactions -->

                        <table class="table table-borderless best-selling-courses recent-transactions two-call-table">

                            <tbody>
                            <tr>
                                <td>
                                    <div class="instructors-pro">
                                        <div class="inst-intro">
                                            <h6>Total Sale</h6>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="sell">$578424.25K</span></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="instructors-pro">
                                        <div class="inst-intro">
                                            <h6>Total Revenue</h6>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="sell">$58762.24K</span></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="instructors-pro">
                                        <div class="inst-intro">
                                            <h6>Current Month Sale</h6>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="sell">$54786.25K</span></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
                <!-- End Sales Information -->
            </div>
        </div>
    </section> <!-- End Oftions Section -->
    <input type="hidden" id="courseStatisticData" value="{{ $courseStatisticData }}">
@endsection
@push('js')
    <script>
        const courseStatisticData = JSON.parse(document.getElementById('courseStatisticData').value)

        var courseStatistics1 = document.getElementById("courseStatistics1");
        if (courseStatistics1) {
            const statisticsBar = new Chart(courseStatistics1, {
                type: 'bar',
                data: {
                    labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saterday"],
                    datasets: [{
                        label: 'New Course',
                        data: courseStatisticData.course_data,
                        fill: false,
                        borderColor: '#3F52E3',
                        backgroundColor: '#3F52E3',
                        borderWidth: 1,
                        barThickness: 5,
                        borderRadius: 5,
                    },
                        {
                            label: 'Enrolment',
                            data: courseStatisticData.enrolment_data,
                            fill: false,
                            borderColor: '#24D6A5',
                            backgroundColor: '#24D6A5',
                            borderWidth: 1,
                            barThickness: 5,
                            borderRadius: 5,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            border: {
                                display: false
                            },
                            grid: {
                                drawBorder: false,
                                borderDash: [0, 0],
                                lineWidth: 0
                            }
                        },
                        y: {
                            grid: {
                                drawBorder: false,
                                borderDash: [5, 5],
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            align: 'center',
                            position: 'bottom',
                            labels: {
                                boxWidth: 7,
                                boxHeight: 7,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                    }
                }
            });
        }
    </script>
@endpush
