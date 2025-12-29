@extends('backend.layouts.master')
@section('title', __('student_profile'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="bg-white redious-border p-20 p-md-30">
                    <div class="row">
                        <div class="col-xxl-3 col-lg-4 col-md-12">
                            <div class="">
                                <div class="bg-white redious-border instructor-profile mb-4 mb-lg-0">
                                    <div class="instructor-header">
                                        <div class="instructor-img">
                                            <img src="{{ getFileLink('100x100', $user->images) }}"
                                                alt="{{ $user->name }}">
                                        </div>

                                        <div class="instructor-intro text-center">
                                            <h4>{{ $user->name }}</h4>
                                        </div>
                                    </div>
                                    <div class="instructor-content">
                                        <table>
                                            <tbody>

                                                @if ($user->phone)
                                                    <tr>
                                                        <td class="title">{{ __('phone') }}</td>
                                                        <td>:{{ __($user->phone) }}</td>
                                                    </tr>
                                                @endif

                                                @if ($user->email)
                                                    <tr>
                                                        <td class="title">{{ __('email_address') }}</td>
                                                        <td>:{{ $user->email }}</td>
                                                    </tr>
                                                @endif
                                                @if ($user->address)
                                                    <tr>
                                                        <td class="title">{{ __('address') }}</td>
                                                        <td>:{{ $user->address }}</td>
                                                    </tr>
                                                @endif
                                                @if ($user->about)
                                                    <tr>
                                                        <td class="title">{{ __('about') }}</td>
                                                        <td>: {{ $user->about }}</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-9 col-lg-8 col-md-12">
                            <div
                                class="default-tab-list default-tab-list-v2 bg-white redious-border activeItem-bd-none p-20 p-sm-30">
                                <ul class="nav pb-12 mb-20" id="pills-tab" role="tablist">

                                    <li class="nav-item" role="presentation">
                                        <a href="{{ route('organization.students.show', $user->id) }}"
                                            class="nav-link {{ request()->route()->getName() == 'students.show'? 'active': '' }} ps-0"
                                            id="courses">{{ __('enrolled_courses') }}</a>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <a href="{{ route('organization.students.certificates', $user->id) }}"
                                            class="nav-link {{ request()->route()->getName() == 'students.certificates'? 'active': '' }}"
                                            id="certificates">{{ __('certificates') }}</a>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <a href="{{ route('organization.students.instructors', $user->id) }}"
                                            class="nav-link {{ request()->route()->getName() == 'students.instructors'? 'active': '' }}"
                                            id="instructors">{{ __('following_instructor') }}</a>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <a href="{{ route('organization.students.payments', $user->id) }}"
                                            class="nav-link {{ request()->route()->getName() == 'students.payments'? 'active': '' }}"
                                            id="payments">{{ __('payment_history') }}</a>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <a href="{{ route('organization.students.activity.logs', $user->id) }}"
                                            class="nav-link {{ request()->route()->getName() == 'students.activity.logs'? 'active': '' }}"
                                            id="activity_logs">{{ __('login_history') }}</a>
                                    </li>

                                </ul>
                                <!-- End Instructor Profile Tab -->
                                <div class="tab-content" id="pills-tabContent">
                                    @if (request()->route()->getName() == 'organization.students.show')
                                        <div class="tab-pane fade show active" id="instructorCourses" role="tabpanel"
                                            aria-labelledby="courses" tabindex="0">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row course_section">
                                                        @include('backend.organization.course.component_with_progress')
                                                    </div>
                                                </div>

                                                @if ($courses->nextPageUrl())
                                                    <div class="text-center d-block m-t-10">
                                                        <a href="javascript:void(0)"
                                                            class="template-btn load_more_course align-items-center btn sg-btn-primary">{{ __('see_more') }}</a>
                                                        @include('backend.common.loading-btn', [
                                                            'class' => 'template-btn btn',
                                                        ])
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    <!-- END Courses Tab====== -->
                                    @if (request()->route()->getName() == 'organization.students.certificates')
                                        <div class="tab-pane fade ins-book show active" id="student_certificates"
                                            role="tabpanel" aria-labelledby="books" tabindex="0">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row certificate_section">
                                                        @include('backend.organization.certificate.component')
                                                    </div>
                                                    @if ($courses->nextPageUrl())
                                                        <div class="text-center d-block m-t-10">
                                                            <a href="javascript:void(0)"
                                                                class="template-btn load_more_book align-items-center btn sg-btn-primary">{{ __('see_more') }}</a>
                                                            @include('backend.common.loading-btn', [
                                                                'class' => 'template-btn btn',
                                                            ])
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if (request()->route()->getName() == 'organization.students.instructors')
                                        <div class="tab-pane fade show active" id="following_instructor" role="tabpanel"
                                            aria-labelledby="liveClass" tabindex="0">
                                            <div class="default-list-table table-responsive yajra-dataTable">
                                                {{ $dataTable->table() }}
                                            </div>
                                        </div>
                                    @endif
                                    @if (request()->route()->getName() == 'organization.students.payments')
                                        <div class="tab-pane fade show active" id="payment_history" role="tabpanel"
                                            aria-labelledby="liveClass" tabindex="0">
                                            <div class="default-list-table table-responsive yajra-dataTable">
                                                {{ $dataTable->table() }}
                                            </div>
                                        </div>
                                    @endif
                                    @if (request()->route()->getName() == 'students.activity.logs')
                                        <div class="tab-pane fade show active" id="payment_history" role="tabpanel"
                                            aria-labelledby="liveClass" tabindex="0">
                                            <div class="default-list-table table-responsive yajra-dataTable">
                                                {{ $dataTable->table() }}
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
    </div>

@endsection
@push('js')
    @if (request()->route()->getName() == 'instructor.students.activity.logs' ||
            request()->route()->getName() == 'instructor.students.payments' ||
            request()->route()->getName() == 'instructor.students.instructors')
        {!! $dataTable->scripts() !!}
    @endif
    <script>
        let page = 1,
            book_page = 1;
        $(document).ready(function() {
            $(document).on('click', '.load_more_course', function() {
                page++;
                let selector = $(this);
                selector.addClass('d-none');
                $('.loading_button').removeClass('d-none');
                let form = {
                    id: '{{ $user->id }}',
                    _token: '{{ csrf_token() }}',
                    page: page
                }
                $.ajax({
                    url: "{{ route('organization.students.load.course') }}",
                    type: "POST",
                    data: form,
                    success: function(data) {
                        $('.course_section').append(data.courses);
                        $('.loading_button').addClass('d-none');
                        if (data.next_page_url) {
                            selector.removeClass('d-none');
                        }
                    },
                    error: function(data) {
                        page--;
                        $('.loading_button').addClass('d-none');
                        selector.removeClass('d-none');
                        console.log(data);
                    }
                });
            });
            $(document).on('click', '.load_more_book', function() {
                book_page++;
                let selector = $(this);
                selector.addClass('d-none');
                $('.loading_button').removeClass('d-none');
                let form = {
                    id: '{{ $user->id }}',
                    _token: '{{ csrf_token() }}',
                    page: book_page
                }
                $.ajax({
                    url: "{{ route('organization.students.load.certificates') }}",
                    type: "POST",
                    data: form,
                    success: function(data) {
                        $('.certificate_section').append(data.certificates);
                        $('.loading_button').addClass('d-none');
                        if (data.next_page_url) {
                            selector.removeClass('d-none');
                        }
                    },
                    error: function(data) {
                        book_page--;
                        $('.loading_button').addClass('d-none');
                        selector.removeClass('d-none');
                        console.log(data);
                    }
                });
            });
            $(document).on('click', '.view_all', function() {
                let td_selector = $(this).closest('td');
                $(this).addClass('d-none');
                td_selector.find('.hide').removeClass('d-none');
                td_selector.find('ul').removeClass('enroll_courses');
            });
            $(document).on('click', '.hide', function() {
                let td_selector = $(this).closest('td');
                $(this).addClass('d-none');
                td_selector.find('.view_all').removeClass('d-none');
                td_selector.find('ul').addClass('enroll_courses');
            });
        });
    </script>
@endpush
