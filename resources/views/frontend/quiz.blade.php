@extends('frontend.layouts.master')
@section('title', __('quiz'))
@section('content')
    <!--====== Start Quiz Section ======-->
    <section class="quiz-section p-t-50 p-b-150 p-b-lg-100 p-b-md-80 p-t-sm-30">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="row">
                        <div class="col-12">
                            <div class="quiz-result-wrapper m-b-30">
                                <div class="quiz-section-title justify-content-center">
                                    <h3> {{__('minimum_pass_mark') }} {{ $quiz->pass_marks }} {{__('correct_answer') }}</h3>
                                </div>
                                <div class="quiz-result-boxes m-t-25">
                                    <div class="quiz-result-box">
                                        <h6>{{ $quiz->duration }}  {{__('minutes') }}</h6>
                                        <p>{{__('your_time') }}</p>
                                    </div>
                                    <div class="quiz-result-box">
                                        <h6>{{ $quiz->total_marks }}</h6>
                                        <p>{{__('total_score') }}</p>
                                    </div>
                                </div>
                                <div class="shape">
                                    <img src="{{ static_asset('frontend/img/icons/quiz-title.png') }}" alt="Quiz Shape">
                                </div>
                            </div>
                            <div class="quiz-section-title m-b-25">
                                <h3>{{ $quiz->title }}</h3>
                            </div>
                        </div>
                    </div>
                    @if (count($quiz->questions) > 0)
                        <form action="{{ route('quiz-answer') }}" method="POST">@csrf
                            <div class="quiz-question-wrapper">
                                @foreach($quiz->questions as $key => $question)
                                    @if($question->question_type == 'default')
                                        <div class="quiz-question">
                                            <h4 class="question-title" id="1">{{ $question->question }}?</h4>
                                            <div class="question-options">
                                                @foreach($question->answers as  $key2 =>$answer)
                                                    <input type="hidden" class="form-control"
                                                           name="answers_{{$question->id}}[]"
                                                           value="{{ $answer['answer'] }}">
                                                    @if($answer['is_correct'] == 1)
                                                        <input type="hidden" class="form-control"
                                                               name="correct_answer_{{$question->id}}"
                                                               value="{{ ($key2+1) }}">
                                                    @endif
                                                    <div class="option">
                                                        <input type="radio" name="student_answer_{{$question->id}}"
                                                               id="op-{{ $answer['answer']  }}_{{ $key2  }}"
                                                               value="{{$key2+1}}">
                                                        <label
                                                            for="op-{{ $answer['answer']  }}_{{ $key2  }}">{{ $answer['answer'] }}</label>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    @elseif($question->question_type == 'mcq')
                                        <div class="quiz-question">
                                            <h4 class="question-title" id="2">{{ $question->question }} </h4>
                                            <div class="question-options">
                                                @foreach($question->answers as  $key3 =>$answer)
                                                    <input type="hidden" class="form-control"
                                                           name="answers_{{$question->id}}[]"
                                                           value="{{ $answer['answer'] }}">
                                                    @if($answer['is_correct'] == 1)
                                                        <input type="hidden" class="form-control"
                                                               name="correct_answer_{{$question->id}}[]"
                                                               value="{{  ($key3+1) }}">
                                                    @endif
                                                    <div class="option">
                                                        <input type="checkbox" name="student_answer_{{$question->id}}[]"
                                                               id="op-{{ $answer['answer']  }}_{{ $key3  }}"
                                                               value="{{$key3+1}}">
                                                        <label
                                                            for="op-{{ $answer['answer']  }}_{{ $key3  }}">{{ $answer['answer'] }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @elseif($question->question_type == 'short_question')
                                        <div class="quiz-question">
                                            <h4 class="question-title" id="5">{{ $question->question }} </h4>
                                            <div class="question-options textarea">
                                                <input type="hidden" class="form-control"
                                                       name="answers_{{$question->id}}[]"
                                                       value="{{ $question->answer }}">
                                                <input type="hidden" class="form-control"
                                                       name="question_type_{{$question->id}}"
                                                       value="{{ $question->question_type }}">
                                                <textarea placeholder=""
                                                          name="student_answer_{{$question->id}}"></textarea>
                                            </div>
                                        </div>
                                    @endif
                                    <input type="hidden" class="form-control" name="question_id[]"
                                           value="{{ $question->id }}">
                                    <input type="hidden" class="form-control" name="quiz_id" value="{{ $quiz->id }}">
                                @endforeach
                            </div>
                            <div class="question-submit-btn m-t-40 m-t-md-30">
                                <button type="submit" class="template-btn">{{__('Submit') }}</button>
                                @include('components.frontend_loading_btn', ['class' => 'btn sg-btn-primary'])
                            </div>
                        </form>
                    @endif

            </div>

        </div>
    </div>
</section>
<!--====== End Payment Section ======-->
@endsection

