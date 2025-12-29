<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Checkout;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\Organization;
use App\Models\Payout;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\Admin\Dashboard\AdvanceEarningStatistic;
use App\Services\Admin\Dashboard\BestSellingCourse;
use App\Services\Admin\Dashboard\CourseStatistic;
use App\Services\Admin\Dashboard\DateWiseQuery;
use App\Services\Admin\Dashboard\EarningStatistic;
use App\Services\Admin\Dashboard\EnrolmentStatistic;
use App\Services\Admin\Dashboard\InstructorStatistic;
use App\Services\Admin\Dashboard\OrganizationStatistic;
use App\Services\Admin\Dashboard\StudentStatistic;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    private function sinceLastMonthWiseQuery($query)
    {

        // Get the last day of the last month
        $lastDayOfLastMonth = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d H:s:i');

        return $query->where('created_at', '<=', $lastDayOfLastMonth);
    }

    public function index(Request $request)
    {

        if ($request->ajax() && $request->has('earning_report')) {
            return app(AdvanceEarningStatistic::class)->execute($request);
        }

        if ($request->ajax() && $request->has('best_selling_course')) {
            $data = app(BestSellingCourse::class)->execute($request);

            return view('backend.admin.dashboard.best_selling_table', ['best_selling_courses' => $data]);
        }

        if ($request->ajax() && $request->has('best_instructor')) {
            $data = Instructor::with('organization')->get();

            return view('backend.admin.dashboard.best_instructor_table', ['best_instructors' => $data]);
        }

        if ($request->ajax() && $request->has('payout')) {

            $data = app(DateWiseQuery::class)->query($request, Payout::with('organization'))->get();

            return view('backend.admin.dashboard.payout_table', ['payouts' => $data]);
        }

        $currentMonth      = Carbon::now()->format('Y-m');

        // Query for sales in the current month
        $currentMonthSales = Checkout::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$currentMonth])
            ->get()->sum('payable_amount');

        $data              = [

            'total_course_count'               => Course::count(),
            'since_last_month_course_count'    => $this->sinceLastMonthWiseQuery(new Course())->count(),

            'total_free_course_count'          => Course::where('is_free', 1)->count(),
            'total_student_count'              => User::where('user_type', 'student')->count(),
            'total_instructor_count'           => Instructor::count(),
            'total_enrolment_count'            => Enroll::count(),
            'since_last_month_enrolment_count' => $this->sinceLastMonthWiseQuery(new Enroll())->count(),

            'total_earning'                    => Checkout::sum('payable_amount'),
            'since_last_month_sale'            => $this->sinceLastMonthWiseQuery(new Checkout())->sum('payable_amount'),

            'total_organization_count'         => Organization::count(),
            'since_last_month_organization'    => $this->sinceLastMonthWiseQuery(new Organization())->count(),

            'courseStatisticData'              => app(CourseStatistic::class)->execute($request),

            'best_selling_courses'             => app(BestSellingCourse::class)->execute($request),

            'best_instructors'                 => Instructor::with('organization')->get(),

            'new_course_count'                 => Course::count(),
            'total_sales'                      => Enroll::sum('price'),

            'payouts'                          => Payout::with('organization')->where('status', 2)->get(),

            'charts'                           => [
                'enrolment'    => app(EnrolmentStatistic::class)->execute($request),
                'earning'      => app(EarningStatistic::class)->execute($request),
                'organization' => app(OrganizationStatistic::class)->execute($request),
                'course'       => app(CourseStatistic::class)->execute($request),
                'advance'      => app(AdvanceEarningStatistic::class)->execute($request),
                'instructor'   => app(InstructorStatistic::class)->execute($request),
                'student'      => app(StudentStatistic::class)->execute($request),
            ],

            'total_admin'                      => User::where('user_type', 'admin')->count(),
            'total_stuff'                      => User::where('user_type', 'stuff')->count(),
            'total_instructor'                 => User::where('user_type', 'instructor')->count(),
            'total_user'                       => User::count(),

            'total_course'                     => Course::count(),
            'free_course'                      => Course::where('is_free', 1)->count(),
            'paid_course'                      => Course::where('is_free', 0)->count(),
            'total_lesson'                     => Lesson::count(),
            'total_assignment'                 => Assignment::count(),

            'total_sale'                       => Checkout::sum('payable_amount'),
            'total_commission'                 => Checkout::sum('payable_amount') * floatval(setting('system_commission')) / 100,
            'total_payout'                     => Payout::where('status', 2)->sum('amount'),
            'total_revenue'                    => 0,
            'current_month_sales'              => $currentMonthSales,
        ];

        //    dd($data);

        return view('backend.admin.dashboard_multi', $data);
    }

    public function instructorDashboard()
    {
        return view('backend.admin.dashboard');
    }

    public function profile(UserRepository $userRepository)
    {
        $user_id = auth()->user()->id;
        $user    = $userRepository->find($user_id);

        return view('backend.admin.auth.profile', compact('user'));
    }

    public function profileUpdate(Request $request, UserRepository $userRepository): \Illuminate\Http\JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        $id = auth()->user()->id;
        $request->validate([
            'first_name' => 'required|string|max:255',
            //'last_name' => 'required|max:255',
            'email'      => 'required|email|unique:users,email,'.Request()->id,
            'phone'      => 'required|unique:users,phone,'.Request()->id,
        ]);

        try {
            $userRepository->update($request->all(), auth()->user()->id);
            Toastr::success(__('update_successful'));

            return response()->json([
                'success' => __('update_successful'),
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function passwordChange()
    {
        return view('backend.admin.auth.password_change');
    }

    public function passwordUpdate(Request $request, UserRepository $userRepository)
    {
        $request->validate([
            'current_password' => ['required'],
            'password'         => 'required|min:6|max:32|confirmed',
        ]);

        $user = $userRepository->findByEmail(auth()->user()->email);
        if (Hash::check($request->current_password, $user->password)) {
            try {
                $user->password = bcrypt($request->password);
                $user->save();
                Toastr::success(__('successfully_password_changed'));
                $this->logout($request);

                return response()->json([
                    'success' => __('successfully_password_changed'),
                    'route'   => route('login'),
                ]);
            } catch (Exception $e) {
                Toastr::warning(__($e->getMessage()));

                return response()->json(['error' => $e->getMessage()]);
            }
        } else {
            Toastr::warning(__('sorry_old_password_not_match'));

            return response()->json(['error' => 'sorry_old_password_not_match']);
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
