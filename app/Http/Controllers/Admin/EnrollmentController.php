<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\EnrollmentDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\CheckoutRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    public $checkoutRepository;

    public function __construct(CheckoutRepository $checkoutRepository)
    {
        $this->checkoutRepository = $checkoutRepository;
    }

    public function index(EnrollmentDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.enrollment.index');
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'student_id' => 'required',
            'course_id'  => 'required',
        ]);
        try {
            DB::beginTransaction();
            $this->checkoutRepository->bulkEnrolls($request->all());
            DB::commit();

            return response()->json([
                'success' => __('enrolled_successfully'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function statusChange($id): \Illuminate\Http\JsonResponse
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
            $status = $this->checkoutRepository->changeStatus($id);

            $data   = [
                'status'  => 'success',
                'message' => $status ? __('enrollment_approved_successfully') : __('enrollment_rejected_successfully'),
                'title'   => __('success'),
            ];

            return response()->json($data);

        } catch (\Exception $e) {

            $data = [
                'status'  => 400,
                'message' => $e->getMessage(),
                'title'   => 'error',
            ];

            return response()->json($data);
        }
    }
}
