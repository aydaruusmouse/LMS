<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Course;
use App\Repositories\ReviewRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    protected $reviewRepository;

    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function storeComment(Request $request): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $request->validate([
            'rating'  => 'required',
            'comment' => 'required',
            'type'    => 'required|in:course,book',
        ]);
        if (config('app.demo_mode')) {
            Toastr::info(__('this_function_is_disabled_in_demo_server'));

            return back();
        }
        DB::beginTransaction();
        try {
            $error            = false;
            $msg              = __('review_added_successfully');

            if ($request->type == 'book' && ! addon_is_activated('book_store')) {
                $error = true;
                $msg   = __('book_store_is_not_installed');
            }

            $commentable_type = $request->type == 'course' ? Course::class : Book::class;

            $is_reviewed      = $this->reviewRepository->searchUserReview([
                'user_id' => auth()->id(),
                'type'    => $commentable_type,
                'id'      => $request->id,
            ]);
            if ($is_reviewed) {
                $error = true;
                if ($request->type == 'course') {
                    $msg = __('you_already_reviewed_this_course');
                } else {
                    $msg = __('you_already_reviewed_this_book');
                }
            }
            if ($error) {
                Toastr::error($msg);

                return back();
            } else {
                $data                     = $request->all();
                $data['user_id']          = auth()->id();
                $data['commentable_id']   = $request->id;
                $data['commentable_type'] = $commentable_type;

                $rating                   = $this->reviewRepository->store($data);

                $rating->commentable->update([
                    'total_rating' => $rating->commentable->reviews()->avg('rating'),
                ]);

                $msg                      = __('review_added_successfully');
                Toastr::success($msg);
                DB::commit();
                $route                    = $request->type == 'course' ? route('course.details', $request->slug).'#comment-respond' : 'book.details';

                return redirect($route);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function reviews(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'id'   => 'required',
            'type' => 'required|in:course,book',
        ]);
        try {
            $input   = [
                'paginate' => setting('paginate'),
                'id'       => $request->id,
                'type'     => $request->type == 'course' ? Course::class : Book::class,
            ];

            $this->reviewRepository->reviews($input);

            $html    = '';

            $reviews = $this->reviewRepository->reviews($input);

            foreach ($reviews as $review) {
                $html .= view('frontend.review_component', compact('review'))->render();
            }

            $data    = [
                'html'          => $html,
                'next_page_url' => $reviews->nextPageUrl(),
                'success'       => true,
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
