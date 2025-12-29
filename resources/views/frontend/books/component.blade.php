<div class="col-xl-3 col-md-4 col-sm-6 col-xs-6">
    <div class="book-list-item text-center m-b-30">
        <div class="book-thumbnail">
            <a href="#">
                <img src="{{ getFileLink('227x340',$book->thumbnail) }}"
                     alt="{{ $book->title }}">
            </a>
        </div>
        <div class="book-text-content">
            <h6><a href="#">{{ $book->title }}</a></h6>
            @if($book->is_free == 1 || $book->price == 0)
                <div class="book-price">{{ __('free') }}</div>
            @elseif($book->is_discount == 1)
                <div class="book-price">
                    <small>{{ get_price($book->price, userCurrency()) }}</small>
                    {{ get_price($book->discount_amount, userCurrency()) }}
                </div>
            @else
                <div class="book-price">
                    {{ get_price($book->price, userCurrency()) }}
                </div>
            @endif
            @if($book->reviews_avg_rating > 0)
                <div class="rating-review books_rating all-rating star-3"
                     data-rating="{{ round($book->reviews_avg_rating,2) }}"></div>
            @endif
        </div>
    </div>
</div>
