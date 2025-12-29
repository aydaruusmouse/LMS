@extends('frontend.layouts.master')
@section('title', __('home'))
@section('content')
<!--====== Start Book Category Area ======-->
<section class="book-category-area p-t-50 p-b-80 p-t-sm-30 p-b-sm-30">
    <div class="container container-1278">
        <div class="row">
            <div class="col-12">
                <div class="course-shorter justify-content-center justify-content-md-between course-shorter-v2 color-secondary m-b-40">
                    <ul class="grid-list">
                        <li class="sort-text">Showing 5 of 26 Results</li>
                    </ul>
                    <div class="sort-right">
                        <div class="course-dropdown">
                            <select>
                                <option value="default">{{__('recent')}}</option>
                                <option value="new">{{__('latest')}}</option>
                                <option value="old">{{__('oldest')}}</option>
                            </select>
                        </div>
                        <form action="#" method="get" class="search-form">
                            <input type="text" placeholder="Search" required="">
                            <button class="search-btn"><i class="bx bx-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="row m-b-30">
                    <div class="col-xl-4 col-md-6 col-sm-6">
                        <div class="book-list-item">
                            <div class="book-thumbnail">
                                <a href="book-details.html"><img src="assets/img/books/book-6.jpg" alt="Book Thumbnail"></a>
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
                    <div class="col-xl-4 col-md-6 col-sm-6">
                        <div class="book-list-item">
                            <div class="book-thumbnail">
                                <a href="book-details.html"><img src="assets/img/books/book-7.jpg" alt="Book Thumbnail"></a>
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
                    <div class="col-xl-4 col-md-6 col-sm-6">
                        <div class="book-list-item">
                            <div class="book-thumbnail">
                                <a href="book-details.html"><img src="assets/img/books/book-8.jpg" alt="Book Thumbnail"></a>
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
                    <div class="col-xl-4 col-md-6 col-sm-6">
                        <div class="book-list-item">
                            <div class="book-thumbnail">
                                <a href="book-details.html"><img src="assets/img/books/book-9.jpg" alt="Book Thumbnail"></a>
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
                    <div class="col-xl-4 col-md-6 col-sm-6">
                        <div class="book-list-item">
                            <div class="book-thumbnail">
                                <a href="book-details.html"><img src="assets/img/books/book-10.jpg" alt="Book Thumbnail"></a>
                            </div>
                            <div class="book-text-content">
                                <h6><a href="book-details.html">Book Is a Window to The World</a></h6>
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
            <div class="col-lg-4">
                <div class="course-sidebar border-radius-3">
                    <div class="widget widget-checklist">
                        <ul class="category-list-group">
                            <li class="dropdown-title">{{__('all_categories')}}</li>
                            <li>
                                <a href="#">Web Design</a>
                                <ul>
                                    <li>
                                        <label>
                                            <input type="checkbox" value="">
                                            <span>Responsive Design </span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox" value="">
                                            <span>Wordpress Theme</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox" value="">
                                            <span>Bootstrap</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox" value="" checked>
                                            <span>HTML & CSS</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox" value="">
                                            <span>Javascript</span>
                                        </label>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Graphic Design </a>
                                <ul>
                                    <li>
                                        <label>
                                            <input type="checkbox" value="">
                                            <span>Adobe Photoshop</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox" value="">
                                            <span>Adobe Illustrator</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox" value="">
                                            <span>Adobe XD</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox" value="">
                                            <span>Figmajam</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox" value="">
                                            <span>Prototyping</span>
                                        </label>
                                    </li>
                                </ul>
                            </li>
                            <li class="show-more">
                                <a href="#" >{{__('show_more')}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="widget widget-checklist">
                        <ul class="widget-list-group">
                            <li class="dropdown-title">{{__('price')}}</li>
                            <li>
                                <label>
                                    <input type="checkbox" value="">
                                    <span>All</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" value="" checked>
                                    <span>Paid</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" value="">
                                    <span>Free</span>
                                </label>
                            </li>
                        </ul>
                    </div>
                    <div class="widget widget-checklist">
                        <ul class="widget-list-group">
                            <li class="dropdown-title">{{__('level')}}</li>
                            <li>
                                <label>
                                    <input type="checkbox" value="">
                                    <span>All</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" value="">
                                    <span>Beginner</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" value="" checked>
                                    <span>Intermediate</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" value="">
                                    <span>Advanced</span>
                                </label>
                            </li>
                        </ul>
                    </div>
                    <div class="widget rating-widget">
                        <div class="rating-group">
                            <h4 class="dropdown-title">{{__('ratings')}}</h4>
                            <label>
                                <input type="checkbox" value="">
                                <span>
                                    <img src="assets/img/rating/rating-1.jpg" alt="rating one">
                                </span>
                            </label>
                            <label>
                                <input class="form-check-input" type="checkbox" value="" checked>
                                <span>
                                    <img src="assets/img/rating/rating-2.jpg" alt="rating two">
                                </span>
                            </label>
                            <label>
                                <input class="form-check-input" type="checkbox" value="">
                                <span>
                                    <img src="assets/img/rating/rating-3.jpg" alt="rating three">
                                </span>
                            </label>
                            <label>
                                <input class="form-check-input" type="checkbox" value="">
                                <span>
                                    <img src="assets/img/rating/rating-4.jpg" alt="rating four">
                                </span>
                            </label>
                            <label>
                                <input class="form-check-input" type="checkbox" value="">
                                <span>
                                    <img src="assets/img/rating/rating-5.jpg" alt="rating five">
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== End Book Category Area ======-->
@endsection
