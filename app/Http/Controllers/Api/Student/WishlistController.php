<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BookResource;
use App\Http\Resources\Api\CourseResource;
use App\Models\Book;
use App\Models\Course;
use App\Models\Wishlist;
use App\Repositories\BookRepository;
use App\Repositories\CourseRepository;
use App\Traits\ApiReturnFormatTrait;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    use ApiReturnFormatTrait;

    public function wishlists(CourseRepository $courseRepository, BookRepository $bookRepository, Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = validator($request->all(), [
            'type' => 'required|in:course,book',
        ]);
        if ($validator->fails()) {
            return $this->responseWithError($validator->errors()->first());
        }
        try {
            $input = [
                'wishlist' => 1,
                'user_id'  => jwtUser()->id,
                'paginate' => setting('api_paginate'),
            ];

            if ($request->type == 'course') {
                $data = [
                    'courses' => CourseResource::collection($courseRepository->activeCourses($input)),
                ];
            } else {
                if (addon_is_activated('book_store')) {
                    return $this->responseWithSuccess(__('addon_not_installed_yet'));
                }
                $data = [
                    'books' => BookResource::collection($bookRepository->activeBooks($input)),
                ];
            }

            return $this->responseWithSuccess('wishlist_retrieved_successfully', $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function addOrRemoveWishlist(Request $request, CourseRepository $courseRepository, BookRepository $bookRepository): \Illuminate\Http\JsonResponse
    {
        $validator = validator($request->all(), [
            'id'   => 'required',
            'type' => 'required|in:course,book',
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
                if (addon_is_activated('book_store')) {
                    return $this->responseWithSuccess(__('addon_not_installed_yet'));
                }                $book = $bookRepository->find($request->id);
                if (! $book) {
                    return $this->responseWithError(__('book_not_found'));
                }
            }
            $wishable_type     = $request->type == 'course' ? Course::class : Book::class;
            $is_wishlist_added = Wishlist::where('user_id', jwtUser()->id)->where('wishable_id', $request->id)->where('wishable_type', $wishable_type)->first();
            if ($is_wishlist_added) {
                $is_wishlist_added->delete();
                $msg = 'wishlist_removed_successfully';
            } else {
                $data                  = $request->all();
                $data['user_id']       = jwtUser()->id;
                $data['wishable_id']   = $request->id;
                $data['wishable_type'] = $wishable_type;

                Wishlist::create($data);
                $msg                   = 'wishlist_added_successfully';
            }

            return $this->responseWithSuccess($msg);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }
}
