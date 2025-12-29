<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\SectionResource;
use App\Models\Course;
use App\Models\HomeScreen;
use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Repositories\CategoryRepository;
use App\Repositories\CourseRepository;
use App\Repositories\LessonRepository;
use App\Repositories\LevelRepository;
use App\Repositories\QuizRepository;
use App\Repositories\ResourceRepository;
use App\Repositories\ReviewRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\UserRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Matrix\Exception;

class CourseController extends Controller
{
    protected $course;

    public function __construct(CourseRepository $course)
    {
        $this->course = $course;
        //        $this->recent_view_repository = $recent_view_repository;
    }

    public function course(Request $request, CategoryRepository $categoryRepository, LevelRepository $levelRepository, SubjectRepository $subjectRepository): View|Factory|\Illuminate\Http\JsonResponse|RedirectResponse|Application
    {
        try {
            $input                  = $request->all();
            $input['total_results'] = 0;
            $input['style']         = $request->style ?? 'grid';
            $input['category_ids']  = array_unique(array_filter(explode(',', $request->category_ids)));
            $input['level_ids']     = $request->level_ids ? array_unique(array_filter(explode(',', $request->level_ids))) : [];
            $input['price']         = $request->price ? array_unique(array_filter(explode(',', $request->price))) : [];
            $input['rating']        = array_unique(array_filter(explode(',', $request->rating)));
            $input['subject_ids']   = $request->subject_ids ? array_unique(array_filter(explode(',', $request->subject_ids))) : [];
            $courses                = $this->course->activeCourses([
                'search'              => $request->subject_title,
                'paginate'            => setting('paginate'),
                'sorting'             => $request->sorting,
                'q'                   => $request->q,
                'category_ids'        => array_unique(array_filter(explode(',', $request->category_ids))),
                'price'               => array_unique(array_filter(explode(',', $request->price))),
                'level_ids'           => array_unique(array_filter(explode(',', $request->level_ids))),
                'rating'              => array_unique(array_filter(explode(',', $request->rating))),
                'subject_ids'         => array_unique(array_filter(explode(',', $request->subject_ids))),
                'with_child_category' => 1,
            ], 'category.language');

            if (! arrayCheck('sorting', $input)) {
                $input['sorting'] = 'latest';
            }

            if ($courses->previousPageUrl()) {
                if ($courses->onLastPage()) {
                    $input['total_results'] = $courses->total();
                } else {
                    $input['total_results'] = $request->page * $courses->perPage();
                }
            }

            if ($courses->onFirstPage()) {
                $input['total_results'] = $courses->count();
            }
            $input['total_courses'] = $courses->total();
            if (request()->ajax()) {
                return response()->json($this->ajaxFilter($courses, $input), 200);
            }

            $single_course_section  = HomeScreen::where('section', 'single_course')->first();
            $single_course          = $single_course_section ? $this->course->findCourses($single_course_section->contents['ids']) : [];
            $subjects               = $subjectRepository->activeSubject([]);
            $data                   = [
                'courses'               => $courses,
                'levels'                => $levelRepository->levels(['paginate' => 4], ['language']),
                'filter_categories'     => $categoryRepository->parentCategories([
                    'type'            => 'course',
                    'paginate'        => 3,
                    'sub_with_course' => 1,
                ], ['subCategories.language', 'language']),
                'single_course'         => $single_course,
                'single_course_section' => $single_course_section,
                'subjects'              => $subjects,
                'category'              => '',
            ];

            return view('frontend.course.courses', array_merge($input, $data));
        } catch (\Exception $e) {
            Toastr::error(__($e->getMessage()));

            return back();
        }
    }

    public function categoryCourses($slug, Request $request, CategoryRepository $categoryRepository, LevelRepository $levelRepository, SubjectRepository $subjectRepository): View|Factory|\Illuminate\Http\JsonResponse|RedirectResponse|Application
    {
        try {
            $category               = $categoryRepository->findBySlug($slug);
            $input                  = $request->all();
            $input['total_results'] = 0;
            $input['style']         = $request->style ?? 'grid';
            $input['category_ids']  = array_unique(array_filter(explode(',', $request->category_ids)));
            $input['level_ids']     = $request->level_ids ? array_unique(array_filter(explode(',', $request->level_ids))) : [];
            $input['price']         = $request->price ? array_unique(array_filter(explode(',', $request->price))) : [];
            $input['rating']        = array_unique(array_filter(explode(',', $request->rating)));
            $input['subject_ids']   = $request->subject_ids ? array_unique(array_filter(explode(',', $request->subject_ids))) : [];
            $courses                = $this->course->activeCourses([
                'search'              => $request->subject_title,
                'paginate'            => setting('paginate'),
                'sorting'             => $request->sorting,
                'q'                   => $request->q,
                'category_id'         => $category->id,
                'price'               => array_unique(array_filter(explode(',', $request->price))),
                'level_ids'           => array_unique(array_filter(explode(',', $request->level_ids))),
                'rating'              => array_unique(array_filter(explode(',', $request->rating))),
                'subject_ids'         => array_unique(array_filter(explode(',', $request->subject_ids))),
                'with_child_category' => 1,
            ], 'category.language');

            if (! arrayCheck('sorting', $input)) {
                $input['sorting'] = 'latest';
            }

            if ($courses->previousPageUrl()) {
                if ($courses->onLastPage()) {
                    $input['total_results'] = $courses->total();
                } else {
                    $input['total_results'] = $request->page * $courses->perPage();
                }
            }

            if ($courses->onFirstPage()) {
                $input['total_results'] = $courses->count();
            }
            $input['total_courses'] = $courses->total();
            if (request()->ajax()) {
                return response()->json($this->ajaxFilter($courses, $input), 200);
            }

            $single_course_section  = HomeScreen::where('section', 'single_course')->first();
            $single_course          = $single_course_section ? $this->course->findCourses($single_course_section->contents['ids']) : [];
            $subjects               = $subjectRepository->activeSubject([]);
            $data                   = [
                'courses'               => $courses,
                'levels'                => $levelRepository->levels(['paginate' => 4], ['language']),
                'filter_categories'     => $categoryRepository->parentCategories([
                    'type'            => 'course',
                    'paginate'        => 3,
                    'sub_with_course' => 1,
                ], ['subCategories.language', 'language']),
                'single_course'         => $single_course,
                'single_course_section' => $single_course_section,
                'subjects'              => $subjects,
                'category'              => $category,
            ];

            return view('frontend.course.courses', array_merge($input, $data));
        } catch (\Exception $e) {
            dd($e);
            Toastr::error(__($e->getMessage()));

            return back();
        }
    }

    public function loadCategory(CategoryRepository $categoryRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $categories = $categoryRepository->parentCategories([
                'type'            => 'course',
                'paginate'        => setting('paginate'),
                'sub_with_course' => 1,
            ], ['subCategories.language', 'language']);
            $data       = [
                'filter_categories' => $categories,
            ];

            return response()->json([
                'html'    => view('frontend.course.category_component', $data)->render(),
                'success' => true,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function loadSubject(SubjectRepository $subjectRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $subjects = $subjectRepository->activeSubject([]);
            $data     = [
                'subjects' => $subjects,
            ];

            return response()->json([
                'html'    => view('frontend.course.subject_component', $data)->render(),
                'success' => true,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function loadLevel(LevelRepository $levelRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $levels = $levelRepository->levels(['paginate' => 4], ['language']);

            $data   = [
                'levels' => $levels,
            ];

            return response()->json([
                'html'    => view('frontend.course.level_component', $data)->render(),
                'success' => true,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    protected function ajaxFilter($courses, $input): array
    {
        try {
            $course_view = '';
            foreach ($courses as $key => $course) {
                $vars = [
                    'course' => $course,
                    'key'    => $key,
                    'style'  => $input['style'],
                    'col'    => 'col-lg-6',
                ];

                $course_view .= view('frontend.course.component', $vars)->render();
            }
            if (count($courses) == 0) {
                $course_view .= view('frontend.not_found', $data = ['title' => 'courses'])->render();
            }

            return [
                'header'    => view('frontend.course.header', $input)->render(),
                'courses'   => $course_view,
                'next_page' => $courses->nextPageUrl(),
            ];
        } catch (\Exception $e) {

            Log::error($e);

            return [];
        }
    }

    public function courseDetails($slug, UserRepository $userRepository, ReviewRepository $reviewRepository): View|Factory|RedirectResponse|Application
    {
        try {
            $course            = $this->course->findBySlug($slug);

            $reviews           = $reviewRepository->reviews([
                'paginate' => setting('paginate'),
                'id'       => $course->id,
                'type'     => Course::class,
                'status'   => 1,
            ]);
            $total             = $reviews->total();
            $instructors       = $userRepository->findUsers([
                'role_id' => 2,
                'ids'     => is_array($course->instructor_ids) ? $course->instructor_ids : [$course->instructor_ids],
                'status'  => 1,
            ], ['instructor']);

            $one_star          = 0;
            $two_star          = 0;
            $three_star        = 0;
            $four_star         = 0;
            $five_star         = 0;
            $review_percentage = $reviewRepository->reviewPercentage([
                'id'   => $course->id,
                'type' => Course::class,
            ]);

            foreach ($review_percentage as $key => $review) {
                if ($key == 1) {
                    $one_star = round(($review * 100) / $total, 2);
                }
                if ($key == 2) {
                    $two_star = round(($review * 100) / $total, 2);
                }
                if ($key == 3) {
                    $three_star = round(($review * 100) / $total, 2);
                }
                if ($key == 4) {
                    $four_star = round(($review * 100) / $total, 2);
                }
                if ($key == 5) {
                    $five_star = round(($review * 100) / $total, 2);
                }
            }

            $related_courses   = $this->course->activeCourses([
                'category_id' => $course->category_id,
                'paginate'    => 5,
                'related'     => 1,
                'id'          => $course->id,
            ]);

            $is_reviewed       = $reviewRepository->searchUserReview([
                'user_id' => auth()->id(),
                'type'    => Course::class,
                'id'      => $course->id,
            ]);
            $has_enrolled      = $course->enrolls()->whereHas('checkout', function ($query) {
                $query->where('user_id', auth()->id());
            })->first();

            $data              = [
                'hasEnrolled'          => $has_enrolled,
                'course'               => $course,
                'sections'             => $course->sections,
                'lessons'              => $course->lessons,
                'faqs'                 => $course->faqs,
                'reviews'              => $reviews,
                'is_reviewed'          => $is_reviewed,
                'instructors'          => $instructors,
                'related_courses'      => $related_courses,
                'organization'         => $course->organization,
                'language'             => $course->language,
                'level'                => $course->level,
                'category'             => $course->category,
                'id'                   => $course->id,
                'ratings'              => [
                    'one_star'   => $one_star,
                    'two_star'   => $two_star,
                    'three_star' => $three_star,
                    'four_star'  => $four_star,
                    'five_star'  => $five_star,
                ],
                'quiz'                 => Quiz::whereHas('section', function ($query) use ($course) {
                    $query->where('course_id', $course->id);
                })->exists(),
                'facebook_link'        => 'https://www.facebook.com/sharer/sharer.php?u='.route('course.details', $course->slug),
                'twitter_link'         => "https://twitter.com/intent/tweet?text=$course->title&url=".route('course.details', $course->slug),
                'whatsapp_link'        => 'https://wa.me/?text='.route('course.details', $course->slug),
                'linkedin_link'        => "https://www.linkedin.com/sharing/share-offsite?mini=true&title=$course->title&summary=Extra+linkedin+summary+can+be+passed+here&url=".route('course.details', $course->slug),
                'is_enrolled'          => $has_enrolled,
                'is_added_to_cart'     => $course->carts()->where('user_id', auth()->id())->first(),
                'is_added_to_wishlist' => $course->wishlists()->where('user_id', auth()->id())->first(),
                'can_review'           => auth()->check() && ! $is_reviewed && $has_enrolled,
            ];

            return view('frontend.course.course_details', $data);
        } catch (\Exception $e) {
            Toastr::warning(__('sorry_course_not_found'));

            return back();
        }
    }

    public function recentViewedCourse($view_type, $data)
    {
        $enrols = $data->enrolls()->whereHas('checkout', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->count();

        if ($enrols > 0) {
            if (! ($this->recent_view_repository->find($view_type, $data->id))) {
                $request['user_id']       = auth()->user()->id;
                $request['viewable_id']   = $data->id;
                $request['viewable_type'] = $view_type;

                return $this->recent_view_repository->store($request);
            }
        } else {
            return true;
        }
    }

    public function myCourse($slug, LessonRepository $lessonRepository, ResourceRepository $resourceRepository)
    {
        try {
            $course    = $this->course->findBySlug($slug, 'my_course');
            $courseIDs = $this->course->activeCoursesIDs([
                'course_id'  => 1,
                'section_id' => 1,
                'user_id'    => auth()->id(),
                'paginate'   => setting('paginate'),
            ], ['enrolls']);

            if (! $course) {
                Toastr::warning(__('sorry_course_not_purchased'));

                return back();
            }

            if ($course->enrolls->first()->checkout->status == 0) {
                Toastr::warning(__('you_cannot_access_this_course'));

                return back();
            }

            $sections         = $course->sections()->active()->with('lessons')->whereHas('lessons', function ($query) {
                $query->where('status', 1);
            })->active()->get();

            $previous_lession = Cache::get('selected_lesson');

            if ($previous_lession && $course->id == $previous_lession['course_id']) {

                $lesson = $lessonRepository->find($previous_lession['lesson_id']);
            } else {

                $lesson = $course->lessons->first();
            }

            $file             = $lesson ? ($lesson->source == 'mp4' ? $lesson->source_data : get_media(getArrayValue('image', @$lesson->source_data), getArrayValue('storage', @$lesson->source_data))) : '';
            $my_resources     = $resourceRepository->myResource($courseIDs);

            $data             = [
                'selected_lesson' => $lesson,
                'sections'        => $sections,
                'lesson_progress' => @$lesson->progress,
                'course'          => $course,
                'my_resource'     => $my_resources,
                'file'            => $file,
            ];

            return view('frontend.learn_course', $data);
        } catch (Exception $e) {
            Toastr::warning(__('sorry_course_not_purchased'));

            return back();
        }
    }

    public function lessonDetails(Request $request, $course, $slug, LessonRepository $lessonRepository): View|Factory|RedirectResponse|Application
    {
        try {
            $course        = $this->course->findBySlug($course);
            $sections      = $course->sections()->active()->with('lessons')->whereHas('lessons', function ($query) {
                $query->where('status', 1);
            })->active()->get();
            $lesson        = $lessonRepository->findBySlug($slug);
            $resource_repo = new ResourceRepository();

            $data          = [
                'selected_lesson' => $lesson,
                'sections'        => $sections,
                'lesson_progress' => $lesson->progress,
                'course'          => $course,
                'file'            => $lesson->source == 'mp4' ? $lesson->source_data : get_media(getArrayValue('image', @$lesson->source_data), getArrayValue('storage', @$lesson->source_data)),
                'my_resource'     => $resource_repo->myResource([$course->id]),
            ];

            return view('frontend.learn_course', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function saveProgress(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'course_id'        => 'required',
            'lesson_id'        => 'required',
            'section_id'       => 'required',
            'total_spent_time' => 'required|lte:total_duration',
            'total_duration'   => 'required',
        ]);
        try {
            $course_progress = $this->course->updateProgress($request->all());

            return response()->json(['success' => true, 'message' => 'Successfully progress saved'], 200);
        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function myQuiz($slug, QuizRepository $quizRepository)
    {
        $quiz             = $quizRepository->findBySlug($slug);
        $course           = $this->course->find($quiz->section->course_id);
        $purchased_course = $this->course->activeCourses([
            'purchase_course' => $quiz->section->course_id,
            'user_id'         => Auth::user()->id,
            'paginate'        => setting('paginate'),
        ])->pluck('id');
        if (! $this->checkQuizSubmit($quiz->id)) {
            return redirect()->route('quiz-answer.show', encrypt($quiz->id));
        }
        try {
            if (count($purchased_course) > 0) {
                $sections = SectionResource::collection($course->sections()->active()->with('lessons')->whereHas('lessons', function ($query) {
                    $query->where('status', 1);
                })->active()->get());

                $data     = [
                    'quiz'     => $quiz,
                    'sections' => $sections,
                ];

                return view('frontend.quiz', $data);
            } else {
                Toastr::warning(__('sorry_course_not_purchased'));

                return back();
            }
        } catch (Exception $e) {
            Toastr::warning(__('sorry_course_not_purchased'));

            return back();
        }
    }

    public function quizAnswerSubmit(Request $request)
    {
        if ($this->checkQuizSubmit($request->quiz_id)) {
            foreach ($request['question_id'] as $key => $question_id) {
                $data                     = [];
                $answer                   = 'answers_'."$question_id";
                $student_answer           = 'student_answer_'."$question_id";
                $correct_answer           = 'correct_answer_'."$question_id";
                $data['user_id']          = auth()->user()->id;
                $data['quiz_question_id'] = $question_id;
                $data['quiz_id']          = $request->quiz_id;
                $data['answers']          = $request->$student_answer;
                $data['correct_answer']   = $request->$correct_answer;
                $question_type            = 'question_type_'."$question_id";
                if ($request->$question_type == 'short_question') {
                    $data['correct_answer'] = $request->$student_answer;
                }
                QuizAnswer::create($data);
            }

            return redirect()->route('quiz-answer.show', encrypt($request->quiz_id));
        } else {
            Toastr::warning(__('already_submitted'));

            return redirect()->route('quiz-answer.show', encrypt($request->quiz_id));
        }
    }

    public function showQuizAnswer($quiz_id, QuizRepository $quizRepository)
    {
        $id      = decrypt($quiz_id);
        $user_id = auth()->user()->id;
        try {
            $quiz           = $quizRepository->find($id);
            $course         = $this->course->find($quiz->section->course_id);

            $correct_answer = QuizAnswer::where([
                ['user_id', $user_id],
                ['quiz_id', $quiz->id],
            ])->whereRaw(DB::raw('answers = correct_answer'))->where('answers', '!=', null)->count();

            $data           = [
                'quiz'           => $quiz,
                'correct_answer' => $correct_answer,
                'course'         => $course,
            ];

            return view('frontend.quiz_answer', $data);
        } catch (Exception $e) {
            Toastr::warning($e->getMessage());

            return back();
        }
    }

    public function checkQuizSubmit($quize_id)
    {
        $answer = QuizAnswer::where([
            ['user_id', \auth()->user()->id],
            ['quiz_id', $quize_id],
        ])->count();
        if ($answer > 0) {
            return false;
        } else {
            return true;
        }
    }
}
