@foreach($books as $book)
    <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-4">
        <div class="instructor-book-item mb-4">
            <div class="instructor-book-thumb">
                <a href="#">
                    <img
                        src="{{ getFileLink('110x150',$book->thumbnail) }}"
                        alt="{{ $book->title }}">
                </a>
            </div>
            <div class="instructor-book-content">
                <h3>{{ $book->title }}</h3>
                <ul class="course-item-info justify-content-end">
                    <li class="rating-review">
                        <span class="total-review"><i class="las la-star"></i> {{ number_format($book->reviews_avg_rating, 2) }}</span>
                    </li>
                </ul>
                <div class="book-price">
                    <h5>{{ get_price($book->price, userCurrency()) }}</h5>
                    <span class="icon"> <i class="las la-shopping-cart"></i> </span>
                </div>
            </div>
        </div>
    </div>
@endforeach
