  @php use Illuminate\Support\Facades\Auth; @endphp
  <!--====== Start Header ======-->
  <header class="template-header course-item-active">
      <!-- Add "sticky-header" class for sticky menu -->
      <div class="header-topbar">
          <div class="container container-1278">
              <div class="row align-items-center justify-content-between">
                  <div class="col-sm-auto col-6">
                      <ul class="contact-info">
                          @if (!empty(setting('topbar_phone')))
                              <li><a href="tel:{{ str_replace(' ', '', setting('topbar_phone')) }}"><i
                                          class="fal fa-phone"></i>{{ setting('topbar_phone') }}</a></li>
                          @endif
                          @if (!empty(setting('topbar_email')))
                              <li><a href="mailto:{{ setting('topbar_email') }}"><i class="fal fa-envelope"></i>
                                      {{ setting('topbar_email') }}</a></li>
                          @endif
                          <li class="language-selection d-none d-sm-block">
                              <select name="language" id="language-selector">
                                  @foreach (app('languages') as $language)
                                      <option value="{{ $language->locale }}"
                                          data-url="{{ setLanguageRedirect($language->locale) }}"
                                          {{ app()->getLocale() == $language->locale ? ' selected' : '' }}>
                                          {{ $language->name }}</option>
                                  @endforeach
                              </select>
                          </li>
                      </ul>
                  </div>
                  <div class="col-sm-auto col-6">
                      <div class="header-topbar-right">
                          <ul>
                              @if (!auth()->check() || (auth()->check() && auth()->user()->user_type == 'student'))
                                    <li class="shopping-mini-cart">
                                        <a href="#" class="cart-btn">
                                            <i class="fal fa-shopping-bag"></i>
                                            <input type="text"
                                                class="badge {{ count($carts['courses']) + count($carts['books']) > 0 ? '' : 'd-none' }}"
                                                id="cart_iteam_no"
                                                value="{{ count($carts['courses']) + count($carts['books']) }}">
                                            {{-- <input type="text" class="badge {{ (count($carts['courses'])+count($carts['books']) > 0) ? '' :'d-none'}}" id="cart_iteam_no" value="{{ count($carts['courses'])+count($carts['books']) }}"> --}}
                                            {{-- <input type="text" class="badge {{ (count($carts['courses'])+count($carts['books']) > 0) ? '' :'d-none'}}" id="cart_iteam_no" value="{{ count($carts['courses'])+count($carts['books']) }}"> --}}
                                        </a>
                                    </li>
                              @endif
                              <li class="user-dropdown">
                                  <a href="#"><i class="fal fa-user"></i></a>
                                  <ul class="dropdown-list">
                                      @if (Auth::check())
                                          <li class="dropdown-list-item">
                                              <a href="{{ route('my-profile') }}"><i
                                                      class="far fa-user"></i>{{ __('my_profile') }}</a>
                                          </li>
                                          <li class="dropdown-list-item">
                                              <a href="{{ route('wallet') }}"><i
                                                      class="fas fa-clipboard-list"></i>{{ __('my_account') }}</a>
                                          </li>
                                          <li class="dropdown-list-item">
                                              <form method="POST" action="{{ route('student.logout') }}"> @csrf
                                                  <a href="{{ route('student.logout') }}"
                                                      onclick="event.preventDefault(); this.closest('form').submit();"><i
                                                          class="fas fa-sign-out-alt"></i>{{ __('logout') }}</a>
                                              </form>
                                          </li>
                                      @else
                                          <li class="dropdown-list-item">
                                              <a href="{{ route('login') }}"><i
                                                      class="fas fa-clipboard-list"></i>{{ __('login') }}</a>
                                          </li>
                                      @endif
                                  </ul>
                              </li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="header-navigation p-t-lg-20 p-b-lg-20 sticky-header {{ isHome() ? '' : 'header-shadow' }}">
          <div class="container container-1278">
              <div class="header-inner">
                  <div class="header-left">
                      <div class="brand-logo">
                          @if (config('app.demo_mode'))
                              @php
                                  $logo = isHome() ? get_media('images/default/logo/' . setting('theme_color') . '/logo-white-text.png') : get_media('images/default/logo/' . setting('theme_color') . '/logo-black-text.png');
                                  $sticky_logo = get_media('images/default/logo/' . setting('theme_color') . '/logo-black-text.png');
                              @endphp
                              <a href="{{ route('home') }}" class="main-logo">
                                  <img src="{{ $logo }}" alt="logo">
                              </a>
                              <a href="{{ route('home') }}" class="sticky-logo">
                                  <img src="{{ $sticky_logo }}" alt="logo">
                              </a>
                          @else
                              <a href="{{ route('home') }}" class="main-logo">
                                  <img src="{{ setting('dark_logo') && @is_file_exists(setting('dark_logo')['original_image']) ? get_media(setting('dark_logo')['original_image']) : get_media('images/default/logo/logo-green-black.png') }}"
                                      alt="logo">
                              </a>
                              <a href="{{ route('home') }}" class="sticky-logo">
                                  <img src="{{ setting('dark_logo') && @is_file_exists(setting('dark_logo')['original_image']) ? get_media(setting('dark_logo')['original_image']) : get_media('images/default/logo/logo-green-black.png') }}"
                                      alt="logo">
                              </a>
                          @endif
                      </div>
                      <nav class="nav-menu d-none d-xl-block">
                          <ul>
                              @if (setting('show_default_courses_link') != 0)
                                  @php
                                      $maxCategoriesPerColumn = 5;
                                      $columns = $categories->chunk($maxCategoriesPerColumn);
                                      if ($columns->count() > 4):
                                          $columns = $columns->chunk(ceil($columns->count() / 4));
                                      endif;
                                  @endphp
                                  <li class="course-active">
                                      <a data-bs-toggle="dropdown" href="javascript:void(0)">{{ __('course') }}</a>
                                      <div class="mega-menu dropdown-menu">
                                          <h6 class="border-bottom-soft-white fw-semibold m-b-10 p-b-10 m-l-25 m-r-25">
                                              {{ __('course_by_categories') }}</h6>
                                          <div class="row g-0">
                                              @foreach ($columns as $columnSet)
                                                  @if ($loop->index < 4)
                                                      <div class="col">
                                                          <ul class="sub-menu">
                                                              @foreach ($columnSet as $category)
                                                                  <li>
                                                                    <a href="{{ route('courses') }}?category_ids={{ $category->id }}">{{ $category->lang_title }}</a>
                                                                  </li>
                                                              @endforeach
                                                          </ul>
                                                      </div>
                                                  @endif
                                              @endforeach
                                          </div>
                                      </div>
                                  </li>
                              @endif
                              {{-- @if (config('app.demo_mode'))
                                <li>
                                    <a href="#" data-bs-toggle="dropdown">Home</a>
                                    <ul class="dropdown-menu sub-menu">
                                        <li><a href="{{url('/')}}">{{ __('home1')}}</a></li>
                                        <li><a href="{{url('/home2')}}">{{ __('home2')}}</a></li>
                                        <li><a href="{{url('/home3')}}">{{ __('home3')}}</a></li>
                                    </ul>
                                </li>
                            @endif --}}
                              @if (is_array(headerFooterMenu('header_menu', App::getLocale())))
                                  @foreach (headerFooterMenu('header_menu', App::getLocale()) as $main_menu)
                                      <li class="{{ url($main_menu['url']) == url()->full() ? 'active' : '' }}">
                                          {{-- <a href="{{url($main_menu['url'])}}" @if (count($main_menu) > 3 && $main_menu['mega_menu'] != 'true') data-bs-toggle="dropdown" @endif>{{ $main_menu['label'] }}</a> --}}
                                          <a href="{{ url($main_menu['url']) }}"
                                              data-bs-toggle="dropdown">{{ $main_menu['label'] }}</a>
                                          @if (count($main_menu) > 3)
                                              @if ($main_menu['mega_menu'] == 'true')
                                                  @php
                                                      $maxSubmenuPerColumn = 5;
                                                      $megaMenuColumns = collect(array_slice($main_menu, 3))->chunk($maxSubmenuPerColumn);
                                                      if ($megaMenuColumns->count() > 4):
                                                          $megaMenuColumns = $megaMenuColumns->chunk(ceil($megaMenuColumns->count() / 4));
                                                      endif;
                                                  @endphp
                                                  <div class="mega-menu dropdown-menu">
                                                      <div class="row g-0">
                                                          @foreach ($megaMenuColumns as $megaMenuColumn)
                                                              @if ($loop->index < 4)
                                                                  <div class="col">
                                                                      <ul class="sub-menu">
                                                                          @foreach ($megaMenuColumn as $subMenu)
                                                                              <li><a
                                                                                      href="{{ url($subMenu['url']) }}">{{ $subMenu['label'] }}</a>
                                                                              </li>
                                                                          @endforeach
                                                                      </ul>
                                                                  </div>
                                                              @endif
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              @else
                                                  <ul class="sub-menu">
                                                      @foreach (array_slice($main_menu, 3) as $submenu)
                                                          <li><a
                                                                  href="{{ url($submenu['url']) }}">{{ $submenu['label'] }}</a>
                                                          </li>
                                                      @endforeach
                                                  </ul>
                                              @endif
                                          @endif
                                      </li>
                                  @endforeach
                              @endif
                          </ul>
                      </nav>
                  </div>
                  <div class="header-right">
                      <ul class="header-extra">
                          <li class="search-bar d-none d-sm-block">
                              <form class="" action="{{ route('courses') }}" method="GET">
                                  <input type="text" placeholder="{{ __('search') }}" name="search"
                                      class="searchbox-input header_search" data-url="{{ route('header.search') }}">
                                  <div class="quick-search-result">

                                  </div>
                                  <button class="search-btn" type="submit">
                                      <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                          xmlns="http://www.w3.org/2000/svg">
                                          <path
                                              d="M16.4255 17.6289C16.2683 17.6289 16.1173 17.5685 15.9964 17.4537L12.9871 14.4383C11.5247 15.6952 9.70583 16.3297 7.88089 16.3297C5.86863 16.3297 3.85636 15.5623 2.32753 14.0334C0.84099 12.5469 0.0252075 10.5769 0.0252075 8.48006C0.0252075 6.38319 0.84099 4.40719 2.32753 2.92669C5.39124 -0.137023 10.3766 -0.137023 13.4343 2.92669C16.3529 5.84538 16.4859 10.5044 13.8391 13.5863L16.8545 16.6016C17.0902 16.8373 17.0902 17.218 16.8545 17.4537C16.7336 17.5685 16.5826 17.6289 16.4255 17.6289ZM12.5822 3.77873C11.289 2.48557 9.58497 1.83294 7.88089 1.83294C6.17681 1.83294 4.47878 2.47952 3.17957 3.77873C1.92266 5.03564 1.23377 6.70346 1.23377 8.48006C1.23377 10.2567 1.92266 11.9245 3.17957 13.1814C5.77194 15.7738 9.98984 15.7738 12.5822 13.1814C15.1746 10.589 15.1746 6.37111 12.5822 3.77873Z"
                                              fill="#333333" />
                                      </svg>
                                  </button>
                              </form>
                          </li>
                          @if (Auth::check())
                              <li class="d-none d-md-block">
                                  <a href="{{ route('course.purchase') }}"
                                      class="template-btn">{{ __('start_a_new_course') }}</a>
                              </li>
                          @else
                              <li class="d-none d-md-block">
                                  <a href="{{ route('login') }}"
                                      class="template-btn">{{ __('start_a_new_course') }}</a>
                              </li>
                          @endif
                          <li class="d-xl-none d-xl-none">
                              <a href="#" class="navbar-toggler text-align-end d-inline-block">
                                  <span></span>
                                  <span></span>
                                  <span></span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
      <!--====== Mobile Slide Menu ======-->
      <div class="mobile-slide-panel">
          <div class="panel-overlay"></div>
          <div class="panel-inner">
              <div class="mobile-logo">
                  <a href="{{ url('/') }}">
                      <img src="{{ setting('dark_logo') && @is_file_exists(setting('dark_logo')['original_image']) ? get_media(setting('dark_logo')['original_image']) : get_media('images/default/logo/logo-green-black.png') }}"
                          alt="logo">
                  </a>
              </div>
              <nav class="mobile-menu">
                  <ul>
                      @if (is_array(headerFooterMenu('header_menu')))
                          @foreach (headerFooterMenu('header_menu') as $main_menu)
                              <li>
                                  <a href="{{ url($main_menu['url']) }}"
                                      @if (count($main_menu) > 3) data-bs-toggle="dropdown" @endif>{{ $main_menu['label'] }}</a>
                                  @if (count($main_menu) > 3)
                                      <ul class="sub-menu">
                                          @foreach (array_slice($main_menu, 3) as $submenu)
                                              <li><a href="{{ url($submenu['url']) }}">{{ $submenu['label'] }}</a>
                                              </li>
                                          @endforeach
                                      </ul>
                                  @endif
                              </li>
                          @endforeach
                      @endif
                  </ul>
              </nav>
              <a href="#" class="panel-close">
                  <i class="fal fa-times"></i>
              </a>
          </div>
      </div>
      <!--====== Off Canvas Cart Slide ======-->
      <div class="off-canvas-wrapper">
          <div class="canvas-overlay"></div>
          <div class="canvas-inner">
              @include('frontend.cart_component')
          </div>
      </div>
  </header>
  <!--====== End Header ======-->
