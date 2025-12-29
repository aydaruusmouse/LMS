@extends('backend.layouts.master')
@section('title', __('quiz_details'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">Edit Quiz/Quiz Details</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('organization.quizzes.update',$quiz->id) }}" class="form" method="POST">@csrf
                            @method('PUT')
                            <div class="row">
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                <input type="hidden" name="section_id" class="section_id"
                                       value="{{ $quiz->section_id }}">
                                <input type="hidden" class="is_modal" value="0">
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label class="form-label">{{ __('title') }}</label>
                                        <input type="text" name="title" class="form-control rounded-2"
                                               placeholder="{{ __('enter_title') }}" value="{{ $quiz->title }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="title_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Lesson Title -->
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label class="form-label">{{ __('duration') }} ({{ __('in_minutes') }})</label>
                                        <input type="number" name="duration" class="form-control rounded-2"
                                               placeholder="e.g.30" value="{{ $quiz->duration }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="duration_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label class="form-label">{{ __('total_marks') }}</label>
                                        <input type="number" name="total_marks" class="form-control rounded-2"
                                               placeholder="e.g.100" value="{{ $quiz->total_marks }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="total_marks_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label class="form-label">{{ __('pass_marks') }}</label>
                                        <input type="number" name="pass_marks" class="form-control rounded-2"
                                               placeholder="e.g.50" value="{{ $quiz->pass_marks }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="pass_marks_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex gap-12 mb-4">
                                    <div class="d-flex gap-12 sandbox_mode_div">
                                        <input type="hidden" name="certificate_included"
                                               value="{{ $quiz->certificate_included }}">
                                        <label class="form-label"
                                               for="certificate_included">{{ __('certificate_included') }}</label>
                                        <div class="setting-check">
                                            <input type="checkbox" value="1" id="certificate_included"
                                                   class="sandbox_mode" {{ $quiz->certificate_included == 1 ? 'checked' : '' }}>
                                            <label for="certificate_included"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex gap-12 sandbox_mode_div mb-4">
                                    <input type="hidden" name="status"
                                           value="{{ $quiz->status }}">
                                    <label class="form-label"
                                           for="status">{{ __('status') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="status"
                                               class="sandbox_mode" {{ $quiz->status == 0 ? '' : 'checked' }}>
                                        <label for="status"></label>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <h6 class="sub-title">Quiz Questions</h6>
                                    @foreach($questions as $question)
                                        <div class="list-view py-12 ps-2 pe-3 pe-sm-30 mb-20">
                                            <div class="list-view-content">
                                                <!-- <h6>Email Confirmation</h6> -->
                                                <p>{{ $question->question }}</p>
                                            </div>

                                            <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#emailTemplate"><i class="las la-edit"></i></a> -->
                                            <ul class="d-flex align-items-center gap-20">
                                                <li><a href="#" class="icon edit_modal" data-total_answers="{{ count($question->answers) }}"
                                                       data-fetch_url="{{ route('organization.quiz-questions.edit',$question->id) }}"
                                                       data-route="{{ route('quiz-questions.update',$question->id) }}"
                                                       data-modal="editQuiz"><i class="lar la-edit"></i></a></li>
                                                <li><a class="icon" data-bs-placement="top"
                                                       href="javascript:void(0)"
                                                       onclick="delete_row('{{ route('organization.quiz-questions.destroy', $question->id) }}',null,true)"
                                                       data-bs-toggle="tooltip"
                                                       data-original-title="{{ __('delete') }}"
                                                       data-bs-title="{{ __('delete') }}"
                                                    ><i class="las la-trash-alt"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    @endforeach
                                    <!-- End List View -->

                                    <div class="mt-30 d-flex">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#addQuiz"
                                           class="d-flex align-items-center button-default gap-2">
                                            <i class="las la-plus"></i>
                                            <span>{{ __('add_question') }}</span>
                                        </a>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-30">
                                        <a href="{{ route('organization.courses.edit',$course->id) }}"
                                           class="btn sg-btn-outline-primary">{{ __('cancel') }}</a>
                                        <button type="submit" class="btn sg-btn-primary">{{ __('save') }}</button>
                                        @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="addQuiz" tabindex="-1" aria-labelledby="addQuizLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <h6 class="sub-title">Add New Question</h6>
                <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>

                <form action="{{ route('organization.quiz-questions.store') }}" method="POST" class="form">@csrf
                    <div class="row gx-20">
                        <input type="hidden" value="{{ $quiz->id }}" name="quiz_id">
                        <input type="hidden" value="0" class="is_modal">
                        <div class="col-12">
                            <div class="mb-4">
                                <label for="question_type" class="form-label">Question Type</label>
                                <div class="select-type-v2">
                                    <select id="question_type" name="question_type"
                                            class="form-select form-select-lg mb-3 without_search">
                                        <option value="default" selected>Default Question</option>
                                        <option value="mcq">Multiple Choice Question</option>
                                        <option value="short_question">Short Question</option>
                                    </select>
                                    <div class="nk-block-des text-danger">
                                        <p class="question_type_error error"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Question Type -->

                        <div class="col-12">
                            <div class="mb-4">
                                <label for="question" class="form-label">Question</label>
                                <input type="text" name="question" class="form-control rounded-2" id="question"
                                       placeholder="Enter Question">
                                <div class="nk-block-des text-danger">
                                    <p class="question_error error"></p>
                                </div>
                            </div>
                        </div>
                        <!-- End Question -->

                        <div class="col-12 question_div">
                            <div class="">
                                <label for="#" class="form-label">Quiz Answers</label>
                                <div class="moveable-lit p-20 p-sm-30 default_question_div rounded-2 border">
                                    <div class="answer_area" id="answerAreaMoved">
                                        <div class="input-group mb-20">
                                            <input type="text" class="form-control" name="answers[]"
                                                   placeholder="Answer">
                                            <div class="custom-radio d-flex align-items-center">
                                                <label>
                                                    <input type="radio" name="correct_answer" checked value="2">
                                                    <span class=""></span>
                                                </label>
                                            </div>
                                            <span class="input-group-text ansMove"><i class="las la-arrows-alt"></i></span>
                                        </div>
                                        <!-- End Input Group -->

                                        <div class="input-group mb-20">
                                            <input type="text" class="form-control" name="answers[]"
                                                   placeholder="Answer">
                                            <div class="custom-radio d-flex align-items-center">
                                                <label>
                                                    <input type="radio" name="correct_answer" checked value="2">
                                                    <span class=""></span>
                                                </label>
                                            </div>
                                            <span class="input-group-text ansMove"><i class="las la-arrows-alt"></i></span>
                                        </div>
                                        <!-- End Input Group -->

                                        <div class="input-group mb-20">
                                            <input type="text" class="form-control" name="answers[]"
                                                   placeholder="Answer">
                                            <div class="custom-radio d-flex align-items-center">
                                                <label>
                                                    <input type="radio" name="correct_answer" checked value="2">
                                                    <span class=""></span>
                                                </label>
                                            </div>
                                            <span class="input-group-text ansMove"><i class="las la-arrows-alt"></i></span>
                                        </div>
                                        <!-- End Input Group -->

                                        <div class="input-group mb-20">
                                            <input type="text" class="form-control" name="answers[]"
                                                   placeholder="Answer">
                                            <div class="custom-radio d-flex align-items-center">
                                                <label>
                                                    <input type="radio" name="correct_answer" checked value="2">
                                                    <span class=""></span>
                                                </label>
                                            </div>
                                            <span class="input-group-text ansMove"><i class="las la-arrows-alt"></i></span>
                                        </div>
                                    </div>
                                    <div class="nk-block-des text-danger">
                                        <p class="answers_error error"></p>
                                    </div>
                                    <div class="nk-block-des text-danger">
                                        <p class="correct_answer_error error"></p>
                                    </div>
                                    <div class="d-flex justify-content-start align-items-center mt-30">
                                        <button type="button" class="btn sg-btn-outline-primary add_answer">Add Answer
                                        </button>
                                    </div>
                                </div>
                                <div class="moveable-lit p-20 p-sm-30 mcq_div d-none rounded-2 border">
                                    <div class="answer_area" id="checkAnswerMoved">
                                        <div class="input-group mb-20">
                                            <input type="hidden" name="mcq_correct_answer[]" class="mcq_correct_answer">
                                            <input type="text" class="form-control" name="mcq_answers[]"
                                                   placeholder="Answer">
                                            <div class="custom-checkbox">
                                                <label>
                                                    <input type="checkbox" value="1">
                                                    <span class="ms-12"></span>
                                                </label>
                                            </div>
                                            <span class="input-group-text ansMove "><i class="las la-arrows-alt"></i></span>
                                        </div>
                                        <!-- End Input Group -->

                                        <div class="input-group mb-20">
                                            <input type="hidden" name="mcq_correct_answer[]" class="mcq_correct_answer" value="1">
                                            <input type="text" class="form-control" name="mcq_answers[]"
                                                   placeholder="Answer">
                                            <div class="custom-checkbox">
                                                <label>
                                                    <input type="checkbox" checked value="1">
                                                    <span class="ms-12"></span>
                                                </label>
                                            </div>
                                            <span class="input-group-text ansMove"><i class="las la-arrows-alt"></i></span>
                                        </div>
                                        <!-- End Input Group -->

                                        <div class="input-group mb-20">
                                            <input type="hidden" name="mcq_correct_answer[]" class="mcq_correct_answer">
                                            <input type="text" class="form-control" name="mcq_answers[]"
                                                   placeholder="Answer">
                                            <div class="custom-checkbox">
                                                <label>
                                                    <input type="checkbox" value="1">
                                                    <span class="ms-12"></span>
                                                </label>
                                            </div>
                                            <span class="input-group-text ansMove"><i class="las la-arrows-alt"></i></span>
                                        </div>
                                        <!-- End Input Group -->

                                        <div class="input-group mb-20">
                                            <input type="hidden" name="mcq_correct_answer[]" class="mcq_correct_answer">
                                            <input type="text" class="form-control" name="mcq_answers[]"
                                                   placeholder="Answer">
                                            <div class="custom-checkbox">
                                                <label>
                                                    <input type="checkbox" value="1">
                                                    <span class="ms-12"></span>
                                                </label>
                                            </div>
                                            <span class="input-group-text ansMove"><i class="las la-arrows-alt"></i></span>
                                        </div>
                                        <!-- End Input Group -->
                                    </div>
                                    <div class="nk-block-des text-danger">
                                        <p class="mcq_answers_error error"></p>
                                    </div>
                                    <div class="nk-block-des text-danger">
                                        <p class="mcq_correct_answer_error error"></p>
                                    </div>
                                    <div class="d-flex justify-content-start align-items-center mt-30">
                                        <button type="button" class="btn sg-btn-outline-primary add_answer">Add Answer
                                        </button>
                                        <!-- <button type="button" class="btn sg-btn-primary">Add Question</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Question -->

                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-30">
                        <button type="button" class="btn sg-btn-outline-primary" data-bs-dismiss="modal"
                                aria-label="Close">Cancel
                        </button>
                        <button type="submit" class="btn sg-btn-primary">Add Question</button>
                        @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editQuiz" tabindex="-1" aria-labelledby="sectionLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <h6 class="sub-title edit_sub_title d-none">{{__('edit_quiz') }}</h6>
                <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="form_div">
                </div>
            </div>
        </div>
    </div>
    <div class="modal checkbox_modal">
        <div class="input-group mb-20">
            <input type="hidden" name="mcq_correct_answer[]" class="mcq_correct_answer">
            <input type="text" class="form-control" name="mcq_answers[]"
                   placeholder="Answer">
            <div class="custom-checkbox">
                <label>
                    <input type="checkbox">
                    <span class="ms-12"></span>
                </label>
                <span class="icon delete_icon"><i class="las la-trash-alt"></i></span>
            </div>
            <span class="input-group-text"><i class="las la-arrows-alt"></i></span>
        </div>
    </div>
    <div class="modal radio_modal">
        <div class="input-group mb-20">
            <input type="text" class="form-control" name="answers[]"
                   placeholder="Answer">
            <div class="custom-radio">
                <label>
                    <input type="radio" name="correct_answer" value="1">
                    <span class="ms-12"></span>
                </label>
                <span class="icon delete_icon"><i class="las la-trash-alt"></i></span>
            </div>
            <span class="input-group-text"><i class="las la-arrows-alt"></i></span>
        </div>
    </div>
    @include('backend.common.delete-script')
@endsection

@push('js_asset')
    <!--====== media.js ======-->
    <script src="{{ static_asset('admin/js/sortable.min.js') }}"></script>
@endpush
@push('js')
    <script>
        $(document).ready(function () {
            let radio_val = 4;
            let checkbox_val = 4;
            $(document).on('change', '#question_type', function () {
                var question_type = $(this).val();
                $('.question_div').removeClass('d-none');

                if (question_type == 'mcq') {
                    $('.mcq_div').removeClass('d-none');
                    $('.default_question_div').addClass('d-none');
                } else if (question_type == 'default') {
                    $('.question_div').removeClass('d-none');
                    $('.mcq_div').addClass('d-none');
                    $('.default_question_div').removeClass('d-none');
                } else {
                    $('.question_div').addClass('d-none');
                }
            });
            $(document).on('click', '.add_answer', function () {
                var question_type = $(this).closest('form').find('#question_type').val();
                if (question_type == 'mcq') {
                    checkbox_val++;
                    $('.mcq_div .answer_area').append($('.checkbox_modal').html());
                } else if (question_type == 'default') {
                    $('.radio_modal input').val(radio_val);
                    $('.default_question_div .answer_area').append($('.radio_modal').html());
                }
            });
            $(document).on('click', '.mcq_div .answer_area .custom-checkbox input[type=checkbox]', function () {
                var checked_checkbox = $(this).is(':checked');
                let selector = $(this).closest('.input-group').find('.mcq_correct_answer');
                if (checked_checkbox) {
                    selector.val(1);
                } else {
                    selector.val(0);
                }
            });
            $(document).on('click', '.edit_modal', function () {
                radio_val = parseInt($(this).data('total_answers'));
                checkbox_val = parseInt($(this).data('total_answers'));
            });
            $(document).on('click', '.delete_icon', function () {
                $(this).closest('.input-group').remove();
            });

            let sections = document.getElementById("answerAreaMoved");
            new Sortable(sections, {
                handle: '.ansMove',
                animation: 150,
            });

            let checkAns = document.getElementById("checkAnswerMoved");
            new Sortable(checkAns, {
                handle: '.ansMove',
                animation: 150,
            });
        });
    </script>
@endpush
