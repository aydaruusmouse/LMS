<nav class="navbar navbar-top navbar-expand-lg bg-body-tertiary py-20 bg-white sticky-top">
    <div class="container-fluid g-5">
        <span class="sidebar-toggler">
            <span class="icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 6H3" stroke="#7E7F92" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path d="M21 12H3" stroke="#7E7F92" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path d="M18 18H3" stroke="#7E7F92" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </svg>
            </span>
        </span>
        <a class="navbar-brand ms-auto d-none" href="{{ url('/') }}">
            <img src="{{ get_media('admin/img/logo/logo-mini.png') }}" alt="Logo">
        </a>

        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="las la-ellipsis-v"></span>
        </button>
        <div class="collapse navbar-collapse navbar-content px-lg-20 navbar-respons" id="navbarScroll">
            <div class="navbar-left-content me-lg-auto d-flex align-items-center gap-20">

                <ul class="dashboard-btn d-flex align-items-center gap-lg-20 gap-sm-2">
                    <li>
                        <a href="{{ route('cache.clear') }}"
                            class="d-flex align-items-center button-default default-circle-btn gap-2">
                            <i class="las la-hdd"></i>
                            <span>{{ __('clear_cache') }}</span>
                        </a>
                    </li>
                    <li class="dropdown add-new-page">
                        <a href="#"
                            class="dropdown-toggle d-flex align-items-center button-default default-circle-btn gap-2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="las la-plus"></i>
                            <span>{{ __('add_new') }}</span>
                        </a>

                        <ul class="dropdown-menu simplebar">
                            @can('courses.create')
                                <li>
                                    <a class="dropdown-item" href="{{ route('courses.create') }}">
                                        <i class="lab la-readme"></i>
                                        <span>{{ __('add_course') }}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('categories.create')
                                <li>
                                    <a class="dropdown-item" href="{{ route('category.create') }}">
                                        <i class="las la-circle"></i>
                                        <span>{{ __('add_category') }}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('subjects.create')
                                <li>
                                    <a class="dropdown-item" href="{{ route('subjects.create') }}">
                                        <i class="las la-circle"></i>
                                        <span>{{ __('add_subject') }}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('tag.create')
                                <li>
                                    <a class="dropdown-item" href="{{ route('tag.index') }}">
                                        <i class="las la-tag"></i>
                                        <span>{{ __('add_tag') }}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('level.create')
                                <li>
                                    <a class="dropdown-item" href="{{ route('level.index') }}">
                                        <i class="las la-circle"></i>
                                        <span>{{ __('add_levels') }}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('students.create')
                                <li>
                                    <a class="dropdown-item" href="{{ route('students.create') }}">
                                        <i class="las la-user-graduate"></i>
                                        <span>{{ __('add_student') }}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('instructors.create')
                                <li>
                                    <a class="dropdown-item" href="{{ route('instructors.create') }}">
                                        <i class="las la-user-tie"></i>
                                        <span>{{ __('add_instructor') }}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('organizations.create')
                                <li>
                                    <a class="dropdown-item" href="{{ route('organizations.create') }}">
                                        <i class="las la-user-graduate"></i>
                                        <span>{{ __('add_organization') }}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('staffs.create')
                                <li>
                                    <a class="dropdown-item" href="{{ route('staffs.create') }}">
                                        <i class="las la-user"></i>
                                        <span>{{ __('add_staff') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('pages.create')
                                <li>
                                    <a class="dropdown-item" href="{{ route('pages.create') }}">
                                        <i class="las la-pager"></i>
                                        <span>{{ __('add_page') }}</span>
                                    </a>
                                </li>
                            @endcan

                            {{-- @can('packages.create')
                                <li>
                                    <a class="dropdown-item" href="{{ route('packages.create') }}">
                                        <i class="las la-money-bill-wave"></i>
                                        <span>{{ __('add_package') }}</span>
                                    </a>
                                </li>
                            @endcan --}}

                            @can('payouts.create')
                                <li>
                                    <a class="dropdown-item" href="{{ route('payouts.create') }}">
                                        <i class="las la-file-invoice-dollar"></i>
                                        <span>{{ __('add_payout') }}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('departments.index')
                                <li>
                                    <a class="dropdown-item" href="{{ route('departments.index') }}">
                                        <i class="las la-circle"></i>
                                        <span>{{ __('add_department') }}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('coupons.create')
                                <li>
                                    <a class="dropdown-item" href="{{ route('coupons.create') }}">
                                        <i class="las la-circle"></i>
                                        <span>{{ __('add_coupon') }}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('tickets.create')
                                <li>
                                    <a class="dropdown-item" href="{{ route('tickets.create') }}">
                                        <i class="las la-headset"></i>
                                        <span>{{ __('add_ticket') }}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('blogs.create')
                                <li>
                                    <a class="dropdown-item" href="{{ route('blogs.create') }}">
                                        <i class="las la-blog"></i>
                                        <span>{{ __('add_blog') }}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('payouts.create')
                                <li>
                                    <a class="dropdown-item" href="{{ route('payouts.create') }}">
                                        <i class="las la-file-invoice-dollar"></i>
                                        <span>{{ __('payout_request') }}</span>
                                    </a>
                                </li>
                            @endcan

                            @if (addon_is_activated('accounts_system'))
                                @can('accounts.create')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('accounts.create') }}">
                                            <i class="las la-money-check"></i>
                                            <span>{{ __('add_account') }}</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('bank-accounts.create')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('bank-accounts.create') }}">
                                            <i class="las la-money-check"></i>
                                            <span>{{ __('add_bank_account') }}</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('incomes.create')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('incomes.create') }}">
                                            <i class="las la-dollar-sign"></i>
                                            <span>{{ __('add_income') }}</span>
                                        </a>
                                    </li>
                                @endcan
                            @endif

                            @can('success-stories.create')
                                <li>
                                    <a class="dropdown-item" href="{{ route('success-stories.create') }}">
                                        <i class="las la-user-graduate"></i>
                                        <span>{{ __('add_success_story') }}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('testimonials.create')
                                <li>
                                    <a class="dropdown-item" href="{{ route('testimonials.create') }}">
                                        <i class="las la-graduation-cap"></i>
                                        <span>{{ __('add_testimonial') }}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('brands.create')
                                <li>
                                    <a class="dropdown-item" href="{{ route('brands.create') }}">
                                        <i class="las la-circle"></i>
                                        <span>{{ __('add_brand') }}</span>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                </ul>
            </div>

            <div class="navbar-right-content">
                <ul class="d-flex align-items-center gap-lg-4 gap-sm-2">
                    <li class="visit-website">
                        <a href="{{ route('home') }}" target="_blank">
                            <i class="las la-globe-americas"></i>
                            <span class="icon-hover">{{ __('visit_website') }}</span>
                        </a>
                    </li>


                    <li class="visit-website dropdown notification">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="las la-bell"></i>
                            <span class="has_notification"></span>
                        </a>
                        @include('backend.layouts.package_subscribe')
                    </li>



                    <li class="select-language dropdown pe-lg-20">
                        @php
                            $active_locale = 'English';
                            $languages = app('languages');
                            $locale_language = $languages->where('locale', userLanguage())->first();
                            if ($locale_language) {
                                $active_locale = $locale_language->name;
                            }
                        @endphp
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $active_locale }}
                        </a>
                        <ul class="dropdown-menu popup-card">
                            @foreach ($languages as $language)
                                <li><a class="dropdown-item" href="{{ route('change.app.setting',['lang' => $language->locale])}}">
                                        <img src="{{ static_asset($language->flag ?: 'admin/img/flag/united-kingdom.svg') }}"
                                            alt="United Kingdom">{{ $language->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="dropdown pe-lg-20">
                        <a href="#" class="dropdown-toggle d-flex gap-12" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{ getFileLink('40x40', Auth::user()->images) }}" alt=""
                                class="user-avater">
                            <span class="user-name">{{ Auth::user()->first_name }}
                                {{ Auth::user()->last_name }}</span>
                            <span class="active_status"></span>
                        </a>
                        <ul class="dropdown-menu popup-card">
                            <li>
                                <a class="dropdown-item" href="{{ route('user.profile') }}">
                                    <i class="lar la-user-circle"></i>
                                    <span>{{ __('manage_profile') }}</span>
                                </a>
                            </li>
                            @if (Auth::check())
                                @if (auth()->user()->role_id == 1)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('user.password-change') }}">
                                            <i class="las la-shield-alt"></i>
                                            <span>{{ __('change_password') }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="javascript:void(0)"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        <i class="las la-sign-out-alt"></i>
                                        <span>{{ __('sign_out') }}</span>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
