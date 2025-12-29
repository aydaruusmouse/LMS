
@php(
$sub_total = 0
)
@if(count($carts['courses']) > 0)
    <h4 class="canvas-inner-title"><span
            class="total_items">{{ count($carts['courses']) }} {{__('courses')}}</span></h4>
    @php(

 $sub_total += $carts['courses']->sum(function($course) {
            return $course->is_free ? 0 : $course->price;
        })
)
    @foreach($carts['courses'] as $course)
        <div class="cart-product" id="cart_{{$course->id}}">
            <div class="thumb">
                <a href="{{ route('course.details', $course->slug) }}"><img
                        src="{{ getFileLink('80x80', $course->image) }}" alt="{{ $course->title }}"></a>
            </div>
            <div class="content">
                <a href="{{ route('course.details', $course->slug) }}"
                   class="title">{{ $course->title  }}</a>
                <div class="quantity-price-wrapper">
                    <span class="quantity">1 ×</span>
                    <span class="price">{{ $course->is_free ? __('free') : get_price($course->price, userCurrency()) }}</span>
                </div>
            </div>
            <a href="{{ url("item/remove?id=$course->id&type=course") }}" data-id="{{ $course->id }}" data-type="course"
               class="remove-from-cart" data-toggle="tooltip" onclick="return confirm('{{__('are_you_sure')}}')"
               data-original-title="{{ __('Delete') }}"><i class="fal fa-times"></i>
            </a>
        </div>
    @endforeach
@endif

@if(count($carts['books']) > 0)
    <h4 class="canvas-inner-title"><span class="total_items">{{ count($carts['books']) }} {{__('books')}}</span>
    </h4>
    @php(
    $sub_total += $carts['books']->sum('price')
)
    @foreach($carts['books'] as $book)
        <div class="cart-product" id="cart_{{$book->id}}">
            <div class="thumb">
                <a href="#"><img src="{{ getFileLink('80x80', $book->thumbnail) }}" alt="product"></a>
            </div>
            <div class="content">
                <a href="#" class="title">{{ $book->title  }}</a>
                <div class="quantity-price-wrapper">
                    <span class="quantity">1 ×</span>
                    <span
                        class="price">{{ $book->is_free ? __('free') : get_price($book->price, userCurrency()) }}</span>
                </div>
            </div>
            <a href="{{ url("item/remove?id=$book->id&type=book") }}" data-id="{{ $book->id }}" data-type="course"
               class="remove-from-cart delete_row" data-toggle="tooltip"
               data-original-title="{{ __('Delete') }}"><i class="fal fa-times"></i>
            </a>
        </div>
    @endforeach
@endif

@if(count($carts['courses']) == 0 && count($carts['books']) == 0)
    <div class="cart-product">
        <div class="content">
            <div class="quantity-price-wrapper">
                <span class="quantity text-danger">{{__('no_items_in_cart')}}</span>
            </div>
        </div>
    </div>
@endif
<div class="cart-footer">
    <div class="subtotal-wrapper">
        <h4 class="subtotal-title">{{__('subtotal')}}</h4>
        <span class="subtotal">{{ get_price($sub_total, userCurrency()) }}</span>
    </div>
    <ul class="cart-btns">
        <li><a href="{{ route('cart.view') }}" class="template-btn">{{__('view_cart')}}</a></li>

        @if (intval(substr(get_price($sub_total, userCurrency()),1)) > 0)
        <li><a href="{{ route('checkout')  }}" class="template-btn bordered-btn-secondary">{{__('checkout')}}</a></li>
        @endif
    </ul>
</div>
<a href="#" class="canvas-close">
    <i class="fal fa-times"></i>
</a>


