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

                <div class="col-lg-12">

                    <div class="section-title">
                        <h4>{{__('overview')}}</h4>
                    </div>

                    <div class="bg-white redious-border mb-4 p-4">
                        <div class="row">
                            <div class="col-xxl-3 col-xl-6 col-md-6">
                                <div class="bg-white redious-border mb-4 p-20 p-sm-30">
                                    <div class="analytics clr-1">
                                        <div class="analytics-icon">
                                            <i class="las la-book-open"></i>
                                        </div>

                                        <div class="analytics-content">
                                            <h4>{{ $new_course_count }}</h4>
                                            <p>{{__('new_course')}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-xxl-3 col-xl-6 col-md-6">
                                <div class="bg-white redious-border mb-4 p-20 p-sm-30">
                                    <div class="analytics clr-3">
                                        <div class="analytics-icon">
                                            <i class="las la-clone"></i>
                                        </div>

                                        <div class="analytics-content">
                                            <h4>{{ $total_student_count }}</h4>
                                            <p>{{__('total_students')}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-xl-6 col-md-6">
                                <div class="bg-white redious-border mb-4 p-20 p-sm-30">

                                    <div class="analytics clr-4">

                                        <div class="analytics-icon">
                                            <i class="las la-handshake"></i>
                                        </div>

                                        <div class="analytics-content">
                                            <h4>{{ $total_enrolment_count }}</h4>
                                            <p>{{__('total_enrolment')}}</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="bg-white redious-border mb-4 p-20 p-sm-30">
                                    <div class="section-top">
                                        <h4>{{__('course_statistic')}}</h4>

                                        <div class="statistics-view dropdown pe-4">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false" id="filterable_parent_item">
                                                {{__('last_7_days')}}
                                            </a>
                                            <ul id="earning_report" class="dropdown-menu">

                                                <li>
                                                    <a class="dropdown-item __js_course_filterable_item" href="#"
                                                        data-query="last_seven_days">
                                                        {{__('last_7_days')}}
                                                    </a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item __js_course_filterable_item" href="#"
                                                        data-query="last_fourteen_days">
                                                        {{__('last_14_days')}}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item __js_course_filterable_item" href="#"
                                                        data-query="last_month">
                                                        {{__('last_month')}}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item __js_course_filterable_item" href="#"
                                                        data-query="last_six_months">
                                                        {{__('last_6_months')}}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item __js_course_filterable_item" href="#"
                                                        data-query="last_twelve_months">
                                                        {{__('last_12_months')}}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- End Statistics Report -->

                                    <div class="statistics-report-chart">
                                        <canvas id="courseStatistics1"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="bg-white redious-border mb-4 p-20 p-sm-30">
                                    <div class="section-top">
                                        <h4>{{__('selling_report')}}</h4>

                                        <div class="statistics-view dropdown pe-4">
                                            <a id="selling_report" href="#" class="dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                {{__('last_7_days')}}
                                            </a>
                                            <ul class="dropdown-menu">

                                                <li>
                                                    <a class="dropdown-item __js_selling_filterable_item"
                                                        href="javascript:void(0)" data-query="last_seven_days">
                                                        {{__('last_7_days')}}
                                                    </a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item __js_selling_filterable_item"
                                                        href="javascript:void(0)" data-query="last_fourteen_days">
                                                        {{__('last_14_days')}}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item __js_selling_filterable_item"
                                                        href="javascript:void(0)" data-query="last_month">
                                                       {{__('last_month')}}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item __js_selling_filterable_item"
                                                        href="javascript:void(0)" data-query="last_six_months">
                                                        {{__('last_6_months')}}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item __js_selling_filterable_item"
                                                        href="javascript:void(0)" data-query="last_twelve_months">
                                                        {{__('last_12_months')}}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- End Statistics Report -->

                                    <div class="statistics-report-chart">
                                        <canvas id="best_selling_statistic"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-lg-12 col-xxl-6">
                                <div class="bg-white redious-border mb-4 mb-xxl-0 pt-20 p-30">
                                    <div class="section-top mb-2">
                                        <h4>{{__('best_selling_courses')}}</h4>

                                        <div class="statistics-view dropdown pe-4">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"
                                                id="best_selling_dropdown_item_container" aria-expanded="false">
                                                {{__('last_7_days')}}
                                            </a>
                                            <ul id="earning_report" class="dropdown-menu">

                                                <li>
                                                    <a class="dropdown-item __js_best_selling_filterable_item"
                                                        href="javascript:void(0)" data-query="last_seven_days">
                                                        {{__('last_7_days')}}
                                                    </a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item __js_best_selling_filterable_item"
                                                        href="javascript:void(0)" data-query="last_fourteen_days">
                                                        {{__('last_14_days')}}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item __js_best_selling_filterable_item"
                                                        href="javascript:void(0)" data-query="last_month">
                                                        {{__('last_month')}}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item __js_best_selling_filterable_item"
                                                        href="javascript:void(0)" data-query="last_six_months">
                                                        {{__('last_6_months')}}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item __js_best_selling_filterable_item"
                                                        href="javascript:void(0)" data-query="last_twelve_months">
                                                        {{__('last_12_months')}}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- End Best Selling Courses -->

                                    <div id="best_selling_table_container">
                                        @include('backend.organization.dashboard.best_selling_table')
                                    </div>

                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>

        </div>

        <input type="hidden" id="chart_data" value="{{ json_encode($charts) }}">

    </section> <!-- End Oftions Section -->

@endsection

@push('js')
    <script src="{{ static_asset('admin/js/chart.min.js') }}"></script>

    <script>
        const charts = JSON.parse(document.getElementById('chart_data').value);

        var courseStatistics1 = document.getElementById("courseStatistics1");

        if (courseStatistics1) {

            var courseStatistic = new Chart(courseStatistics1, {
                type: 'bar',
                data: {
                    labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saterday"],
                    datasets: [{
                            label: 'Course',
                            data: {{ json_encode($charts['course'], true) }},
                            fill: false,
                            borderColor: '#3F52E3',
                            backgroundColor: '#3F52E3',
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




        var sellingChart = document.getElementById("best_selling_statistic");
        if (sellingChart) {
            var sellingReportChart = new Chart(sellingChart, {
                type: "line",
                data: {
                    labels: [
                        "Sunday",
                        "Monday",
                        "Tuesday",
                        "Wednesday",
                        "Thursday",
                        "Friday",
                        "Saterday",
                    ],
                    datasets: [{
                            label: "Regular Sell",
                            data: charts.advance.regular,
                            fill: false,
                            borderColor: "#3F52E3",
                            backgroundColor: "#3F52E3",
                            borderWidth: 1,
                            barThickness: 5,
                            borderRadius: 5,
                            tension: 0.4,
                        },
                        // {
                        //     label: "Offer Sell",
                        //     data: charts.advance.offer,
                        //     fill: false,
                        //     borderColor: "#24D6A5",
                        //     backgroundColor: "#24D6A5",
                        //     borderWidth: 1,
                        //     barThickness: 5,
                        //     borderRadius: 5,
                        //     tension: 0.4,
                        // },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            border: {
                                display: false,
                            },
                            grid: {
                                drawBorder: false,
                                borderDash: [0, 0],
                                lineWidth: 0,
                            },
                        },
                        y: {
                            grid: {
                                drawBorder: false,
                                borderDash: [5, 5],
                            },
                        },
                    },
                    plugins: {
                        legend: {
                            align: "center",
                            position: "bottom",
                            labels: {
                                boxWidth: 7,
                                boxHeight: 7,
                                usePointStyle: true,
                                pointStyle: "circle",
                            },
                        },
                    },
                },
            });
        }



        $(document).on('click', '.__js_course_filterable_item', function(event) {

            let url = "{{ url()->current() }}";

            $('#filterable_parent_item').html(event.target.innerHTML)

            axios.get(url, {
                    params: {
                        course_statistic: true,
                        query_string: $(this).data('query')
                    }
                })
                .then(response => {
                    const data = response.data;
                    courseStatistic.data.datasets[0].data = data;
                    courseStatistic.update();
                })
        })



        $(document).on('click', '.__js_selling_filterable_item', function(event) {

            let url = "{{ url()->current() }}";

            $('#filterable_parent_item').html(event.target.innerHTML)

            axios.get(url, {
                    params: {
                        selling_report: true,
                        query_string: $(this).data('query')
                    }
                })
                .then(response => {
                    const data = response.data;
                    sellingReportChart.data.datasets[0].data = data.regular;
                    sellingReportChart.data.datasets[1].data = data.offer;
                    sellingReportChart.update();
                })
        })




        $(document).on('click', '.__js_best_selling_filterable_item', function(event) {
            $('#best_selling_dropdown_item_container').html(event.target.innerHTML)
            let url = "{{ url()->current() }}"

            axios.get(url, {
                    params: {
                        best_selling_course: true,
                        query_string: $(this).data('query'),
                    }
                })
                .then(response => {
                    $('#best_selling_table_container').html(response.data);
                })
        })


        $(document).on('click', '.__js_best_instructor_filterable_item', function(event) {
            $('#best_instructor_dropdown_item_container').html(event.target.innerHTML)
            let url = "{{ url()->current() }}"

            axios.get(url, {
                    params: {
                        best_instructor: true,
                        query_string: $(this).data('query'),
                    }
                })
                .then(response => {
                    $('#best_instructor_container').html(response.data);
                })
        })
    </script>
@endpush
