@extends('frontend.layouts.master')
@section('title', __('home'))
@section('content')
 <!--====== Start Blog Area ======-->
<!--====== Start Hero Area ======-->
<section class="hero-area hero-area-v5 p-t-100 p-b-50 p-b-sm-15">
    <div class="container container-1278">
        <div class="row justify-content-center align-items-center">
            <div class="col-xl-6 col-lg-6 col-md-10">
                <div class="hero-content text-align-center text-align-lg-start p-b-md-60">
                    <span class="hero-subtitle">The Number 1 Platform for Online Learning</span>
                    <h1 class="hero-title">Find the Best Book to enrich your <span>Knowledge.</span></h1>
                    <p>You are in the right place to sharpen your knowledge. Choose from thousands of books according to your course and skills.</p>
                    <ul class="hero-btns d-flex align-items-center">
                        <li>
                            <a href="#" class="template-btn">
                                {{__('browse_all_books')}} <i class="fas fa-long-arrow-right"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="template-btn bordered-btn-secondary">
                               {{__('browse_featured')}}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-9">
                <div class="hero-masonry-image hero-masonry-image-v2">
                    <div class="row">
                        <div class="col-6 text-end">
                            <img src="{{ get_media('frontend/img/hero/hero-v5-masonry-5.jpg') }}" alt="Hero Image">
                        </div>
                        <div class="col-6 align-self-end">
                            <img src="{{ get_media('frontend/img/hero/hero-v5-masonry-6.jpg') }}" alt="Hero Image">
                        </div>
                        <div class="col-6 text-end">
                            <img src="{{ get_media('frontend/img/hero/hero-v5-masonry-7.jpg') }}" alt="Hero Image">
                        </div>
                        <div class="col-6">
                            <img src="{{ get_media('frontend/img/hero/hero-v5-masonry-8.jpg') }}" alt="Hero Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== End Hero Area ======-->

<!--====== Start Your Books Section ======-->
<section class="your-books-section p-t-80 p-b-50">
    <div class="container container-1278">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="common-heading text-center m-b-35">
                    <h3>{{__('choose_your_books')}}</h3>
                    <p>{{__('choose_from_our_huge_collection_of_books.')}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Books Tab -->
                <div class="books-tabs main-tabs">
                    <ul class="nav nav-pills max-content" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="all-books-tab" data-bs-toggle="pill" data-bs-target="#all-books" type="button" role="tab" aria-controls="all-books" aria-selected="true">All</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="historic-books-tab" data-bs-toggle="pill" data-bs-target="#historic-books" type="button" role="tab" aria-controls="historic-books" aria-selected="false">Historic</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="documentary-books-tab" data-bs-toggle="pill" data-bs-target="#documentary-books" type="button" role="tab" aria-controls="documentary-books" aria-selected="false">Documentary</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="skill-books-tab" data-bs-toggle="pill" data-bs-target="#skill-books" type="button" role="tab" aria-controls="skill-books" aria-selected="false">Skills</button>
                        </li>
                    </ul>

                    <div class="books-tab-content tab-content" id="pills-tabContent">
                        <!-- All Books Tab -->
                        <div class="tab-pane fade show active" id="all-books" role="tabpanel" aria-labelledby="all-books-tab">
                            <div class="row book-list-items-v1 gx-3 gx-md-4">
                                <div class="col-xl-3 col-md-4 col-sm-6">
                                    <div class="book-list-item">
                                        <div class="book-thumbnail">
                                            <a href="book-details.html">
                                                <img src="assets/img/books/book-6.jpg" alt="Book Thumbnail">
                                            </a>
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
                                <div class="col-xl-3 col-md-4 col-sm-6">
                                    <div class="book-list-item">
                                        <div class="book-thumbnail">
                                            <a href="book-details.html">
                                                <img src="assets/img/books/book-7.jpg" alt="Book Thumbnail">
                                            </a>
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
                                <div class="col-xl-3 col-md-4 col-sm-6">
                                    <div class="book-list-item">
                                        <div class="book-thumbnail">
                                            <a href="book-details.html">
                                                <img src="assets/img/books/book-8.jpg" alt="Book Thumbnail">
                                            </a>
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
                                <div class="col-xl-3 col-md-4 col-sm-6">
                                    <div class="book-list-item">
                                        <div class="book-thumbnail">
                                            <a href="book-details.html">
                                                <img src="assets/img/books/book-9.jpg" alt="Book Thumbnail">
                                            </a>
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
                                <div class="col-xl-3 col-md-4 col-sm-6">
                                    <div class="book-list-item">
                                        <div class="book-thumbnail">
                                            <a href="book-details.html">
                                                <img src="assets/img/books/book-10.jpg" alt="Book Thumbnail">
                                            </a>
                                        </div>
                                        <div class="book-text-content">
                                            <h6><a href="book-details.html">Book Is a Window to the World</a></h6>
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
                                <div class="col-xl-3 col-md-4 col-sm-6">
                                    <div class="book-list-item">
                                        <div class="book-thumbnail">
                                            <a href="book-details.html">
                                                <img src="assets/img/books/book-11.jpg" alt="Book Thumbnail">
                                            </a>
                                        </div>
                                        <div class="book-text-content">
                                            <h6><a href="book-details.html">Happy World Book Day</a></h6>
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
                                <div class="col-xl-3 col-md-4 col-sm-6">
                                    <div class="book-list-item">
                                        <div class="book-thumbnail">
                                            <a href="book-details.html">
                                                <img src="assets/img/books/book-12.jpg" alt="Book Thumbnail">
                                            </a>
                                        </div>
                                        <div class="book-text-content">
                                            <h6><a href="book-details.html">Become a Sign Language Expert</a></h6>
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
                                <div class="col-xl-3 col-md-4 col-sm-6">
                                    <div class="book-list-item">
                                        <div class="book-thumbnail">
                                            <a href="book-details.html">
                                                <img src="assets/img/books/book-13.jpg" alt="Book Thumbnail">
                                            </a>
                                        </div>
                                        <div class="book-text-content">
                                            <h6><a href="book-details.html">Feel the Poetry</a></h6>
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

                        <!-- Historic Books Tab -->
                        <div class="historic-books-tab tab-pane fade" id="historic-books" role="tabpanel" aria-labelledby="historic-books-tab">
                            <p>Historic books</p>
                        </div>

                        <!-- Documentary Books Tab -->
                        <div class="documentary-books-tab tab-pane fade m-b-10" id="documentary-books" role="tabpanel" aria-labelledby="documentary-books-tab">
                            <p>Documentary books</p>
                        </div>

                        <!-- Skill Books Tab -->
                        <div class="skill-books-tab tab-pane fade" id="skill-books" role="tabpanel" aria-labelledby="skill-books-tab">
                            <p>Skills books</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== End Your Books Section ======-->

<!--====== Start Counter Section ======-->
<section class="counter-section color-bg-dark p-t-80 p-b-50">
    <div class="container container-1278">
        <div class="row counter-items-v2">
            <div class="col-xl-3 col-sm-6">
                <div class="counter-item color-5 m-b-30">
                    <div class="icon">
                        <img src="assets/img/icons/book.svg" alt="book">
                    </div>
                    <div class="content">
                        <p class="title">Total Courses</p>
                        <div class="counter-wrap">
                            <span class="counter">75000</span>
                            <span class="suffix">+</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="counter-item color-5 m-b-30">
                    <div class="icon">
                        <img src="assets/img/icons/user.svg" alt="user">
                    </div>
                    <div class="content">
                        <p class="title">Instructors</p>
                        <div class="counter-wrap">
                            <span class="counter">4500</span>
                            <span class="suffix">+</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="counter-item color-5 m-b-30">
                    <div class="icon">
                        <img src="assets/img/icons/cart.svg" alt="cart">
                    </div>
                    <div class="content">
                        <p class="title">Learners</p>
                        <div class="counter-wrap">
                            <span class="counter">33000</span>
                            <span class="suffix">+</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="counter-item color-5 m-b-30">
                    <div class="icon">
                        <img src="assets/img/icons/smile.svg" alt="smile">
                    </div>
                    <div class="content">
                        <p class="title">Satisfied</p>
                        <div class="counter-wrap">
                            <span class="counter">93</span>
                            <span class="suffix">%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== End Counter Section ======-->

<!--====== Start Top Catagories Book Section ======-->
<section class="top-categories-book-section p-t-80 p-b-80">
    <div class="container container-1278">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="common-heading m-b-35 text-center">
                    <h3>{{__('book_by_categories')}}</h3>
                    <p>{{__('select_your_favorite_category_from_our_wide_range_of_collections.')}}</p>
                </div>
            </div>
        </div>
        <div class="row course-lesson-v2 course-lesson-slider-v2 slider-primary">
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <a href="#" class="course-lesson-item">
                    <img src="assets/img/books/book-catagory/book-category-thumbnail-1.jpg" alt="Catagory thumbnail">
                    <div class="course-lesson-item-content">
                        <h5>SSC Level</h5>
                        <p>Class 9 & 10 Books</p>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <a href="#" class="course-lesson-item">
                    <img src="assets/img/books/book-catagory/book-category-thumbnail-2.jpg" alt="Catagory thumbnail">
                    <div class="course-lesson-item-content">
                        <h5>HSC Level</h5>
                        <p>Class 11 & 12 Books</p>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <a href="#" class="course-lesson-item">
                    <img src="assets/img/books/book-catagory/book-category-thumbnail-3.jpg" alt="Catagory thumbnail">
                    <div class="course-lesson-item-content">
                        <h5>Careers</h5>
                        <p>Careers and Job Preparation Books</p>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <a href="#" class="course-lesson-item">
                    <img src="assets/img/books/book-catagory/book-category-thumbnail-4.jpg" alt="Catagory thumbnail">
                    <div class="course-lesson-item-content">
                        <h5>Motivation & Spiritual</h5>
                        <p>Motivation & Spiritual Books</p>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <a href="#" class="course-lesson-item">
                    <img src="assets/img/books/book-catagory/book-category-thumbnail-2.jpg" alt="Catagory thumbnail">
                    <div class="course-lesson-item-content">
                        <h5>Novels & Fictions</h5>
                        <p>All types of Novels and Fictions</p>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <a href="#" class="course-lesson-item">
                    <img src="assets/img/books/book-catagory/book-category-thumbnail-3.jpg" alt="Catagory thumbnail">
                    <div class="course-lesson-item-content">
                        <h5>Fairy Tales</h5>
                        <p>Popular Fairy Tales</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!--====== Start Top Catagories Book Section ======-->

<!--====== Start Our Instructor Section ======-->
<section class="our-instructor-section color-bg-black p-t-80 p-b-80">
    <div class="container container-1278">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="section-title color-white m-b-35 text-center">
                    <h3>{{__('Best_Author_of_the_Week')}}</h3>
                    <p>{{__('The_authors_make_us_proud_with_their_excellent_contributions.')}}</p>
                </div>
            </div>
        </div>
        <div class="row team-items-v1 team-slider slider-primary">
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="team-member-item">
                    <div class="member-img">
                        <a href="instructor-details.html"><img src="assets/img/team/team-member-1.jpg" alt="Team member"></a>
                    </div>
                    <div class="member-content">
                        <h5><a href="instructor-details.html">Amelia Margaret</a></h5>
                        <p>CEO & Co-founder</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="team-member-item">
                    <div class="member-img">
                        <a href="instructor-details.html"><img src="assets/img/team/team-member-2.jpg" alt="Team member"></a>
                    </div>
                    <div class="member-content">
                        <h5><a href="instructor-details.html">William Domain</a></h5>
                        <p>CEO & Co-founder</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="team-member-item">
                    <div class="member-img">
                        <a href="instructor-details.html"><img src="assets/img/team/team-member-3.jpg" alt="Team member"></a>
                    </div>
                    <div class="member-content">
                        <h5><a href="instructor-details.html">Emily Elizabeth</a></h5>
                        <p>CEO & Co-founder</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="team-member-item">
                    <div class="member-img">
                        <a href="instructor-details.html"><img src="assets/img/team/team-member-4.jpg" alt="Team member"></a>
                    </div>
                    <div class="member-content">
                        <h5><a href="instructor-details.html">Daniel Thomas</a></h5>
                        <p>CEO & Co-founder</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="team-member-item">
                    <div class="member-img">
                        <a href="instructor-details.html"><img src="assets/img/team/team-member-5.jpg" alt="Team member"></a>
                    </div>
                    <div class="member-content">
                        <h5><a href="instructor-details.html">Amelia Margaret</a></h5>
                        <p>CEO & Co-founder</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="team-member-item">
                    <div class="member-img">
                        <a href="instructor-details.html"><img src="assets/img/team/team-member-6.jpg" alt="Team member"></a>
                    </div>
                    <div class="member-content">
                        <h5><a href="instructor-details.html">Daniel Thomas</a></h5>
                        <p>CEO & Co-founder</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== End Our Instructor Section ======-->

<!--====== Start Best Books Section ======-->
<section class="best-books-section p-t-80 p-b-80">
    <div class="container container-1278">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="common-heading m-b-35 text-center">
                    <h3>{{__('Best_Selling_Books_of_This_Month')}}</h3>
                    <p>{{__('choose_from_our_huge_collection_of_books.')}}</p>
                </div>
            </div>
        </div>
        <div class="row book-list-slider slider-primary">
            <div class="col-xl-3 col-md-4 col-sm-6">
                <div class="book-list-item">
                    <div class="book-thumbnail">
                        <a href="book-details.html">
                            <img src="assets/img/books/book-6.jpg" alt="Book Thumbnail">
                        </a>
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
            <div class="col-xl-3 col-md-4 col-sm-6">
                <div class="book-list-item">
                    <div class="book-thumbnail">
                        <a href="book-details.html">
                            <img src="assets/img/books/book-7.jpg" alt="Book Thumbnail">
                        </a>
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
            <div class="col-xl-3 col-md-4 col-sm-6">
                <div class="book-list-item">
                    <div class="book-thumbnail">
                        <a href="book-details.html">
                            <img src="assets/img/books/book-8.jpg" alt="Book Thumbnail">
                        </a>
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
            <div class="col-xl-3 col-md-4 col-sm-6">
                <div class="book-list-item">
                    <div class="book-thumbnail">
                        <a href="book-details.html">
                            <img src="assets/img/books/book-9.jpg" alt="Book Thumbnail">
                        </a>
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
            <div class="col-xl-3 col-md-4 col-sm-6">
                <div class="book-list-item">
                    <div class="book-thumbnail">
                        <a href="book-details.html">
                            <img src="assets/img/books/book-10.jpg" alt="Book Thumbnail">
                        </a>
                    </div>
                    <div class="book-text-content">
                        <h6><a href="book-details.html">Book Is a Window to the World</a></h6>
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
            <div class="col-xl-3 col-md-4 col-sm-6">
                <div class="book-list-item">
                    <div class="book-thumbnail">
                        <a href="book-details.html">
                            <img src="assets/img/books/book-11.jpg" alt="Book Thumbnail">
                        </a>
                    </div>
                    <div class="book-text-content">
                        <h6><a href="book-details.html">Happy World Book Day</a></h6>
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
</section>
<!--====== End Best Books Section ======-->

<!--====== Start Book CTA Section ======-->
<section class="book-cta-section">
    <div class="container container-1278">
        <div class="book-cta-wrapper p-l-sm-20 p-r-sm-20">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-4 align-self-end text-center d-none d-md-block">
                    <img src="assets/img/cta/cta-image-2.png" alt="CTA Image">
                </div>
                <div class="col-lg-4 col-md-auto">
                    <div class="book-cta-content">
                        <p>Unlimited Free Book</p>
                        <h3><span>25%</span> Off Select Books</h3>
                        <a href="#" class="template-btn">
                            Free Book <i class="fas fa-long-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3 text-center d-none d-md-block">
                    <img class="" src="assets/img/cta/cta-image-3.png" alt="CTA Image">
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== End Book CTA Section ======-->

<!--====== Start Featured Blog Section ======-->
<section class="featured-news-section p-t-80 p-b-50">
    <div class="container container-1278">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="common-heading m-b-45 text-center">
                    <h3>{{__('features_in_newspaper')}}</h3>
                    <p>{{__('Let’s take a look at some of our featured publications')}}</p>
                </div>
            </div>
        </div>
        <div class="row blog-post-items-v3">
            <div class="col-lg-4 col-sm-6">
                <div class="blog-post-item">
                    <div class="post-thumbnail">
                        <a href="blog-details-2.html">
                            <img src="assets/img/blog/blog-v3-thumbnail-1.jpg" alt="Blog Thumbnail">
                        </a>
                        <ul class="post-meta">
                            <li class="date"><a href="#"><i class="fal fa-calendar"></i> 06 Jan 2022</a></li>
                        </ul>
                    </div>
                    <div class="post-content">
                        <h4 class="title">
                            <a href="blog-details-2.html" target="_blank">Role of a Teacher in the Classroom</a>
                        </h4>
                        <p class="content">
                            Traditionalists think that adults know more than children and should thus make all essential decisions in the classroom, such as setting and enforcing regulations, monitoring student behavior, planning the curriculum, imparting knowledge, and so on.
                        </p>
                        <div class="post-meta-wrapper">
                            <div class="left-content">
                                <ul class="post-meta">
                                    <li><a href="#"><i class="fal fa-comment-alt"></i> 203</a></li>
                                    <li><a href="#"><i class="fal fa-user"></i> By Admin</a></li>
                                </ul>
                            </div>
                            <div class="right-content">
                                <a href="blog-details-2.html" target="_blank" class="read-more-btn">Read More <i class="fas fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="blog-post-item">
                    <div class="post-thumbnail">
                        <a href="blog-details-2.html">
                            <img src="assets/img/blog/blog-v3-thumbnail-2.jpg" alt="Blog Thumbnail">
                        </a>
                        <ul class="post-meta">
                            <li class="date"><a href="#"><i class="fal fa-calendar"></i> 06 Jan 2022</a></li>
                        </ul>
                    </div>
                    <div class="post-content">
                        <h4 class="title">
                            <a href="blog-details-2.html" target="_blank">You Taught it. They Didn’t Get it. Now What?</a>
                        </h4>
                        <p class="content">
                            As teachers, we regularly find ourselves employing teaching practices that make us feel at ease. But what if what we prefer does not suit all of our students? What about pupils who don't grasp the concepts or skills the first time around?
                        </p>
                        <div class="post-meta-wrapper">
                            <div class="left-content">
                                <ul class="post-meta">
                                    <li><a href="#"><i class="fal fa-comment-alt"></i> 203</a></li>
                                    <li><a href="#"><i class="fal fa-user"></i> By Admin</a></li>
                                </ul>
                            </div>
                            <div class="right-content">
                                <a href="blog-details-2.html" target="_blank" class="read-more-btn">Read More <i class="fas fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="blog-post-item">
                    <div class="post-thumbnail">
                        <a href="blog-details-2.html">
                            <img src="assets/img/blog/blog-v3-thumbnail-3.jpg" alt="Blog Thumbnail">
                        </a>
                        <ul class="post-meta">
                            <li class="date"><a href="#"><i class="fal fa-calendar"></i> 06 Jan 2022</a></li>
                        </ul>
                    </div>
                    <div class="post-content">
                        <h4 class="title">
                            <a href="blog-details-2.html" target="_blank">Facing With Your Inner Obstacle</a>
                        </h4>
                        <p class="content">
                            Chrissy, a special education teacher, shared her big idea with me during our first coaching session: creating empowerment binders for her pupils. She would instruct pupils on how to use these binders to collect their study materials (graphic organizers, anchor charts, etc.)
                        </p>
                        <div class="post-meta-wrapper">
                            <div class="left-content">
                                <ul class="post-meta">
                                    <li><a href="#"><i class="fal fa-comment-alt"></i> 203</a></li>
                                    <li><a href="#"><i class="fal fa-user"></i> By Admin</a></li>
                                </ul>
                            </div>
                            <div class="right-content">
                                <a href="blog-details-2.html" target="_blank" class="read-more-btn">Read More <i class="fas fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== End Featured Blog Section ======-->

<!--====== Start Best Selling Book Section ======-->
<section class="best-selling-book-section color-bg-off-white p-t-80 p-b-50">
    <div class="container container-1278">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="common-heading m-b-45 text-center">
                    <h3>{{__('best_selling_books')}}</h3>
                    <p>{{__('want_to_grab_a_piece_of_our_best_selling_books?')}}</p>
                </div>
            </div>
        </div>
        <div class="row book-list-items-v2">
            <div class="col-lg-6">
                <div class="book-list-item">
                    <div class="book-thumbnail">
                        <a href="book-details.html">
                            <img src="assets/img/books/book-14.jpg" alt="Book Thumbnail">
                        </a>
                    </div>
                    <div class="book-text-content">
                        <h6><a href="book-details.html">The Psychology of Money</a></h6>
                        <p class="author">By <a href="#">Morgan Housel</a></p>
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
                        <p class="desc">Money success doesn't always depend on your knowledge. It has to do with your behavior. Even for extremely intelligent people, conduct is difficult to teach.</p>
                        <p class="book-price"><small>$120.99</small> $115.50</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="book-list-item">
                    <div class="book-thumbnail">
                        <a href="book-details.html">
                            <img src="assets/img/books/book-15.jpg" alt="Book Thumbnail">
                        </a>
                    </div>
                    <div class="book-text-content">
                        <h6><a href="book-details.html">The Picture of Dorian</a></h6>
                        <p class="author">By <a href="#">Oscar Wilde</a></p>
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
                        <p class="desc">A corrupt young guy mysteriously preserves his youthful beauty, but a special artwork gradually discloses his underlying depravity to all. In 1886, in Victorian London, the corrupt Lord Henry Wotton (George Sanders) meets the pure Dorian Gray (Hurd Hatfield) posing for genius painter Basil Hallward (Lowell Gilmore) (Lowell Gilmore).</p>
                        <p class="book-price"><small>$120.99</small> $115.50</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== End Best Selling Book Section ======-->

<!--====== Start Recent & On Sale Book Section ======-->
<section class="recent-on-sale-book-section p-t-80 p-b-50">
    <div class="container container-1278">
        <div class="row book-list-items-v3">
            <div class="col-xl-4 col-md-6 m-b-30">
                <div class="section-title-v4 m-b-20">
                    <h3>{{__('recent_books')}}</h3>
                </div>
                <div class="book-list-item">
                    <div class="book-thumbnail">
                        <a href="book-details.html">
                            <img src="assets/img/books/book-thumbnail-small-1.jpg" alt="Book Thumbnail">
                        </a>
                    </div>
                    <div class="book-text-content">
                        <h6><a href="book-details.html">Book Is a Window to the World</a></h6>
                        <p class="author">By <a href="#">Morgan Housel</a></p>
                        <p class="book-price"><small>$120.99</small> $115.50</p>
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
                <div class="book-list-item">
                    <div class="book-thumbnail">
                        <a href="book-details.html">
                            <img src="assets/img/books/book-thumbnail-small-2.jpg" alt="Book Thumbnail">
                        </a>
                    </div>
                    <div class="book-text-content">
                        <h6><a href="book-details.html">Book Outlet</a></h6>
                        <p class="author">By <a href="#">Oscar Wilde</a></p>
                        <p class="book-price"><small>$120.99</small> $115.50</p>
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
                <div class="book-list-item">
                    <div class="book-thumbnail">
                        <a href="book-details.html">
                            <img src="assets/img/books/book-thumbnail-small-3.jpg" alt="Book Thumbnail">
                        </a>
                    </div>
                    <div class="book-text-content">
                        <h6><a href="book-details.html">Save the Wild Life</a></h6>
                        <p class="author">By <a href="#">Oscar Wilde</a></p>
                        <p class="book-price"><small>$120.99</small> $115.50</p>
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
                <a href="#" class="template-btn">
                    {{__('view_all')}} <i class="fal fa-long-arrow-right"></i>
                </a>
            </div>

            <div class="col-xl-4 col-md-6 m-b-30">
                <div class="section-title-v4 m-b-20">
                    <h3>{{__('on_sale')}}</h3>
                </div>
                <div class="book-list-item">
                    <div class="book-thumbnail">
                        <a href="book-details.html">
                            <img src="assets/img/books/book-thumbnail-small-4.jpg" alt="Book Thumbnail">
                        </a>
                    </div>
                    <div class="book-text-content">
                        <h6><a href="book-details.html">Best Classes</a></h6>
                        <p class="author">By <a href="#">Morgan Housel</a></p>
                        <p class="book-price"><small>$120.99</small> $115.50</p>
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
                <div class="book-list-item">
                    <div class="book-thumbnail">
                        <a href="book-details.html">
                            <img src="assets/img/books/book-thumbnail-small-5.jpg" alt="Book Thumbnail">
                        </a>
                    </div>
                    <div class="book-text-content">
                        <h6><a href="book-details.html">Feel the Poetry</a></h6>
                        <p class="author">By <a href="#">Oscar Wilde</a></p>
                        <p class="book-price"><small>$120.99</small> $115.50</p>
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
                <div class="book-list-item">
                    <div class="book-thumbnail">
                        <a href="book-details.html">
                            <img src="assets/img/books/book-thumbnail-small-6.jpg" alt="Book Thumbnail">
                        </a>
                    </div>
                    <div class="book-text-content">
                        <h6><a href="book-details.html">Travel Adventures Holidays</a></h6>
                        <p class="author">By <a href="#">Oscar Wilde</a></p>
                        <p class="book-price"><small>$120.99</small> $115.50</p>
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
                <a href="#" class="template-btn">
                    {{__('view_all')}} <i class="fal fa-long-arrow-right"></i>
                </a>
            </div>

            <div class="col-xl-4 col-md-6 m-b-30">
                <div class="section-title-v4 m-b-20">
                    <h3>{{__('limited_stock')}}</h3>
                </div>
                <div class="book-list-item">
                    <div class="book-thumbnail">
                        <a href="book-details.html">
                            <img src="assets/img/books/book-thumbnail-small-7.jpg" alt="Book Thumbnail">
                        </a>
                    </div>
                    <div class="book-text-content">
                        <h6><a href="book-details.html">School Admission</a></h6>
                        <p class="author">By <a href="#">Morgan Housel</a></p>
                        <p class="book-price"><small>$120.99</small> $115.50</p>
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
                <div class="book-list-item">
                    <div class="book-thumbnail">
                        <a href="book-details.html">
                            <img src="assets/img/books/book-thumbnail-small-8.jpg" alt="Book Thumbnail">
                        </a>
                    </div>
                    <div class="book-text-content">
                        <h6><a href="book-details.html">Digital Masters here</a></h6>
                        <p class="author">By <a href="#">Oscar Wilde</a></p>
                        <p class="book-price"><small>$120.99</small> $115.50</p>
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
                <div class="book-list-item">
                    <div class="book-thumbnail">
                        <a href="book-details.html">
                            <img src="assets/img/books/book-thumbnail-small-9.jpg" alt="Book Thumbnail">
                        </a>
                    </div>
                    <div class="book-text-content">
                        <h6><a href="book-details.html">Happy World Book Day</a></h6>
                        <p class="author">By <a href="#">Oscar Wilde</a></p>
                        <p class="book-price"><small>$120.99</small> $115.50</p>
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
                <a href="#" class="template-btn">
                    {{__('view_all')}} <i class="fal fa-long-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>
<!--====== End Recent & On Sale Book Section ======-->
@endsection
