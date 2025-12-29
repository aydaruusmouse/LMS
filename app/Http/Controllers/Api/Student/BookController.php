<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BookResource;
use App\Http\Resources\Api\CategoryResource;
use App\Http\Resources\Api\SliderResource;
use App\Models\Book;
use App\Repositories\BookRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ReviewRepository;
use App\Repositories\SliderRepository;
use App\Traits\ApiReturnFormatTrait;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookController extends Controller
{
    use ApiReturnFormatTrait;

    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function latestBooks(): \Illuminate\Http\JsonResponse
    {
        try {
            if (! addon_is_activated('book_store')) {
                return $this->responseWithError(__('book_store_addon_is_not_activated'), []);
            }
            $results = [
                'books' => BookResource::collection($this->bookRepository->activeBooks([
                    'paginate' => 1,
                ])),
            ];

            return $this->responseWithSuccess(__('latest_books_retrieved_successfully'), $results);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function bookStore(SliderRepository $sliderRepository, CategoryRepository $categoryRepository, Request $request): \Illuminate\Http\JsonResponse
    {
        if (! addon_is_activated('book_store')) {
            return $this->responseWithError(__('book_store_addon_is_not_activated'));
        }
        if (config('app.demo_mode')) {
            Toastr::info(__('this_function_is_disabled_in_demo_server'));

            return back();
        }
        try {
            $results[] = [
                'section_type' => 'sliders',
                'sliders'      => SliderResource::collection($sliderRepository->activeSliders()),
            ];
            $results[] = [
                'section_type'   => 'trending_books',
                'trending_books' => BookResource::collection($this->bookRepository->activeBooks([
                    'trending' => 1,
                    'paginate' => setting('api_paginate'),
                ])),
            ];
            $results[] = [
                'section_type' => 'categories',
                'categories'   => CategoryResource::collection($categoryRepository->activeCategories([
                    'type' => 'book',
                    'lang' => $request->header('lang') ?? app()->getLocale(),
                ])),
            ];
            $results[] = [
                'section_type'     => 'recent_published',
                'recent_published' => BookResource::collection($this->bookRepository->activeBooks([
                    'paginate' => setting('api_paginate'),
                ], ['instructor'])),
            ];
            $results[] = [
                'section_type'  => 'popular_books',
                'popular_books' => BookResource::collection($this->bookRepository->activeBooks([
                    'is_popular' => 1,
                    'paginate'   => setting('api_paginate'),
                ])),
            ];
            $results[] = [
                'section_type'     => 'high_rated_books',
                'high_rated_books' => BookResource::collection($this->bookRepository->activeBooks([
                    'high_rated' => 1,
                    'paginate'   => setting('api_paginate'),
                ])),
            ];

            return $this->responseWithSuccess(__('book_store_retrieved_successfully'), $results);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function bookDetails($id, ReviewRepository $reviewRepository): \Illuminate\Http\JsonResponse
    {
        if (! addon_is_activated('book_store')) {
            return $this->responseWithError(__('book_store_addon_is_not_activated'), null);
        }
        try {
            $user              = jwtUser();

            $book              = $this->bookRepository->find($id);

            if (! $book) {
                return $this->responseWithError(__('book_not_found'));
            }

            $instructor        = $book->instructor;
            $organization      = $book->organization;
            $review_repository = new ReviewRepository();
            $is_reviewed       = $review_repository->searchUserReview([
                'id'      => $id,
                'user_id' => $user ? $user->id : 0,
                'type'    => Book::class,
            ]);

            $one_star          = 0;
            $two_star          = 0;
            $three_star        = 0;
            $four_star         = 0;
            $five_star         = 0;
            $reviews           = $reviewRepository->reviewPercentage([
                'id'   => $id,
                'type' => Book::class,
            ]);

            foreach ($reviews as $key => $review) {
                if ($key == 1) {
                    $one_star = $review;
                }
                if ($key == 2) {
                    $two_star = $review;
                }
                if ($key == 3) {
                    $three_star = $review;
                }
                if ($key == 4) {
                    $four_star = $review;
                }
                if ($key == 5) {
                    $five_star = $review;
                }
            }

            $data              = [
                'id'                => (int) $id,
                'title'             => $book->title,
                'description'       => nullCheck($book->description),
                'thumbnail'         => getFileLink('320x320', $book->thumbnail),
                'price'             => $book->is_free ? __('free') : number_format($book->price, 3, '.', ''),
                'is_discounted'     => $book->is_discount,
                'discount_type'     => nullCheck($book->discount_type),
                'discounted_price'  => number_format($book->discount_amount, 3, '.', ''),
                'is_wishlist_added' => $user && $book->wishlists->where('user_id', $user->id)->first(),
                'instructor'        => $instructor ? [
                    'id'             => (int) $instructor->id,
                    'name'           => $instructor->name,
                    'designation'    => nullCheck(@$instructor->instructor->designation),
                    'image'          => $instructor->profile_pic,
                    'joined_at'      => Carbon::parse($instructor->created_at)->format('d-M-Y'),
                    'published_book' => $instructor->books->count(),
                ] : '',

                'related_books'     => BookResource::collection($this->bookRepository->activeBooks([
                    'category_id' => $book->category_ids,
                    'paginate'    => setting('api_paginate'),
                    'related'     => 1,
                    'id'          => $book->id,
                ])),

                'organization'      => $organization ? [
                    'id'      => $organization->id,
                    'name'    => $organization->org_name,
                    'tagline' => nullCheck($organization->tagline),
                    'logo'    => getFileLink('72x72', $organization->logo),
                ] : null,
                'contact_no'        => nullCheck(setting('contact_no')),
                'total_reviews'     => $book->reviews_count,
                'avg_ratings'       => number_format($book->reviews_avg_rating, 2),
                'is_ebook'          => $book->available_format == 'pdf',
                'current_stock'     => (int) $book->current_stock,
                'is_reviewed'       => (bool) $is_reviewed,
                'can_review'        => $user && ! $is_reviewed && $book->enrolls()->whereHas('checkout', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->first(),
                'rating_counts'     => [
                    'total_review' => $book->reviews_count,
                    'avg_rating'   => number_format($book->reviews_avg_rating, 2),
                    'one_star'     => (int) $one_star,
                    'two_star'     => (int) $two_star,
                    'three_star'   => (int) $three_star,
                    'four_star'    => (int) $four_star,
                    'five_star'    => (int) $five_star,
                ],
                'summary'           => [
                    'description' => nullCheck($book->description),
                    'title'       => $book->title,
                    'author'      => $instructor ? $instructor->name : '',
                    'publisher'   => $organization ? $organization->org_name : '',
                    'edition'     => nullCheck($book->edition),
                    'page'        => (int) $book->page,
                    'country'     => $book->country ? $book->country->name : '',
                    'language'    => $book->language ? $book->language->name : '',
                ],
            ];

            return $this->responseWithSuccess(__('book_retrieved_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }
}
