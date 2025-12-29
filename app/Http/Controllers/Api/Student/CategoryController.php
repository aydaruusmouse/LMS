<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CategoryResource;
use App\Http\Resources\Api\CourseResource;
use App\Repositories\CategoryRepository;
use App\Repositories\CourseRepository;
use App\Traits\ApiReturnFormatTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiReturnFormatTrait;

    public function categories(CategoryRepository $categoryRepository, Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $data = [
                'categories' => CategoryResource::collection($categoryRepository->activeCategories([
                    'type' => 'course',
                    'lang' => $request->header('lang') ?? 'en',
                ])),
            ];

            return $this->responseWithSuccess(__('categories_retrieved'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function courses($id, CourseRepository $courseRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $data = [
                'courses' => CourseResource::collection($courseRepository->activeCourses([
                    'category_id'         => $id,
                    'with_child_category' => $id,
                    'paginate'            => setting('api_paginate'),
                ])),
            ];

            return $this->responseWithSuccess(__('courses_retrieved'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }
}
