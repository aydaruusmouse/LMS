@extends('backend.layouts.master')
@section('title', __('send_notification'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{ __('send_notification') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('custom-notification.store') }}" method="POST" class="form">@csrf
                            <div class="row gx-20 add-coupon">
                                <input type="hidden" class="is_modal" value="0"/>
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="couponTitle" class="form-label">{{ __('title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="couponTitle" name="title"
                                               placeholder="{{ __('enter_title') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="title_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Coupon Title -->
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="popup_description"
                                               class="form-label">{{ __('description') }}</label>
                                        <textarea class="form-control" id="popup_description"
                                                  name="description"
                                                  placeholder="{{ __('enter_description') }}"></textarea>
                                        <div class="nk-block-des text-danger">
                                            <p class="description_error error">{{ $errors->first('lang') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="multi-select-v2 mb-4">
                                        <label for="role_ids"
                                               class="form-label">{{ __('select_user_type') }}</label>
                                        <select id="role_ids" name="role_ids[]" multiple placeholder="{{ __('select_user_type') }}"
                                                class="multiple-select-1 form-select-lg rounded-0 mb-3"
                                                aria-label=".form-select-lg example">
                                            <option value="">{{ __('select_user_type') }}</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="user_ids_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="multi-select-v2 mb-4">
                                        <label for="action_for"
                                               class="form-label">{{ __('action_for') }} (<small>{{ __('for_specific_url') }}</small>)</label>
                                        <select id="action_for" name="action_for"
                                                class="multiple-select-1 form-select-lg rounded-0 mb-3"
                                                aria-label=".form-select-lg example">
                                            <option value="">{{ __('select_action_for') }}</option>
                                            <option value="course">{{ __('course') }}</option>
                                            <option value="instructor">{{ __('instructor') }}</option>
                                            <option value="organization">{{ __('organization') }}</option>
                                            <option value="student">{{ __('student') }}</option>
                                            <option value="blog">{{ __('blog') }}</option>
                                            <option value="category">{{ __('category') }}</option>
                                            <option value="subject">{{ __('subject') }}</option>
                                            @if(addon_is_activated('book_store'))
                                                <option value="book">{{ __('book') }}</option>
                                            @endif
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="action_for_error error"></p>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12 instructor_div type_div d-none">
                                    <div class="multi-select-v2 mb-4">
                                        <label for="selectInstructor"
                                               class="form-label">{{ __('select_instructor') }}</label>
                                        <select id="selectInstructor" name="instructor_id"
                                                class="multiple-select-1 form-select-lg rounded-0 mb-3"
                                                aria-label=".form-select-lg example">
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="instructor_ids_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Select Instructor -->
                                <div class="col-lg-12 category_div type_div d-none">
                                    <div class="multi-select-v2 mb-4">
                                        <label for="select_category"
                                               class="form-label">{{ __('select_category') }}</label>
                                        <select id="select_category" name="category_id"
                                                class="multiple-select-1 form-select-lg rounded-0 mb-3"
                                                aria-label=".form-select-lg example">
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="category_ids_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Select category -->
                                <div class="col-lg-12 course_div type_div d-none">
                                    <div class="multi-select-v2 mb-4">
                                        <label for="select_course" class="form-label">{{ __('select_course') }}</label>
                                        <select id="select_course" name="course_id"
                                                class="multiple-select-1 form-select-lg rounded-0 mb-3"
                                                aria-label=".form-select-lg example">
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="course_ids_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 organization_div type_div d-none">
                                    <div class="multi-select-v2 mb-4">
                                        <label for="select_organization" class="form-label">{{ __('select_organization') }}</label>
                                        <select id="select_organization" name="organization_id"
                                                class="multiple-select-1 form-select-lg rounded-0 mb-3"
                                                aria-label=".form-select-lg example">
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="organization_ids_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 student_div type_div d-none">
                                    <div class="multi-select-v2 mb-4">
                                        <label for="select_student" class="form-label">{{ __('select_student') }}</label>
                                        <select id="select_student" name="student_id" data-route="{{ route('ajax.users',['role_id' => 3]) }}"
                                                class="multiple-select-1 form-select-lg rounded-0 mb-3"
                                                aria-label=".form-select-lg example">
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="student_ids_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 blog_div type_div d-none">
                                    <div class="multi-select-v2 mb-4">
                                        <label for="select_blog" class="form-label">{{ __('select_blog') }}</label>
                                        <select id="select_blog" name="blog_id"  data-route="{{ route('ajax.blogs') }}"
                                                class="multiple-select-1 form-select-lg rounded-0 mb-3" placeholder="{{ __('select_blog') }}"
                                                aria-label=".form-select-lg example">
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="student_ids_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 subject_div type_div d-none">
                                    <div class="multi-select-v2 mb-4">
                                        <label for="select_subject" class="form-label">{{ __('select_subject') }}</label>
                                        <select id="select_subject" name="subject_id"
                                                class="multiple-select-1 form-select-lg rounded-0 mb-3"
                                                aria-label=".form-select-lg example">
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="subject_ids_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 book_div type_div d-none">
                                    <div class="multi-select-v2 mb-4">
                                        <label for="select_book" class="form-label">{{ __('select_book') }}</label>
                                        <select id="select_book" name="book_id" data-route="{{ route('ajax.books') }}"
                                                class="multiple-select-1 form-select-lg rounded-0 mb-3"
                                                aria-label=".form-select-lg example">
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="book_ids_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="multi-select-v2 mb-4">
                                        <label for="select_app" class="form-label">{{ __('select_app') }} (<small>{{ __('for_app') }}</small>)</label>
                                        <select id="select_app" name="open_from"
                                                class="multiple-select-1 form-select-lg rounded-0 mb-3"
                                                aria-label=".form-select-lg example">
                                            <option value="">{{ __('select_app') }}</option>
                                            <option value="student_app">{{ __('student_app') }}</option>
                                            <option value="instructor_app">{{ __('instructor_app') }}</option>
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="book_ids_error error"></p>
                                        </div>
                                    </div>
                                </div>

                                @include('backend.common.media-input',[
                                    'title' => __('image'),
                                    'name'  => 'image_media_id',
                                    'col'   => 'col-12 mb-4',
                                    'size'  => '(828x490)',
                                    'label' => __('image'),
                                    'image' => old('image_media_id')
                                ])

                                <div class="d-flex justify-content-end align-items-center mt-30">
                                    <button type="submit" class="btn sg-btn-primary">{{__('submit') }}</button>
                                    @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('backend.common.gallery-modal')
    <!-- End Oftions Section -->
@endsection
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@push('js_asset')
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
@endpush
@push('js')
    <script src="{{ static_asset('admin/js/media.js') }}"></script>

    <script>
        $(document).ready(function () {
            searchInstructor($('#selectInstructor'));
            searchCourse($('#select_course'));
            searchCategory($('#select_category'));
            searchOrganization($('#select_organization'));
            searchUser($('#select_student'));
            searchBlog($('#select_blog'));
            searchSubjects($('#select_subject'));
            searchBook($('#select_book'));

            $(document).on('change', '#action_for', function () {
                let type = $(this).val();
                $('.type_div').addClass('d-none');
                $('.' + type + '_div').removeClass('d-none');
            });
        });
    </script>
@endpush
