@extends('backend.layouts.master')
@section('title', __('instructor'))
@section('content')

    <!-- Instructor Profile -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="bg-white redious-border p-30">
                    <div class="row">
                        <div class="col-xxl-3 col-lg-4 col-md-12">
                            <div class="">
                                <div class="bg-white redious-border instructor-profile position-relative mb-4 mb-lg-0">
                                    <div class="instructor-header">
                                        <div class="instructor-img">
                                            <img src="{{ getFileLink('100x100',$user->images) }}"
                                                 alt="{{ $user->name }}">
                                        </div>

                                        <div class="instructor-intro text-center">
                                            <h4>{{ $user->name }}</h4>
                                            <h6> {{ $instructor->designation }} </h6>
                                        </div>

                                        <ul class="follwo-list">
                                            <li><a href="#">{{__('followers') }} : {{ $followers }}</a></li>
                                            <li><a href="#">{{__('following') }} : {{ $followings }}</a></li>
                                        </ul>
                                        <div class="edit-instructor-pro">
                                            @if(($user->id == auth()->user()->id))
                                                @if(hasPermission('instructors.self-edit'))
                                                    <li>
                                                        <a class="edit_modal" href="{{ route('organization.instructors.edit', $user->id) }}"><i
                                                                class="las la-edit"></i></a>
                                                    </li>
                                                @endif
                                            @else
                                                @if(hasPermission('instructors.edit'))
                                                    <li>
                                                        <a class="edit_modal" href="{{ route('organization.instructors.edit', $user->id) }}"><i
                                                                class="las la-edit"></i></a>
                                                    </li>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="instructor-content">
                                        <div class="instructor-tags">
                                            <h6>{{__('expertise') }}</h6>
                                            <div class="d-flex align-items-center gap-12">

                                                @foreach($expertises as $expert)
                                                    <button type="button"
                                                            class="btn btn-sm sg-btn-outline-primary">{{ $expert->title}}</button>
                                                @endforeach
                                            </div>
                                        </div>
                                        <table>
                                            <tbody>
                                            @if($user->phone)
                                                <tr>
                                                    <td class="title">{{__('phone') }}</td>
                                                    <td>:{{__($user->phone) }}</td>
                                                </tr>
                                            @endif

                                            @if($user->email)
                                                <tr>
                                                    <td class="title">{{__('email_address') }}</td>
                                                    <td>:{{ $user->email }}</td>
                                                </tr>
                                            @endif
                                            @if($user->address)
                                                <tr>
                                                    <td class="title">{{__('address') }}</td>
                                                    <td>:{{ $user->address }}</td>
                                                </tr>
                                            @endif
                                            @if($user->about)
                                                <tr>
                                                    <td class="title">{{ __('about') }}</td>
                                                    <td>: {{ $user->about }}</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td class="title">{{__('Organisation') }}</td>
                                                <td><a class="sg-text-primary" target="_blank"
                                                       href="{{ route('organization.organizations.overview', $instructor->organization_id) }}">:{{ $instructor->organization->org_name }}</a>
                                                </td>
                                            </tr>
                                            @if($instructor->social_links && count($instructor->social_links) > 0)
                                                <tr>
                                                    <td class="title">{{ __('social_links') }}</td>
                                                    <td>
                                                        @foreach($instructor->social_links as $key => $link)
                                                            <a target="_blank"
                                                               href="{{ $link }}"> {{ __($key) }}</a>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-9 col-lg-8 col-md-12">
                            <div class="default-tab-list default-tab-list-v2  bg-white redious-border p-20 p-sm-30">
                                <ul class="nav pb-12 mb-20" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active ps-0" id="courses" data-bs-toggle="pill"
                                           data-bs-target="#instructorCourses" role="tab"
                                           aria-controls="instructorCourses" aria-selected="true">{{ __('courses') }}</a>
                                    </li>
                                    {{-- <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="books" data-bs-toggle="pill"
                                           data-bs-target="#instructorBooks" role="tab"
                                           aria-controls="instructorBooks" aria-selected="false">{{ __('books') }}</a>
                                    </li> --}}
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="liveClass" data-bs-toggle="pill"
                                           data-bs-target="#instructorLiveClass" role="tab"
                                           aria-controls="instructorLiveClass" aria-selected="false">{{ __('live_class') }}</a>
                                    </li>
                                </ul>
                                <!-- End Instructor Profile Tab -->

                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="instructorCourses" role="tabpanel"
                                         aria-labelledby="courses" tabindex="0">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row course_section">
                                                    @include('backend.admin.course.component_with_progress')
                                                </div>
                                            </div>

                                            @if($courses->nextPageUrl())
                                                <div class="text-center d-block m-t-10">
                                                    <a href="javascript:void(0)"
                                                       class="template-btn load_more_course">{{__('see_more') }}</a>
                                                    @include('backend.common.loading-btn',['class' => 'template-btn'])
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                    <!-- END Courses Tab====== -->

                                    <div class="tab-pane fade ins-book" id="instructorBooks" role="tabpanel"
                                         aria-labelledby="books" tabindex="0">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="row book_section">
                                                    @include('backend.admin.book.component')
                                                </div>
                                                @if($books->nextPageUrl())
                                                    <div class="text-center d-block m-t-10">
                                                        <a href="javascript:void(0)"
                                                           class="template-btn load_more_book">{{__('see_more') }}</a>
                                                        <button type="button" class="btn loading_button d-none"><img
                                                                src="{{ static_asset('images/default/loading.gif') }}"
                                                                alt="loading.gif"
                                                                width="30"></button>
                                                    </div>
                                                @endif
                                            </div>
                                            <!-- End Instructor Book Item -->
                                        </div>
                                    </div>
                                    <!-- END Books Tab====== -->

                                    <div class="tab-pane fade" id="instructorLiveClass" role="tabpanel"
                                         aria-labelledby="liveClass" tabindex="0">
                                        <div class="default-list-table table-responsive yajra-dataTable">
                                            {{ $dataTable->table() }}
                                        </div>
                                    </div>
                                    <!-- END Live Class Tab====== -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal For Add Live Class======================== -->
    <div class="modal fade" id="addLiveClass" tabindex="-1" aria-labelledby="addLiveClassLabel" aria-hidden="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <h6 class="sub-title">Add Live Class</h6>
                <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>

                <form action="#">
                    <div class="row gx-20">
                        <div class="col-12">
                            <div class="select-type-v2 mb-4">
                                <label for="selectCourse" class="form-label">Select Course</label>
                                <select id="selectCourse" class="form-select form-select-lg mb-3 without_search"
                                        aria-label=".form-select-lg example">
                                    <option selected>Select Course</option>
                                    <option value="1">UI Design</option>
                                    <option value="2">Graphic Design</option>
                                    <option value="3">Web Design</option>
                                    <option value="4">Web Development</option>
                                    <option value="2">Graphic Design</option>
                                    <option value="3">Web Design</option>
                                    <option value="4">Web Development</option>
                                </select>
                            </div>
                        </div>
                        <!-- End Select Course -->

                        <div class="col-12">
                            <div class="mb-4">
                                <label for="classTitle" class="form-label">Class Title</label>
                                <input type="text" class="form-control rounded-2" id="classTitle">
                            </div>
                        </div>
                        <!-- End Class Title -->

                        <div class="col-12">
                            <div class="mb-4">
                                <label for="dateTime" class="form-label">Date & Time</label>
                                <input type="date" class="form-control rounded-2" id="dateTime">
                            </div>
                        </div>
                        <!-- End Date & Time -->

                        <div class="col-12">
                            <div class="select-type-v2 mb-4">
                                <label for="meetingMethod" class="form-label">Meeting Method</label>
                                <select id="meetingMethod" class="form-select form-select-lg mb-3 without_search"
                                        aria-label=".form-select-lg example">
                                    <option selected>Meeting Method</option>
                                    <option value="1">UI Design</option>
                                    <option value="2">Graphic Design</option>
                                    <option value="3">Web Design</option>
                                    <option value="4">Web Development</option>
                                    <option value="2">Graphic Design</option>
                                    <option value="3">Web Design</option>
                                    <option value="4">Web Development</option>
                                </select>
                            </div>
                        </div>
                        <!-- End Meeting Method -->

                        <div class="col-12">
                            <div class="">
                                <label for="classDescription" class="form-label">Class Description</label>
                                <textarea class="form-control" id="classDescription" style="height: 100px"></textarea>
                            </div>
                        </div>
                        <!-- End Class Description -->

                    </div>
                    <!-- END Permissions Tab====== -->
                    <div class="d-flex justify-content-end align-items-center mt-30">
                        <button type="button" class="btn sg-btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('js')
    {{ $dataTable->scripts() }}
    <script>
        let page = 1, book_page = 1;
        $(document).ready(function () {
            $(document).on('click', '.load_more_course', function () {
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
                    url: "{{ route('organization.load.more.course') }}",
                    type: "POST",
                    data: form,
                    success: function (data) {
                        $('.course_section').append(data.courses);
                        $('.loading_button').addClass('d-none');
                        if (data.next_page_url) {
                            selector.removeClass('d-none');
                        }
                    },
                    error: function (data) {
                        page--;
                        $('.loading_button').addClass('d-none');
                        selector.removeClass('d-none');
                        console.log(data);
                    }
                });
            });
            $(document).on('click', '.load_more_book', function () {
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
                    url: "{{ route('organization.load.more.books') }}",
                    type: "POST",
                    data: form,
                    success: function (data) {
                        $('.book_section').append(data.books);
                        $('.loading_button').addClass('d-none');
                        if (data.next_page_url) {
                            selector.removeClass('d-none');
                        }
                    },
                    error: function (data) {
                        book_page--;
                        $('.loading_button').addClass('d-none');
                        selector.removeClass('d-none');
                        console.log(data);
                    }
                });
            });
        });
    </script>
@endpush
