@extends('frontend.layouts.master')
@section('title', __('about'))
@section('content')
<!--====== Start Checkout Section ======-->
<section class="checkout-section p-t-50 p-t-sm-30 p-b-65 p-b-sm-50">
    <div class="container container-1278">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="section-title-with-progress-bar m-b-sm-45 m-b-70 text-center">
                    <h4>Checkout</h4>
                    <p>Buy $299.00 more to enjoy FREE Shipping</p>
                    <div class="progress-bar-wrapper">
                        <div class="progress-bar-container">
                            <div class="progress-bar" style="width: 195px"></div>
                            <div class="indicator" style="left: 190px">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 m-b-50">
                <div class="checkout-address-details">
                    <div class="section-title-v3 color-dark m-b-15">
                        <h6>Shipping Address</h6>
                    </div>
                    <div class="checkout-accordion">
                        <div class="accordion accordion-flush" id="checkoutShippingAddress">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="pickhub-point-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pickhub-point-collapseOne" aria-expanded="false" aria-controls="pickhub-point-collapseOne">
                                        <label>
                                            <input type="checkbox" value="">
                                            <span>Use PickHub Point</span>
                                        </label>
                                    </button>
                                </h2>
                                <div id="pickhub-point-collapseOne" class="accordion-collapse collapse" aria-labelledby="pickhub-point-headingOne" data-bs-parent="#checkoutShippingAddress">
                                    <div class="accordion-body">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium impedit enim recusandae repudiandae minima dolor tempore repellat hic incidunt cumque, iure mollitia animi temporibus ut odio odit nostrum sapiente voluptatibus omnis voluptatum id doloribus, nam tenetur. Itaque voluptate optio repellendus?
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="pickhub-point-headingTwo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#pickhub-point-collapseTwo" aria-expanded="false" aria-controls="pickhub-point-collapseTwo">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                            <span>Default Address</span>
                                        </label>
                                    </button>
                                </h2>
                                <div id="pickhub-point-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="pickhub-point-headingTwo" data-bs-parent="#checkoutShippingAddress">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="shipping_address_selector d-block m-b-sm-20">
                                                    <div class="address-card">
                                                        <div class="justify-content-between d-flex">
                                                            <div class="text d-flex">
                                                                <div class="float-left">
                                                                    <input type="radio" name="selected_address" class="form-check-input" checked>
                                                                </div>
                                                                <div class="address-right">
                                                                    <ul >
                                                                        <li>Name : User Address</li>
                                                                        <li>Email : user@gmail.com</li>
                                                                        <li>Phone : +880 1700000000</li>
                                                                        <li>Country : Bangladesh</li>
                                                                        <li>State : Dhaka District</li>
                                                                        <li>City : Gazipur</li>
                                                                        <li>Postal Code: 1229</li>
                                                                        <li>Street Address : Clients Address</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <ul class="action">
                                                                <li><a href="#">Edit</a></li>
                                                                <li><a href="#">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="shipping_address_selector d-block">
                                                    <div class="address-card">
                                                        <div class="justify-content-between d-flex">
                                                            <div class="text d-flex">
                                                                <div class="float-left">
                                                                    <input type="radio" name="selected_address" class="form-check-input">
                                                                </div>
                                                                <div class="address-right">
                                                                    <ul >
                                                                        <li>Name : User Address</li>
                                                                        <li>Email : user@gmail.com</li>
                                                                        <li>Phone : +880 1700000000</li>
                                                                        <li>Country : Bangladesh</li>
                                                                        <li>State : Dhaka District</li>
                                                                        <li>City : Gazipur</li>
                                                                        <li>Postal Code: 1229</li>
                                                                        <li>Street Address : Clients Address</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <ul class="action">
                                                                <li><a href="#">Edit</a></li>
                                                                <li><a href="#">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="checkout-billing m-t-50">
                    <div class="section-title-v3 color-dark m-b-15">
                        <h6>Billing Address</h6>
                    </div>
                    <div class="checkout-accordion">
                        <div class="accordion accordion-flush" id="checkoutBillingAddress">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="checkout-billing-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#checkout-billing-collapseOne" aria-expanded="false" aria-controls="checkout-billing-collapseOne">
                                        <label>
                                            <input type="checkbox" value="">
                                            <span>Billing Address is same as Shipping Address</span>
                                        </label>
                                    </button>
                                </h2>
                                <div id="checkout-billing-collapseOne" class="accordion-collapse collapse" aria-labelledby="checkout-billing-headingOne" data-bs-parent="#checkoutBillingAddress">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="shipping_address_selector d-block m-b-sm-20">
                                                    <div class="address-card">
                                                        <div class="justify-content-between d-flex">
                                                            <div class="text d-flex">
                                                                <div class="float-left">
                                                                    <input type="radio" name="selected_billing_address" class="form-check-input" checked>
                                                                </div>
                                                                <div class="address-right">
                                                                    <ul >
                                                                        <li>Name : User Address</li>
                                                                        <li>Email : user@gmail.com</li>
                                                                        <li>Phone : +880 1700000000</li>
                                                                        <li>Country : Bangladesh</li>
                                                                        <li>State : Dhaka District</li>
                                                                        <li>City : Gazipur</li>
                                                                        <li>Postal Code: 1229</li>
                                                                        <li>Street Address : Clients Address</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <ul class="action">
                                                                <li><a href="#">Edit</a></li>
                                                                <li><a href="#">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="shipping_address_selector d-block">
                                                    <div class="address-card">
                                                        <div class="justify-content-between d-flex">
                                                            <div class="text d-flex">
                                                                <div class="float-left">
                                                                    <input type="radio" name="selected_billing_address" class="form-check-input">
                                                                </div>
                                                                <div class="address-right">
                                                                    <ul >
                                                                        <li>Name : User Address</li>
                                                                        <li>Email : user@gmail.com</li>
                                                                        <li>Phone : +880 1700000000</li>
                                                                        <li>Country : Bangladesh</li>
                                                                        <li>State : Dhaka District</li>
                                                                        <li>City : Gazipur</li>
                                                                        <li>Postal Code: 1229</li>
                                                                        <li>Street Address : Clients Address</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <ul class="action">
                                                                <li><a href="#">Edit</a></li>
                                                                <li><a href="#">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="checkout-billing-headingTwo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#checkout-billing-collapseTwo" aria-expanded="false" aria-controls="checkout-billing-collapseTwo">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                            <span>Default Address</span>
                                        </label>
                                    </button>
                                </h2>
                                <div id="checkout-billing-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="checkout-billing-headingTwo" data-bs-parent="#checkoutBillingAddress">
                                    <div class="accordion-body">
                                        <form action="#" class="user-form p-0">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Janathan Spectular">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="gopal@gmail.com">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="phone">Phone</label>
                                                    <input type="tel" class="form-control" name="phone" id="phone" placeholder="01952312487">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="phone">Country</label>
                                                    <select name="language">
                                                        <option value="en"> Argentina</option>
                                                        <option value="bn"> Bangladesh</option>
                                                        <option value="bn"> Belgium</option>
                                                        <option value="bn"> Belarus</option>
                                                        <option value="bn"> Germany</option>
                                                        <option value="bn"> United States</option>
                                                        <option value="bn"> Spain</option>
                                                        <option value="bn"> Turkey</option>
                                                        <option value="bn"> New Zealand</option>
                                                        <option value="bn"> Finland</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="phone">State</label>
                                                    <select name="language">
                                                        <option value="en"> Buenos Aires</option>
                                                        <option value="bn"> Dhaka</option>
                                                        <option value="bn"> Brussels</option>
                                                        <option value="bn"> Minsk</option>
                                                        <option value="bn"> Berlin</option>
                                                        <option value="bn"> Washington D.C.	</option>
                                                        <option value="bn"> Madrid</option>
                                                        <option value="bn"> Ankara</option>
                                                        <option value="bn"> Wellington</option>
                                                        <option value="bn"> Helsinki</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="phone">City</label>
                                                    <select name="language">
                                                        <option value="en"> Buenos Aires</option>
                                                        <option value="bn"> Dhaka</option>
                                                        <option value="bn"> Brussels</option>
                                                        <option value="bn"> Minsk</option>
                                                        <option value="bn"> Berlin</option>
                                                        <option value="bn"> Washington D.C.	</option>
                                                        <option value="bn"> Madrid</option>
                                                        <option value="bn"> Ankara</option>
                                                        <option value="bn"> Wellington</option>
                                                        <option value="bn"> Helsinki</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="ps_code">Postal Code</label>
                                                    <input type="number" class="form-control" name="ps_code" id="ps_code" placeholder="1229">
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="address">Address</label>
                                                    <input type="text" class="form-control" name="address" id="address" placeholder="Lake City Concord, Khilkhet, Dhaka-1229">
                                                </div>
                                                <div class="col-12 text-end">
                                                    <button class="template-btn m-b-10 w-auto d-inline-block" type="submit">Update Profile</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 m-b-50">
                <div class="checkout-sidebar">
                    <div class="widget m-b-30 cart-product-table">
                        <h6 class="border-bottom-soft-white p-b-10 fw-semibold m-b-20">Order Summary</h6>
                        <div class="cart-product border-bottom-soft-white p-b-15 m-b-15">
                            <div class="book-thumbnail">
                                <a href="book-details.html">
                                    <img src="assets/img/books/book-thumbnail-small-10.jpg" alt="Book Thumbnail">
                                </a>
                            </div>
                            <div class="book-text-content">
                                <h6><a href="book-details.html">The Phychology of money</a></h6>
                                <p class="author">By <a href="#">Morgan Housel</a></p>
                                <p class="file-type">Hard Copy</p>
                                <div class="quantity-price-wrapper">
                                    <span class="quantity">1 ×</span>
                                    <span class="price">$115.50</span>
                                </div>
                            </div>
                        </div>
                        <div class="cart-product border-bottom-soft-white p-b-15 m-b-15">
                            <div class="book-thumbnail">
                                <a href="book-details.html">
                                    <img src="assets/img/books/book-thumbnail-small-10.jpg" alt="Book Thumbnail">
                                </a>
                            </div>
                            <div class="book-text-content">
                                <h6><a href="book-details.html">The Phychology of money</a></h6>
                                <p class="author">By <a href="#">Morgan Housel</a></p>
                                <p class="file-type">Hard Copy</p>
                                <div class="quantity-price-wrapper">
                                    <span class="quantity">1 ×</span>
                                    <span class="price">$115.50</span>
                                </div>
                            </div>
                        </div>
                        <div class="cart-product border-bottom-soft-white p-b-15 m-b-15">
                            <div class="book-thumbnail">
                                <a href="book-details.html">
                                    <img src="assets/img/books/book-thumbnail-small-10.jpg" alt="Book Thumbnail">
                                </a>
                            </div>
                            <div class="book-text-content">
                                <h6><a href="book-details.html">The Phychology of money</a></h6>
                                <p class="author">By <a href="#">Morgan Housel</a></p>
                                <p class="file-type">Hard Copy</p>
                                <div class="quantity-price-wrapper">
                                    <span class="quantity">1 ×</span>
                                    <span class="price">$115.50</span>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="see-all-btn">See all</a>
                    </div>
                    <div class="cart-product-calculation m-t-sm-15">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>$ 514.75</td>
                                </tr>
                                <tr>
                                    <td>Tax</td>
                                    <td>$ 0.00</td>
                                </tr>
                                <tr>
                                    <td>Discount</td>
                                    <td>$ 0.00</td>
                                </tr>
                                <tr>
                                    <td>Shipping Cost</td>
                                    <td>$ 10.00</td>
                                </tr>
                                <tr>
                                    <td>Coupon Discount</td>
                                    <td>$ 0.00</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>$ 524.75</td>
                                </tr>
                            </tbody>
                        </table>
                        <form action="#" class="coupon-input">
                            <input type="text" class="form-control" placeholder="Apply Coupon Code">
                            <button type="submit" class="button" name="apply_coupon" value="Apply">Apply</button>
                        </form>
                        <a href="#" class="template-btn d-block text-center">Proceed to Payment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== End Checkout Section ======-->
@endsection
