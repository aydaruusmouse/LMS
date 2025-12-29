<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Instructor;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\Instructor\Dashboard\BestSellingCourse;
use App\Services\Organization\Dashboard\AdvanceEarningStatistic;
use App\Services\Organization\Dashboard\CourseStatistic;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InstructorDashboardController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax() && $request->has('course_statistic')) {
            return app(CourseStatistic::class)->execute($request);
        }

        if ($request->ajax() && $request->has('selling_report')) {
            return app(AdvanceEarningStatistic::class)->execute($request);
        }

        if ($request->ajax() && $request->has('best_selling_course')) {
            $data = app(BestSellingCourse::class)->execute($request);

            return view('backend.instructor.dashboard.best_selling_table', ['best_selling_courses' => $data]);
        }

        if ($request->ajax() && $request->has('best_instructor')) {

            $data = Instructor::with('organization')->get();

            return view('backend.instructor.dashboard.best_instructor_table', ['best_instructors' => $data]);
        }

        $data = [

            'total_student_count'    => User::whereHas('checkouts')->where('user_type', 'student')->count(),

            'total_instructor_count' => Instructor::where('organization_id', authOrganizationId())->count(),

            'total_enrolment_count'  => Enroll::count(),

            'new_course_count'       => Course::whereHas('users', function ($query) {
                $query->where('users.id', auth()->id());
            })->count(),

            'best_selling_courses'   => app(BestSellingCourse::class)->execute($request),

            'charts'                 => [

                'course'  => app(CourseStatistic::class)->execute($request),

                'advance' => app(AdvanceEarningStatistic::class)->execute($request),

            ],

            'total_course'           => Course::count(),

        ];

        return view('backend.instructor.dashboard', $data);
    }

    public function profile(UserRepository $userRepository)
    {
        $user_id = auth()->user()->id;
        $user    = $userRepository->find($user_id);

        return view('backend.instructor.auth.profile', compact('user'));
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
            'last_name'  => 'required|max:255',
            'email'      => 'required|email|unique:users,email,'.Request()->id,
            'phone'      => 'required|numeric|unique:users,phone,'.Request()->id,
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
        return view('backend.instructor.auth.password_change');
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
