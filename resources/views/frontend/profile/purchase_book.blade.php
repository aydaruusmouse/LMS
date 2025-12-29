@extends('frontend.layouts.master')
@section('title', __('about'))
@section('content')
    <!--====== Start Purchase Book Section ======-->
    <section class="purchase-book-section p-t-50 p-b-80 p-b-md-20 p-b-sm-30 p-t-sm-30">
        <div class="container container-1278">
            <div class="row">
                @include('frontend.profile.sidebar')
                <div class="col-md-8">
                    <div class="purchase-book-wrapper">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title-v3 color-dark m-b-40 m-b-sm-20">
                                    <h3>{{__('my_book')}}</h3>
                                    <p>Showing 8 of 26 Results</p>
                                </div>
                            </div>
                        </div>
                        <div class="row gx-3 gx-md-4">
                            <div class="col-xl-4 col-md-6 col-sm-6 col-xs-6">
                                <div class="book-list-item">
                                    <div class="book-thumbnail">
                                        <a href="book-details.html"><img src="assets/img/books/book-6.jpg"
                                                                         alt="Book Thumbnail"></a>
                                    </div>
                                    <div class="book-text-content">
                                        <h6><a href="book-details.html">It’s Time to Go Back to School</a></h6>
                                        <p class="book-price"><small>$5.49</small> $5.49</p>
                                        <div class="rating-review">
                                            <ul class="all-rating star-3">
                                                <li>
                                                    <div class="main-rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <div class="blank-rating">
                                                        <i class="fal fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-sm-6 col-xs-6">
                                <div class="book-list-item">
                                    <div class="book-thumbnail">
                                        <a href="book-details.html"><img src="assets/img/books/book-7.jpg"
                                                                         alt="Book Thumbnail"></a>
                                    </div>
                                    <div class="book-text-content">
                                        <h6><a href="book-details.html">How Many Books Do You Read Per Year</a></h6>
                                        <p class="book-price"><small>$5.49</small> $5.49</p>
                                        <div class="rating-review">
                                            <ul class="all-rating star-3">
                                                <li>
                                                    <div class="main-rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <div class="blank-rating">
                                                        <i class="fal fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-sm-6 col-xs-6">
                                <div class="book-list-item">
                                    <div class="book-thumbnail">
                                        <a href="book-details.html"><img src="assets/img/books/book-8.jpg"
                                                                         alt="Book Thumbnail"></a>
                                    </div>
                                    <div class="book-text-content">
                                        <h6><a href="book-details.html">Digital Master’s Here</a></h6>
                                        <p class="book-price"><small>$5.49</small> $5.49</p>
                                        <div class="rating-review">
                                            <ul class="all-rating star-3">
                                                <li>
                                                    <div class="main-rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <div class="blank-rating">
                                                        <i class="fal fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-sm-6 col-xs-6">
                                <div class="book-list-item">
                                    <div class="book-thumbnail">
                                        <a href="book-details.html"><img src="assets/img/books/book-9.jpg"
                                                                         alt="Book Thumbnail"></a>
                                    </div>
                                    <div class="book-text-content">
                                        <h6><a href="book-details.html">World Book Day</a></h6>
                                        <p class="book-price"><small>$5.49</small> $5.49</p>
                                        <div class="rating-review">
                                            <ul class="all-rating star-3">
                                                <li>
                                                    <div class="main-rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <div class="blank-rating">
                                                        <i class="fal fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Purchase Book Section ======-->
@endsection
