<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Course;
use App\Models\Wishlist;
use App\Repositories\BookRepository;
use App\Repositories\CourseRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function wishlists(CourseRepository $courseRepository, Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $input                  = $request->all();
            $courses                = $courseRepository->activeCourses([
                'wishlist' => 1,
                'user_id'  => auth()->id(),
                'paginate' => 2,
            ], ['category']);

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
                return response()->json($this->ajaxFilter($courses, $input));
            }

            $data                   = [
                'course_wishlist' => $courses,
            ];

            return view('frontend.profile.wishlist_courses', array_merge($input, $data));
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json(['error' => $e->getMessage()]);
            }
            Toastr::error($e->getMessage());

            return back();
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
                ];

                $course_view .= view('frontend.profile.components.wishlist', $vars)->render();
            }
            if (count($courses) == 0) {
                $course_view .= view('frontend.not_found', ['title' => 'courses'])->render();
            }

            return [
                'header'    => view('frontend.profile.components.wishlist_header', $input)->render(),
                'courses'   => $course_view,
                'next_page' => $courses->nextPageUrl(),
            ];
        } catch (\Exception $e) {
            return [];
        }
    }

    public function addOrRemoveWishlist(Request $request, CourseRepository $courseRepository, BookRepository $bookRepository): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'id'   => 'required',
            'type' => 'required|in:course,book',
        ]);

        try {
            if ($request->type == 'course') {
                $course = $courseRepository->find($request->id);
                if (! $course) {
                    return response()->json(['error' => __('course_not_found')]);
                }
            } else {
                if (addon_is_activated('book_store')) {
                    return response()->json(['error' => __('addon_not_installed_yet')]);
                }
                $book = $bookRepository->find($request->id);
                if (! $book) {
                    return response()->json(['error' => __('book_not_found')]);
                }
            }
            $wishable_type     = $request->type == 'course' ? Course::class : Book::class;
            $is_wishlist_added = Wishlist::where('user_id', auth()->id())->where('wishable_id', $request->id)->where('wishable_type', $wishable_type)->first();
            if ($is_wishlist_added) {
                $is_wishlist_added->delete();
                $msg    = 'wishlist_removed_successfully';
                $status = 0;
            } else {
                $data                  = $request->all();
                $data['user_id']       = auth()->id();
                $data['wishable_id']   = $request->id;
                $data['wishable_type'] = $wishable_type;

                Wishlist::create($data);
                $msg                   = 'wishlist_added_successfully';
                $status                = 1;
            }

            return response()->json(['status' => @$status, 'success' => __($msg)]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
