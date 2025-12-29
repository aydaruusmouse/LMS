<?php

namespace App\Http\Controllers\Api\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CourseResource;
use App\Http\Resources\Api\FaqResource;
use App\Http\Resources\Api\ReviewResource;
use App\Http\Resources\Api\SectionResource;
use App\Http\Resources\Api\UserResource;
use App\Models\Book;
use App\Models\Course;
use App\Repositories\BookRepository;
use App\Repositories\CourseRepository;
use App\Repositories\FaqRepository;
use App\Repositories\ReviewRepository;
use App\Repositories\UserRepository;
use App\Traits\ApiReturnFormatTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    use ApiReturnFormatTrait;

    protected $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;

    }

    public function courses(): JsonResponse
    {
        try {
            $user    = jwtUser();
            $courses = Course::withCount('lessons')->withCount('enrolls')->whereHas('users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })->paginate(setting('api_paginate'));
            $data    = [
                'courses' => CourseResource::collection($courses),
            ];

            return $this->responseWithSuccess(__('course_fetched_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function pendingCourses(): JsonResponse
    {
        try {
            $user    = jwtUser();
            $courses = Course::withCount('lessons')->withCount('enrolls')->whereHas('users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })->where('is_published', 0)->paginate(setting('api_paginate'));
            $data    = [
                'courses' => CourseResource::collection($courses),
            ];

            return $this->responseWithSuccess(__('course_fetched_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function courseDetails($id, UserRepository $userRepository, FaqRepository $faqRepository, Request $request): JsonResponse
    {
        try {
            $user            = jwtUser();
            $course          = $this->courseRepository->findInstructorCourse($id, $user);
            $currency_code   = $request->currency ?: null;

            if (! $course) {
                return $this->responseWithError('course_not_found');
            }

            $lessons         = $course->lessons;
            $sections        = $course->sections()->active()->with('lessons')->withCount('quizzes')->whereHas('lessons', function ($query) {
                $query->where('status', 1);
            })->active()->get();
            $instructors     = $userRepository->findUsers([
                'role_id' => 2,
                'ids'     => $course->instructor_ids,
                'status'  => 1,
            ]);
            $sectionResource = SectionResource::collection($sections);
            $video_lessons   = $course->lessons()->where('lesson_type', 'video')->count();
            $audio_lessons   = $course->lessons()->where('lesson_type', 'audio')->count();
            $doc_lessons     = $course->lessons()->where('lesson_type', 'doc')->count();
            $organization    = $course->organization;
            $related_courses = Course::whereHas('users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })->where(function ($query) use ($course) {
                $query->where('category_id', $course->category_id)->orWhereHas('category', function ($query) use ($course) {
                    $query->where('parent_id', $course->category_id);
                });
            })->where('id', '!=', $course->id)->take(8)->get();
            $data            = [
                'id'                => (int) $id,
                'title'             => $course->title,
                'slug'              => $course->slug,
                'short_description' => nullCheck($course->short_description),
                'description'       => nullCheck($course->description),
                'thumbnail'         => getFileLink('320x320', $course->thumbnail),
                'video_source'      => $course->video_source,
                'video_link'        => $course->video_source == 'upload' ? get_media(getArrayValue('image', $course->video), getArrayValue('storage', $course->video)) : $course->video,
                'price'             => $course->is_free ? __('free') : get_price($course->price, $currency_code),
                'is_discounted'     => $course->is_discount,
                'discount_type'     => nullCheck($course->discount_type),
                'discounted_price'  => get_price($course->discount_amount, $currency_code),
                'is_wishlist_added' => $user && $course->wishlists->where('user_id', $user->id)->first(),
                'is_cartlist_added' => $user && $course->carts->where('user_id', $user->id)->first(),
                'features'          => [
                    'total_lesson'      => count($lessons).' '.__('lessons'),
                    'total_enroll'      => $course->enrolls_count.' '.__('enrolls'),
                    'total_quiz'        => $sections->sum('quizzes_count').' '.__('quizzes'),
                    'total_videos'      => $video_lessons.' '.__('video_records'),
                    'total_note_files'  => $doc_lessons.' '.__('note_files'),
                    'total_audio_files' => $audio_lessons.' '.__('audio_records'),
                ],
                'instructors'       => UserResource::collection($instructors),
                'sections'          => $sectionResource,
                'resources'         => [
                    'is_doc_available'   => $doc_lessons   > 0,
                    'is_audio_available' => $audio_lessons > 0,
                    'is_video_available' => $video_lessons > 0,
                ],
                'related_courses'   => CourseResource::collection($related_courses),
                'faqs'              => FaqResource::collection($faqRepository->activeFaq([
                    'lang'      => $request->header('lang') ?? app()->getLocale(),
                    'course_id' => $course->id,
                    'paginate'  => setting('api_paginate'),
                ])),
                'organization'      => $organization ? [
                    'id'      => $organization->id,
                    'name'    => $organization->org_name,
                    'tagline' => nullCheck($organization->tagline),
                    'logo'    => getFileLink('72x72', $organization->logo),
                ] : '',
                'contact_no'        => nullCheck(setting('contact_no')),
                'total_reviews'     => $course->reviews_count,
                'avg_ratings'       => number_format($course->reviews_avg_rating, 2),
            ];

            return $this->responseWithSuccess(__('course_retrieved_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function reviews(Request $request, BookRepository $bookRepository, ReviewRepository $reviewRepository): JsonResponse
    {
        $validator = validator($request->all(), [
            'id'   => 'required',
            'type' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors()->first());
        }
        try {
            $user  = jwtUser();
            if ($request->type == 'course') {
                $course = $this->courseRepository->findInstructorCourse($request->id, $user);
                if (! $course) {
                    return $this->responseWithError(__('course_not_found'));
                }
            } else {
                if (! addon_is_activated('book_store')) {
                    return $this->responseWithSuccess(__('addon_not_installed_yet'));
                }
                $book = $bookRepository->find($request->id);
                if (! $book) {
                    return $this->responseWithError(__('book_not_found'));
                }
            }
            $input = [
                'paginate' => setting('api_paginate'),
                'id'       => $request->id,
                'type'     => $request->type == 'course' ? Course::class : Book::class,
            ];

            $data  = [
                'reviews' => ReviewResource::collection($reviewRepository->reviews($input)),
            ];

            return $this->responseWithSuccess('reviews_retrieved_successfully', $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function changeStatus($id): JsonResponse
    {
        try {
            $this->courseRepository->changeStatus($id, jwtUser());

            return $this->responseWithSuccess('Status Changed Successfully');
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function changeReviewStatus($id, ReviewRepository $reviewRepository): JsonResponse
    {
        try {
            $review      = $reviewRepository->find($id);
            if (! $review) {
                return $this->responseWithError(__('review_not_found'));
            }
            $course      = $review->commentable;
            if (! $course) {
                return $this->responseWithError(__('course_not_found'));
            }
            $instructors = $course->users->pluck('id')->toArray();
            if (! in_array(jwtUser()->id, $instructors)) {
                return $this->responseWithError(__('you_are_not_authorized'));
            }
            $reviewRepository->changeStatus($id);

            return $this->responseWithSuccess('Status Changed Successfully');
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function categoryCourses($id)
    {
        try {
            $courses = Course::withCount('lessons')->withCount('enrolls')->withAvg('reviews', 'rating')
                ->where('is_private', 0)->where(function ($query) use ($id) {
                    $query->where('category_id', $id)
                        ->orWhereHas('category', function ($query) use ($id) {
                            $query->where('parent_id', $id);
                        });
                })->whereHas('users', function ($query) {
                    $query->where('users.id', jwtUser()->id);
                })->paginate(setting('api_paginate'));

            $data    = [
                'courses' => CourseResource::collection($courses),
            ];

            return $this->responseWithSuccess(__('courses_retrieved'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }
}
