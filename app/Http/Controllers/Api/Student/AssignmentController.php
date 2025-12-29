<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\MyAssignmentResource;
use App\Models\Assignment;
use App\Models\SubmitedAssignment;
use App\Repositories\AssignmentRepository;
use App\Repositories\SubmitedAssignmentRepository;
use App\Traits\ApiReturnFormatTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssignmentController extends Controller
{
    use ApiReturnFormatTrait;

    protected $assignmentRepository;

    protected $certificateRepository;

    protected $course;

    protected $submitedAssignmentRepository;

    public function __construct(AssignmentRepository $assignmentRepository, SubmitedAssignmentRepository $submitedAssignmentRepository)
    {
        $this->assignmentRepository         = $assignmentRepository;
        $this->submitedAssignmentRepository = $submitedAssignmentRepository;

    }

    public function myAssignments(): \Illuminate\Http\JsonResponse
    {
        try {
            $assignments         = $this->assignmentRepository->myAssignments();
            $my_assignments      = Assignment::where('status', 1)->CourseAssignment()->pluck('id')->toArray();
            $submited_assignment = SubmitedAssignment::whereIn('assignment_id', $my_assignments)->count();
            $due_assignments     = count($my_assignments) - $submited_assignment;
            $complete_assignment = SubmitedAssignment::whereIn('assignment_id', $my_assignments)->where('status', 1)->count();
            $failed_assignment   = SubmitedAssignment::whereIn('assignment_id', $my_assignments)->where('status', 2)->count();

            $data                = [
                'assignments'         => MyAssignmentResource::collection($assignments),
                'due_assignments'     => $due_assignments,
                'complete_assignment' => $complete_assignment,
                'failed_assignment'   => $failed_assignment,
            ];

            return $this->responseWithSuccess('assignment_retrieved_successfully', $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function submitAssignment(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'assignment_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $user                 = jwtUser();
            $submitted_assignment = SubmitedAssignment::where('user_id', auth()->user()->id)->where('assignment_id', $request->assignment_id)->first();
            if (blank($submitted_assignment)) {
                $request['user_id'] = $user->id;
                $this->submitedAssignmentRepository->store($request->all());

                return $this->responseWithSuccess('submitted_successful');

            } elseif ($submitted_assignment->status == 0) {
                $request['user_id']       = $user->id;
                $request['assignment_id'] = $request->assignment_id;
                $this->submitedAssignmentRepository->update($request->all(), $submitted_assignment->id);

                return $this->responseWithSuccess('submitted_successful');
            } else {
                return $this->responseWithError(__('not_allowed'));
            }

        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }
}
