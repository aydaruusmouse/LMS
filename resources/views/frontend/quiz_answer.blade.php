@extends('frontend.layouts.master')
@section('title', __('quiz_answer'))
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
                                @php
                                      $question_mark= ($quiz->total_marks / $quiz->questions->count());
                                      $found_mark = ($correct_answer * $question_mark);
                                @endphp
                                @if($quiz->pass_marks  <= $found_mark)
                                <h3>{{__('quiz_pass') }}</h3>
                                @else
                                    <h3 class="text-danger">{{__('quiz_fail')}}</h3>
                                @endif
                            </div>
                            <div class="quiz-result-boxes m-t-25">
                                <div class="quiz-result-box">
                                    <h6>{{ $quiz->duration }}</h6>
                                    <p>{{__('your_time')}}</p>
                                </div>
                                <div class="quiz-result-box">
                                    <h6>{{ sprintf('%.2f', $found_mark)  }} </h6>
                                    <p>{{__('your_score')}}</p>
                                </div>
                                <div class="quiz-result-box">
                                    <h6>{{ $found_mark >= $quiz->pass_marks ? __('pass'): __('fail')}} </h6>
                                    <p>{{__('your_result')}}</p>
                                </div>
                            </div>
                            <div class="shape">
                                <img src="{{ static_asset('frontend/img/icons/quiz-title.png')  }}" alt="Quiz Shape">
                            </div>
                        </div>
                        <div class="quiz-section-title m-b-25">
                            <h3>{{ $quiz->title }}</h3>
                        </div>
                    </div>
                </div>
                <div class="quiz-question-wrapper">
                    @foreach($quiz->questions as $key => $question)
                        @if($question->question_type == 'default')
                            <div class="quiz-question">
                                <h4 class="question-title {{  ($question->getAnswer->answers !=  $question->getAnswer->correct_answer) ? 'false': '' }}" id="1">{{ $question->question }}?</h4>
                                <div class="question-options">
                                    @foreach($question->answers as  $key2 =>$answer)
                                        <div class="option">
                                            @if($answer['is_correct'] == 1)
                                            <input type="checkbox"  id="op-{{ $answer['answer']  }}_{{ $key2  }}" checked>
                                             @elseif($question->getAnswer->answers == ($key2+1))
                                                <input type="checkbox" class="false"   checked disabled id="op-{{ $answer['answer']  }}_{{ $key2  }}">
                                            @endif
                                            <label for="op-{{ $answer['answer']  }}_{{ $key2  }}">{{ $answer['answer'] }}</label>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        @elseif($question->question_type == 'mcq')
                            <div class="quiz-question">
                                <h4 class="question-title {{  ($question->getAnswer->answers !=  $question->getAnswer->correct_answer) ? 'false': '' }}" id="2">{{ $question->question }} </h4>
                                <div class="question-options">
                                    @foreach($question->answers as  $key3 =>$answer)
                                        <div class="option">
                                            <input type="checkbox"  id="op-{{ $answer['answer']  }}_{{ $key3  }}"   {{ $answer['is_correct'] == 1 ? 'checked':'' }} disabled>
{{--                                            @if(arrayCheck(($key3+1), $question->getAnswer->answers) && ($question->getAnswer->answers != $question->getAnswer->correct_answer))--}}
{{--                                                <input type="checkbox" class="false" checked disabled id="op-{{ $answer['answer']  }}_{{ $key3  }}">--}}
{{--                                            @endif--}}
                                            @if($question->getAnswer->answers !='')
                                                @if(in_array(($key3+1), $question->getAnswer->answers) && !in_array(($key3+1), $question->getAnswer->correct_answer))
                                                    <input type="checkbox" class="false" checked disabled id="op-{{ $answer['answer']  }}_{{ $key3  }}">
                                                @endif
                                            @endif
                                            <label for="op-{{ $answer['answer']  }}_{{ $key3  }}">{{ $answer['answer'] }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @elseif($question->question_type == 'short_question')
                            <div class="quiz-question">
                                <h4 class="question-title {{  ($question->getAnswer->answers !=  $question->getAnswer->correct_answer) ? 'false': '' }}" id="5">{{ $question->question }} </h4>
                                <div class="question-options textarea" >
                                    <textarea disabled name="correct_answer_{{$question->id}}"> {{ $question->getAnswer->answers }} </textarea>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="question-submit-btn m-t-40 m-t-md-30">
                    <a href="{{ route('my-course',$course->slug) }}" class="template-btn">Continue to Course</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== End Quiz Section ======-->
@endsection

