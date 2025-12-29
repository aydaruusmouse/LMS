@extends('frontend.layouts.master')
@section('title', __('home'))
@section('content')
<!--====== Start Book Details Area ======-->
<section class="book-details-area p-t-50 p-t-sm-30 p-b-55 p-b-sm-35">
    <div class="container container-1278">
        <div class="row">
            <div class="col-lg-8">
                <div class="product-buy-now-wrap">
                    <div class="row">
                        <div class="col-xl-4 col-md-3">
                            <div class="product-image text-align-center text-align-sm-start">
                                <img src="{{static_asset('frontend/img/books/book-2.jpg')}}" alt="Product Thumbnail" class="w-lg-100">
                            </div>
                        </div>
                        <div class="col-xl-8 col-md-9">
                            <div class="product-summary">
                                <h3 class="title">Digital Masters Here</h3>
                                <p class="author">By <a href="#">Morgan Housel</a></p>
                                <div class="rating-review">
                                    <ul class="all-rating star-4">
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
                                    <span class="total-review">(469 Reviews)</span>
                                </div>
                                <p class="book-price"><small>$5.49</small> $4.49</p>
                                <table class="product-specification">
                                    <tbody>
                                        <tr>
                                            <th>Book Formate:</th>
                                            <td>
                                                <label>
                                                    <input type="checkbox" value="" checked>
                                                    <span>Hardcopy</span>
                                                </label>
                                            </td>
                                            <td>
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <span>PDF</span>
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Categories:</th>
                                            <td>MBA,</td>
                                            <td>Professional</td>
                                        </tr>
                                        <tr>
                                            <th>Publication:</th>
                                            <td>Pearson</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <form action="#" class="cart">
                                    <div class="qty-and-stock">
                                        <div class="qty">
                                            <input type="button" class="qtyminus" value="-">
                                            <input type="number" name="qty" class="qtyinput" min="1" max="10" step="1" value="1">
                                            <input type="button" class="qtyplus" value="+">
                                        </div>
                                        <span class="current-stock">In stock</span>
                                    </div>
                                    <div class="dual-btn">
                                        <button type="submit" name="add-to-cart" class="template-btn"><i class="fal fa-shopping-cart m-e-2"></i> Add to cart</button>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="template-btn bordered-btn-secondary">Read a little</a>
                                    </div>
                                </form>
                                <ul class="social-profile">
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                </ul>
                                <a href="#" class="wishlist-icon">
                                    <i class="fal fa-heart"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="book-details-tabs main-tabs">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="pill" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="author-tab" data-bs-toggle="pill" data-bs-target="#author" type="button" role="tab" aria-controls="author" aria-selected="false">Author</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="pill" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
                        </li>
                    </ul>
                    <div class="book-details-tab-content m-b-20 tab-content" id="pills-tabContent">
                        <!-- Book Details Description Tab -->
                        <div class="details-tab tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                            <div class="tab-content-inner">
                                <h4>Details about this Book </h4>
                                <p>Digital Master's goal is to foresee the numerous ways in which digital philosophy, technology, and methodology will alter the course of enterprise and the human condition. In today's overly complex, hyperconnected, and interdependent business dynamic, Digital Masters Here - not only apply the most cutting-edge digital technology to their business management disciplines but also orchestrates the unified digital symphony across all critical business domains, by fostering a digital mindset to creating a high-performing workforce.</p>
                                <div class="specification-table">
                                    <h4>Specification</h4>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <th>Title</th>
                                                <td>Wood Comfortable Chair Comfortable Chair</td>
                                            </tr>
                                            <tr>
                                                <th>Author</th>
                                                <td>Gopal Talukder</td>
                                            </tr>
                                            <tr>
                                                <th>Categories</th>
                                                <td>MBA, Professional</td>
                                            </tr>
                                            <tr>
                                                <th>Book  Formate</th>
                                                <td>Hardcopy, Pdf</td>
                                            </tr>
                                            <tr>
                                                <th>Number of Page</th>
                                                <td>1632</td>
                                            </tr>
                                            <tr>
                                                <th>Edition</th>
                                                <td>4th Published, 2022</td>
                                            </tr>
                                            <tr>
                                                <th>Country</th>
                                                <td>Bangladesh</td>
                                            </tr>
                                            <tr>
                                                <th>Language</th>
                                                <td>Bangla</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Book Author Tab -->
                        <div class="author-tab tab-pane fade" id="author" role="tabpanel" aria-labelledby="author-tab">
                            <div class="tab-content-inner">
                                <img class="m-b-25 author-image" src="{{static_asset('frontend/img/author/book-author/book-author-7.jpg')}}" alt="Author Thumbnail">
                                <h4>About Olivia Nova</h4>
                                <p>Dedicated, resourceful and goal-driven professional educator with a solid commitment to the social and academic growth and development of every child.An accommodating and versatile individual with the talent to develop inspiring hands-on lessons that will capture a child's imagination and breed success. Highly motivated, enthusiastic and dedicated educator who wants all children to be successful learners.</p>
                                <p>Committed to creating a classroom atmosphere that is stimulating and encouraging to students. Aptitude to remain flexible, ensuring that every child's learning styles and abilities are addressed.Superior interpersonal and communication skills to foster meaningful relationships with students, staff and parents Demonstrated ability to consistently individualize instruction, based on student's needs and interests</p>
                                <p>Exceptional ability to establish cooperative, professional relationships with parents, staff and administration. Professional Educator with diverse experience and strong track record fostering child-centered curriculum and student creativity.</p>
                                <p>Warm and caring teacher who wants all children to be successful learners and works to create a classroom atmosphere that is stimulating, encouraging, and adaptive to the varied needs of students.</p>
                                <div class="row m-t-20">
                                    <div class="col-lg-9">
                                        <h4 class="p-b-20">More Books of Olivia Nova</h4>
                                        <div class="row">
                                            <div class="col-sm-6 col-xs-6">
                                                <div class="book-list-item">
                                                    <div class="book-thumbnail">
                                                        <a href="book-details.html">
                                                            <img src="{{static_asset('frontend/img/books/book-9.jpg')}}" alt="Book Thumbnail">
                                                        </a>
                                                    </div>
                                                    <div class="book-text-content">
                                                        <h6><a href="book-details.html">Wood Comfortable Chair</a></h6>
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
                                            <div class="col-sm-6 col-xs-6">
                                                <div class="book-list-item">
                                                    <div class="book-thumbnail">
                                                        <a href="book-details.html">
                                                            <img src="{{static_asset('frontend/img/books/book-11.jpg')}}" alt="Book Thumbnail">
                                                        </a>
                                                    </div>
                                                    <div class="book-text-content">
                                                        <h6><a href="book-details.html">Wood Comfortable Chair</a></h6>
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
                                            <div class="col-sm-6">
                                                <div class="book-list-item">
                                                    <div class="book-thumbnail">
                                                        <a href="book-details.html">
                                                            <img src="{{static_asset('frontend/img/books/book-6.jpg')}}" alt="Book Thumbnail">
                                                        </a>
                                                    </div>
                                                    <div class="book-text-content">
                                                        <h6><a href="book-details.html">Wood Comfortable Chair</a></h6>
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
                                            <div class="col-sm-6">
                                                <div class="book-list-item">
                                                    <div class="book-thumbnail">
                                                        <a href="book-details.html">
                                                            <img src="{{static_asset('frontend/img/books/book-16.jpg')}}" alt="Book Thumbnail">
                                                        </a>
                                                    </div>
                                                    <div class="book-text-content">
                                                        <h6><a href="book-details.html">Wood Comfortable Chair</a></h6>
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

                        <!-- Book Reviews Tab -->
                        <div class="reviews-tab tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="average-rating-summary">
                                <div class="average-rating">
                                    <h5>Average Rating</h5>
                                    <h2>4.5</h2>
                                    <div class="rating-star">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fal fa-star"></i>
                                        <span>(543 Reviews)</span>
                                    </div>
                                </div>
                                <div class="average-rating-details">
                                    <h5>Details</h5>
                                    <div class="star-count-progress">
                                        <div class="line-progress">
                                            <p>5 Star <span>212 Person</span></p>
                                            <div data-progress="90"></div>
                                        </div>
                                        <div class="line-progress">
                                            <p>4 Star <span>145 Person</span></p>
                                            <div data-progress="70"></div>
                                        </div>
                                        <div class="line-progress">
                                            <p>3 Star <span>111 Person</span></p>
                                            <div data-progress="50"></div>
                                        </div>
                                        <div class="line-progress">
                                            <p>2 Star <span>43 Person</span></p>
                                            <div data-progress="60"></div>
                                        </div>
                                        <div class="line-progress">
                                            <p>1 Star <span>4 Person</span></p>
                                            <div data-progress="20"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Comments Template -->
                            <div class="comments-template comments-template-v2">
                                <div class="comments-respond" id="comment-respond">
                                    <h4 class="template-title"><span>Review Own</span></h4>
                                    <form>
                                        <div class="input-field m-b-20">
                                            <textarea name="message"></textarea>
                                        </div>
                                        <div class="input-field">
                                            <button class="template-btn">Post Review</button>
                                        </div>
                                    </form>
                                </div>
                                <ul class="comments-list">
                                    <li class="comment">
                                        <div class="comment-body">
                                            <div class="avatar">
                                                <img src="{{static_asset('frontend/img/blog/comment-avatar-1.jpg')}}" alt="comment author">
                                            </div>
                                            <div class="comment-content">
                                                <div class="author-name-wrapper">
                                                    <h5 class="author-name">
                                                        Melissa Mortez
                                                        <span class="author-role">Student</span>
                                                    </h5>
                                                    <span class="date">9w ago</span>
                                                </div>
                                                <p>Excellent overview of the subject matter. Updated modules may experience minor attribute issues; however this presents a great learning opportunity for the student.</p>
                                                <form class="reply">
                                                    <textarea name="message" placeholder="Reply"></textarea>
                                                    <button class="template-btn">Post</button>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="comment">
                                        <div class="comment-body">
                                            <div class="avatar">
                                                <img src="{{static_asset('frontend/img/blog/comment-avatar-1.jpg')}}" alt="comment author">
                                            </div>
                                            <div class="comment-content">
                                                <div class="author-name-wrapper">
                                                    <h5 class="author-name">
                                                        Melissa Mortez
                                                        <span class="author-role">Student</span>
                                                    </h5>
                                                    <span class="date">9w ago</span>
                                                </div>
                                                <p>Great overview of the subject matter. Although minor attributes issues may occur in updated modules, this is a great learning opportunity.</p>
                                                <form class="reply">
                                                    <textarea name="message" placeholder="Reply"></textarea>
                                                    <button class="template-btn">Post</button>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="comment">
                                        <div class="comment-body">
                                            <div class="avatar">
                                                <img src="{{static_asset('frontend/img/blog/comment-avatar-1.jpg')}}" alt="comment author">
                                            </div>
                                            <div class="comment-content">
                                                <div class="author-name-wrapper">
                                                    <h5 class="author-name">
                                                        Melissa Mortez
                                                        <span class="author-role">Student</span>
                                                    </h5>
                                                    <span class="date">9w ago</span>
                                                </div>
                                                <p>Each video has a different voice. It can be either audible or barely audible. It would be great if it was consistent, but I need to adjust the volume.</p>
                                            </div>
                                        </div>
                                        <ul class="children">
                                            <li>
                                                <div class="comment-body">
                                                    <div class="avatar">
                                                        <img src="{{static_asset('frontend/img/blog/comment-avatar-1.jpg')}}" alt="comment author">
                                                    </div>
                                                    <div class="comment-content">
                                                        <div class="author-name-wrapper">
                                                            <h5 class="author-name">
                                                                Melissa Mortez
                                                                <span class="author-role">Student</span>
                                                            </h5>
                                                            <span class="date">9w ago</span>
                                                        </div>
                                                        <p>Thanks for mentioning the issues. We will try to fix the audible issues.</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>  
                        </div>
                    </div>                        
                </div>
            </div>
            <div class="col-lg-4">
                <div class="book-sidebar">
                    <div class="widget d-none d-md-block">
                        <div class="row icon-boxes-v3">
                            <div class="col-sm-6 col-lg-12">
                                <div class="icon-box">
                                    <div class="icon-box-icon">
                                        <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_2783_6196)">
                                                <path d="M26.4313 20.8086C23.9986 20.8086 22.0195 22.7877 22.0195 25.2204C22.0195 27.6531 23.9986 29.6321 26.4313 29.6321C28.8644 29.6321 30.8431 27.6531 30.8431 25.2204C30.8431 22.7877 28.864 20.8086 26.4313 20.8086ZM26.4313 27.4263C25.2148 27.4263 24.2254 26.4369 24.2254 25.2204C24.2254 24.0038 25.2148 23.0145 26.4313 23.0145C27.6478 23.0145 28.6372 24.0038 28.6372 25.2204C28.6372 26.437 27.6478 27.4263 26.4313 27.4263Z" fill="var(--color-secondary-4)"/>
                                                <path d="M11.361 20.8086C8.92829 20.8086 6.94922 22.7877 6.94922 25.2204C6.94922 27.6531 8.92829 29.6321 11.361 29.6321C13.7937 29.6321 15.7728 27.6531 15.7728 25.2204C15.7728 22.7877 13.7937 20.8086 11.361 20.8086ZM11.361 27.4263C10.1445 27.4263 9.15511 26.4369 9.15511 25.2204C9.15511 24.0038 10.1445 23.0145 11.361 23.0145C12.5772 23.0145 13.5669 24.0038 13.5669 25.2204C13.5669 26.437 12.5775 27.4263 11.361 27.4263Z" fill="var(--color-secondary-4)"/>
                                                <path d="M29.4039 8.18062C29.2164 7.80819 28.8351 7.57324 28.4182 7.57324H22.6094V9.77913H27.738L30.7413 15.7526L32.7127 14.7614L29.4039 8.18062Z" fill="var(--color-secondary-4)"/>
                                                <path d="M23.1268 24.1533H14.7812V26.3592H23.1268V24.1533Z" fill="var(--color-secondary-4)"/>
                                                <path d="M8.05139 24.1533H4.22791C3.61869 24.1533 3.125 24.6471 3.125 25.2562C3.125 25.8654 3.61876 26.3591 4.22791 26.3591H8.05146C8.66068 26.3591 9.15437 25.8654 9.15437 25.2562C9.15437 24.647 8.66061 24.1533 8.05139 24.1533Z" fill="var(--color-secondary-4)"/>
                                                <path d="M34.7684 17.4113L32.5989 14.6172C32.3905 14.348 32.0688 14.1907 31.7279 14.1907H23.7132V6.4701C23.7132 5.86088 23.2194 5.36719 22.6103 5.36719H4.22791C3.61869 5.36719 3.125 5.86095 3.125 6.4701C3.125 7.07925 3.61876 7.57301 4.22791 7.57301H21.5073V15.2936C21.5073 15.9028 22.0011 16.3965 22.6102 16.3965H31.1878L32.7941 18.4656V24.1538H29.7426C29.1334 24.1538 28.6397 24.6476 28.6397 25.2568C28.6397 25.866 29.1334 26.3597 29.7426 26.3597H33.897C34.5062 26.3597 34.9999 25.8659 35 25.2568V18.0878C35 17.8429 34.9183 17.6047 34.7684 17.4113Z" fill="var(--color-secondary-4)"/>
                                                <path d="M7.97726 18.5664H2.90369C2.29447 18.5664 1.80078 19.0602 1.80078 19.6693C1.80078 20.2785 2.29454 20.7722 2.90369 20.7722H7.97719C8.58641 20.7722 9.0801 20.2785 9.0801 19.6693C9.08017 19.0602 8.58641 18.5664 7.97726 18.5664Z" fill="var(--color-secondary-4)"/>
                                                <path d="M10.5147 14.2275H1.10291C0.49376 14.2275 0 14.7213 0 15.3305C0 15.9397 0.49376 16.4334 1.10291 16.4334H10.5147C11.1239 16.4334 11.6176 15.9397 11.6176 15.3305C11.6176 14.7214 11.1239 14.2275 10.5147 14.2275Z" fill="var(--color-secondary-4)"/>
                                                <path d="M12.3155 9.88965H2.90369C2.29447 9.88965 1.80078 10.3834 1.80078 10.9926C1.80078 11.6018 2.29454 12.0955 2.90369 12.0955H12.3155C12.9247 12.0955 13.4184 11.6017 13.4184 10.9926C13.4185 10.3834 12.9247 9.88965 12.3155 9.88965Z" fill="var(--color-secondary-4)"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_2783_6196">
                                                    <rect width="35" height="35" fill="white"/>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                    <div class="icon-box-content">
                                        <h5>Free Shipping & Returns</h5>
                                        <p>Orders over $100</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-12">
                                <div class="icon-box">
                                    <div class="icon-box-icon">
                                        <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M33.9062 21.875C33.3025 21.875 32.8125 22.365 32.8125 22.9688V30.625H2.1875V17.5H14.2188C14.8225 17.5 15.3125 17.01 15.3125 16.4062C15.3125 15.8025 14.8225 15.3125 14.2188 15.3125H2.1875V10.9375H14.2188C14.8225 10.9375 15.3125 10.4475 15.3125 9.84375C15.3125 9.24 14.8225 8.75 14.2188 8.75H2.1875C0.98 8.75 0 9.73 0 10.9375V30.625C0 31.8325 0.98 32.8125 2.1875 32.8125H32.8125C34.02 32.8125 35 31.8325 35 30.625V22.9688C35 22.365 34.51 21.875 33.9062 21.875Z" fill="var(--color-secondary-4)"/>
                                            <path d="M9.84375 21.875H5.46875C4.865 21.875 4.375 22.365 4.375 22.9688C4.375 23.5725 4.865 24.0625 5.46875 24.0625H9.84375C10.4475 24.0625 10.9375 23.5725 10.9375 22.9688C10.9375 22.365 10.4475 21.875 9.84375 21.875Z" fill="var(--color-secondary-4)"/>
                                            <path d="M34.3372 5.5557L26.6809 2.27445C26.4031 2.15852 26.0947 2.15852 25.8169 2.27445L18.1606 5.5557C17.7603 5.72852 17.5 6.12445 17.5 6.56195V10.937C17.5 16.9548 19.7247 20.4723 25.7053 23.9176C25.8738 24.0138 26.0619 24.062 26.25 24.062C26.4381 24.062 26.6262 24.0138 26.7947 23.9176C32.7753 20.481 35 16.9635 35 10.937V6.56195C35 6.12445 34.7397 5.72852 34.3372 5.5557ZM32.8125 10.937C32.8125 15.9879 31.1413 18.7682 26.25 21.6995C21.3587 18.7616 19.6875 15.9813 19.6875 10.937V7.28383L26.25 4.4707L32.8125 7.28383V10.937Z" fill="var(--color-secondary-4)"/>
                                            <path d="M30.2152 8.98803C29.7449 8.61616 29.058 8.68834 28.6774 9.15866L25.2386 13.4593L23.878 11.4249C23.5389 10.9218 22.8586 10.7883 22.3621 11.1208C21.8611 11.4555 21.7233 12.1358 22.058 12.6368L24.2455 15.918C24.4402 16.209 24.7596 16.3883 25.1096 16.4058C25.1249 16.4058 25.1424 16.4058 25.1555 16.4058C25.4858 16.4058 25.8008 16.2571 26.0108 15.9946L30.3858 10.5258C30.7621 10.0533 30.6877 9.36647 30.2152 8.98803Z" fill="var(--color-secondary-4)"/>
                                        </svg>
                                    </div>
                                    <div class="icon-box-content">
                                        <h5>Secure Payment</h5>
                                        <p>100% Secure Payment</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-12">
                                <div class="icon-box">
                                    <div class="icon-box-icon">
                                        <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_2783_6225)">
                                                <path d="M35 17.5C35.003 19.796 34.5533 22.0701 33.6767 24.1922C32.8001 26.3142 31.5138 28.2427 29.8914 29.8673C28.2689 31.4918 26.3421 32.7806 24.2212 33.66C22.1002 34.5393 19.8268 34.9919 17.5308 34.9919C15.2348 34.9919 12.9613 34.5393 10.8404 33.66C8.71941 32.7806 6.79261 31.4918 5.17015 29.8673C3.54768 28.2427 2.26138 26.3142 1.3848 24.1922C0.508212 22.0701 0.0585458 19.796 0.0615125 17.5C0.0615125 17.1906 0.184429 16.8939 0.403221 16.6751C0.622014 16.4563 0.91876 16.3334 1.22818 16.3334C1.5376 16.3334 1.83435 16.4563 2.05314 16.6751C2.27193 16.8939 2.39485 17.1906 2.39485 17.5C2.3987 21.2168 3.76859 24.8024 6.24393 27.5749C8.71926 30.3474 12.1273 32.1133 15.8199 32.5366C19.5124 32.96 23.2317 32.0114 26.2703 29.8711C29.309 27.7309 31.4549 24.5484 32.3 20.929C33.145 17.3097 32.6301 13.5059 30.8534 10.2414C29.0766 6.97692 26.1619 4.47939 22.6636 3.22392C19.1654 1.96846 15.3277 2.04266 11.8806 3.4324C8.43346 4.82215 5.61744 7.43048 3.96818 10.7612H6.40757C6.71699 10.7612 7.01373 10.8842 7.23253 11.1029C7.45132 11.3217 7.57424 11.6185 7.57424 11.9279C7.57424 12.2373 7.45132 12.5341 7.23253 12.7529C7.01373 12.9717 6.71699 13.0946 6.40757 13.0946H1.16667C0.857248 13.0946 0.560501 12.9717 0.341709 12.7529C0.122916 12.5341 0 12.2373 0 11.9279V6.35575C0 6.04634 0.122916 5.74959 0.341709 5.5308C0.560501 5.312 0.857248 5.18909 1.16667 5.18909C1.47609 5.18909 1.77283 5.312 1.99163 5.5308C2.21042 5.74959 2.33333 6.04634 2.33333 6.35575V8.87083C4.23316 5.5094 7.19343 2.87238 10.7512 1.37213C14.309 -0.128106 18.2636 -0.406964 21.9967 0.57917C25.7298 1.56531 29.0309 3.76083 31.3836 6.82238C33.7363 9.88394 35.0081 13.6389 35 17.5ZM16.3333 23.1917V18.5727C13.674 18.1391 11.6667 16.2536 11.6667 14C11.6667 11.7465 13.674 9.86103 16.3333 9.42744V8.16671C16.3333 7.85729 16.4563 7.56055 16.675 7.34176C16.8938 7.12296 17.1906 7.00005 17.5 7.00005C17.8094 7.00005 18.1062 7.12296 18.325 7.34176C18.5438 7.56055 18.6667 7.85729 18.6667 8.16671V9.42744C21.3261 9.86103 23.3333 11.7465 23.3333 14C23.3333 14.3095 23.2104 14.6062 22.9916 14.825C22.7728 15.0438 22.4761 15.1667 22.1667 15.1667C21.8573 15.1667 21.5605 15.0438 21.3417 14.825C21.1229 14.6062 21 14.3095 21 14C21 13.0067 20.0099 12.1371 18.6667 11.8083V16.4274C21.3261 16.861 23.3333 18.7465 23.3333 21C23.3333 23.2536 21.3261 25.1391 18.6667 25.5727V26.8334C18.6667 27.1428 18.5438 27.4395 18.325 27.6583C18.1062 27.8771 17.8094 28 17.5 28C17.1906 28 16.8938 27.8771 16.675 27.6583C16.4563 27.4395 16.3333 27.1428 16.3333 26.8334V25.5727C13.674 25.1391 11.6667 23.2536 11.6667 21C11.6667 20.6906 11.7896 20.3939 12.0084 20.1751C12.2272 19.9563 12.5239 19.8334 12.8333 19.8334C13.1428 19.8334 13.4395 19.9563 13.6583 20.1751C13.8771 20.3939 14 20.6906 14 21C14 21.9934 14.9901 22.863 16.3333 23.1917ZM18.6667 18.8083V23.1917C20.0099 22.863 21 21.9934 21 21C21 20.0067 20.0099 19.1371 18.6667 18.8083ZM16.3333 16.1917V11.8083C14.9901 12.1371 14 13.0067 14 14C14 14.9934 14.9901 15.863 16.3333 16.1917Z" fill="var(--color-secondary-4)"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_2783_6225">
                                                    <rect width="35" height="35" fill="white"/>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                    <div class="icon-box-content">
                                        <h5>Money Back Guarantee</h5>
                                        <p>Within 30 Days</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-12">
                                <div class="icon-box">
                                    <div class="icon-box-icon">
                                        <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M33.0611 14.5715C32.3624 14.1397 31.5845 14.0517 30.8984 14.1193V13.3984C30.8984 6.02937 24.8682 0 17.5 0C10.1309 0 4.10156 6.03025 4.10156 13.3984V14.1193C3.41551 14.0517 2.63758 14.1397 1.93888 14.5715C0.652285 15.3666 0 17.0419 0 19.5508C0 22.0638 0.653516 23.748 1.94243 24.5566C2.58269 24.9583 3.3304 25.0978 4.10156 25.0315V25.7715C4.10156 26.3378 4.56066 26.7969 5.12695 26.7969H9.22852C9.7948 26.7969 10.2539 26.3378 10.2539 25.7715V13.3984C10.2539 12.8321 9.7948 12.373 9.22852 12.373H6.19917C6.71925 6.5947 11.5886 2.05078 17.5 2.05078C23.4114 2.05078 28.2808 6.5947 28.8008 12.373H25.7715C25.2052 12.373 24.7461 12.8321 24.7461 13.3984V25.7715C24.7461 26.3378 25.2052 26.7969 25.7715 26.7969H28.8477V27.8223C28.8477 29.5185 27.4677 30.8984 25.7715 30.8984H22.4506C22.0273 29.705 20.8875 28.8477 19.5508 28.8477H17.5C15.8038 28.8477 14.4238 30.2276 14.4238 31.9238C14.4238 33.62 15.8038 35 17.5 35H19.5508C20.8875 35 22.0273 34.1426 22.4506 32.9492H25.7715C28.5985 32.9492 30.8984 30.6493 30.8984 27.8223C30.8984 26.5733 30.8984 25.842 30.8984 25.0314C31.6697 25.0977 32.4174 24.9581 33.0576 24.5565C34.3465 23.748 35 22.0638 35 19.5508C35 17.0419 34.3477 15.3666 33.0611 14.5715ZM4.10156 22.9675C3.77439 23.0244 3.36547 23.0284 3.03229 22.8193C2.39935 22.4223 2.05078 21.2615 2.05078 19.5508C2.05078 17.8565 2.39155 16.7092 3.01027 16.3202C3.34482 16.1098 3.76633 16.1248 4.10156 16.191V22.9675ZM8.20312 14.4238V24.7461H6.15234V14.4238H8.20312ZM19.5508 32.9492H17.5C16.9346 32.9492 16.4746 32.4892 16.4746 31.9238C16.4746 31.3584 16.9346 30.8984 17.5 30.8984H19.5508C20.1162 30.8984 20.5762 31.3584 20.5762 31.9238C20.5762 32.4892 20.1162 32.9492 19.5508 32.9492ZM28.8477 24.7461H26.7969V14.4238H28.8477V24.7461ZM31.975 22.8147C31.6436 23.0263 31.2302 23.0222 30.8984 22.9647V16.1911C31.2337 16.1249 31.6551 16.1099 31.9897 16.3203C32.6084 16.7092 32.9492 17.8565 32.9492 19.5508C32.9492 21.2545 32.6032 22.4137 31.975 22.8147Z" fill="var(--color-secondary-4)"/>
                                        </svg>
                                    </div>
                                    <div class="icon-box-content">
                                        <h5>Customer Support</h5>
                                        <p>Within 1 Business Day</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget m-t-25 m-t-sm-0">
                        <h4 class="widget-title">Related Books</h4>
                        <div class="row book-list-items-v3">
                            <div class="col-md-6 col-lg-12">
                                <div class="book-list-item">
                                    <div class="book-thumbnail">
                                        <a href="book-details.html">
                                            <img src="{{static_asset('frontend/img/books/book-thumbnail-small-1.jpg')}}" alt="Book Thumbnail">
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
                            </div>
                            <div class="col-md-6 col-lg-12">
                                <div class="book-list-item">
                                    <div class="book-thumbnail">
                                        <a href="book-details.html">
                                            <img src="{{static_asset('frontend/img/books/book-thumbnail-small-2.jpg')}}" alt="Book Thumbnail">
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
                            </div>
                            <div class="col-md-6 col-lg-12">
                                <div class="book-list-item">
                                    <div class="book-thumbnail">
                                        <a href="book-details.html">
                                            <img src="{{static_asset('frontend/img/books/book-thumbnail-small-3.jpg')}}" alt="Book Thumbnail">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== End Book Details Area ======-->

<!--====== Start Recent & On Sale Book Section ======-->
<section class="recent-on-sale-book-section color-bg-off-white p-t-75 p-b-55 p-t-sm-0 p-b-sm-50">
    <div class="container container-1278">
        <div class="row book-list-items-v3">
            <div class="col-xl-4 col-md-6 m-b-10" data-aos="fade-up" data-aos-delay="200">
                <div class="section-title-v4 m-b-20">
                    <h3>Recent Books</h3>
                </div>
                <div class="book-list-item">
                    <div class="book-thumbnail">
                        <a href="book-details.html">
                            <img src="{{static_asset('frontend/img/books/book-thumbnail-small-1.jpg')}}" alt="Book Thumbnail">
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
                            <img src="{{static_asset('frontend/img/books/book-thumbnail-small-2.jpg')}}" alt="Book Thumbnail">
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
                            <img src="{{static_asset('frontend/img/books/book-thumbnail-small-3.jpg')}}" alt="Book Thumbnail">
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
            </div>

            <div class="col-xl-4 col-md-6 m-b-10" data-aos="fade-up" data-aos-delay="400">
                <div class="section-title-v4 m-b-20">
                    <h3>On Sale</h3>
                </div>
                <div class="book-list-item">
                    <div class="book-thumbnail">
                        <a href="book-details.html">
                            <img src="{{static_asset('frontend/img/books/book-thumbnail-small-4.jpg')}}" alt="Book Thumbnail">
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
                            <img src="{{static_asset('frontend/img/books/book-thumbnail-small-5.jpg')}}" alt="Book Thumbnail">
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
                            <img src="{{static_asset('frontend/img/books/book-thumbnail-small-6.jpg')}}" alt="Book Thumbnail">
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
            </div>

            <div class="col-xl-4 col-md-6 m-b-10" data-aos="fade-up" data-aos-delay="600">
                <div class="section-title-v4 m-b-20">
                    <h3>Limited Stock</h3>
                </div>
                <div class="book-list-item">
                    <div class="book-thumbnail">
                        <a href="book-details.html">
                            <img src="{{static_asset('frontend/img/books/book-thumbnail-small-7.jpg')}}" alt="Book Thumbnail">
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
                            <img src="{{static_asset('frontend/img/books/book-thumbnail-small-8.jpg')}}" alt="Book Thumbnail">
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
                            <img src="{{static_asset('frontend/img/books/book-thumbnail-small-9.jpg')}}" alt="Book Thumbnail">
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
            </div>
        </div>
    </div>
</section>
<!--====== End Recent & On Sale Book Section ======-->

<!--====== Modal ======-->
<div class="read-book-modal modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="{{static_asset('frontend/img/books/book-preview.png')}}" alt="Book Screenshot">
            </div>
        </div>
    </div>
</div>

@endsection
