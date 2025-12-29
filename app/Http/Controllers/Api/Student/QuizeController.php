<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Models\QuizQuestion;
use App\Repositories\CourseRepository;
use App\Repositories\QuizRepository;
use App\Repositories\SectionRepository;
use App\Traits\ApiReturnFormatTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuizeController extends Controller
{
    use ApiReturnFormatTrait;

    protected $courseRepository;

    protected $quiz;

    protected $section;

    public function __construct(CourseRepository $courseRepository, QuizRepository $quiz, SectionRepository $section)
    {
        $this->courseRepository = $courseRepository;
        $this->quiz             = $quiz;
        $this->section          = $section;
    }

    public function courseSections(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $course   = $this->courseRepository->find($request->course_id);
            $sections = $course->sections;
            $data     = [
                'sections' => $sections,
            ];

            return $this->responseWithSuccess(__('quizzes_retrieved_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function courseQuiz(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'section_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $id      = $request->section_id;
            $section = $this->section->find($id);
            $quizzes = $section->quizzes;
            $data    = [
                'quizzes' => $quizzes,
            ];

            return $this->responseWithSuccess(__('questions_retrieved_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function quizQuestions(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'quiz_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $id        = $request->quiz_id;
            $quiz      = $this->quiz->find($id);
            $questions = QuizQuestion::whereHas('quiz', function ($q) use ($id) {
                $q->where('status', 1)->where('quiz_id', $id);
            })->get();
            $response  = [];
            foreach ($questions as $question) {
                $result['question']      = $question->question;
                $result['question_type'] = $question->question_type;
                $result['option']        = $question->answers;
                $answer                  = [];
                foreach ($question->answers as $key => $options_answer) {
                    if ($options_answer['is_correct'] == 1) {
                        array_push($answer, $key);
                    }
                    $result['correct_answer_index'] = $answer;
                }
                array_push($response, $result);
            }

            $data      = [
                'quiz'      => $quiz,
                'questions' => $response,
            ];

            return $this->responseWithSuccess(__('questions_retrieved_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }
}
