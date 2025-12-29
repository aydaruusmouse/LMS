<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\MyCourseResource;
use App\Models\Course;
use App\Repositories\CertificateRepository;
use App\Repositories\CourseRepository;
use App\Traits\ApiReturnFormatTrait;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    use ApiReturnFormatTrait;

    protected $courseRepository;

    protected $certificateRepository;

    protected $course;

    public function __construct(CourseRepository $courseRepository, Course $course, CertificateRepository $certificateRepository)
    {
        $this->courseRepository      = $courseRepository;
        $this->course                = $course;
        $this->certificateRepository = $certificateRepository;
    }

    public function certificates(): \Illuminate\Http\JsonResponse
    {
        try {
            $input          = [
                'my_course'   => 1,
                'user_id'     => jwtUser()->id,
                'paginate'    => setting('api_paginate'),
                'course_view' => setting('course_view_percent'),

            ];

            $courses        = MyCourseResource::collection($this->courseRepository->activeCourses($input));
            $updatedCourses = [];

            foreach ($courses as $course) {
                if ($course->enrolls[0]->complete_count > setting('course_view_percent')) {
                    $updatedCourses[] = $course;
                }
            }
            $data           = [
                'courses' => $updatedCourses,
            ];

            return $this->responseWithSuccess('course_retrieved_successfully', $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function certificateShow($id): \Illuminate\Http\JsonResponse
    {
        try {
            $course      = $this->course->find($id);
            $certificate = $course->certificate;
            if (! $certificate) {
                return $this->responseWithError('certificate_not_found');
            }
            $data        = [
                'certificate' => $certificate,
            ];

            return $this->responseWithSuccess('certificate_retrived_successfully', $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function certificateDownload($id)
    {
        try {
            $certificate = $this->certificateRepository->findCertificate($id);
            if (! $certificate) {
                return $this->responseWithError('certificate_not_found');
            }
            $pdf         = Pdf::loadView('backend.admin.certificate.download_certificate', compact('certificate'));
            $pdf_name    = $certificate->title.'.pdf';

            return $pdf->download($pdf_name.'.pdf');

        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }
}
