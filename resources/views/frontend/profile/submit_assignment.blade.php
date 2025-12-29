@extends('frontend.layouts.master')
@section('title', __('assignment'))
@section('content')
    <!--====== Start Submit Assignment Section ======-->
    <section class="submit-assignment-section p-t-50 p-b-80 p-b-md-50 p-t-sm-30">
        <div class="container container-1278">
            <div class="row">
                <div class="col-12">
                    <div class="section-title-v3 color-dark m-b-40 m-b-sm-15">
                        <h3>{{ __('Assignment Details') }}</h3>
                    </div>
                </div>
            </div>
            <div class="assignment-details-wrapper">
                <form action="{{ route('assignment.submit') }}" class="footer-subscription ajax_form" method="POST">@csrf
                    <input type="hidden" value="{{ $assignment->id }}" name="assignment_id">
                    <div class="row align-items-end">
                        <div class="col-md-6">
                            <div class="assignment-info">
                                <div class="text-block m-b-40">
                                    <h6>{{ __('assignment_title') }}</h6>
                                    <p>{{ $assignment->title }}</p>
                                </div>
                                @if ($assignment->description)
                                    <div class="text-block m-b-30 assignment-item">
                                        <h6>{{ __('assignment_descriptions') }}</h6>
                                        <p>{!! $assignment->description !!}</p>
                                    </div>
                                @endif

                                <div class="upload-assignment">
                                    <h6>{{ __('upload_assignment') }}</h6>
                                    <div>
                                        <label for="submitted_file" class="file-upload-text">
                                            <span>{{ __('no_file_chosen') }}</span>
                                            <span class="file-btn">{{ __('choose_file') }}</span>
                                        </label>
                                        <input class="d-none file_picker" type="file" id="submitted_file"
                                            name="submitted_file">
                                        <div class="nk-block-des text-danger">
                                            <p class="submitted_file_error error"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="assignment-details">
                                <div class="assignment-details-inner">
                                    <div class="text-block m-b-25 p-b-25 border-bottom-soft-white">
                                        <h6>{{ __('marks') }}</h6>
                                        <p>{{ $assignment->total_marks }}</p>
                                    </div>
                                    <div class="text-block m-b-20">
                                        <h6>{{ __('assignment_file') }}</h6>
                                        <a href="{{ getPdfFile($assignment->file) }}" target="_blank" class="color-gray"
                                            download>{{ getPdfFile($assignment->file, 'title') }}</a>
                                    </div>
                                    @if ($submitted_assignment)
                                        <div class="text-block m-b-20 delete-item">
                                            <h6>{{ __('your_submitted_file') }}</h6>
                                            <div class="submitted-file">
                                                <a href="{{ static_asset($submitted_assignment->file) }}" download
                                                    class="color-gray">
                                                    {{ getPdfFile($submitted_assignment->file) }}
                                                </a>
                                                <div class="delete-btn assignment-delete"
                                                    data-id="{{ $submitted_assignment->id }}">
                                                    <svg width="13" height="14" viewBox="0 0 13 14" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1 3.40039H11.8" stroke="var(--color-gray)"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M10.6031 3.4V11.8C10.6031 12.1183 10.4767 12.4235 10.2517 12.6485C10.0266 12.8736 9.72138 13 9.40312 13H3.40312C3.08487 13 2.77964 12.8736 2.5546 12.6485C2.32955 12.4235 2.20313 12.1183 2.20312 11.8V3.4M4.00312 3.4V2.2C4.00312 1.88174 4.12955 1.57652 4.3546 1.35147C4.57964 1.12643 4.88487 1 5.20312 1H7.60312C7.92138 1 8.22661 1.12643 8.45165 1.35147C8.6767 1.57652 8.80312 1.88174 8.80312 2.2V3.4"
                                                            stroke="var(--color-gray)" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M5.20312 6.40039V10.0004" stroke="var(--color-gray)"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M7.60156 6.40039V10.0004" stroke="var(--color-gray)"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="assignment-details-btns align-items-center d-flex gap-3 m-t-30">
                                    <a href="{{ redirect()->back()->getTargetUrl() }}"
                                        class="template-btn bordered-btn-secondary">{{ __('back') }}</a>
                                    <button type="submit" class="template-btn">
                                        {{ __('submit_assignment') }}
                                    </button>
                                    @include('components.frontend_loading_btn', [
                                        'class' => 'btn sg-btn-primary',
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </section>
    <!--====== End Submit Assignment Section ======-->
@endsection
@push('js')
    <script>
        //=========== delete script ===========
        $(document).on('click', '.assignment-delete', function() {
            var id = $(this).attr('data-id');
            var token = "{{ @csrf_token() }}";
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": token,
                },
                type: 'POST',
                url: "{{ route('assignment.submit.delete') }}",
                data: {
                    id
                },
                success: function(response) {
                    if (response.status == 'success') {
                        toastr["success"](response.message);
                        window.location.reload();
                    } else {
                        toastr["error"](response.message);
                    }
                },
                error: function(response) {
                    toastr["error"](response.message);
                }
            })
        })
    </script>
@endpush
