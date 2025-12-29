<nav class="navbar navbar-top navbar-expand-lg bg-body-tertiary py-20 bg-white sticky-top">
    <div class="container-fluid g-5">
        <span class="sidebar-toggler">
            <span class="icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 6H3" stroke="#7E7F92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M21 12H3" stroke="#7E7F92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M18 18H3" stroke="#7E7F92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </span>
        </span>
        <a class="navbar-brand ms-auto d-none" href="{{ url('/') }}">
            <img src="{{ get_media('images/default/logo/logo-green-mini.png') }}" alt="Logo">
        </a>

        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="las la-ellipsis-v"></span>
        </button>
        <div class="collapse navbar-collapse navbar-content px-lg-20 navbar-respons" id="navbarScroll">

            <div class="navbar-left-content me-lg-auto d-flex align-items-center gap-20">
                <ul class="dashboard-btn d-flex align-items-center gap-lg-20 gap-sm-2">
                    @if(auth()->user()->user_type == 'admin')
                    <li class="dropdown add-new-page">
                        <a href="#"
                            class="dropdown-toggle d-flex align-items-center button-default default-circle-btn gap-2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="las la-plus"></i>
                            <span>{{ __('add_new') }}</span>
                        </a>
                        <ul class="dropdown-menu simplebar">
                            <li>
                                <a class="dropdown-item" href="{{ route('instructor.courses.create') }}">
                                    <i class="lab la-readme"></i>
                                    <span>{{ __('add_course') }}</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('instructor.instructors.create') }}">
                                    <i class="las la-user-tie"></i>
                                    <span>{{ __('add_instructor') }}</span>
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('instructor.students.create') }}">
                                    <i class="las la-user-graduate"></i>
                                    <span>{{ __('add_student') }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
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
                    <li class="visit-website dropdown     notification">
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
                            $locale_language = $languages->where('locale', app()->getLocale())->first();
                            if ($locale_language) {
                                $active_locale = $locale_language->name;
                            }
                        @endphp
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $active_locale }}
                        </a>
                        <ul class="dropdown-menu popup-card">
                            @foreach ($languages as $language)
                                <li><a class="dropdown-item" href="{{ setLanguageRedirect($language->locale) }}">
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
                                <a class="dropdown-item" href="{{ route('instructor.user.profile') }}">
                                    <i class="lar la-user-circle"></i>
                                    <span>{{ __('profile') }}</span>
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('instructor.tickets.create') }}">
                                    <i class="las la-question-circle"></i>
                                    <span>{{ __('need_help?') }}</span>
                                </a>
                            </li>
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
