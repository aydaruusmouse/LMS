<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CommissionReportDataTable;
use App\DataTables\CourseSaleDataTable;
use App\DataTables\PaymentReportDataTable;
use App\DataTables\PayoutReportDataTable;
use App\DataTables\WishlistDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\CourseRepository;
use App\Repositories\InstructorRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\ReportRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $reportRepository;

    protected $organizationRepository;

    protected $categoryRepository;

    public function __construct(ReportRepository $reportRepository, OrganizationRepository $organizationRepository, CategoryRepository $categoryRepository)
    {
        $this->reportRepository       = $reportRepository;
        $this->organizationRepository = $organizationRepository;
        $this->categoryRepository     = $categoryRepository;
    }

    public function bookSaleReport()
    {
        return view('backend.admin.report.book_sale');
    }

    public function courseSaleReport(CourseSaleDataTable $dataTable, Request $request, CourseRepository $courseRepository)
    {
        $categories    = $this->categoryRepository->activeCategories(['paginate' => setting('paginate'), 'type' => 'course']);
        $organizations = $this->organizationRepository->activeOrganization(['paginate' => setting('paginate')]);

        $courses       = $request->course_ids ? $courseRepository->activeCourses([
            'ids'      => $request->course_ids,
            'paginate' => setting('paginate'),
        ]) : [];

        if ($request->dateRange) {
            $dat_range  = explode('-', $request->dateRange);
            $start_date = date('Y-m-d', strtotime($dat_range[0]));
            $end_date   = date('Y-m-d', strtotime($dat_range[1]));
        } else {
            $start_date = null;
            $end_date   = null;
        }

        $filtered_data = [
            'course_ids'      => $request->course_ids,
            'category_id'     => $request->category_id ?? null,
            'organization_id' => $request->organization_id,
            'dateRange'       => $request->dateRange,
            'start_date'      => $start_date,
            'end_date'        => $end_date,
        ];

        $data          = [
            'categories'      => $categories,
            'organizations'   => $organizations,
            'courses'         => $courses,
            'organization_id' => $request->organization_id ?? null,
            'category_id'     => $request->category_id     ?? null,
            'dateRange'       => $request->dateRange       ?? null,
        ];

        return $dataTable->with($filtered_data)->render('backend.admin.report.course_sale', $data);
    }

    public function commissionHistory(CommissionReportDataTable $dataTable, Request $request, InstructorRepository $instructorRepository)
    {

        $start_date    = null;
        $end_date      = null;

        if ($request->dateRange) {
            $daterange  = explode('-', $request->dateRange);
            $start_date = Carbon::parse($daterange[0])->startOfDay();
            $end_date   = Carbon::parse($daterange[1])->endOfDay();
        }

        $filtered_data = [
            'dateRange'  => $request->dateRange,
            'start_date' => $start_date,
            'end_date'   => $end_date,
        ];

        $data          = [
            'dateRange' => $request->dateRange ?? null,
        ];

        return $dataTable->with($filtered_data)->render('backend.admin.report.commission_history', $data);
    }

    public function paymentHistory(PaymentReportDataTable $dataTable, Request $request)
    {
        if ($request->dateRange) {
            $dat_range  = explode('-', $request->dateRange);
            $start_date = date('Y-m-d', strtotime($dat_range[0]));
            $end_date   = date('Y-m-d', strtotime($dat_range[1]));
        } else {
            $start_date = null;
            $end_date   = null;
        }
        $filtered_data = [
            'payment_type' => $request->payment_type,
            'dateRange'    => $request->dateRange,
            'start_date'   => $start_date,
            'end_date'     => $end_date,
        ];

        $data          = [
            'payment_type' => $request->payment_type ?? null,
            'dateRange'    => $request->dateRange    ?? null,
        ];

        return $dataTable->with($filtered_data)->render('backend.admin.report.payment_history', $data);
    }

    public function payoutHistory(PayoutReportDataTable $dataTable, Request $request)
    {
        if ($request->dateRange) {
            $dat_range  = explode('-', $request->dateRange);
            $start_date = date('Y-m-d', strtotime($dat_range[0]));
            $end_date   = date('Y-m-d', strtotime($dat_range[1]));
        } else {
            $start_date = null;
            $end_date   = null;
        }

        $data          = [
            'payment_method' => $request->payment_method ?? null,
            'dateRange'      => $request->dateRange      ?? null,
        ];
        $filtered_data = [
            'payment_method' => $request->payment_method,
            'dateRange'      => $request->dateRange,
            'start_date'     => $start_date,
            'end_date'       => $end_date,
        ];

        return $dataTable->with($filtered_data)->render('backend.admin.report.payout_history', $data);
    }

    public function wishlist(WishlistDataTable $dataTable, Request $request)
    {
        $categories    = $this->categoryRepository->activeCategories(['paginate' => setting('paginate'), 'type' => 'course']);
        $organizations = $this->organizationRepository->activeOrganization(['paginate' => setting('paginate')]);
        $data          = [
            'categories'      => $categories,
            'organizations'   => $organizations,
            'organization_id' => $request->organization_id ?? null,
            'category_id'     => $request->category_id     ?? null,
        ];
        $filtered_data = [
            'category_id'     => $request->category_id,
            'organization_id' => $request->organization_id,
        ];

        return $dataTable->with($filtered_data)->render('backend.admin.report.wishlist', $data);
    }
}
