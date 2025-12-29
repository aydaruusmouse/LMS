<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\BlogRepository;
use App\Repositories\BookRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CityRepository;
use App\Repositories\CourseRepository;
use App\Repositories\LessonRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\StateRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\SuccessStoryRepository;
use App\Repositories\TestimonialRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function organizations(Request $request, OrganizationRepository $repository): \Illuminate\Http\JsonResponse
    {
        try {
            $organizations = $repository->activeOrganization([
                'q'        => $request->q,
                'paginate' => 20,
            ]);
            $options       = [];
            foreach ($organizations as $item) {
                $options[] = [
                    'text' => $item->org_name,
                    'id'   => $item->id,
                ];
            }

            return response()->json($options);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function categories(Request $request, CategoryRepository $repository): \Illuminate\Http\JsonResponse
    {
        try {
            $categories = $repository->activeCategories([
                'q'            => $request->q,
                'paginate'     => 20,
                'parent_id'    => '20',
                'type'         => 'course',
                'excluded_ids' => $request->excluded_ids,
            ], ['language']);
            $options    = [];
            foreach ($categories as $item) {
                $options[] = [
                    'text' => $item->lang_title,
                    'id'   => $item->id,
                ];
            }

            return response()->json($options);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function instructor(Request $request, UserRepository $userRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $instructors = $userRepository->findUsers([
                'role_id'         => 2,
                'q'               => $request->q,
                'organization_id' => $request->organization_id,
            ]);
            $options     = [];
            foreach ($instructors as $item) {
                $options[] = [
                    'text' => $item->name,
                    'id'   => $item->id,
                ];
            }

            return response()->json($options);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function user(Request $request, UserRepository $userRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $users   = $userRepository->findUsers([
                'q'       => $request->q,
                'take'    => 20,
                'role_id' => $request->role_id,
            ]);
            $options = [];
            foreach ($users as $item) {
                $options[] = [
                    'text' => $item->name,
                    'id'   => $item->id,
                ];
            }

            return response()->json($options);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function successStory(Request $request, SuccessStoryRepository $successStoryRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $stories = $successStoryRepository->activeStories([
                'q'    => $request->q,
                'lang' => $request->lang ?? app()->getLocale(),
            ]);

            $options = [];
            foreach ($stories as $item) {
                $options[] = [
                    'text' => $item->story_title ?: $item->title,
                    'id'   => $item->id,
                ];
            }

            return response()->json($options);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function subjects(Request $request, SubjectRepository $subjectRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $stories = $subjectRepository->activeSubject([
                'q'    => $request->q,
                'lang' => $request->lang ?? app()->getLocale(),
            ], ['language']);

            $options = [];
            foreach ($stories as $item) {
                $options[] = [
                    'text' => $item->lang_title,
                    'id'   => $item->id,
                ];
            }

            return response()->json($options);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function lessons(Request $request, LessonRepository $lessonRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $lessons = $lessonRepository->activeLesson([
                'q'          => $request->q,
                'section_id' => $request->section_id,
            ]);

            if ($request->section_id) {
                $options[] = [
                    'text' => __('select_lesson'),
                    'id'   => '',
                ];
            } else {
                $options = [];
            }

            foreach ($lessons as $item) {
                $options[] = [
                    'text' => $item->title,
                    'id'   => $item->id,
                ];
            }

            return response()->json($options);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function courses(Request $request, CourseRepository $courseRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $courses = $courseRepository->activeCourses([
                'q'           => $request->q,
                'is_featured' => $request->is_featured,
                'paginate'    => setting('paginate'),
            ]);

            $options = [];
            foreach ($courses as $item) {
                $options[] = [
                    'text' => $item->title,
                    'id'   => $item->id,
                ];
            }

            return response()->json($options);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function blogs(Request $request, BlogRepository $blogRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $blogs   = $blogRepository->activeBlogs([
                'q' => $request->q,
            ]);

            $options = [];
            foreach ($blogs as $item) {
                $options[] = [
                    'text' => $item->lang_title,
                    'id'   => $item->id,
                ];
            }

            return response()->json($options);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function testimonial(Request $request, TestimonialRepository $testimonialRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $testimonials = $testimonialRepository->activeTestimonials([
                'q'    => $request->q,
                'lang' => $request->lang ?? app()->getLocale(),
            ]);

            $options      = [];
            foreach ($testimonials as $item) {
                $options[] = [
                    'text' => $item->lang_name,
                    'id'   => $item->id,
                ];
            }

            return response()->json($options);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function loadInstructorCourse(Request $request, CourseRepository $courseRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $courses = $courseRepository->activeCourses([
                'user_id'           => $request->id,
                'paginate'          => setting('paginate'),
                'instructor_course' => 1,
            ]);

            return response()->json([
                'courses'       => view('backend.admin.course.component', compact('courses'))->render(),
                'next_page_url' => $courses->nextPageUrl(),
                'success'       => true,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function loadInstructorBooks(Request $request, BookRepository $bookRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $books = $bookRepository->activeBooks([
                'instructor_id' => $request->id,
                'paginate'      => setting('paginate'),
            ]);

            return response()->json([
                'books'         => view('backend.admin.book.component', compact('books'))->render(),
                'next_page_url' => $books->nextPageUrl(),
                'success'       => true,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function getStates(Request $request, StateRepository $stateRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $states  = $stateRepository->stateByCountry($request->country_id);
            $options = [
                [
                    'text' => __('select_state'),
                    'id'   => '',
                ],
            ];
            foreach ($states as $item) {
                $options[] = [
                    'text' => $item->name,
                    'id'   => $item->id,
                ];
            }

            return response()->json($options);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function getCities(Request $request, CityRepository $cityRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $cities  = $cityRepository->cityByState($request->state_id);
            $options = [
                [
                    'text' => __('select_city'),
                    'id'   => '',
                ],
            ];
            foreach ($cities as $item) {
                $options[] = [
                    'text' => $item->name,
                    'id'   => $item->id,
                ];
            }

            return response()->json($options);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function getBooks(Request $request, BookRepository $repository): \Illuminate\Http\JsonResponse
    {
        try {
            $books = $repository->activeBooks([
                'q' => $request->q,
            ]);

            foreach ($books as $item) {
                $options[] = [
                    'text' => $item->title,
                    'id'   => $item->id,
                ];
            }

            return response()->json($options);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
