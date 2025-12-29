<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Course;
use App\Models\CourseProgress;
use App\Models\Enroll;
use App\Traits\ApiReturnFormatTrait;
use App\Traits\ImageTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class CourseRepository
{
    use ApiReturnFormatTrait;
    use ImageTrait;

    public function all()
    {
        return Course::orderByDesc('id')->paginate(setting('paginate'));
    }

    public function store($request)
    {
        if (arrayCheck('image_media_id', $request)) {
            $request['image'] = $this->getImageWithRecommendedSize($request['image_media_id'], '402', '248', true);
        }

        if (arrayCheck('meta_image', $request)) {
            $request['meta_image'] = $this->getImageWithRecommendedSize($request['meta_image'], '1200', '630', true);
        } else {
            $request['meta_image'] = getArrayValue('image', $request);
        }

        if (! arrayCheck('meta_title', $request)) {
            $request['meta_title'] = $request['title'];
        }

        if (! arrayCheck('meta_keywords', $request)) {
            $request['meta_keywords'] = Str::slug($request['title']);
        }

        if (! arrayCheck('meta_description', $request)) {
            $request['meta_description'] = arrayCheck('short_description', $request) ? $request['short_description'] : $request['title'];
        }

        if (arrayCheck('video_source', $request) && arrayCheck('video', $request) && $request['video_source'] == 'upload') {
            $request['video'] = $this->saveFile($request['video'], 'pos_file', false);
        }
        if (arrayCheck('video_source', $request) && $request['video_source'] != 'upload') {
            $request['video'] = $request['video_link'];
        }

        if (arrayCheck('discount_period', $request)) {
            $dates                        = explode(' - ', $request['discount_period']);
            $request['discount_start_at'] = Carbon::parse($dates[0])->startOfDay();
            $request['discount_end_at']   = Carbon::parse($dates[1])->endOfDay();
        }

        $request['user_id'] = auth()->id();

        $request['slug']    = getSlug('courses', $request['title']);

        if (arrayCheck('is_free', $request) && $request['is_free'] == 1) {
            $request['price'] = 0;
        } else {
            $request['price'] = priceFormatUpdate($request['price'], setting('default_currency'));
        }

        $course             = Course::create($request);
        $course->users()->sync($request['instructor_ids']);

        $course->category->increment('total_courses');

        return $course;
    }

    public function update($request, $id)
    {
        $increment                  = false;
        $course                     = Course::findOrfail($id);
        if (arrayCheck('category_id', $request) && $course->category_id != $request['category_id']) {
            $increment = true;
            $course->category->decrement('total_courses');
        }

        if (arrayCheck('image_media_id', $request)) {
            $request['image'] = $this->getImageWithRecommendedSize($request['image_media_id'], '402', '248', true);
        }

        if (! arrayCheck('meta_title', $request) && arrayCheck('title', $request)) {
            $request['meta_title'] = $course->meta_title ?: $request['title'];
        }

        if (! arrayCheck('meta_keywords', $request) && arrayCheck('title', $request)) {
            $request['meta_keywords'] = $course->meta_keywords ?: Str::slug($request['title']);
        }

        if (! arrayCheck('meta_description', $request) && arrayCheck('title', $request)) {
            $request['meta_description'] = $course->meta_description ?: (arrayCheck('short_description', $request) ? $request['short_description'] : $request['title']);
        }

        if (arrayCheck('meta_image', $request)) {
            $request['meta_image'] = $this->getImageWithRecommendedSize($request['meta_image'], '1200', '630', true);
        } else {
            $request['meta_image'] = getArrayValue('image', $request);
        }

        if (arrayCheck('video_source', $request) && arrayCheck('video', $request) && $request['video_source'] == 'upload') {
            $request['video'] = $this->saveFile($request['video'], 'pos_file', false);
        }
        if (arrayCheck('video_source', $request) && $request['video_source'] != 'upload') {
            $request['video'] = $request['video_link'];
        }

        if (arrayCheck('discount_period', $request)) {
            $dates                        = explode(' - ', $request['discount_period']);
            $request['discount_start_at'] = Carbon::parse($dates[0])->startOfDay();
            $request['discount_end_at']   = Carbon::parse($dates[1])->endOfDay();
        }
        if (arrayCheck('is_free', $request) && $request['is_free'] == 1) {
            $request['price'] = 0;
        } else {
            $request['price'] = priceFormatUpdate($request['price'], setting('default_currency'));
        }

        if (arrayCheck('title', $request)) {
            $request['slug'] = getSlug('courses', $request['title'], 'slug', $course->id);
        }

        if (isset($request['save_and_published'])) {
            $request['is_published'] = 1;
        }

        $course->users()->sync($request['instructor_ids']);

        $request['is_discountable'] = arrayCheck('is_discountable', $request) ? $request['is_discountable'] : '0';
        $request['is_free']         = arrayCheck('is_free', $request) ? $request['is_free'] : '0';
        $request['is_renewable']    = arrayCheck('is_renewable', $request) ? $request['is_renewable'] : '0';
        $course->update($request);

        if ($increment) {
            $category = Category::findOrfail($request['category_id']);
            $category->increment('total_courses');
        }

        return $course;
    }

    public function find($id)
    {
        return Course::withAvg('reviews', 'rating')->withCount('reviews')->withCount('enrolls')->find($id);
    }

    public function findBySlug($slug = '', $is_my_course = false)
    {
        return Course::with('wishlists')->where('slug', $slug)->when($is_my_course, function ($query) {
            $query->whereHas('enrolls.checkout', function ($query) {
                $query->where('user_id', auth()->id());
            });
        })->withCount('enrolls')->first();
    }

    public function destroy($id)
    {
        $course = Course::findOrfail($id);
        $course->category->decrement('total_courses');

        if ($course->video_source == 'upload' && $course->video) {
            $this->deleteFile($course->video);
        }

        return $course->delete($id);
    }

    public function updateProgress($request): bool
    {
        $progress            = CourseProgress::where('user_id', authUser()->id)
            ->where('course_id', $request['course_id'])->where('section_id', $request['section_id'])
            ->where('lesson_id', $request['lesson_id'])->first();

        if ($progress) {
            if ($request['total_spent_time'] == 0 || $request['total_duration'] == 0) {
                $progress_in_percentage = 0;
            } else {
                $progress_in_percentage = ($request['total_spent_time'] / $request['total_duration']) * 100;
            }

            if ($request['total_spent_time'] >= $progress->total_spent_time) {
                $progress->update([
                    'total_duration'   => $request['total_duration'],
                    'total_spent_time' => $request['total_spent_time'],
                    'progress'         => round($progress_in_percentage, 2),
                    'status'           => $progress_in_percentage >= 60 ? 1 : 0,
                ]);
            }
        } else {
            $progress = CourseProgress::create([
                'user_id'          => authUser()->id,
                'course_id'        => $request['course_id'],
                'section_id'       => $request['section_id'],
                'lesson_id'        => $request['lesson_id'],
                'total_duration'   => $request['total_duration'],
                'total_spent_time' => $request['total_spent_time'],
                'progress'         => 0,
            ]);
        }

        $progress_percentage = CourseProgress::where('user_id', authUser()->id)
            ->where('course_id', $request['course_id'])
            ->sum('progress');

        $enroll              = Enroll::whereHas('checkout', function ($query) {
            $query->where('user_id', authUser()->id);
        })->where('enrollable_id', $request['course_id'])->first();

        if ($enroll) {
            $enroll->update([
                'complete_count' => $progress_percentage / count($progress->course->lessons),
            ]);
        }

        return true;
    }

    public function findCourses($ids, $with = []): Collection|array
    {
        return Course::with($with)->withAvg('reviews', 'rating')->withCount('reviews')->whereIn('id', $ids)->get();
    }

    public function studentWiseCourse($student_id)
    {
        return Course::whereHas('enrolls.checkout', function ($query) use ($student_id) {
            $query->where('user_id', $student_id);
        })->paginate();
    }

    public function activeCourses($data, $relation = [])
    {

        return Course::with($relation)->withCount('lessons')->withCount('enrolls')->withAvg('reviews', 'rating')
            ->where('is_private', 0)
            ->when(arrayCheck('suggested_course', $data), function ($query) {
                $query->orderBy('enrolls_count', 'desc');
            })->when(arrayCheck('is_featured', $data), function ($query) use ($data) {
                $query->where('is_featured', $data['is_featured']);
            })->when(arrayCheck('is_free', $data), function ($query) use ($data) {
                $query->where('is_free', $data['is_free']);
            })->when(arrayCheck('offered', $data), function ($query) {
                $query->where('is_free', 0)->where('discount', '>', 0)->where('discount_start_at', '<', now())->where('discount_end_at', '>=', now());
            })->when(arrayCheck('instructor_course', $data), function ($query) use ($data) {
                $query->whereHas('users', function ($query) use ($data) {
                    $query->where('users.id', $data['user_id']);
                });
            })->when(arrayCheck('organization_course', $data), function ($query) use ($data) {
                $query->where('organization_id', $data['organization_course']);
            })->when(arrayCheck('my_course', $data), function ($query) use ($data) {
                $query->withSum('progresses', 'progress')->whereHas('enrolls.checkout', function ($query) use ($data) {
                    $query->where('status',1)->where('user_id', $data['user_id'])->when(arrayCheck('course_view', $data), function ($query) use ($data) {
                        $query->where('complete_count', '>=', $data['course_view']);
                    });
                });
            })->when(arrayCheck('purchase_course', $data), function ($query) use ($data) {
                $query->whereHas('enrolls.checkout', function ($query) use ($data) {
                    $query->where('courses.id', $data['purchase_course'])->where('user_id', $data['user_id']);
                });
            })->when(arrayCheck('wishlist', $data), function ($query) use ($data) {
                $query->whereHas('wishlists', function ($query) use ($data) {
                    $query->where('user_id', $data['user_id']);
                });
            })->when(arrayCheck('category_id', $data), function ($query) use ($data) {
                $query->where('category_id', $data['category_id'])->when(arrayCheck('with_child_category', $data), function ($query) use ($data) {
                    $query->orWhereHas('category', function ($query) use ($data) {
                        $query->where('parent_id', $data['category_id']);
                    });
                });
            })->when(arrayCheck('related', $data) && arrayCheck('id', $data) && arrayCheck('category_id', $data), function ($query) use ($data) {
                $query->where('id', '!=', $data['id'])->where('category_id', $data['category_id']);
            })->when(arrayCheck('search', $data), function ($query) use ($data) {
                $query->where('title', 'like', '%'.$data['search'].'%')
                    ->orWhereHas('category', function ($query) use ($data) {
                        $query->where('title', 'like', '%'.$data['search'].'%');
                    })->orWhereHas('category.languages', function ($query) use ($data) {
                        $query->where('title', 'like', '%'.$data['search'].'%');
                    })->orWhereHas('organization', function ($query) use ($data) {
                        $query->where('org_name', 'like', '%'.$data['search'].'%');
                    })->orWhereHas('language', function ($query) use ($data) {
                        $query->where('name', 'like', '%'.$data['search'].'%')
                            ->orWhere('locale', 'like', '%'.$data['search'].'%');
                    })->orWhereHas('level', function ($query) use ($data) {
                        $query->where('title', 'like', '%'.$data['search'].'%');
                    })->orWhereHas('subject', function ($query) use ($data) {
                        $query->where('title', 'like', '%'.$data['search'].'%');
                    })->orWhereHas('subject.languages', function ($query) use ($data) {
                        $query->where('title', 'like', '%'.$data['search'].'%');
                    });
            })->when(arrayCheck('q', $data), function ($query) use ($data) {
                $query->where('title', 'like', '%'.$data['q'].'%');
            })->when(arrayCheck('filter', $data), function ($query) use ($data) {
                $filter = $data['filter'];
                $query->$filter();
            })->when(arrayCheck('category_ids', $data) && count($data['category_ids']) > 0, function ($query) use ($data) {
                $query->whereIn('category_id', $data['category_ids'])->when(arrayCheck('with_child_category', $data), function ($query) use ($data) {
                    $query->orWhereHas('category', function ($query) use ($data) {
                        $query->whereIn('parent_id', $data['category_ids']);
                    });
                });
            })->when(arrayCheck('level_ids', $data) && count($data['level_ids']) > 0, function ($query) use ($data) {
                $query->whereIn('level_id', $data['level_ids']);
            })->when(arrayCheck('subject_ids', $data) && count($data['subject_ids']) > 0, function ($query) use ($data) {
                $query->whereIn('subject_id', $data['subject_ids']);
            })->when(arrayCheck('rating', $data) && count($data['rating']) > 0, function ($query) use ($data) {
                $min_rating = $data['rating'][0];
                $max_rating = end($data['rating']);
                $query->whereBetween('total_rating', [$min_rating, $max_rating]);
            })->when(arrayCheck('price', $data) && count($data['price']) > 0, function ($query) use ($data) {
                if (in_array('paid', $data['price']) && in_array('free', $data['price'])) {
                    $query->whereIn('is_free', [1, 0]);
                } else {
                    if (in_array('paid', $data['price'])) {
                        $query->where('is_free', 0);
                    } elseif (in_array('free', $data['price'])) {
                        $query->where('is_free', 1);
                    }
                }
            })->when(arrayCheck('take', $data), function ($query) use ($data) {
                $query->take($data['take']);
            })->when(arrayCheck('skip', $data), function ($query) use ($data) {
                $query->skip($data['skip']);
            })->when(arrayCheck('sorting', $data), function ($query) use ($data) {
                if ($data['sorting'] == 'oldest') {
                    $query->orderBy('id', 'asc');
                } elseif ($data['sorting'] == 'top_rated') {
                    $query->orderBy('total_rating', 'desc');
                } else {
                    $query->orderBy('id', 'desc');
                }
            })->when(! arrayCheck('sorting', $data), function ($query) {
                $query->orderBy('id', 'desc');
            })->when(arrayCheck('ids', $data), function ($query) use ($data) {
                $query->whereIn('id', $data['ids']);
            })->active()
            ->whereNull('deleted_at')
            ->paginate($data['paginate']);
    }

    public function courseFilter($data, $relation = [])
    {
        return Course::with($relation)->withCount('lessons')->withCount('enrolls')->withAvg('reviews', 'rating')
            ->when(arrayCheck('category_id', $data), function ($query) use ($data) {
                $query->whereIn('category_id', $data['category_id']);
            })->when(arrayCheck('is_free', $data), function ($query) use ($data) {
                $query->orWhereIn('is_free', $data['is_free']);
            })->when(arrayCheck('level', $data), function ($query) use ($data) {
                $query->orWhereIn('level_id', $data['level']);
            })->when(arrayCheck('ratings_filter', $data), function ($query) use ($data) {
                $query->orWhereIn('reviews.rating', $data['ratings_filter']);
            })->latest()->active()->paginate($data['paginate']);
    }

    public function cartCourse()
    {
        return Course::whereHas('carts', function ($query) {
            $query->where('user_id', auth()->id());
        })->active()->get();
    }

    public function published($id)
    {

        $course = Course::find($id);

        $status = $course->is_published == 1 ? 0 : 1;

        $course->update([
            'status' => 'approved',
        ]);

        return $course->update([
            'is_published' => $status,
        ]);
    }

    public function activeCoursesIDs($data, $relation = [])
    {
        $courseIds = Course::with($relation)
            ->withCount('lessons')
            ->withCount('enrolls')
            ->withAvg('reviews', 'rating')
            ->where('is_private', 0)
            ->when(arrayCheck('my_course', $data), function ($query) use ($data) {
                $query->whereHas('enrolls.checkout', function ($query) use ($data) {
                    $query->where('user_id', $data['user_id'])
                        ->when(arrayCheck('course_view', $data), function ($query) use ($data) {
                            $query->where('complete_count', '>=', $data['course_view']);
                        });
                });
            })
            ->whereNull('deleted_at')
            ->paginate($data['paginate'])
            ->pluck('id');

        return $courseIds;
    }

    public function findInstructorCourse($id, $user)
    {
        return Course::withAvg('reviews', 'rating')->withCount('reviews')->withCount('enrolls')->whereHas('users', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })->find($id);
    }

    public function changeStatus($id, $user)
    {
        $course = $this->findInstructorCourse($id, $user);

        $status = $course->is_published == 1 ? 0 : 1;

        return $course->update([
            'is_published' => $status,
        ]);
    }
}
