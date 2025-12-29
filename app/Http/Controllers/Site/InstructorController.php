<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Course;
use App\Models\Follow;
use App\Models\Instructor;
use App\Models\Rating;
use App\Repositories\BadgeRepository;
use App\Repositories\BlogRepository;
use App\Repositories\BookRepository;
use App\Repositories\CourseRepository;
use App\Repositories\ExpertiseRepository;
use App\Repositories\InstructorRepository;
use App\Repositories\UserRepository;
use App\Traits\SendMailTrait;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    use SendMailTrait;

    protected $user;

    protected $instructor;

    protected $expertise;

    protected $course;

    protected $book;

    protected $badge;

    public function __construct(ExpertiseRepository $expertise, CourseRepository $course, BookRepository $book, BadgeRepository $badge, InstructorRepository $instructor)
    {
        $this->instructor = $instructor;
        $this->course     = $course;
        $this->expertise  = $expertise;
        $this->book       = $book;
        $this->badge      = $badge;
    }

    public function instructor(Request $request)
    {
        try {
            $best_teacher               = $this->instructor->all(['user'], ['best_teacher' => 1]);
            if (request()->ajax() && $request->type == 'best_teacher') {
                return response()->json($this->bestTeacherFilter($best_teacher));
            }
            $instructors                = $this->instructor->all(['user']);
            if ($instructors->previousPageUrl()) {
                if ($instructors->onLastPage()) {
                    $input['total_results'] = $instructors->total();
                } else {
                    $input['total_results'] = $request->page * $instructors->perPage();
                }
            }
            if ($instructors->onFirstPage()) {
                $input['total_results'] = $instructors->count();
            }
            $input['total_instructors'] = $instructors->total();
            if (request()->ajax()) {
                return response()->json($this->ajaxFilter($instructors, $input));
            }

            $data                       = [
                'instructors'       => $instructors,
                'best_teacher'      => $best_teacher,
                'total_instructors' => $instructors->total(),
                'total_results'     => $instructors->count(),

            ];

            return view('frontend.instructor.instructor', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return redirect('/');
        }
    }

    public function instructorDetails($id, BlogRepository $blogRepository, UserRepository $userRepository): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $instructor          = Instructor::where('slug', $id)->first();
            if (! $instructor) {
                Toastr::error(__('instructor_not_found'));

                return redirect()->route('home');
            }
            $user                = $instructor->user;

            $courses             = $this->course->activeCourses([
                'user_id'           => $user->id,
                'paginate'          => setting('paginate'),
                'instructor_course' => 1,
            ]);
            $total_course        = $this->course->activeCourses([
                'user_id'           => $user->id,
                'paginate'          => '',
                'instructor_course' => 1,
            ])->count();
            $books               = [];
            if (addon_is_activated('book_store')) {
                $books = Book::whereHas('instructor', function ($query) use ($instructor) {
                    $query->where('id', $instructor->id);
                })->paginate(setting('paginate'));
            }

            $course_id           = Course::whereHas('users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })->pluck('id')->toArray();

            $blogs               = $blogRepository->findBlogs([
                'user_id'  => $user->id,
                'paginate' => 1,
            ]);

            $user_create         = Carbon::parse(date('Y-m-d', strtotime($user->created_at)));
            $user_life_time_days = today()->diffInDays($user_create);
            $badges              = $this->badge->activeBadge(['lang' => app()->getLocale(), 'to_day' => $user_life_time_days]);
            $expertise           = $this->expertise->instructorExperties($instructor->expertises ?: []);

            $data                = [
                'instructor'    => $instructor,
                'user'          => $user,
                'books'         => $books,
                'courses'       => $courses,
                'total_student' => $userRepository->enrollableStudent($course_id),
                'badges'        => $badges,
                'expertise'     => $expertise,
                'blogs'         => $blogs,
                'is_followed'   => Follow::where('user_id', auth()->id())->where('follower_id', $user->id)->exists(),
                'total_rating'  => Rating::whereHasMorph('commentable', [Course::class], function ($query) use ($user) {
                    $query->whereJsonContains('instructor_ids', (string) $user->id);
                })->avg('rating'),
                'total_review'  => Rating::whereHasMorph('commentable', [Course::class], function ($query) use ($user) {
                    $query->whereJsonContains('instructor_ids', (string) $user->id);
                })->count(),
                'total_course'  => $total_course,
            ];

            if (addon_is_activated('book_store')) {
                $books         = $this->book->activeBooks([
                    'instructor_id' => $instructor->user_id,
                    'paginate'      => setting('paginate'),
                ]);

                $data['books'] = $books;
            }

            return view('frontend.instructor.instructor_details', $data);
        } catch (\Exception $e) {
            Toastr::error(__($e->getMessage()));

            return back();
        }
    }

    public function instructorContact(Request $request): \Illuminate\Http\RedirectResponse
    {
        session()->flash('contact');
        $request->validate([
            'name'    => ['required', 'string'],
            'email'   => ['required', 'string', 'email', 'max:255'],
            'message' => ['required'],
        ]);
        if ($instructor = $this->instructor->get($request->instructor_id)) {
            try {
                $data['name']            = $request->name;
                $data['email']           = $request->email;
                $data['contact_message'] = $request->message;
                $data['contact_subject'] = __('visitor_mail');
                $data['subject']         = __('faculty_visitor_mail');
                $send_to                 = $instructor->user->email;
                $this->sendmail($send_to, 'emails.instructor_contact', $data);
                Toastr::success(__('successfully_email_send'));

                return back();
            } catch (\Exception $e) {
                Toastr::error($e->getMessage());

                return redirect()->back();
            }
        } else {
            Toastr::warning(__('instructor_not_found'));

            return redirect()->back();
        }
    }

    public function follow(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $follow = Follow::where('user_id', auth()->id())->where('follower_id', $request->follow_id)->first();
            if ($follow) {
                $follow->delete();
                $msg = __('unfollowed_successfully');
            } else {
                $data                = [];
                $data['user_id']     = auth()->id();
                $data['follower_id'] = $request->follow_id;
                Follow::create($data);
                $msg                 = __('followed_successfully');
            }

            return response()->json([
                'success' => $msg,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function loadCourses(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $courses = $this->course->activeCourses([
                'user_id'           => $request->user_id,
                'paginate'          => setting('paginate'),
                'instructor_course' => 1,
            ]);
            $html    = '';
            foreach ($courses as $key => $course) {
                $vars = [
                    'course' => $course,
                    'key'    => $key,
                    'col'    => 'col-lg-4',
                ];
                $html .= view('frontend.course.component', $vars)->render();
            }

            return response()->json([
                'html'          => $html,
                'next_page_url' => $courses->nextPageUrl(),
                'success'       => true,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function loadBooks(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $books = $this->book->activeBooks([
                'instructor_id' => $request->user_id,
                'paginate'      => setting('paginate'),
            ]);

            $html  = '';
            foreach ($books as $key => $book) {
                $vars = [
                    'book' => $book,
                    'key'  => $key,
                    'col'  => 'col-lg-4',
                ];
                $html .= view('frontend.books.component', $vars)->render();
            }

            return response()->json([
                'html'          => $html,
                'next_page_url' => $books->nextPageUrl(),
                'success'       => true,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function loadBlogs(Request $request, BlogRepository $blogRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $blogs = $blogRepository->findBlogs([
                'user_id'  => $request->user_id,
                'paginate' => 1,
            ]);

            $html  = '';
            foreach ($blogs as $key => $blog) {
                $vars = [
                    'blog' => $blog,
                    'key'  => $key,
                ];
                $html .= view('frontend.blogs.component', $vars)->render();
            }

            return response()->json([
                'html'          => $html,
                'next_page_url' => $blogs->nextPageUrl(),
                'success'       => true,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    protected function bestTeacherFilter($instructors): array
    {
        try {
            $instructor_view = '';
            foreach ($instructors as $key => $instructor) {
                $vars = [
                    'teacher' => $instructor,
                    'key'     => $key,
                ];

                $instructor_view .= view('frontend.instructor.component.best_teacher', $vars)->render();
            }

            return [
                'instructors' => $instructor_view,
                'next_page'   => $instructors->nextPageUrl(),
            ];
        } catch (\Exception $e) {
            return [];
        }
    }

    protected function ajaxFilter($instructors, $input): array
    {
        try {
            $instructor_view = '';
            foreach ($instructors as $key => $instructor) {
                $vars = [
                    'instructor' => $instructor,
                    'key'        => $key,
                ];

                $instructor_view .= view('frontend.instructor.component.instructor_load_more', $vars)->render();
            }

            return [
                'instructors'       => $instructor_view,
                'total_instructors' => $input['total_instructors'],
                'total_results'     => $input['total_results'],
                'next_page'         => $instructors->nextPageUrl(),
            ];
        } catch (\Exception $e) {
            return [];
        }
    }
}
