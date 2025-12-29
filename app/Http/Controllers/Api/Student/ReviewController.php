<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ReviewResource;
use App\Models\Book;
use App\Models\Course;
use App\Repositories\BookRepository;
use App\Repositories\CourseRepository;
use App\Repositories\ReviewRepository;
use App\Traits\ApiReturnFormatTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    use ApiReturnFormatTrait;

    protected $reviewRepository;

    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function reviews(Request $request, CourseRepository $courseRepository, BookRepository $bookRepository): \Illuminate\Http\JsonResponse
    {
        $validator = validator($request->all(), [
            'id'   => 'required',
            'type' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors()->first());
        }
        try {
            if ($request->type == 'course') {
                $course = $courseRepository->find($request->id);
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
                'status'   => 1,
            ];

            $data  = [
                'reviews' => ReviewResource::collection($this->reviewRepository->reviews($input)),
            ];

            return $this->responseWithSuccess('reviews_retrieved_successfully', $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function writeReview(Request $request, CourseRepository $courseRepository, BookRepository $bookRepository): \Illuminate\Http\JsonResponse
    {
        $validator = validator($request->all(), [
            'rating'  => 'required',
            'comment' => 'required',
            'type'    => 'required|in:course,book',
        ]);
        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors()->first());
        }
        DB::beginTransaction();
        try {
            if ($request->type == 'course') {
                $course = $courseRepository->find($request->id);
                if (! $course) {
                    return $this->responseWithError(__('course_not_found'));
                }
            } else {
                $book = $bookRepository->find($request->id);
                if (! $book) {
                    return $this->responseWithError(__('book_not_found'));
                }
            }
            $commentable_type         = $request->type == 'course' ? Course::class : Book::class;
            $is_reviewed              = $this->reviewRepository->searchUserReview([
                'user_id' => jwtUser()->id,
                'type'    => $commentable_type,
                'id'      => $request->id,
            ]);
            if ($is_reviewed) {
                if ($request->type == 'course') {
                    return $this->responseWithError(__('you_already_reviewed_this_course'));
                } else {
                    return $this->responseWithError(__('you_already_reviewed_this_book'));
                }
            }
            $data                     = $request->all();
            $data['user_id']          = jwtUser()->id;
            $data['commentable_id']   = $request->id;
            $data['commentable_type'] = $commentable_type;

            $rating                   = $this->reviewRepository->store($data);

            $rating->commentable->update([
                'total_rating' => $rating->commentable->reviews()->avg('rating'),
            ]);
            DB::commit();

            return $this->responseWithSuccess('review_added_successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->responseWithError($e->getMessage());
        }
    }
}
