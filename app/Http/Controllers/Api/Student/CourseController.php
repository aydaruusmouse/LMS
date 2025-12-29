<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CourseResource;
use App\Http\Resources\Api\FaqResource;
use App\Http\Resources\Api\MyCourseResource;
use App\Http\Resources\Api\MyResourcesResource;
use App\Http\Resources\Api\SectionResource;
use App\Http\Resources\Api\UserResource;
use App\Models\Course;
use App\Repositories\CourseRepository;
use App\Repositories\FaqRepository;
use App\Repositories\LessonRepository;
use App\Repositories\ResourceRepository;
use App\Repositories\ReviewRepository;
use App\Repositories\UserRepository;
use App\Traits\ApiReturnFormatTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    use ApiReturnFormatTrait;

    protected $courseRepository;

    protected $resourceRepository;

    public function __construct(CourseRepository $courseRepository, ResourceRepository $resourceRepository)
    {
        $this->courseRepository   = $courseRepository;
        $this->resourceRepository = $resourceRepository;

    }

    public function myCourse(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $input = [
                'my_course' => 1,
                'user_id'   => jwtUser()->id,
                'paginate'  => $request->paginate ?: setting('api_paginate'),
            ];

            $data  = [
                'courses' => MyCourseResource::collection($this->courseRepository->activeCourses($input)),
            ];

            return $this->responseWithSuccess('course_retrieved_successfully', $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function searchCourses(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $input = [
                'search'   => $request->q,
                'user_id'  => jwtUser() ? jwtUser()->id : '',
                'paginate' => setting('api_paginate'),
            ];

            $data  = [
                'courses' => CourseResource::collection($this->courseRepository->activeCourses($input)),
            ];

            return $this->responseWithSuccess(__('course_retrieved_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function latestCourses(): \Illuminate\Http\JsonResponse
    {
        try {
            $input = [
                'paginate' => 2,
            ];

            $data  = [
                'courses' => CourseResource::collection($this->courseRepository->activeCourses($input)),
            ];

            return $this->responseWithSuccess(__('course_retrieved_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function courseDetails($id, UserRepository $userRepository, FaqRepository $faqRepository, Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $user              = jwtUser();
            $course            = $this->courseRepository->find($id);
            $currency_code     = $request->currency ?: null;

            if (! $course) {
                return $this->responseWithError('course_not_found');
            }

            $lessons           = $course->lessons;
            $sections          = $course->sections()->active()->with('lessons')->withCount('quizzes')->whereHas('lessons', function ($query) {
                $query->where('status', 1);
            })->active()->get();
            $instructors       = $userRepository->findUsers([
                'role_id' => 2,
                'ids'     => $course->instructor_ids,
                'status'  => 1,
            ]);
            $sectionResource   = SectionResource::collection($sections);
            $video_lessons     = $course->lessons()->where('lesson_type', 'video')->count();
            $audio_lessons     = $course->lessons()->where('lesson_type', 'audio')->count();
            $doc_lessons       = $course->lessons()->where('lesson_type', 'doc')->count();
            $organization      = $course->organization;
            $review_repository = new ReviewRepository();
            $is_reviewed       = $review_repository->searchUserReview([
                'id'      => $id,
                'user_id' => $user ? $user->id : 0,
                'type'    => Course::class,
            ]);
            $related_courses   = Course::where(function ($query) use ($course) {
                $query->where('category_id', $course->category_id)->orWhereHas('category', function ($query) use ($course) {
                    $query->where('parent_id', $course->category_id);
                });
            })->where('id', '!=', $course->id)->where('is_published', 1)->take(8)->get();
            $data              = [
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
                'is_reviewed'       => (bool) $is_reviewed,
                'can_review'        => $user && ! $is_reviewed && $course->enrolls()->whereHas('checkout', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->first(),
            ];

            return $this->responseWithSuccess(__('course_retrieved_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function sections($id): \Illuminate\Http\JsonResponse
    {
        try {
            $course = $this->courseRepository->find($id);

            if (! $course) {
                return $this->responseWithError('course_not_found');
            }

            $data   = [
                'sections' => SectionResource::collection($course->sections()->active()->with('lessons.progress')->with('quizzes')->whereHas('lessons', function ($query) {
                    $query->where('status', 1);
                })->active()->get()),
            ];

            return $this->responseWithSuccess(__('section_retrieved_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function lessonDetails($id, LessonRepository $lessonRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $lesson         = $lessonRepository->find($id);
            if (! $lesson) {
                return $this->responseWithError('lesson_not_found');
            }
            $data           = [
                'id'          => (int) $lesson->id,
                'title'       => $lesson->title,
                'description' => nullCheck($lesson->description),
                'type'        => $lesson->lesson_type,
                'duration'    => $lesson->duration,
                'is_free'     => (bool) $lesson->is_free,
                'thumbnail'   => getFileLink('320x320', $lesson->is_free),
            ];
            $data['source'] = '';
            $data['link']   = '';
            if ($lesson->lesson_type == 'video') {
                $data['source'] = $lesson->source;
                $data['link']   = $lesson->source == 'upload' ? (string) get_media($lesson->link) : (string) $lesson->link;
            } elseif ($lesson->lesson_type == 'audio') {
                $data['source'] = $lesson->source;
                $data['link']   = $lesson->source == 'upload' ? (string) get_media($lesson->link) : (string) $lesson->link;
            } elseif ($lesson->lesson_type == 'doc') {
                $data['source'] = $lesson->source;
                $data['link']   = $lesson->source == 'upload' ? (string) get_media($lesson->link) : (string) $lesson->link;
            }

            return $this->responseWithSuccess(__('lesson_retrieved_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function saveProgress(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = validator($request->all(), [
            'course_id'        => 'required',
            'lesson_id'        => 'required',
            'section_id'       => 'required',
            'total_spent_time' => 'required|lte:total_duration',
            'total_duration'   => 'required',
        ]);

        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors()->first());
        }
        DB::beginTransaction();

        try {

            $this->courseRepository->updateProgress($request);
            DB::commit();

            return $this->responseWithSuccess(__('Successfully progress saved'));

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function myResources($id): \Illuminate\Http\JsonResponse
    {
        try {
            $my_resources = $this->resourceRepository->myResourceBasedOnCourseID($id);

            $data         = [
                'resources' => MyResourcesResource::collection($my_resources),
            ];

            return $this->responseWithSuccess(__('resources_retrieved_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }
}
