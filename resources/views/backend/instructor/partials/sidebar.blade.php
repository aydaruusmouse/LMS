<header class="navbar-dark-v1">
    <div class="header-position">
        <span class="sidebar-toggler">
            <i class="las la-times"></i>
        </span>
        <div class="dashboard-logo d-flex justify-content-center align-items-center py-20">
            <a class="logo" href="{{ route('instructor.dashboard') }}">
                <img src="{{ setting('admin_logo') && @is_file_exists(setting('admin_logo')['original_image']) ? get_media(setting('admin_logo')['original_image']) : get_media('images/default/logo/logo-green-white.png') }}"
                    alt="Logo">
            </a>
            <a class="logo-icon" href="{{ route('instructor.dashboard') }}">
                <img src="{{ setting('admin_mini_logo') && @is_file_exists(setting('admin_mini_logo')['original_image']) ? get_media(setting('admin_mini_logo')['original_image']) : get_media('images/default/logo/logo-green-mini.png') }}"
                    alt="Logo">
            </a>
        </div>
        <nav class="side-nav">

            <ul>

                <li class="{{ menuActivation(['instructor'], 'active') }}">
                    <a href="{{ route('instructor.dashboard') }}" role="button" aria-expanded="false"
                        aria-controls="dashboard">
                        <i class="las la-tachometer-alt"></i>
                        <span>{{ __('dashboard') }}</span>
                    </a>
                </li>


                <li class="{{ menuActivation(['instructor/courses', 'instructor/courses/*'], 'active') }}">
                    <a class="" href="{{ route('instructor.courses.index') }}"> <i class="las la-book"></i>
                        <span>{{ __('my_courses') }}</span></a>
                </li>


                <li
                    class="{{ menuActivation(['instructor/students', 'instructor/students/*', 'instructor/students/create'], 'active') }}">
                    <a href="{{ route('instructor.students.index') }}">
                        <i class="las la-user-graduate"></i>
                        <span>{{ __('my_students') }}</span>
                    </a>
                </li>





                <li class="{{ menuActivation(['instructor/certificates*'], 'active') }}">
                    <a href="{{ route('instructor.certificates.index') }}"> <i class="las la-certificate"></i>
                        <span>{{ __('certificates') }}</span></a>
                </li>



                <li class="{{ menuActivation('instructor/media-library', 'active') }}">
                    <a href="{{ route('instructor.media-library.index') }}">
                        <i class="las la-images"></i>
                        <span>{{ __('media_library') }}</span>
                    </a>
                </li>




            </ul>
        </nav>
    </div>
</header>
