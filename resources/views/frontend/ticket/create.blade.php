@extends('frontend.layouts.master')
@section('title', __('create_ticket'))
@section('content')
    <section class="support-section p-t-35 p-t-sm-30 p-b-md-50 p-b-80">
        <div class="container container-1278">
            <div class="row">
                <div class="col-12">
                    <div class="section-title-v3 color-dark m-b-20">
                        <h4>Create Ticket</h4>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="ticket-replies">
                        <form action="{{ route('support-tickets.store') }}" class="user-form p-0 row ajax_form" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-6">
                                <label for="fullName">First Name</label>
                                <input type="text" class="form-control" name="first_name" id="fullName"
                                       placeholder="{{ __('enter_first_name') }}">
                                <p class="text-danger first_name_error error"></p>
                            </div>
                            <div class="col-6">
                                <label for="fullName">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name"
                                       placeholder="{{ __('enter_last_name') }}">
                                <p class="text-danger last_name_error error"></p>
                            </div>
                            <div class="col-12">
                                <label for="emailAddress">Email Address</label>
                                <input type="email" class="form-control" name="email" id="emailAddress"
                                       placeholder="{{ __('enter_email') }}">
                                <p class="text-danger email_error error"></p>
                            </div>
                            <div class="col-12">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control" name="subject" id="subject"
                                       placeholder="{{ __('enter_subject') }}">
                                <p class="text-danger subject_error error"></p>
                            </div>
                            <div class="col-sm-6">
                                <label for="department">Department</label>
                                <select name="department_id" id="department" class="select2">
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->title }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger department_id_error error"></p>
                            </div>
                            <div class="col-sm-6">
                                <label for="priority">Priority</label>
                                <select name="priority" id="priority" class="select2">
                                    <option value="">{{ __('select_priority') }}</option>
                                    <option value="low">{{ __('low') }}</option>
                                    <option value="medium">{{ __('medium') }}</option>
                                    <option value="high">{{ __('high') }}</option>
                                </select>
                                <p class="text-danger priority_error error"></p>
                            </div>
                            <div class="col-12">
                                <h2 class="m-b-20 ticket-title">{{ __('your_message') }}</h2>
                                <textarea class="form-control" name="description" id="message" placeholder="{{ __('your_message') }}"></textarea>
                                <p class="text-danger description_error error"></p>
                            </div>
                            <div class="col-sm-12">
                                <h2 class="m-b-20 ticket-title">Upload Your File</h2>
                                <input type="file" name="student_file" id="chooseFile" accept=".jpg, .jpeg, .gif, .png">
                                <p class="fz-16">{{ __('valid_file_types') }}</p>
                            </div>
                            <div class="col-md-2 col-sm-3 m-t-20">
                                <button class="template-btn" type="submit">Submit</button>
                                @include('components.frontend_loading_btn', ['class' => 'template-btn'])
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $(".select2").select2({
                templateSelection: function(selected, container) {
                    // Add a class to the select2-selection element
                    container.parent().addClass('custom-select');

                    // Return the default markup for the selected option
                    return selected.text;
                }
            });
            //$('.select2').select2();
        });
    </script>
@endpush
