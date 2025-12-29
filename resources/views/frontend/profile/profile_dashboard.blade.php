@extends('frontend.layouts.master')
@section('title', __('profile_dashboard'))
@section('content')
    <!--====== Start Profile Dashboard Section ======-->
    <section class="profile-dashboard-section p-t-50 p-b-80 p-b-md-50 p-t-sm-30">
        <div class="container container-1278">
            <div class="row">
                @include('frontend.profile.sidebar')
                <div class="col-md-8">
                    <div class="dashboard-wrapper">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title-v3 color-dark m-b-40 m-b-sm-15">
                                    <h3>{{__('dashboard') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row icon-boxes-v4 gx-3 gx-lg-4 m-b-20 m-b-md-15">
                            <div class="col-xl-4 col-md-6 col-6">
                                <div class="dboard-icon-box">
                                    <a href="{{ route('course.purchase') }}">
                                        <div class="icon-box">
                                            <div class="icon-box-icon box-bg-clr-1">
                                                <img class="icon-clr"
                                                     src="{{ static_asset('frontend/img/icons/book-2.svg') }}"
                                                     alt="book">
                                            </div>
                                            <div class="icon-box-content">
                                                <h5>{{ $purchased_course->total() }}</h5>
                                                <p>{{__('purchased_course') }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @if(addon_is_activated('book_store'))
                                <div class="col-xl-4 col-md-6 col-6">
                                    <div class="dboard-icon-box">
                                        <a href="{{ route('book.purchase') }}">
                                            <div class="icon-box">
                                                <div class="icon-box-icon box-bg-clr-2">
                                                    <img src="{{ static_asset('frontend/img/icons/bag.svg') }}"
                                                         alt="bag">
                                                </div>
                                                <div class="icon-box-content">
                                                    <h5>{{ $purchased_book }}</h5>
                                                    <p>{{__('purchased_books') }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            <div class="col-xl-4 col-md-6 col-6">
                                <div class="dboard-icon-box">
                                    <a href="{{ route('my-assignment') }}">
                                        <div class="icon-box">
                                            <div class="icon-box-icon box-bg-clr-3">
                                                <img src="{{ static_asset('frontend/img/icons/file.svg') }} "
                                                     alt="file">
                                            </div>
                                            <div class="icon-box-content">
                                                <h5>{{ $assignment }}</h5>
                                                <p>{{__('due_assignment') }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-6">
                                <div class="dboard-icon-box">
                                    <a href="{{ route('course.wishlist') }}">
                                        <div class="icon-box">
                                            <div class="icon-box-icon box-bg-clr-4">
                                                <img src="{{ static_asset('frontend/img/icons/heart.svg') }} "
                                                     alt="heart">
                                            </div>
                                            <div class="icon-box-content">
                                                <h5>{{ $course_wishlist }}</h5>
                                                <p>{{__('course') }} {{__('wishlist') }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @if(addon_is_activated('book_store'))
                                <div class="col-xl-4 col-md-6 col-6">
                                    <div class="dboard-icon-box">
                                        <a href="{{ route('book.wishlist') }}">
                                            <div class="icon-box">
                                                <div class="icon-box-icon box-bg-clr-5">
                                                    <img src="{{ static_asset('frontend/img/icons/heart.svg') }} "
                                                         alt="heart">
                                                </div>
                                                <div class="icon-box-content">
                                                    <h5>{{ $book_wishlist }}</h5>
                                                    <p>{{__('book_wishlist') }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            <div class="col-xl-4 col-md-6 col-sm-6">
                                <div class="dboard-icon-box">
                                    <a href="{{ route('meetings') }}">
                                        <div class="icon-box">
                                            <div class="icon-box-icon box-bg-clr-6">
                                                <img src="{{ static_asset('frontend/img/icons/video-chat.svg') }} "
                                                     alt="video chat">
                                            </div>
                                            <div class="icon-box-content">
                                                <h5>{{ $total_meeting }}</h5>
                                                <p>{{__('total_meeting') }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row balance-box-v2 m-b-20 m-b-sm-30">
                            @if(setting('wallet_system'))
                                <div class="col-lg-6">
                                    <div class="balance-box m-b-20">
                                        <div class="balance-box-content">
                                            <h6>{{__('available_balance') }}</h6>
                                            <h4>{{ $balance }}</h4>
                                        </div>
                                        <div class="balance-box-icon">
                                            <img src="{{ static_asset('frontend/img/icons/wallet.svg') }} "
                                                 alt="Wallet">
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-lg-6">
                                <div class="user-intro m-b-20">
                                    <div class="user-intro-header">
                                        <div class="user-thumb">
                                            <img src="{{ getFileLink('80x80', Auth()->user()->images) }}"
                                                 alt="Profile user">
                                        </div>
                                        <div class="user-info">
                                            <h4>{{ Auth()->user()->first_name }} {{ Auth()->user()->last_name }}</h4>
                                            <span>{{__('student') }}</span>
                                        </div>
                                        <a href="{{ route('edit.profile') }}"
                                           class="edit-profile ms-auto align-self-start">{{__('edit') }}</a>
                                    </div>

                                    <ul class="user-contact-info">
                                        <li><a href="{{ auth()->user()->phone }}"><i
                                                    class="fal fa-phone"></i>{{ auth()->user()->phone }}</a></li>
                                        <li><a href="{{ auth()->user()->email }}"><i
                                                    class="fal fa-envelope"></i> {{ auth()->user()->email }}</a></li>
                                        <li><i class="fal fa-map-marker-alt"></i> {{ auth()->user()->address }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @if(addon_is_activated('book_store'))
                            <div class="pending-order">
                                <h4 class="title">{{__('recent_orders') }}</h4>
                                @if(count($purchased_course)>0)
                                    @foreach($purchased_course as $book)
                                        <div class="book-list-items-v3 g-0">
                                            <div class="book-list-item shadow-none">
                                                <div class="book-thumbnail">
                                                    <a href="#">
                                                        <img src="{{ getFileLink('110x150',$book->thumbnail) }}"
                                                             alt="{{ $book->title }}">
                                                    </a>
                                                </div>
                                                <div class="book-text-content">
                                                    <h6><a href="#">{{ $book->title }}</a></h6>
                                                    <p class="author">{{__('by') }} <a
                                                            href="#">{{ $book->user->first_name }}</a></p>
                                                    <p class="book-price">
                                                        <small>{{ get_price($book->price, userCurrency()) }}</small> {{ get_price($book->price, userCurrency()) }}
                                                    </p>
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
                                                <div class="view-order align-self-end m-b-10">
                                                    <a href="#" class="template-btn">View Order</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    @include('frontend.not_found',$data=['title'=> 'Order'])
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Profile Dashboard Section ======-->
@endsection
