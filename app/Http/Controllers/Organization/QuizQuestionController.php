<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Repositories\QuizQuestionRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuizQuestionController extends Controller
{
    protected $quizQuestion;

    public function __construct(QuizQuestionRepository $quizQuestion)
    {
        $this->quizQuestion = $quizQuestion;
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'question'           => ['required', Rule::unique('quiz_questions')->where(function ($query) use ($request) {
                $query->where('quiz_id', $request->quiz_id);
            })->ignore('id')],
            'question_type'      => 'required',
            'answers'            => 'required_if:question_type,==,default',
            'correct_answer'     => 'required_if:question_type,==,default',
            'mcq_answers'        => 'required_if:question_type,==,mcq',
            'mcq_correct_answer' => 'required_if:question_type,==,mcq',
        ]);
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }

        try {
            $this->quizQuestion->store($request->all());
            Toastr::success(__('create_successful'));

            return response()->json([
                'success' => __('create_successful'),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function edit($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $question      = $this->quizQuestion->find($id);

            $data          = [
                'question' => $question,
                'quiz'     => $question->quiz,
            ];

            $response_data = [
                'status' => 'success',
                'html'   => view('backend.organization.course.quiz_question.edit', $data)->render(),
            ];

            return response()->json($response_data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'question'           => ['required', Rule::unique('quiz_questions')->where(function ($query) use ($request, $id) {
                $query->where('quiz_id', $request->quiz_id)->where('id', '!=', $id);
            })->ignore('id')],
            'question_type'      => 'required',
            'answers'            => 'required_if:question_type,==,default',
            'correct_answer'     => 'required_if:question_type,==,default',
            'mcq_answers'        => 'required_if:question_type,==,mcq',
            'mcq_correct_answer' => 'required_if:question_type,==,mcq',
        ]);
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }

        try {
            $this->quizQuestion->update($request->all(), $id);
            Toastr::success(__('update_successful'));

            return response()->json([
                'success' => __('update_successful'),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status'  => 'danger',
                'message' => __('this_function_is_disabled_in_demo_server'),
                'title'   => 'error',
            ];

            return response()->json($data);
        }
        try {
            $this->quizQuestion->destroy($id);
            Toastr::success(__('delete_successful'));
            $data = [
                'status'  => 'success',
                'message' => __('delete_successful'),
                'title'   => __('success'),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'status'  => 'danger',
                'message' => $e->getMessage(),
                'title'   => __('error'),
            ];

            return response()->json($data);
        }
    }
}
